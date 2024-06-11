<?php

namespace Christian\HolaMundo\Block;

use Magento\Framework\View\Element\Template;
use Christian\HolaMundo\Model\HolaMundoFactory;
use Christian\HolaMundo\Model\Resource\HolaMundo\CollectionFactory as HolaMundoCollectionFactory;
use Christian\HolaMundo\Helper\HolamundoHelper;

class Demo extends Template{
    
    protected $_holaMundoFactory;

    protected $_holaMundoCollectionFactory;

    protected $_holaMundoHelper;

    public function __construct(
        HolaMundoHelper $_holaMundoHelper,
        HolaMundoCollectionFactory $_holaMundoCollectionFactory,
        HolaMundoFactory $_holaMundoFactory,
        Template\Context $context,
        array $data = [])
    {
        $this->_holaMundoHelper = $_holaMundoHelper;
        $this->_holaMundoCollectionFactory = $_holaMundoCollectionFactory;
        $this->_holaMundoFactory = $_holaMundoFactory;
        parent::__construct($context,$data);
    }



    public function getHolaMundo(){
        $holaMundo = $this->_holaMundoFactory->create();
         $result = $holaMundo->load(1);
        return $holaMundo;
    }
    /*public function getHolaMundoCollection(){
        $collection = $this->_holaMundoCollectionFactory->create()->load();
        if(!empty($collection)){
            foreach($collection as $object){
                try{
                    $object->setValue('nuevo value');
                    $object->setOption('nuevo option');
                    $object->save();
                }catch(\Exception $e){
                    echo $e->getMessage();
                }
            }
        }
        return $this->_holaMundoHelper->updateHolaMundo('option3','value3');
    }*/
}