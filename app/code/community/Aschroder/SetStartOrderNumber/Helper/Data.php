<?php

/**
 * Various Helper functions for the SetStartOrderNumber module
 *
 * @author Ashley Schroder (aschroder.com)
 */

class Aschroder_SetStartOrderNumber_Helper_Data extends Mage_Core_Helper_Abstract {

	public function getOrderNumber($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/order',$iStoreId);
	}
	public function getInvoiceNumber($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/invoice',$iStoreId);
	}
	public function getShipmentNumber($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/shipment',$iStoreId);
	}
	public function getCreditNumber($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/credit',$iStoreId);
	}
	public function isOverrideEnabled($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/override',$iStoreId);
	}
	public function getDisablePadding($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/disable_padding',$iStoreId);
	}
	public function getDisablePrefix($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/disable_prefix',$iStoreId);
	}
	public function getExtraIncrement($iStoreId=null) {
		return Mage::getStoreConfig('sales/setstartordernumber/extra_increment',$iStoreId);
	}
    public function getPrefixLength($iStoreId=null){
        return Mage::getStoreConfig('sales/setstartordernumber/prefix_length',$iStoreId);
    }
	
}
