<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\SupplierSourceLink\Command;

use Magento\Framework\Api\SearchCriteriaInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkSearchResultsInterface;

/**
 * Find Stocks by SearchCriteria command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial GetList call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \Magento\InventoryApi\Api\StockRepositoryInterface
 * @api
 */
interface GetListInterface
{
    /**
     * Find Stocks by given SearchCriteria
     * SearchCriteria is not required because load all stocks is useful case
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return SupplierSourceLinkSearchResultsInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): SupplierSourceLinkSearchResultsInterface;
}
