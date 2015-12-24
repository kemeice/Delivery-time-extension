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
 * Deliverytime Resource Model
 * 
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_Model_Mysql4_Deliverytime extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('deliverytime/deliverytime', 'deliverytime_id');
    }
}