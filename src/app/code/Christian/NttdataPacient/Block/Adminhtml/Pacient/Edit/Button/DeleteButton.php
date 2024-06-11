<?php

namespace Christian\NttdataPacient\Block\Adminhtml\Pacient\Edit\Button;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\App\RequestInterface;

class DeleteButton implements ButtonProviderInterface
{
    /**
     * @param UrlInterface $urlBuilder
     * @param RequestInterface $request
     */
    public function __construct(
        private UrlInterface $urlBuilder,
        private RequestInterface $request
    ) {
    }

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Delete'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(\''
                . __('Are you sure you want to delete this promotion?')
                . '\', \'' . $this->getDeleteUrl() . '\')'
        ];
    }

    /**
     * @return void
     */
    public function getDeleteUrl()
    {
        return $this->urlBuilder->getUrl('nttdatapacient/*/delete', ['id' => $this->request->getParam('id')]);
    }
}
