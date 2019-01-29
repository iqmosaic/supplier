<?php

namespace Iqmosaic\SupplierFrontUi\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    private $coreRegistry;
    private $authSession;
    private $supplierFactory;


    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Iqmosaic\Supplier\Model\SupplierFactory $supplierFactory

    ) {
        $this->coreRegistry = $registry;
        $this->authSession = $authSession;
        $this->supplierFactory = $supplierFactory;

        parent::__construct($context);
    }

    public function getSupplier()
    {

        if (! $supplier = $this->coreRegistry->registry('supplier')) {
            $userId = $this->authSession->getUser()->getUserId();
            $supplier = $this->supplierFactory->create();
            $supplier->load($userId, 'user_id');
            $this->coreRegistry->register('supplier', $supplier);
        }

        return $supplier;
    }
}
