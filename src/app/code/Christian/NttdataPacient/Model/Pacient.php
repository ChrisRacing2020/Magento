<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Model;

use  Christian\NttdataPacient\Model\ResourceModel\Pacient as ResourceModelPacient;
use Magento\Framework\Model\AbstractModel;

class Pacient extends AbstractModel
{
  protected function _construct()
  {
    $this->_init(ResourceModelPacient::class);
  }
}