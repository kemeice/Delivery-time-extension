<?php

class Magecheckout_DeliveryTime_Model_System_Config_Source_General_Position
{
	public function toOptionArray()
	{
		return array(
			'0' => Mage::helper('deliverytime')->__('Before Shipping Method'),
			'1' => Mage::helper('deliverytime')->__('After Shipping Method'),
		);
	}
}