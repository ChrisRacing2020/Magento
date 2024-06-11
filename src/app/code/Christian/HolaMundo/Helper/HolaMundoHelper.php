<?php

namespace Christian\HolaMundo\Helper;

use Christian\HolaMundo\Model\Resource\HolaMundo\CollectionFactory as HolaMundoCollectionFactory;
use Christian\HolaMundo\Model\HolaMundoFactory;
use Magento\Framework\App\Helper\AbstractHelper;

class HolaMundoHelper extends AbstractHelper {

    protected $_holaMundoCollectionFactory;
    protected $_holaMundoFactory;

    public function __construct(
        HolaMundoCollectionFactory $_holaMundoCollectionFactory,
        HolaMundoFactory $_holaMundoFactory
    ){
        $this->_holaMundoCollectionFactory = $_holaMundoCollectionFactory;
        $this->_holaMundoFactory = $_holaMundoFactory;

    }

    public function updateHolaMundo($option,$value, $id = ''){
        $holaMundo = $this->_holaMundoFactory->create();
        //var_dump($holamundo);
        //die();
        $holaMundo->setData(
            array('value' => $value,
                'option' => $option)
        );
        $holaMundo->save();
    }


}