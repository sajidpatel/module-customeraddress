<?php
namespace SajidPatel\CustomerAddress\Api\Data;

interface CustomerAddressInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    const AREA = 'area';

    /**
     * Get Area
     *
     * @return string|null
     */
    public function getArea();

    /**
     * Set Area
     *
     * @param string $area
     * @return $this
     */
    public function setArea($area);
}
