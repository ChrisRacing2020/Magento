<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Controller\Adminhtml\Pacient;

use Christian\NttdataPacient\Model\Pacient;
use Christian\NttdataPacient\Model\PacientFactory;
use Christian\NttdataPacient\Model\ResourceModel\Pacient as ResourceModelPacient;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action implements HttpGetActionInterface
{
  const ADMIN_RESOURCE = 'Christian_NttdataPacient::pacient_delete';


  /**
   * Edit constructor
   * @param Context $context
   * @param PageFactory $pageFactory
   * @var PacientFactory $pacientFactory
   * @var ResourceModelPacient $pacientResource
   */
  public function __construct(
    Context $context,
    protected PageFactory $pageFactory,
    protected PacientFactory $pacientFactory,
    protected ResourceModelPacient $pacientResource
  ) {
    parent::__construct($context);
  }

  /**
   * @return Page
   */
  public function execute(): Redirect
  {
    try {
      $id = $this->getRequest()->getParam('id');
      /** @var Faq $faq */
      $pacient = $this->pacientFactory->create();
      $this->pacientResource->load($pacient, $id);
      if ($pacient->getId()) {
        $this->pacientResource->delete($pacient);
        $this->messageManager->addSuccessMessage(__('The record has been deleted'));
      } else {
        $this->messageManager->addErrorMessage(__('The record does not exist.'));
      }
    } catch (\Exception $e) {
      $this->messageManager->addErrorMessage($e->getMessage());
    }

    /** @var Redirect $redirect */
    $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

    return $redirect->setPath('*/*');
  }
}
