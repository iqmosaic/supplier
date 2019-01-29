<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\InventoryPrice\Model;

use Magento\Framework\Api\SearchResults;
use Iqmosaic\InventoryPrice\Api\Data\InventoryPriceSearchResultsInterface;

/**
 * SourceSearchResults
 */
class InventoryPriceSearchResults extends SearchResults implements InventoryPriceSearchResultsInterface
{
}
