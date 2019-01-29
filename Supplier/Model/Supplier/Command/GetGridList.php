<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\Supplier\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Iqmosaic\Supplier\Model\ResourceModel\Supplier\Collection;
use Iqmosaic\Supplier\Model\ResourceModel\Supplier\CollectionFactory;

// use Magento\InventoryApi\Api\Data\StockSearchResultsInterfaceFactory;

use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterfaceFactory;


/**
 * @inheritdoc
 */
class GetGridList implements GetGridListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $supplierCollectionFactory;

    /**
     * @var StockSearchResultsInterfaceFactory
     */
    private $supplierSearchResultsFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * GetList constructor.
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $supplierCollectionFactory
     * @param SupplierSearchResultsInterfaceFactory $supplierSearchResultsFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $supplierCollectionFactory,
        SupplierSearchResultsInterfaceFactory $supplierSearchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->supplierCollectionFactory = $supplierCollectionFactory;
        $this->supplierSearchResultsFactory = $supplierSearchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): SupplierSearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->supplierCollectionFactory->create();

        $collection->join(
            ['c' =>'customer_entity']
            , 'c.entity_id = main_table.customer_id'
            , ['name' => 'concat(firstname, " " ,lastname)']
        );

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $searchResult = $this->supplierSearchResultsFactory->create();

        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
