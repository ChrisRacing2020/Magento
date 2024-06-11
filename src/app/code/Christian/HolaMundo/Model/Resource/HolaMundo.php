<?php

namespace Christian\HolaMundo\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class HolaMundo extends AbstractDb{

    public function _construct()
    {
        $this->_init('christian_holamundo','entity_id');
    }
    public function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        return parent::_beforeSave($object);
    }
    public function _beforeDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        return parent::_beforeDelete($object);
    }
}
