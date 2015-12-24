<?php

class Magecheckout_DeliveryTime_Block_Checkout_Container extends Mage_Core_Block_Template
{
	public function getPosition()
	{
		return Mage::helper('deliverytime')->getPoisition();
	}

	protected function _toHtml()
	{
		return parent::_toHtml();
	}
}