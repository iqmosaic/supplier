<?php

declare(strict_types=1);

namespace Iqmosaic\SupplierApi\Api;

use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;
use Magento\Framework\Api\SearchResultsInterface;
/**
 * Interface SupplierRepositoryInterface
 * @package Iqmosaic\SupplierApi\Api
 */
interface SupplierSourceLinkRepositoryInterface
{
    /**
     * Save Supplier data
     *
     * @param SupplierInterface $supplier
     */
    // public function save(SupplierInterface $supplier): void;

    /**
     * @param int $supplierId
     * @return SupplierInterface
     */
    // public function get(int $supplierId): SupplierInterface;

    /**
     * Find Sources by SearchCriteria
     * SearchCriteria is not required because load all stocks is useful case
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkSearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ): Data\SupplierSourceLinkSearchResultsInterface;

    /**
     * Find Sources by SearchCriteria
     * SearchCriteria is not required because load all stocks is useful case
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkSearchResultsInterface
     */
    public function getSourceList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ): SearchResultsInterface;

    /**
     * @param \Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface[] $links
     * @return void
     */
    public function saveMultiple(
        array $links
    ): void;

    /**
     * @param \Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface[] $links
     * @return void
     */
    public function deleteMultiple(
        array $links
    ): void;
}
