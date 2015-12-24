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
 * Deliverytime Edit Tabs Block
 * 
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('deliverytime_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('deliverytime')->__('Item Information'));
    }
    
    /**
     * prepare before render block to html
     *
     * @return Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Edit_Tabs
     */
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('deliverytime')->__('Item Information'),
            'title'     => Mage::helper('deliverytime')->__('Item Information'),
            'content'   => $this->getLayout()
                                ->createBlock('deliverytime/adminhtml_deliverytime_edit_tab_form')
                                ->toHtml(),
        ));
        $this->_updateActiveTab();
        return parent::_beforeToHtml();
    }
    protected function _updateActiveTab()
    {
        $tabId = $this->getRequest()->getParam('tab');
        if ($tabId) {
            $tabId = preg_replace("#{$this->getId()}_#", '', $tabId);
            if ($tabId) {
                $this->setActiveTab($tabId);
            }
        }
    }
}