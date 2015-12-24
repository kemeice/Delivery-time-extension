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
 * Deliverytime Edit Block
 * 
 * @category     Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    const PAGE_TABS_BLOCK_ID = 'deliverytime_tabs';
    public function __construct()
    {
        parent::__construct();
        
        $this->_objectId = 'id';
        $this->_blockGroup = 'deliverytime';
        $this->_controller = 'adminhtml_deliverytime';
        
        $this->_updateButton('save', 'label', Mage::helper('deliverytime')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('deliverytime')->__('Delete Item'));
        
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit(\'' . $this->_getSaveAndContinueUrl() . '\')',
            'class'        => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('deliverytime_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'deliverytime_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'deliverytime_content');
            }

            function saveAndContinueEdit(urlTemplate){
                var urlTemplateSyntax = /(^|.|\\r|\\n)({{(\\w+)}})/;
                var template = new Template(urlTemplate, urlTemplateSyntax);
                var url = template.evaluate({tab_id:" . self::PAGE_TABS_BLOCK_ID . "JsTabs.activeTab.id});
                editForm.submit(url);
            }
        ";
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', array(
            '_current'   => true,
            'back'       => 'edit',
            'tab'        => '{{tab_id}}',
            'active_tab' => null
        ));
    }
    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('deliverytime_data')
            && Mage::registry('deliverytime_data')->getId()
        ) {
            return Mage::helper('deliverytime')->__("Edit Item '%s'",
                                                $this->htmlEscape(Mage::registry('deliverytime_data')->getTitle())
            );
        }
        return Mage::helper('deliverytime')->__('Add Item');
    }
}