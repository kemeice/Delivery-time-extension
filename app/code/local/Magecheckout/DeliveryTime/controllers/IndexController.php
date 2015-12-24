<?php
/**
 * Magegiant
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the magegiant.com license that is
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
 * DeliveryTime Index Controller
 *
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_IndexController extends Mage_Core_Controller_Front_Action
{
	/**
	 * index action
	 */
	public function saveDataAction()
	{
		if ($this->getRequest()->isPost()) {
			$date  = $this->getRequest()->getParam('date');
			$range = $this->getRequest()->getParam('range');
			$data  = array(
				'date'  => $date,
				'range' => $range,
			);
			Mage::getSingleton('core/session')->setData('delivery_time_current_data', $data);
		}

	}
}