<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierApi\Api\Data;

use \Magento\Framework\Api\ExtensibleDataInterface;


/**
 * Interface SupplierSourceLinkInterface
 * @package Iqmosaic\SupplierApi\Api\Data
 */
interface SupplierSourceLinkInterface extends ExtensibleDataInterface
{
    /**
     * Constants for keys of data array.
     * Identical to the name of the getter in snake case
     */
    const LINK_ID = 'link_id';
    const SUPPLIER_ID = 'supplier_id';
    const SOURCE_CODE = 'source_code';
    const STATUS = 'status';
    const ADDED_AT = 'added_at';


    const STATUS_ENABLED = 0;
    const STATUS_DISABLED = 1;

    /**
     * Get link id
     *
     * @return int|null
     */
    public function getLinkId(): ?int;

    /**
     * Set link id
     *
     * @param int|null $linkId
     * @return void
     */
    public function setLinkId(?int $linkId): void;

    /**
     * Get supplier id
     *
     * @return int|null
     */
    public function getSupplierId(): ?int;

    /**
     * Set supplier id
     *
     * @param int|null $supplierId
     * @return void
     */
    public function setSupplierId(?int $supplierId): void;

    /**
     * Get source code
     *
     * @return string|null
     */
    public function getSourceCode(): ?string;

    /**
     * Set source code
     *
     * @param string|null $sourceCode
     * @return void
     */
    public function setSourceCode(?string $sourceCode): void;

    /**
     * Get status
     *
     * @return string|null
     */
    public function getStatus(): ?string;

    /**
     * Set status
     *
     * @param string|null $status
     * @return void
     */
    public function setStatus(?string $status): void;


    /**
     * Get added at
     *
     * @return string|null
     */
    public function getAddedAt(): ?string;

    /**
     * Set contact name
     *
     * @param string|null $addedAt
     * @return void
     */
    public function setAddedAt(?string $addedAt): void;



}
