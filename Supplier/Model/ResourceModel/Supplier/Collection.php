<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\ResourceModel\Supplier;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Iqmosaic\Supplier\Model\ResourceModel\Supplier as SupplierResourceModel;
use Iqmosaic\Supplier\Model\Supplier as SupplierModel;

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
        $this->_init(SupplierModel::class, SupplierResourceModel::class);
    }
}
