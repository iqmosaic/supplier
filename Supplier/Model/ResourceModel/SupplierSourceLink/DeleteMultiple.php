<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink;

use Magento\Framework\App\ResourceConnection;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink as SupplierSourceLinkResourceModel;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;

/**
 * Implementation of SupplierSourceLink delete multiple operation for specific db layer
 * Delete Multiple used here for performance efficient purposes over single delete operation
 */
class DeleteMultiple
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Multiple delete stock source links
     *
     * @param SupplierSourceLinkInterface[] $links
     * @return void
     */
    public function execute(array $links)
    {
        if (!count($links)) {
            return;
        }

        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName(
            SupplierSourceLinkResourceModel::TABLE_NAME_SUPPLIER_SOURCE_LINK
        );

        $whereSql = $this->buildWhereSqlPart($links);
        $connection->delete($tableName, $whereSql);
    }

    /**
     * Build WHERE part of the delete SQL query
     *
     * @param SupplierSourceLinkInterface[] $links
     * @return string
     */
    private function buildWhereSqlPart(array $links): string
    {
        $connection = $this->resourceConnection->getConnection();

        $condition = [];

        foreach ($links as $link) {
            $sourceCodeCondition = $connection->quoteInto(
                SupplierSourceLinkInterface::SOURCE_CODE . ' = ?',
                $link->getSourceCode()
            );
            $supplierIdCondition = $connection->quoteInto(
                SupplierSourceLinkInterface::SUPPLIER_ID . ' = ?',
                $link->getSupplierId()
            );
            $condition[] = '(' . $sourceCodeCondition . ' AND ' . $supplierIdCondition . ')';
        }

        return implode(' OR ', $condition);
    }
}
