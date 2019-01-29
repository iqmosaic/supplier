<?php


declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Model\Supplier;


use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\EntityManager\EventManager;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterfaceFactory;
use Iqmosaic\SupplierApi\Api\SupplierRepositoryInterface;

class SaveProcessor
{

    /**
     * @var SupplierInterfaceFactory
     */
    private $supplierFactory;

    /**
     * @var SupplierRepositoryInterface
     */
    private $supplierRepository;

    /**
     * @var SupplierSourceLinkProcessor
     */
    private $supplierSourceLinkProcessor;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @param SupplierInterfaceFactory $supplierFactory
     * @param SupplierRepositoryInterface $supplierRepository
     * @param SupplierSourceLinkProcessor $supplierSourceLinkProcessor
     * @param DataObjectHelper $dataObjectHelper
     * @param EventManager $eventManager
     */
    public function __construct(
        SupplierInterfaceFactory $supplierFactory,
        SupplierRepositoryInterface $supplierRepository,
        SupplierSourceLinkProcessor $supplierSourceLinkProcessor,
        DataObjectHelper $dataObjectHelper,
        EventManager $eventManager
    ) {
        $this->supplierFactory = $supplierFactory;
        $this->supplierRepository = $supplierRepository;
        $this->supplierSourceLinkProcessor = $supplierSourceLinkProcessor;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->eventManager = $eventManager;
    }

    /**
     * Save supplier process action
     *
     * @param int|null $supplierId
     * @param RequestInterface $request
     * @return int
     */
    public function process($supplierId, RequestInterface $request): int
    {

        if (null === $supplierId) {
            $supplier = $this->supplierFactory->create();
        } else {
            $supplier = $this->supplierRepository->get($supplierId);
        }
        $requestData = $request->getParams();


        $this->dataObjectHelper->populateWithArray($supplier, $requestData['general'], SupplierInterface::class);


        $this->eventManager->dispatch(
            'controller_action_inventory_populate_supplier_with_data',
            [
                'request' => $request,
                'supplier' => $supplier,
            ]
        );
        $supplierId = $this->supplierRepository->save($supplier);

        $this->eventManager->dispatch(
            'save_supplier_controller_processor_after_save',
            [
                'request' => $request,
                'supplier' => $supplier,
            ]
        );

        $assignedSources = $this->getAssignedSources($requestData);

        $this->supplierSourceLinkProcessor->process($supplierId, $assignedSources);

        return (int) $supplierId;
    }


    private function getAssignedSources(?array $requestData)
    {

        return isset($requestData['sources']['assigned_sources'])
        && is_array($requestData['sources']['assigned_sources'])
            ? $requestData['sources']['assigned_sources']
            : [];
    }

}