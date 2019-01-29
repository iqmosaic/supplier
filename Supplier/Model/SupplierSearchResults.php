<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model;

use Magento\Framework\Api\SearchResults;
use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;

/**
 * SourceSearchResults
 */
class SupplierSearchResults extends SearchResults implements SupplierSearchResultsInterface
{
}
