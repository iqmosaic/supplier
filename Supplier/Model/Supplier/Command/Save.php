<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\Supplier\Command;

use Magento\Framework\Exception\CouldNotSaveException;
// use Magento\Framework\Validation\ValidationException;
use Iqmosaic\Supplier\Model\ResourceModel\Supplier as SupplierResourceModel;
// use Magento\InventoryApi\Model\SourceValidatorInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class Save implements SaveInterface
{
    /**
     * @var SourceValidatorInterface
     */
    private $sourceValidator;

    /**
     * @var SupplierResourceModel
     */
    private $supplierResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Save constructor.
     * @param SupplierResourceModel $supplierResource
     * @param LoggerInterface $logger
     */
    public function __construct(
        // SourceValidatorInterface $sourceValidator,
        SupplierResourceModel $supplierResource,
        LoggerInterface $logger
    ) {
        // $this->sourceValidator = $sourceValidator;
        $this->supplierResource = $supplierResource;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute(SupplierInterface $supplier): int
    {
        /*
        $validationResult = $this->sourceValidator->validate($source);

        if (!$validationResult->isValid()) {
            throw new ValidationException(__('Validation Failed'), null, 0, $validationResult);
        }
        */

        try {
            $this->supplierResource->save($supplier);
            return $supplier->getSupplierId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Source'), $e);
        }
    }
}
