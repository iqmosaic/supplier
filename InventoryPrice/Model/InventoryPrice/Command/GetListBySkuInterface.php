<?php

declare(strict_types=1);

namespace Iqmosaic\InventoryPrice\Model\InventoryPrice\Command;

use Magento\Framework\Api\SearchCriteriaInterface;
// use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface GetListBySkuInterface
 * @package Iqmosaic\Supplier\Model\Supplier\Command
 */
interface GetListBySkuInterface
{
    /**
     * @param string|null $sku
     * @return SearchResultsInterface
     */
    public function execute(string $sku = null): SearchResultsInterface;
}
