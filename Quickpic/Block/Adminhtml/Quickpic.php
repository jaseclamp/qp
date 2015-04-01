<?php
class Refracter_Quickpic_Block_Adminhtml_Quickpic extends Mage_Adminhtml_Block_Widget_Grid_Container
{
 
    public function __construct()
    {
	
		$this->_blockGroup = 'quickpic';
		$this->_controller = 'adminhtml_quickpic';
        $this->_headerText = Mage::helper('quickpic')->__('QuickPic');
        //$this->_addButtonLabel = Mage::helper('sales')->__('Create New Quote');
        parent::__construct();
        
        // Removing top button
        // Button is added to the grid view.
        $this->_removeButton('add');
        
    }
    
    public function getCreateUrl()
    { 
        return $this->getUrl('adminhtml/sales_order_create/start');
    }
}
