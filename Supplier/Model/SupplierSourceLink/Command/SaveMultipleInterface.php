<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\SupplierSourceLink\Command;

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
interface SaveMultipleInterface
{
    /**
     * @param \Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface[] $links
     * @return void
     */
    public function execute(array $links): void;
}
