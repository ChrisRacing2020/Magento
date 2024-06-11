<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Ui\DataProvider;

use Christian\NttdataPacient\Model\ResourceModel\Pacient\Collection;
use Christian\NttdataPacient\Model\ResourceModel\Pacient\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Pacient extends AbstractDataProvider
{
    /**
     * @var Collection $collection
     */
    protected $collection;
    /**
     * @var array
     */
    private array $loadedData;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [])
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (!isset($this->loadedData)) {
            $this->loadedData = [];

            foreach ($this->collection->getItems() as $item) {
                $this->loadedData[$item->getData('id')] = $item->getData();
            }
        }

        return $this->loadedData;
    }
}
