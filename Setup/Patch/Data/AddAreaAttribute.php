<?php
namespace SajidPatel\CustomerAddress\Setup\Patch\Data;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddAreaAttribute implements DataPatchInterface
{
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * Constructor
     *
     * @param CustomerSetupFactory $customerSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ){
        $this->customerSetupFactory = $customerSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Apply
     */
    public function apply()
    {
        /** @var \Magento\Customer\Setup\CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'area');
        $attribute->setData(
            'used_in_forms',
            [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]
        );
        $attribute->save();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
