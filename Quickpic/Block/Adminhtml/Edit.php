<?php
class Refracter_Quickpic_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget
{
	
	public function __construct()
    {
		define('__RemoteURL','http://stageapp-01.madisontech.com.au/quickpic/remote/get');
		$token = Mage::getStoreConfig('quickpic/remote'); 
		$token = json_decode($token,true); 
		$token = $token['token']; 
    }
    
    public function getImages()
    { 
			
		$productId = $this->getVar('id'); 
		$product = Mage::getModel('catalog/product')->load($productId); 
		
		$query = $product->getName();
		
		$json = file_get_contents( __RemoteURL . '?token='.$token.'query=' . urlencode( $query ) );
		
		$data = json_decode($json,true); 
	
		return $data; 
		
    }
}