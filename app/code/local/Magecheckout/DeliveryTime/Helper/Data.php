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
 * DeliveryTime Helper
 *
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_Helper_Data extends Mage_Core_Helper_Abstract
{
	const XML_PATH_ENABLED = 'deliverytime/general/is_enabled';
	const XML_PATH_GENERAL_CONFIG = 'deliverytime/general/';
	const XML_PATH_TIME_CONFIG = 'deliverytime/time/';


	public function isEnabled($storeId = null)
	{
		if (!$storeId) {
			$storeId = Mage::app()->getStore()->getId();
		}

		return Mage::getStoreConfig(self::XML_PATH_ENABLED, $storeId);
	}

	public function getPoisition()
	{
		return $this->getGeneralConfig('position');
	}

	public function getGeneralConfig($name, $storeId = null)
	{
		if (!$storeId) {
			$storeId = Mage::app()->getStore()->getId();
		}

		return Mage::getStoreConfig(self::XML_PATH_GENERAL_CONFIG . $name, $storeId);

	}

	public function getDateFormat()
	{
		return $this->getGeneralConfig('format');
	}

	public function getWeekDays()
	{
		return $this->getTimeConfig('days');
	}

	public function getTimeConfig($name, $storeId = null)
	{
		if (!$storeId) {
			$storeId = Mage::app()->getStore()->getId();
		}

		return Mage::getStoreConfig(self::XML_PATH_TIME_CONFIG . $name, $storeId);

	}

	public function getSpecifyDays()
	{
		return $this->getTimeConfig('holidays');
	}

	public function getRange()
	{
		return unserialize($this->getTimeConfig('range'));
	}
}