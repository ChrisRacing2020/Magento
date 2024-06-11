<?php

namespace Christian\HolaMundo\Model;

use Magento\Framework\Model\AbstractModel;

class HolaMundo extends AbstractModel{

    public function _construct()
    {
        $this->_init(
            'Christian\HolaMundo\Model\Resource\HolaMundo'
        );
    }

}
