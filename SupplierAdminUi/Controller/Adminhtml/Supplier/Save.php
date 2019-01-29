<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Controller\Adminhtml\Supplier;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Validation\ValidationException;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;
use Iqmosaic\SupplierAdminUi\Model\Supplier\SaveProcessor AS SupplierSaveProcessor;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Save Controller
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_InventoryApi::supplier';

    /**
     * @var SupplierSaveProcessor
     */
    private $supplierSaveProcessor;

    /**
     * @param Context $context
     * @param SupplierSaveProcessor $supplierSaveProcessor
     */
    public function __construct(
        Context $context,
        SupplierSaveProcessor $supplierSaveProcessor
    ) {
        parent::__construct($context);
        $this->supplierSaveProcessor = $supplierSaveProcessor;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $requestData = $request->getParams();
        if (!$request->isPost() || empty($requestData['general'])) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            $this->processRedirectAfterFailureSave($resultRedirect);
            return $resultRedirect;
        }
        return $this->processSave($requestData, $request, $resultRedirect);
    }

    /**
     * @param array $requestData
     * @param RequestInterface $request
     * @param Redirect $resultRedirect
     * @return ResultInterface
     */
    private function processSave(
        array $requestData,
        RequestInterface $request,
        Redirect $resultRedirect
    ): ResultInterface {

        try {
            $supplierId = !empty($requestData['general'][SupplierInterface::SUPPLIER_ID])
                ? (int)$requestData['general'][SupplierInterface::SUPPLIER_ID]
                : null;

            $supplierId = $this->supplierSaveProcessor->process($supplierId, $request);

            $this->messageManager->addSuccessMessage(__('The Supplier has been saved.'));
            $this->processRedirectAfterSuccessSave($resultRedirect, $supplierId);


        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('The Supplier does not exist.'));
            $this->processRedirectAfterFailureSave($resultRedirect);
        } catch (ValidationException $e) {
            foreach ($e->getErrors() as $localizedError) {
                $this->messageManager->addErrorMessage($localizedError->getMessage());
            }
            $this->processRedirectAfterFailureSave($resultRedirect, $supplierId);
        } catch (CouldNotSaveException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->processRedirectAfterFailureSave($resultRedirect, $supplierId);
        } catch (InputException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->processRedirectAfterFailureSave($resultRedirect, $supplierId);
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not save Supplier.'));
            $this->processRedirectAfterFailureSave($resultRedirect, $supplierId ?? null);
        }
        return $resultRedirect;
    }

    /**
     * @param Redirect $resultRedirect
     * @param int $supplierId
     *
     * @return void
     */
    private function processRedirectAfterSuccessSave(Redirect $resultRedirect, int $supplierId)
    {
        if ($this->getRequest()->getParam('back')) {
            $resultRedirect->setPath('*/*/edit', [
                SupplierInterface::SUPPLIER_ID => $supplierId,
                '_current' => true,
            ]);
        } elseif ($this->getRequest()->getParam('redirect_to_new')) {
            $resultRedirect->setPath('*/*/new', [
                '_current' => true,
            ]);
        } else {
            $resultRedirect->setPath('*/*/');
        }
    }

    /**
     * @param Redirect $resultRedirect
     * @param int|null $supplierId
     *
     * @return void
     */
    private function processRedirectAfterFailureSave(Redirect $resultRedirect, int $supplierId = null)
    {
        if (null === $supplierId) {
            $resultRedirect->setPath('*/*/new');
        } else {
            $resultRedirect->setPath('*/*/edit', [
                SupplierInterface::SUPPLIER_ID => $supplierId,
                '_current' => true,
            ]);
        }
    }
}
