<?php

namespace Christian\NttdataPacient\Controller\Adminhtml\Pacient;

use Christian\NttdataPacient\Model\Pacient;
use Christian\NttdataPacient\Model\PacientFactory;
use Christian\NttdataPacient\Model\ResourceModel\Pacient as PacientResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Christian_NttdataPacient::pacient_save';

    /**
     * @param Context $context
     * @param PacientFactory $pacientFactory
     * @param PacientResource $pacientResource
     */
    public function __construct(
        Context             $context,
        private PacientFactory $pacientFactory,
        private PacientResource $pacientResource
    )
    {
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $post = $this->getRequest()->getPost();
        $isExistingPost = $post->id;

        /** @var Pacient $pacient */
        $pacient = $this->pacientFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($isExistingPost) {
            try {
                $this->pacientResource->load($pacient, $post->id);

                if (!$pacient->getData('id')) {
                    throw new NotFoundException(__('This record no longer exists.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath('*/*/');
            }
        } else {
            // If new, build an object with the posted data to save it
            unset($post->id);
        }
        $pacient->setData(array_merge($pacient->getData(), $post->toArray()));

        try {
            $this->pacientResource->save($pacient);
            $this->messageManager->addSuccessMessage(__('The record has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the record.'));
            return $redirect->setPath('*/*/');
        }

        // On success, redirect back to the admin grid
        return $redirect->setPath('*/*/index');
    }
}
