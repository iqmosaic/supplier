<?php

declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Controller\Adminhtml\Supplier;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class NewAction
 * @package Iqmosaic\SupplierAdminUi\Controller\Adminhtml\Supplier
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Iqmosaic_SupplierApi::supplier_admin';

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Iqmosaic_SupplierAdminUi::supplier_admin')
            ->addBreadcrumb(__('Suppliers'), __('Add'));
        $resultPage->getConfig()->getTitle()->prepend(__('New Supplier'));

        return $resultPage;
    }
}