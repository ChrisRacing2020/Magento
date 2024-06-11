<?php declare(strict_types=1);

namespace Christian\NttdataPacient\Controller\Adminhtml\Pacient;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Christian\NttdataPacient\Model\Pacient;
use Christian\NttdataPacient\Model\PacientFactory;
use Christian\NttdataPacient\Model\ResourceModel\Pacient as PacientResource;

class InlineEdit extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Christian_NttdataPacient::pacient_save';

    public function __construct(
        Context $context,
        protected JsonFactory $jsonFactory,
        protected PacientFactory $pacientFactory,
        protected PacientResource $pacientResource
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $json = $this->jsonFactory->create();
        $messages = [];
        $error = false;
        $isAjax = $this->getRequest()->getParam('isAjax', false);
        $items = $this->getRequest()->getParam('items', []);

        if (!$isAjax || !count($items)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        }

        if (!$error) {
            foreach ($items as $item) {
                $id = $item['id'];
                try {
                    /** @var Pacient $pacient */
                    $pacient = $this->pacientFactory->create();
                    $this->pacientResource->load($pacient, $id);
                    $pacient->setData(array_merge($pacient->getData(), $item));
                    $this->pacientResource->save($pacient);
                } catch (\Exception $e) {
                    $messages[] = __("Something went wrong while saving item $id");
                    $error = true;
                }
            }
        }

        return $json->setData([
            'messages' => $messages,
            'error' => $error,
        ]);
    }
}