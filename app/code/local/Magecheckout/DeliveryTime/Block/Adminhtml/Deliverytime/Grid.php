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
 * Deliverytime Grid Block
 * 
 * @category    Magegiant
 * @package     Magegiant_DeliveryTime
 * @author      Magegiant Developers
 */
class Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('deliverytimeGrid');
        $this->setDefaultSort('deliverytime_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    
    /**
     * prepare collection for block to display
     *
     * @return Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('deliverytime/deliverytime')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    /**
     * prepare columns for this grid
     *
     * @return Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('deliverytime_id', array(
            'header'    => Mage::helper('deliverytime')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'deliverytime_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('deliverytime')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));

        $this->addColumn('content', array(
            'header'    => Mage::helper('deliverytime')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('deliverytime')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'        => 'options',
            'options'     => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action',
            array(
                'header'    =>    Mage::helper('deliverytime')->__('Action'),
                'width'        => '100',
                'type'        => 'action',
                'getter'    => 'getId',
                'actions'    => array(
                    array(
                        'caption'    => Mage::helper('deliverytime')->__('Edit'),
                        'url'        => array('base'=> '*/*/edit'),
                        'field'        => 'id'
                    )),
                'filter'    => false,
                'sortable'    => false,
                'index'        => 'stores',
                'is_system'    => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('deliverytime')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('deliverytime')->__('XML'));

        return parent::_prepareColumns();
    }
    
    /**
     * prepare mass action for this grid
     *
     * @return Magecheckout_DeliveryTime_Block_Adminhtml_Deliverytime_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('deliverytime_id');
        $this->getMassactionBlock()->setFormFieldName('deliverytime');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'        => Mage::helper('deliverytime')->__('Delete'),
            'url'        => $this->getUrl('*/*/massDelete'),
            'confirm'    => Mage::helper('deliverytime')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('deliverytime/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('deliverytime')->__('Change status'),
            'url'    => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name'    => 'status',
                    'type'    => 'select',
                    'class'    => 'required-entry',
                    'label'    => Mage::helper('deliverytime')->__('Status'),
                    'values'=> $statuses
                ))
        ));
        return $this;
    }
    
    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}