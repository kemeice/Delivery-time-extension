<?php

class Magecheckout_DeliveryTime_Model_Deliverytime extends Mage_Core_Model_Abstract
{
	const BEFORE_SHIPPING = 0;
	const AFTER_SHIPPING = 1;

	public function _construct()
	{
		parent::_construct();
		$this->_init('deliverytime/deliverytime');
	}
}