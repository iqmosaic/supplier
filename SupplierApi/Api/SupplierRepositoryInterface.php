<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierApi\Api;

use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;


/**
 * Interface SupplierRepositoryInterface
 * @package Iqmosaic\SupplierApi\Api
 */
interface SupplierRepositoryInterface
{
    /**
     * @param SupplierInterface $supplier
     * @return int
     */
    public function save(SupplierInterface $supplier): int;

    /**
     * @param int $supplierId
     * @return SupplierInterface
     */
    public function get(int $supplierId): SupplierInterface;

    /**
     * Find Sources by SearchCriteria
     * SearchCriteria is not required because load all stocks is useful case
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ): \Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;
}
