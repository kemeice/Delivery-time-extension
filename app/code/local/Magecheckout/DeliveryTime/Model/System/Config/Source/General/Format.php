<?php

class Magecheckout_DeliveryTime_Model_System_Config_Source_General_Format
{
	public function toOptionArray()
	{
		return array(
			'Y-m-d' => Mage::helper('deliverytime')->__('Year - Month - Day'),
			'd-m-Y' => Mage::helper('deliverytime')->__('Day - Month - Year'),
		);
	}
}