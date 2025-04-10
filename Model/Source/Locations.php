<?php

namespace LeanCommerce\LocationGrid\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use LeanCommerce\LocationGrid\Model\ResourceModel\Grid\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Locations extends AbstractSource implements OptionSourceInterface
{
    protected CollectionFactory $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getAllOptions()
    {
        $collection = $this->collectionFactory->create();

        $options = array_map(fn($item) => [
            'value' => $item->getEntityId(),
            'label' => $item->getBranchName()
        ], iterator_to_array($collection));

        return $options ?: [['value' => '', 'label' => 'No locations available']];
    }
}
