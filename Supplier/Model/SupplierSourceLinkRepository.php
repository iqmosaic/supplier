<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\Supplier\Model;

use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

use Iqmosaic\Supplier\Model\SupplierSourceLink\Command\GetListInterface;
use Iqmosaic\Supplier\Model\SupplierSourceLink\Command\GetSourceListInterface;
use Iqmosaic\Supplier\Model\SupplierSourceLink\Command\SaveMultipleInterface;
use Iqmosaic\Supplier\Model\SupplierSourceLink\Command\DeleteMultipleInterface;

use Iqmosaic\SupplierApi\Api\Data\SupplierSearchResultsInterface;
use Iqmosaic\SupplierApi\Api\SupplierSourceLinkRepositoryInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Magento\Framework\Api\SearchResultsInterface;
/**
 * @inheritdoc
 */
class SupplierSourceLinkRepository implements SupplierSourceLinkRepositoryInterface
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
     * @var SaveMultipleInterface
     */
    private $commandSaveMultiple;


    /**
     * @var SaveMultipleInterface
     */
    private $commandDeleteMultiple;


    /**
     * @var GetListInterface
     */
    private $commandGetList;

    /**
     * @var GetSourceListInterface
     */
    private $commandGetSourceList;


    /**
     * SupplierSourceLinkRepository constructor.
     * @param GetListInterface $commandGetList
     * @param GetSourceListInterface $commandGetSourceList
     * @param SaveMultipleInterface $commandSaveMultiple
     * @param DeleteMultipleInterface $commandDeleteMultiple
     */
    public function __construct(
        GetListInterface $commandGetList,
        GetSourceListInterface $commandGetSourceList,
        SaveMultipleInterface $commandSaveMultiple,
        DeleteMultipleInterface $commandDeleteMultiple
    ) {
        $this->commandGetList = $commandGetList;
        $this->commandGetSourceList = $commandGetSourceList;
        $this->commandSaveMultiple = $commandSaveMultiple;
        $this->commandDeleteMultiple = $commandDeleteMultiple;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SupplierSourceLinkSearchResultsInterface
    {
        return $this->commandGetList->execute($searchCriteria);
    }

    /**
     * @inheritdoc
     */
    public function getSourceList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        return $this->commandGetSourceList->execute($searchCriteria);
    }


    /**
     * @inheritdoc
     */
    public function saveMultiple(array $links): void
    {
        $this->commandSaveMultiple->execute($links);
    }

    /**
     * @inheritdoc
     */
    public function deleteMultiple(array $links): void
    {
        $this->commandDeleteMultiple->execute($links);
    }
}
