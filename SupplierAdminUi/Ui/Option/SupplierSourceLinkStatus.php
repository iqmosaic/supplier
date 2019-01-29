<?php

declare(strict_types=1);

namespace Iqmosaic\SupplierAdminUi\Ui\Option;

use Magento\Framework\Data\OptionSourceInterface;
use Iqmosaic\SupplierApi\Api\Data\SupplierSourceLinkInterface;

/**
 * Provide option values for UI
 */
class SupplierSourceLinkStatus implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => SupplierSourceLinkInterface::STATUS_ENABLED,
                'label' => __('Source Enabled'),
            ],
            [
                'value' => SupplierSourceLinkInterface::STATUS_DISABLED,
                'label' => __('Source Disabled'),
            ]
        ];
    }
}