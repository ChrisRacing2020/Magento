<?php

declare(strict_types=1);

namespace Caraque\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends Action implements HttpGetActionInterface
{
  const ADMIN_RESOURCE = 'Caraque_Minerva::faq_save';

  /** @var PageFactory */
  protected $pageFactory;

  /**
   * Index constructor.
   * @param Context $context
   * @param PageFactory $pageFactory
   */
  public function __construct(
    Context $context,
    PageFactory $pageFactory
  ) {
    parent::__construct($context);
    $this->pageFactory = $pageFactory;
  }

  /**
   * @return Page
   */
  public function execute(): Page
  {
    $page = $this->pageFactory->create();
    $page->setActiveMenu('Caraque_Minerva::faq');
    $page->getConfig()->getTitle()->prepend(__('New FAQ'));

    return $page;
  }
}
