<?php

namespace Christian\HolaMundo\Model\Resource\HolaMundo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{

    public function _construct()
    {
        $this->_init(
            'Christian\HolaMundo\Model\HolaMundo',
            'Christian\HolaMundo\Model\Resource\HolaMundo'
        );
    }

}
