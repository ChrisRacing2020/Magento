<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Model\ResourceModel\Pacient;

use Christian\NttdataPacient\Model\Pacient;
use Christian\NttdataPacient\Model\ResourceModel\Pacient as ResourceModelPacient;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
  protected function _construct()
  {
    $this->_init(Pacient::class, ResourceModelPacient::class);
  }
}