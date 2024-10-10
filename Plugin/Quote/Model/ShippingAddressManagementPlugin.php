<?php

namespace SajidPatel\CustomerAddress\Plugin\Quote\Model;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\ShippingAddressManagementInterface;

class ShippingAddressManagementPlugin
{
    /**
     * Before Assign
     *
     * @param ShippingAddressManagementInterface $subject
     * @param int $cartId
     * @param AddressInterface $address
     * @return array
     */
    public function beforeAssign(
        ShippingAddressManagementInterface $subject,
        int $cartId,
        AddressInterface $address
    ): array {
        $extensionAttributes = $address->getExtensionAttributes();
        if ($extensionAttributes && $extensionAttributes->getArea()) {
            $address->setArea($extensionAttributes->getArea());
        }

        return [$cartId, $address];
    }
}
