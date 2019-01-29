<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Ui\DataProvider;

use Magento\Backend\Model\Session;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder AS SearchCriteriaBuilderCollection;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;



use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;
use Iqmosaic\SupplierApi\Api\SupplierRepositoryInterface;
use Iqmosaic\SupplierApi\Api\SupplierSourceLinkRepositoryInterface;


/**
 * @api
 */
class SupplierDataProvider extends DataProvider
{
    const SUPPLIER_FORM_NAME = 'supplier_supplier_form_data_source';

    /**
     * @var SupplierRepositoryInterface
     */
    private $supplierRepository;

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var SupplierSourceLinkRepositoryInterface
     */
    private $supplierSourceLinkRepository;

    /**
     * @var SearchCriteriaBuilderCollection
     */
    private $searchCriteriaBuilderCollection;

    /**
     * @var Session
     */
    private $session;

    /**
     * SupplierDataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param SupplierRepositoryInterface $supplierRepository
     * @param SupplierSourceLinkRepositoryInterface $supplierSourceLinkRepository
     * @param SearchResultFactory $searchResultFactory
     * @param Session $session
     * @param SearchCriteriaBuilderCollection $searchCriteriaBuilderCollection
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        SupplierRepositoryInterface $supplierRepository,
        SupplierSourceLinkRepositoryInterface $supplierSourceLinkRepository,
        SearchResultFactory $searchResultFactory,
        Session $session,
        SearchCriteriaBuilderCollection $searchCriteriaBuilderCollection,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->supplierRepository = $supplierRepository;
        $this->supplierSourceLinkRepository = $supplierSourceLinkRepository;
        $this->searchResultFactory = $searchResultFactory;
        $this->session = $session;
        $this->searchCriteriaBuilderCollection = $searchCriteriaBuilderCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $data = parent::getData();

        if (self::SUPPLIER_FORM_NAME === $this->name) {

            if ($data['totalRecords'] > 0) {
                $supplierId = $data['items'][0][SupplierInterface::SUPPLIER_ID];
                $generalData = $data['items'][0];

                $dataForSingle[$supplierId] = [
                    'general' => $generalData,
                    'sources' => [
                        'assigned_sources' => $this->getSupplierSourceLink($supplierId)
                    ]
                ];

                return $dataForSingle;
            }
        }

        return $data;
    }


    private function getSupplierSourceLink($supplierId)
    {
        $searchCriteria = $this->searchCriteriaBuilderCollection
            ->addFilter(SupplierSourceLinkInterface::SUPPLIER_ID, $supplierId)
            ->create();

        $links = [];
        foreach ($this->supplierSourceLinkRepository->getList($searchCriteria)->getItems() AS $link) {
            $links[] = $link->getData();
        }

        return $links;
    }
    /**
     * {@inheritdoc}
     */
    public function getSearchResult()
    {
        $searchCriteria = $this->getSearchCriteria();

        $result = $this->supplierRepository->getGridList($searchCriteria);

        $searchResult = $this->searchResultFactory->create(
            $result->getItems(),
            $result->getTotalCount(),
            $searchCriteria,
            SupplierInterface::SUPPLIER_ID
        );
        return $searchResult;
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {

        if ($filter->getField() == 'name' ) {
            $filter->setField('c.firstname');
        }

        $this->searchCriteriaBuilder->addFilter($filter);
    }
}
