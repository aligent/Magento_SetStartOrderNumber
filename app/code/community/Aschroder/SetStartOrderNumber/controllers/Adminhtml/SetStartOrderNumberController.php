<?php

/**
 * SetStartOrderNumber controller - for invoking the update from the UI. 
 *
 * @author Ashley Schroder (aschroder.com)
 */
class Aschroder_SetStartOrderNumber_Adminhtml_SetStartOrderNumberController
	extends Mage_Adminhtml_Controller_Action {

	public function indexAction() {
		echo "No default action on index";
	}
	
	public function updateAction() {
		
		Mage::log("Running update for Aschroder_SetStartOrderNumber...");
		
		$collection = Mage::getModel('eav/entity_type')->getCollection();
		$override = Mage::helper('setstartordernumber')->isOverrideEnabled();
		
		$store = $this->getRequest()->getParam('website');
		if (!$store) {
			//in some cases store id 1 is not present so use first non-default store in that case

			//get store ids
			$aStoreIds = array_keys(Mage::app()->getStores(false, false));
			sort($aStoreIds);
			$storeID = current($aStoreIds);
		} else {
			$storeID = Mage::app()->getWebsite($store)->getId();
		}
		
		$objects = array(
		'order' => Mage::helper('setstartordernumber')->getOrderNumber($storeID),
		'invoice' => Mage::helper('setstartordernumber')->getInvoiceNumber($storeID),
		'shipment' => Mage::helper('setstartordernumber')->getShipmentNumber($storeID),
		'creditmemo' => Mage::helper('setstartordernumber')->getCreditNumber($storeID));
		
		foreach ($collection->getItems() as $item) {
			
			if(isset($objects[$item->getEntityTypeCode()]) && 
				$new_number = $objects[$item->getEntityTypeCode()]) {
				
				// This is one of the entities we care about and we have a value for it.
				$store = Mage::getModel('eav/entity_store')->loadByEntityStore($item->getEntityTypeId(), $storeID);
                $iPrefixLength=(int)strip_tags(Mage::helper('setstartordernumber')->getPrefixLength($storeID));
				if ($store && $store->getId()) {
					
					// already exists - check it's lower 
					// (unless some expert user has elected to override...)
					if($override || $store->getIncrementLastId() < $new_number) {
						
						$old = $store->getIncrementLastId();
						$store->setIncrementPrefix(substr($new_number."",0,$iPrefixLength));
						$store->setIncrementLastId($new_number);
						$store->save();
						$this->_getSession()->addSuccess(
									"Updated: " . $item->getEntityTypeCode() . 
									" from " . $old . 
									" to " .  $new_number ); 
					        
						
					} else {
						
						$this->_getSession()->addError(
									"Skipped: " . $item->getEntityTypeCode() . 
									" because " . $store->getIncrementLastId() . 
									" is greater than or equal to " .  $new_number . 
									" (and you are not in override mode)"); 
					}
					
				} else {
					
					// None exists yet insert one
					$store->setEntityTypeId($item->getEntityTypeId());
					$store->setStoreId($storeID);
					$store->setIncrementPrefix(substr($new_number."",0,$iPrefixLength));
					$store->setIncrementLastId($new_number);
					$store->save();
					$this->_getSession()->addSuccess(
									"Inserted new value for: " . $item->getEntityTypeCode() . 
									" of " .  $new_number ); 
				}
				
			}
		}
		
		$this->_redirectReferer();
	}
} 
