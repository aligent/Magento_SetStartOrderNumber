<?php

/**
 * Various Helper functions for the SetStartOrderNumber module
 *
 * @author Ashley Schroder (aschroder.com)
 */

class Aschroder_SetStartOrderNumber_Helper_Data extends Mage_Core_Helper_Abstract {

	public function getOrderNumber() {
		return Mage::getStoreConfig('sales/setstartordernumber/order');
	}
	public function getInvoiceNumber() {
		return Mage::getStoreConfig('sales/setstartordernumber/invoice');
	}
	public function getShipmentNumber() {
		return Mage::getStoreConfig('sales/setstartordernumber/shipment');
	}
	public function getCreditNumber() {
		return Mage::getStoreConfig('sales/setstartordernumber/credit');
	}
	public function isOverrideEnabled() {
		return Mage::getStoreConfig('sales/setstartordernumber/override');
	}
	public function getDisablePadding() {
		return Mage::getStoreConfig('sales/setstartordernumber/disable_padding');
	}
	public function getDisablePrefix() {
		return Mage::getStoreConfig('sales/setstartordernumber/disable_prefix');
	}
	public function getExtraIncrement() {
		return Mage::getStoreConfig('sales/setstartordernumber/extra_increment');
	}
	
}
