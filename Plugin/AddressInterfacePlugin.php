<?php
namespace SajidPatel\CustomerAddress\Plugin;

use Magento\Customer\Api\Data\AddressInterface;
use SajidPatel\CustomerAddress\Api\Data\CustomerAddressInterface;

class AddressInterfacePlugin
{
    public function afterGetExtensionAttributes(
        AddressInterface $subject,
        ?\Magento\Customer\Api\Data\AddressExtensionInterface $result
    ) {
        if ($subject instanceof CustomerAddressInterface && $result === null) {
            $result = $subject->getExtensionAttributes();
        }
        return $result;
    }
}
