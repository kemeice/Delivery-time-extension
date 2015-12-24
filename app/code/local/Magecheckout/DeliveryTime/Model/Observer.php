<?php
/**
 * Magegiant
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magegiant.com license that is
 * available through the world-wide-web at this URL:
 * http://magegiant.com/license-agreement/
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @copyright   Copyright (c) 2015 Magegiant (http://magegiant.com/)
 * @license     http://magegiant.com/license-agreement/
 */

/**
 * DeliveryTime Observer Model
 *
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_Model_Observer
{
	public function checkoutControllerOnepageSaveShippingMethod($observer)
	{
		$request = $observer->getEvent()->getRequest();
		if (!$this->_isEnable())
			return $this;
		if ($request->getPost('date-picker')) {
			$datePost    = $request->getPost('date-picker');
			$rangePost   = $request->getPost('time-range');
			$configRange = Mage::helper('deliverytime')->getRange();
			if (!$configRange)
				return $this;
			$range = $configRange[$rangePost];


			$data = array(
				'delivery_date' => $datePost,
				'time_start'    => $range['start'],
				'time_end'      => $range['end'],
			);
			Mage::getSingleton('checkout/session')->setData('delivery_time_data', $data);
		}

		return $this;
	}

	/**
	 * process controller_action_predispatch event
	 *
	 * @return Magecheckout_DeliveryTime_Model_Observer
	 */
	protected function _isEnable()
	{
		return Mage::helper('deliverytime')->isEnabled();
	}

	public function checkoutSubmitAllAfter($observer)
	{
		$event = $observer->getEvent();
		if (!$event)
			return $this;
		if (!$this->_isEnable())
			return $this;
		$order = $event->getOrder();
		if (!Mage::getSingleton('checkout/session')->getData('delivery_time_data'))
			return $this;
		$deliveryData = Mage::getSingleton('checkout/session')->getData('delivery_time_data');
		if (!is_array($deliveryData)) {
			$deliveryData = array();
		}
		if (!$order || !$order->getId())
			return $this;

		$data  = array(
			'delivery_date' => $deliveryData['delivery_date'],
			'time_start'    => $deliveryData['time_start'],
			'time_end'      => $deliveryData['time_end'],
			'order_id'      => $order->getId()
		);
		$model = Mage::getModel('deliverytime/deliverytime');
		$model->setData($data)->save();

	}

	/*
	 *
	 * Secured checkout
	 */
	public function controllerActionLayoutLoadAfter($observer)
	{
		$event = $observer->getEvent();
		if (!$event)
			return $this;
		if (!$this->_isEnable())
			return $this;
		$fullActionName = $event->getAction()->getFullActionName();
		$layout = $event->getLayout();
		if ($fullActionName === 'securedcheckout_index_index'
			|| $fullActionName === 'securedcheckout_checkout_saveAddressTrigger'
			|| $fullActionName === 'securedcheckout_checkout_ajaxCartItem'
		) {
			$layout->getUpdate()->addHandle('deliverytime_osc');
		}

		return $this;
	}

	public function securedcheckoutSaveOrderSessionDataAfter($observer)
	{
		Mage::getSingleton('core/session')->setData('delivery_time_current_data', null);

		return $this;
	}
}