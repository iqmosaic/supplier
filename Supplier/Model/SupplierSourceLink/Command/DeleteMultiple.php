<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model\SupplierSourceLink\Command;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\InputException;
use Iqmosaic\Supplier\Model\ResourceModel\SupplierSourceLink\DeleteMultiple  AS DeleteMultipleModel;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class DeleteMultiple implements DeleteMultipleInterface
{
    /**
     * @var DeleteMultipleModel
     */
    private $deleteMultiple;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DeleteMultiple constructor.
     * @param DeleteMultipleModel $deleteMultiple
     * @param LoggerInterface $logger
     */
    public function __construct(
        DeleteMultipleModel $deleteMultiple,
        LoggerInterface $logger
    ) {
        $this->deleteMultiple = $deleteMultiple;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $links): void
    {
        if (empty($links)) {
            throw new InputException(__('Input data is empty'));
        }

        try {
            $this->deleteMultiple->execute($links);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__('Could not delete StockSourceLinks'), $e);
        }
    }
}
