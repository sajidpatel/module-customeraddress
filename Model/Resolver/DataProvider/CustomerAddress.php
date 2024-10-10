<?php
namespace SajidPatel\CustomerAddress\Model\Resolver\DataProvider;

use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;

class CustomerAddress
{
    private $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function getCustomerAddressById(int $addressId): array
    {
        try {
            $address = $this->addressRepository->getById($addressId);
            $result = $address->__toArray();
            $result['area'] = $address->getExtensionAttributes()->getArea();
            return $result;
        } catch (LocalizedException $e) {
            throw new GraphQlInputException(__($e->getMessage()));
        }
    }
}
