<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\InventoryPrice\Api\Data;

use \Magento\Framework\Api\ExtensibleDataInterface;


/**
 * Represents product aggregation among some different physical storages (in technical words, it is an index)
 *
 * Used fully qualified namespaces in annotations for proper work of WebApi request parser
 *
 * @api
 */
interface InventoryPriceInterface extends ExtensibleDataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SKU = 'sku';
    const SOURCE_CODE = 'source_code';
    const SUPPLIER_ID = 'supplier_id';
    const PRICE = 'price';

    /**#@-*/

    /**
     * Get sku
     *
     * @return string|null
     */
    public function getSku(): ?string;

    /**
     * Set sku
     *
     * @param string|null $sku
     * @return void
     */
    public function setSku(?string $sku): void;

    /**
     * Get source_code
     *
     * @return string|null
     */
    public function getSourceCode(): ?string;

    /**
     * Set source_code
     *
     * @param string|null $sourceCode
     * @return void
     */
    public function setSourceCode(?string $sourceCode): void;


    /**
     * Get supplier_id
     *
     * @return int|null
     */
    public function getSupplierId(): ?int;

    /**
     * Set supplier_id
     *
     * @param int|null $supplierId
     * @return void
     */
    public function setSupplierId(?int $supplierId): void;

    /**
     * Get company name
     *
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * Set company name
     *
     * @param float|null $price
     * @return void
     */
    public function setPrice(?float $price): void;

}