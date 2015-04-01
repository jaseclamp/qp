<?php
class Refracter_Quickpic_Adminhtml_QuickpicController extends Mage_Adminhtml_Controller_Action
{

   public function indexAction() {
       
        $this->loadLayout();
        
		//$block = $this->getLayout()->createBlock('core/text', 'green-block')->setText('<h1>Tests</h1>');
        //$this->_addContent($block);
        
		$this->_addContent($this->getLayout()->createBlock('quickpic/adminhtml_quickpic'));
		
		$this->_setActiveMenu('catalog/quickpic_menu');
		$this->_addBreadcrumb(Mage::helper('adminhtml')->__('QuickPic'), Mage::helper('adminhtml')->__('QuickPic'));
		
		$this->renderLayout();      
    }
	
	public function editAction() {
       
        $this->loadLayout();
		
		$this->_setActiveMenu('catalog/quickpic_menu');
		
		$this->_addBreadcrumb(Mage::helper('adminhtml')->__('QuickPic'), Mage::helper('adminhtml')->__('QuickPic'));
		
		$this->renderLayout();      
    }
	
	public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('refracter_quickpic/adminhtml_quickpic_grid')->toHtml()
        );
    }
    
}
