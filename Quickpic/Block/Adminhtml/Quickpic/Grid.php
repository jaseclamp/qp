<?php

class Refracter_Quickpic_Block_Adminhtml_Quickpic_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
		parent::__construct();
		$this->setId('refracter_quickpic_grid');
		$this->setSaveParametersInSession(true);
		$this->setDefaultSort('increment_id');
		$this->setDefaultDir('desc');
    }
	
	//list out current products with no images
	protected function _prepareCollection()
    {

		
		$collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('name');
			
		$collection->addAttributeToSelect('thumbnail');
		
		$collection->addAttributeToFilter('image', array('eq' => 'no_selection'));
        
		//$collection->joinAttribute('image', 'catalog_product/image', 'entity_id', null, 'left');

		$this->setCollection($collection);
		return parent::_prepareCollection();
    }
    
    
    /*protected function  _prepareLayout()
    {        
        $this->setChild('priceupdate_deactivate_button',
          $this->getLayout()->createBlock('adminhtml/widget_button')
          ->setData(array(
            'label'     => Mage::helper('qquoteadv')->__('Create New Quote'),
            'onclick'   => 'setLocation(\'' . $this->getCreateQuoteUrl() . '\')',              
            'class' => 'add'
          ))
                
        );

        return parent::_prepareLayout();
    }*/


	protected function _prepareColumns()
	{         
		
		$this->addColumn('entity_id',
            array(
                'header'=> Mage::helper('catalog')->__('ID'),
                'width' => '50px',
                'type'  => 'number',
                'index' => 'entity_id',
        ));
		$this->addColumnAfter('thumbnail',
			array(
				'header'=> Mage::helper('catalog')->__('Thumbnail'),
				'index' => 'thumbnail',
				'type' => 'options',
				'frame_callback' => array($this, 'callback_image'),
				'options' => array('no_selection' => 'No', '1' => 'Yes')
		),'entity_id');
		
        /*$this->addColumn('image', array(
            'header' => Mage::helper('catalog')->__('Image'),
            'align' => 'left',
            'index' => 'image',
            'width'     => '70',
            'renderer' => 'Refracter_Quickpic_Block_Adminhtml_Quickpic_Thumbnail'
        ));*/ 
		
		$this->addColumn('name',
            array(
                'header'=> Mage::helper('catalog')->__('Name'),
				'width' => '50px',
                'index' => 'name',
        ));
		
		$this->addColumn('sku',
            array(
                'header'=> Mage::helper('catalog')->__('SKU'),
                'width' => '80px',
                'index' => 'sku',
        ));

		
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('catalog')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('catalog')->__('Get Pics'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

		$resturn = parent::_prepareColumns();
	
		return $return;
		
	}

	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('product');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'=> Mage::helper('catalog')->__('Get Pics'),
             'url'  => $this->getUrl('*/*/getpics')
        ));
       

        Mage::dispatchEvent('adminhtml_catalog_product_grid_prepare_massaction', array('block' => $this));
        return $this;
    }
	
	public function callback_image($value)
	{
		$width = 70;
		$height = 70;
		if($value=='No')
		{
			$value = 'http://placehold.it/'.$width.'/'.$height.'.png?text=No+Image';
			return "<img src='".$value."' width=".$width." height=".$height."/>";
		}
		return "<img src='".Mage::getBaseUrl('media').'catalog/product'.$value."' width=".$width." height=".$height."/>";
	}

	public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'store'=>$this->getRequest()->getParam('store'),
            'id'=>$row->getId())
        );
    }
	
}