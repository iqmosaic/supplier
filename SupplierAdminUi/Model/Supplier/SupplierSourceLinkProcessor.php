<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Model\Supplier;

use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Iqmosaic\SupplierApi\Api\SupplierSourceLinkRepositoryInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterfaceFactory;



/**
 * At the time of processing Stock save form this class used to save links correctly
 * Performs replace strategy of sources for the stock
 */
class SupplierSourceLinkProcessor
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;



    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var SupplierSourceLinkRepositoryInterface
     */
    private $supplierSourceLinkRepositoryInterface;

    /**
     * @var
     */
    private $supplierSourceLinkInterfaceFactory;


    /**
     * SupplierSourceLinkProcessor constructor.
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SupplierSourceLinkRepositoryInterface $supplierSourceLinkRepositoryInterface
     * @param SupplierSourceLinkInterfaceFactory $supplierSourceLinkInterfaceFactory
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SupplierSourceLinkRepositoryInterface $supplierSourceLinkRepositoryInterface,
        SupplierSourceLinkInterfaceFactory $supplierSourceLinkInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->supplierSourceLinkRepositoryInterface = $supplierSourceLinkRepositoryInterface;
        $this->supplierSourceLinkInterfaceFactory = $supplierSourceLinkInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param int $supplierId
     * @param array $linksData
     *
     */
    public function process(int $supplierId, array $linksData)
    {
        $linksForDelete = $this->getAssignedLinks($supplierId);

        $linksForSave = [];

        foreach ($linksData as $linkData) {

            $sourceCode = $linkData[SupplierSourceLinkInterface::SOURCE_CODE];

            if (isset($linksForDelete[$sourceCode])) {
                $link = $linksForDelete[$sourceCode];
            } else {
                /** @var SupplierSourceLinkSearchResultsInterface $link */
                $link = $this->supplierSourceLinkInterfaceFactory->create();
            }

            $linkData[SupplierSourceLinkInterface::SUPPLIER_ID] = $supplierId;

            $this->dataObjectHelper->populateWithArray($link, $linkData, SupplierSourceLinkInterface::class);

            $linksForSave[] = $link;
            unset($linksForDelete[$sourceCode]);
        }

        if (count($linksForSave) > 0) {
            $this->supplierSourceLinkRepositoryInterface->saveMultiple($linksForSave);
        }

        if (count($linksForDelete) > 0) {
            $this->supplierSourceLinkRepositoryInterface->deleteMultiple($linksForDelete);
        }
    }

    /**
     * @param int $supplierId
     * @return array
     */
    private function getAssignedLinks(int $supplierId): array
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(SupplierSourceLinkInterface::SUPPLIER_ID, $supplierId)
            ->create();


        $result = [];
        foreach ($this->supplierSourceLinkRepositoryInterface->getList($searchCriteria)->getItems() as $link) {
            $result[$link->getSourceCode()] = $link;
        }

        return $result;
    }
}
