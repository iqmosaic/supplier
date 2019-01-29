<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\PredefinedId;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;

/**
 * Implementation of basic operations for SupplierSourceLink entity for specific db layer
 */
class SupplierSourceLink extends AbstractDb
{
    /**
     * Provides possibility of saving entity with predefined/pre-generated id
     */
    use PredefinedId;

    /**#@+
     * Constants related to specific db layer
     */
    const TABLE_NAME_SUPPLIER_SOURCE_LINK = 'supplier_source_link';
    /**#@-*/

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME_SUPPLIER_SOURCE_LINK, SupplierSourceLinkInterface::LINK_ID);
    }
}
