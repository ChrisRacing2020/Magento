<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Controller\Adminhtml\Pacient;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action implements HttpGetActionInterface
{
  const ADMIN_RESOURCE = 'Christian_NttdataPacient::pacient_save';

  
  /**
   * Edit constructor
   * @param Context $context
   * @param PageFactory $pageFactory
   */
  public function __construct(
    Context $context,
    protected PageFactory $pageFactory
  ) {
    parent::__construct($context);
  }

  /**
   * @return Page
   */
  public function execute(): Page
  {
    $page = $this->pageFactory->create();
    $page->setActiveMenu('Christian_NttdataPacient::pacient');
    $page->getConfig()->getTitle()->prepend(__('Edit Pacient'));

    return $page;
  }
}