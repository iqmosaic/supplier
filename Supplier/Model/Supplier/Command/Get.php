<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\Supplier\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use Iqmosaic\Supplier\Model\ResourceModel\Supplier as SupplierResourceModel;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterfaceFactory;

/**
 * @inheritdoc
 */
class Get implements GetInterface
{
    /**
     * @var SupplierResourceModel
     */
    private $sourceResource;

    /**
     * @var SupplierInterfaceFactory
     */
    private $sourceFactory;

    /**
     * @param SupplierResourceModel $sourceResource
     * @param SupplierInterfaceFactory $sourceFactory
     */
    public function __construct(
        SupplierResourceModel $sourceResource,
        SupplierInterfaceFactory $sourceFactory
    ) {
        $this->sourceResource = $sourceResource;
        $this->sourceFactory = $sourceFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute(int $supplierId): SupplierInterface
    {
        /** @var SupplierInterface $source */
        $supplier = $this->sourceFactory->create();
        $this->sourceResource->load($supplier, $supplierId, SupplierInterface::SUPPLIER_ID);

        if (null === $supplier->getSupplierId()) {
            throw new NoSuchEntityException(__('Supplier with code "%value" does not exist.', ['value' => $supplierId]));
        }
        return $supplier;
    }
}
