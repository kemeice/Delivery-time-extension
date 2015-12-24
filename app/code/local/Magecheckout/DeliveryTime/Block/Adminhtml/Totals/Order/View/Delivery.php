<?php

class Magecheckout_DeliveryTime_Block_Adminhtml_Totals_Order_View_Delivery
	extends Mage_Adminhtml_Block_Template
{
	public function _construct()
	{
		parent::_construct();
		$this->setTemplate('magecheckout/deliverytime/totals/order/view/delivery.phtml');
	}
}