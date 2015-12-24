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

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create deliverytime table
 */
$installer->run("

  DROP TABLE IF EXISTS {$installer->getTable('magecheckout_deliverytime')};
  CREATE TABLE {$installer->getTable('magecheckout_deliverytime')} (
  `deliverytime_id` int(11) unsigned NOT NULL auto_increment,
  `delivery_date` varchar(255) NOT NULL default '',
  `time_start` varchar(255) NOT NULL default '',
  `time_end` varchar(255) NOT NULL default '',
  `order_id` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`deliverytime_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();

