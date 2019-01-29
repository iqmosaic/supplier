<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\PredefinedId;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;

/**
 * Implementation of basic operations for Supplier entity for specific db layer
 */
class Supplier extends AbstractDb
{
    /**
     * Provides possibility of saving entity with predefined/pre-generated id
     */
    use PredefinedId;

    /**#@+
     * Constants related to specific db layer
     */
    const TABLE_NAME_SUPPLIER = 'supplier';
    /**#@-*/

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME_SUPPLIER, SupplierInterface::SUPPLIER_ID);
    }
}
