<?php

namespace SajidPatel\CustomerAddress\Plugin\Quote\Model;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\AddressExtensionInterface;
use Magento\Quote\Api\Data\AddressExtensionFactory;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\QuoteManagement;

class QuoteManagementPlugin
{
    /**
     * @var AddressExtensionFactory
     */
    private $addressExtensionFactory;

    /**
     * Constructor
     *
     * @param AddressExtensionFactory $addressExtensionFactory
     */
    public function __construct(
        AddressExtensionFactory $addressExtensionFactory
    ) {
        $this->addressExtensionFactory = $addressExtensionFactory;
    }

    /**
     * Before Submit Order
     *
     * @param QuoteManagement $subject
     * @param Quote $quote
     * @param array $orderData
     * @return array
     */
    public function beforeSubmit(
        QuoteManagement $subject,
        Quote $quote,
        array $orderData = []
    ): array {
        $shippingAddress = $quote->getShippingAddress();
        $billingAddress = $quote->getBillingAddress();

        if ($shippingAddress && $shippingAddress->getArea()) {
            $this->setAreaToExtensionAttributes($shippingAddress);
        }

        if ($billingAddress && $billingAddress->getArea()) {
            $this->setAreaToExtensionAttributes($billingAddress);
        }

        return [$quote, $orderData];
    }

    /**
     * Set Area to Extension Attributes
     *
     * @param AddressInterface $address
     */
    private function setAreaToExtensionAttributes(AddressInterface $address): void
    {
        $extensionAttributes = $address->getExtensionAttributes() ?: $this->addressExtensionFactory->create();
        $extensionAttributes->setArea($address->getArea());
        $address->setExtensionAttributes($extensionAttributes);
    }
}
