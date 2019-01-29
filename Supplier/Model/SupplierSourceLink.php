<?php


declare(strict_types=1);

namespace Iqmosaic\Supplier\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink as SupplierSourceLinkResourceModel;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;

class SupplierSourceLink extends AbstractExtensibleModel implements SupplierSourceLinkInterface
{

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(SupplierSourceLinkResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getLinkId(): ?int
    {
        return $this->getData(self::LINK_ID) === null ?
            null:
            (int)$this->getData(self::LINK_ID);
    }

    /**
     * @inheritdoc
     */
    public function setLinkId(?int $linkId): void
    {
        $this->setData(self::LINK_ID, $linkId);
    }

    /**
     * @inheritdoc
     */
    public function getSupplierId(): ?int
    {
        return $this->getData(self::SUPPLIER_ID) === null ?
            null:
            (int)$this->getData(self::SUPPLIER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setSupplierId(?int $supplierId): void
    {
        $this->setData(self::SUPPLIER_ID, $supplierId);
    }

    /**
     * @inheritdoc
     */
    public function getSourceCode(): ?string
    {
        return $this->getData(self::SOURCE_CODE) === null ?
            null:
            (string)$this->getData(self::SOURCE_CODE);
    }

    /**
     * @inheritdoc
     */
    public function setSourceCode(?string $sourceCode): void
    {
        $this->setData(self::SOURCE_CODE, $sourceCode);
    }

    /**
     * @inheritdoc
     */
    public function getStatus(): ?string
    {
        return $this->getData(self::STATUS) === null ?
            null:
            (string)$this->getData(self::STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setStatus(?string $status): void
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritdoc
     */
    public function getAddedAt(): ?string
    {
        return $this->getData(self::ADDED_AT) === null ?
            null:
            (string)$this->getData(self::ADDED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setAddedAt(?string $addedAt): void
    {
        $this->setData(self::ADDED_AT, $addedAt);
    }

}