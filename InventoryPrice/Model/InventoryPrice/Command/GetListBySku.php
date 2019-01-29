<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\InventoryPrice\Model\InventoryPrice\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Iqmosaic\InventoryPrice\Model\ResourceModel\InventoryPrice\Collection;
use Iqmosaic\InventoryPrice\Model\ResourceModel\InventoryPrice\CollectionFactory;
use Magento\Framework\Api\SearchResultsInterface;

// use Magento\InventoryApi\Api\Data\StockSearchResultsInterfaceFactory;

// use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;
use Iqmosaic\InventoryPrice\Api\Data\InventoryPriceSearchResultsInterface;
use Iqmosaic\InventoryPrice\Api\Data\InventoryPriceSearchResultsInterfaceFactory;


use Iqmosaic\Supplier\Model\ResourceModel\Supplier AS SupplierResourceModel;
use Magento\Inventory\Model\ResourceModel\Source AS SourceResourceModel;


/**
 * @inheritdoc
 */
class GetListBySku implements GetListBySkuInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $inventoryPriceCollectionFactory;

    /**
     * @var InventoryPriceSearchResultsInterface
     */
    private $inventoryPriceSearchResultsInterfaceFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * GetListBySku constructor.
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $inventoryPriceCollectionFactory
     * @param InventoryPriceSearchResultsInterface $inventoryPriceSearchResultsInterfaceFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $inventoryPriceCollectionFactory,
        InventoryPriceSearchResultsInterfaceFactory $inventoryPriceSearchResultsInterfaceFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->inventoryPriceCollectionFactory = $inventoryPriceCollectionFactory;
        $this->inventoryPriceSearchResultsInterfaceFactory = $inventoryPriceSearchResultsInterfaceFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function execute(string $sku = null): SearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->inventoryPriceCollectionFactory->create();

        $collection->getSelect()
            ->where('main_table.sku = ?', $sku)
            ->joinLeft(
                ['s' => SupplierResourceModel::TABLE_NAME_SUPPLIER],
                'main_table.supplier_id = s.supplier_id',
                ['company_name']
                )
            ->joinLeft(
                ['sc' => SourceResourceModel::TABLE_NAME_SOURCE],
                'main_table.source_code = sc.source_code',
                []
            );

        $searchResult = $this->inventoryPriceSearchResultsInterfaceFactory->create();

        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        // $searchResult->setSearchCriteria($searchCriteria);


        return $searchResult;
    }
}
