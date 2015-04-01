<?php
class Refracter_Quickpic_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget
{
	
	var $token; 
	
	public function __construct()
    {
		define('__RemoteURL','http://stageapp-01.madisontech.com.au/quickpic/remote');
		$this->token = Mage::getStoreConfig('quickpic/remote'); 
		$this->token = json_decode($this->token,true); 
		$this->token = $this->token['token']; 
    }
    
    public function getImages()
    { 
			
		$productId  = (int) $this->getRequest()->getParam('id');
		
		$product = Mage::getModel('catalog/product')->load($productId); 
		
		$query = $product->getName();
		
		$_url = __RemoteURL . '/get?token='.$this->token.'&query=' . urlencode( $query );
		
		$json = file_get_contents( $_url );
		
		$data = json_decode($json,true); 
	
		return $data; 
		
    }
}