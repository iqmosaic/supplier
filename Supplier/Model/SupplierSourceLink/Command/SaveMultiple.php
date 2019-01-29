<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\SupplierSourceLink\Command;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink\SaveMultiple AS SaveMultipleModel;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class SaveMultiple implements SaveMultipleInterface
{
    /**
     * @var SaveMultiple
     */
    private $saveMultiple;

    /**
     * @var LoggerInterface
     */
    private $logger;


    /**
     * SaveMultiple constructor.
     * @param SaveMultipleModel $saveMultiple
     * @param LoggerInterface $logger
     */
    public function __construct(

        SaveMultipleModel $saveMultiple,
        LoggerInterface $logger
    ) {
        $this->saveMultiple = $saveMultiple;
        $this->logger = $logger;
    }

    /**
     * @param SupplierSourceLinkInterface[] $links
     * @throws CouldNotSaveException
     * @throws InputException
     */
    public function execute(array $links): void
    {
        if (empty($links)) {
            throw new InputException(__('Input data is empty'));
        }

        try {
            $this->saveMultiple->execute($links);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save SupplierSourceLinks'), $e);
        }
    }
}
