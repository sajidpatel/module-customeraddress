<?php
namespace SajidPatel\CustomerAddress\Model;

use SajidPatel\CustomerAddress\Api\Data\CustomerAddressInterface;

class Address extends \Magento\Customer\Model\Address implements CustomerAddressInterface
{
    /**
     * @inheritDoc
     */
    public function getArea()
    {
        return $this->getData(self::AREA);
    }

    /**
     * @inheritDoc
     */
    public function setArea($area)
    {
        return $this->setData(self::AREA, $area);
    }
}
