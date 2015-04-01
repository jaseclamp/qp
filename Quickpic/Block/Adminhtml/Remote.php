<?php
class Refracter_Quickpic_Block_Adminhtml_Remote extends Mage_Adminhtml_Block_Widget
{
	
	public function __construct()
    {
		define('__RemoteURL','http://stageapp-01.madisontech.com.au/quickpic/remote');
    }
    
    public function getRemoteData()
    { 
			
		$json = Mage::getStoreConfig('quickpic/remote'); 
		
		if(!$json)
		{
			$config = new Mage_Core_Model_Config();
			$json = file_get_contents( __RemoteURL );
			$config->saveConfig('quickpic/remote', $json, 'default', 0);
		}

		$data = json_decode($json,true); 
	
		return $data; 
		
    }
}