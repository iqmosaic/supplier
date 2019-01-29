<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Controller\Adminhtml\Supplier;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Iqmosaic\SupplierApi\Api\SupplierRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit Controller
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_InventoryApi::supplier';

    /**
     * @var SupplierRepositoryInterface
     */
    private $supplierRepository;

    /**
     * @param Context $context
     * @param SupplierRepositoryInterface $supplierRepository
     */
    public function __construct(
        Context $context,
        SupplierRepositoryInterface $supplierRepository
    ) {
        parent::__construct($context);
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $supplierId = $this->getRequest()->getParam(SupplierInterface::SUPPLIER_ID);

        try {
            $supplier = $this->supplierRepository->get((int) $supplierId);

            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result->setActiveMenu('Magento_InventoryApi::supplier')
                ->addBreadcrumb(__('Edit Supplier'), __('Edit Supplier'));
            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Supplier: %name', ['name' => $supplier->getCompanyName()]));

        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Supplier with supplier code "%value" does not exist.', ['value' => $supplierId])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
