<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
  public function __construct(
    ContextInterface $context,
    UiComponentFactory $uiComponentFactory,
    protected UrlInterface $urlBuilder,
    array $components = [],
    array $data = []
  ) {
    parent::__construct($context, $uiComponentFactory, $components, $data);
  }

  public function prepareDataSource(array $dataSource): array
  {
    if (!isset($dataSource['data']['items'])) {
      return $dataSource;
    }

    foreach ($dataSource['data']['items'] as &$item) {
      if (!isset($item['id'])) {
        continue;
      }

      $item[$this->getData('name')] = [
        'edit' => [
          'href' => $this->urlBuilder->getUrl('nttdatapacient/pacient/edit', [
            'id' => $item['id'],
          ]),
          'label' => __('Edit'),
        ],
        'delete' => [
          'href' => $this->urlBuilder->getUrl('nttdatapacient/pacient/delete', [
            'id' => $item['id'],
          ]),
          'label' => __('Delete'),
          'confirm' => [
            'title' => __('Delete %1', $item['nombre']),
            'message' => __('Are you, sure you want to delete the "%1" record?', $item['nombre']),
          ],
        ],
      ];
    }

    return $dataSource;
  }
}
