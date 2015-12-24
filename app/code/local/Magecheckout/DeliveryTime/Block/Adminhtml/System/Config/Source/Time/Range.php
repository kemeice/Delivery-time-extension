<?php

class Magecheckout_DeliveryTime_Block_Adminhtml_System_Config_Source_Time_Range extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
	public function __construct()
	{
		$this->addColumn('start', array(
			'label' => Mage::helper('deliverytime')->__('Time Start'),
			'style' => 'width:150px',
		));
		$this->addColumn('end', array(
			'label' => Mage::helper('deliverytime')->__('Time End'),
			'style' => 'width:150px',
		));
		$this->_addAfter       = false;
		$this->_addButtonLabel = Mage::helper('deliverytime')->__('Add Range');
		parent::__construct();
	}
}
