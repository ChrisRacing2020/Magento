<?php

namespace Christian\NttdataPacient\Block\Frontend;

use Magento\Framework\View\Element\Template;
use Christian\NttdataPacient\Model\ResourceModel\Pacient\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;

class Demo extends Template
{
    protected $collectionFactory;

    public function __construct(Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getMessage()
    {
        return 'ejemplo2';
    }

    public function getPacientes()
    {
        $collection = $this->collectionFactory->create();
        $pacientes = [];

        foreach ($collection as $pacient) {
            $pacientes[] = [
                'NIF' => $pacient->getData('NIF'), // Ajusta esto según el campo correcto
                'nombre' => $pacient->getData('nombre'),
                'apellidos' => $pacient->getData('apellidos'), 
                'telefono' => $pacient->getData('telefono'), 
                'correo' => $pacient->getData('correo'),  
                'localidad' => $pacient->getData('localidad'),  

            ];
        }

        return json_encode($pacientes);
    }
}
