<?php

namespace Christian\NttdataPacient\Controller\Ajax;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Christian\NttdataPacient\Model\PacientFactory;

class Save extends Action
{
    protected $resultJsonFactory;
    protected $pacientFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        PacientFactory $pacientFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pacientFactory = $pacientFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $data = $this->getRequest()->getPostValue();

            if (!empty($data)) {
                $pacient = $this->pacientFactory->create();
                $pacient->setData($data);
                $pacient->save();
                return $result->setData(['success' => true, 'message' => 'Paciente añadido correctamente']);
            } else {
                return $result->setData(['success' => false, 'message' => 'Datos no válidos']);
            }
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
