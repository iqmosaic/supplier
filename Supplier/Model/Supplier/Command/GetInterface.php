<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\Supplier\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;

/**
 * Get Source by code command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial Get call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \Magento\InventoryApi\Api\SourceRepositoryInterface
 * @api
 */
interface GetInterface
{
    /**
     * Get Supplier data by supplierId
     *
     * @param int $supplierId
     * @return SupplierInterface
     */
    public function execute(int $supplierId): SupplierInterface;
}
