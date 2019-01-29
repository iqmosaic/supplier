<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink as SupplierSourceLinkResourceModel;
use Iqmosaic\Supplier\Model\SupplierSourceLink as SupplierSourceLinkModel;

/**
 * Resource Collection of SourceItem entities
 *
 * @api
 */
class Collection extends AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(SupplierSourceLinkModel::class, SupplierSourceLinkResourceModel::class);
    }
}
