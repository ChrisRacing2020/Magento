<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Controller\Adminhtml\Pacient;

use Christian\NttdataPacient\Model\ResourceModel\Pacient as PacientResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Christian\NttdataPacient\Model\ResourceModel\Pacient\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action implements HttpPostActionInterface
{
  const ADMIN_RESOURCE = 'Christian_NttdataPacient::pacient_delete';

  public function __construct(
    Context $context,
    protected CollectionFactory $collectionFactory,
    protected Filter $filter,
    protected PacientResource $pacientResource
  ) {
    parent::__construct($context);
  }

  public function execute(): Redirect
  {
    $collection = $this->collectionFactory->create();
    $items = $this->filter->getCollection($collection);
    $itemsSize = $items->getSize();
   
    $recordDeleted=0;
            foreach ($collection as $item) {
                $deleteItem = $this->_objectManager->get('Christian\NttdataPacient\Model\Pacient')->load($item->getId());
                $deleteItem->delete();
                $recordDeleted++;
            }


    $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $itemsSize));

    /** @var Redirect $redirect */
    $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

    return $redirect->setPath('*/*');
  }
}
