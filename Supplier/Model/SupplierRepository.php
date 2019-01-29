<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model;

use Magento\Framework\Api\SearchCriteriaInterface;

use Iqmosaic\Supplier\Model\Supplier\Command\GetInterface;
use Iqmosaic\Supplier\Model\Supplier\Command\GetListInterface;
use Iqmosaic\Supplier\Model\Supplier\Command\GetGridListInterface;
use Iqmosaic\Supplier\Model\Supplier\Command\SaveInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;
use Iqmosaic\SupplierApi\Api\SupplierRepositoryInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;

/**
 * @inheritdoc
 */
class SupplierRepository implements SupplierRepositoryInterface
{

    /**
     * @var GetInterface
     */
    private $commandGet;


    /**
     * @var SaveInterface
     */
    private $commandSave;

    /**
     * @var GetListInterface
     */
    private $commandGetList;

    /**
     * @var GetGridListInterface
     */
    private $commandGetGridList;


    /**
     * SupplierRepository constructor.
     * @param GetInterface $commandGet
     * @param SaveInterface $commandSave
     * @param GetListInterface $commandGetList
     * @param GetGridListInterface $commandGetGridList
     */
    public function __construct(
        GetInterface $commandGet,
        SaveInterface $commandSave,
        GetListInterface $commandGetList,
        GetGridListInterface $commandGetGridList
    ) {
        $this->commandGet = $commandGet;
        $this->commandSave = $commandSave;
        $this->commandGetList = $commandGetList;
        $this->commandGetGridList = $commandGetGridList;
    }


    /**
     * @inheritdoc
     */
    public function save(SupplierInterface $supplier): int
    {
        return $this->commandSave->execute($supplier);
    }


    /**
     * @inheritdoc
     */
    public function get(int $supplierId): SupplierInterface
    {
        return $this->commandGet->execute($supplierId);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SupplierSearchResultsInterface
    {
        return $this->commandGetList->execute($searchCriteria);
    }

    /**
     * @inheritdoc
     */
    public function getGridList(SearchCriteriaInterface $searchCriteria = null): SupplierSearchResultsInterface
    {
        return $this->commandGetGridList->execute($searchCriteria);
    }
}
