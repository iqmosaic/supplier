<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\SupplierSourceLink\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink\Collection;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink\CollectionFactory;

// use Magento\InventoryApi\Api\Data\StockSearchResultsInterfaceFactory;

use Magento\Framework\Api\SearchResultsInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkSearchResultsInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkSearchResultsInterfaceFactory;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\Inventory\Model\ResourceModel\Source;





/**
 * @inheritdoc
 */
class GetSourceList implements GetSourceListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $supplierSourceLinkCollectionFactory;

    /**
     * @var StockSearchResultsInterfaceFactory
     */
    private $supplierSourceLinkSearchResultsFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * GetList constructor.
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $supplierSourceLinkCollectionFactory
     * @param SupplierSourceLinkSearchResultsInterfaceFactory $supplierSourceLinkSearchResultsFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $supplierSourceLinkCollectionFactory,
        SupplierSourceLinkSearchResultsInterfaceFactory $supplierSourceLinkSearchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->supplierSourceLinkCollectionFactory = $supplierSourceLinkCollectionFactory;
        $this->supplierSourceLinkSearchResultsFactory = $supplierSourceLinkSearchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->supplierSourceLinkCollectionFactory->create();

        $collection->join(
            ['is' => Source::TABLE_NAME_SOURCE]
            , 'is.source_code = main_table.source_code'
            , ['*']
        );

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {

            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $searchResult = $this->supplierSourceLinkSearchResultsFactory->create();

        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
