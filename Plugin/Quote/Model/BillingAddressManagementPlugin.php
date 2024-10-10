<?php

namespace SajidPatel\CustomerAddress\Plugin\Quote\Model;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\BillingAddressManagementInterface;

class BillingAddressManagementPlugin
{
    /**
     * Before Assign
     *
     * @param BillingAddressManagementInterface $subject
     * @param int $cartId
     * @param AddressInterface $address
     * @return array
     */
    public function beforeAssign(
        BillingAddressManagementInterface $subject,
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
