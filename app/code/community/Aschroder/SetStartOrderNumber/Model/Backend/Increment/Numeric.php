<?php
/**
 * Custom increment logic
 * 
 * We change only two parent class functions to:
 * 1) Allow padding to be disabled
 * 2) Choose an increment amount (default 1)
 * 3) Allow prefix to be disabled
 * 
 * @author Ashley Schroder (aschroder.com)
 */

class Aschroder_SetStartOrderNumber_Model_Backend_Increment_Numeric
    extends Mage_Eav_Model_Entity_Increment_Abstract {
    	
    	
    public function format($id) {
    	
    	// If we are not using a prefix, we do not assign it
    	if ($disable_prefix = Mage::helper('setstartordernumber')->getDisablePrefix()) {
	        $result = "";
        } else {
	        $result = $this->getPrefix();
        }
        
        if ($disable_padding = Mage::helper('setstartordernumber')->getDisablePadding()) {
        	$result.= (string)$id;
        } else {
	        $result.= str_pad((string)$id, $this->getPadLength(), $this->getPadChar(), STR_PAD_LEFT);
        }
        return $result;
    }
    
    public function getNextId() {
    	
        $last = $this->getLastId();
        $disable_prefix = Mage::helper('setstartordernumber')->getDisablePrefix();
        
        // If we are using prefixes AND this id starts with a prefix, then strip it off before we increment.
        if (!$disable_prefix && strpos($last, $this->getPrefix())===0) {
        	
            $last = (int)substr($last, strlen($this->getPrefix()));
        } else {
        	
            $last = (int)$last;
        }
        
        if ($extra_increment = Mage::helper('setstartordernumber')->getExtraIncrement()) {
	        $next = $last+$extra_increment;
        } else {
	        $next = $last+1;
        }
        
        return $this->format($next);
    }
}
