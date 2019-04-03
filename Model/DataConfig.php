<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento COMMUNITY edition
 * BSS Commerce does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * BSS Commerce does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   BSS
 * @package    Bss_Limitcartqty
 * @author     Extension Team
 * @copyright  Copyright (c) 2015-2016 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\Limitcartqty\Model;

use Bss\Limitcartqty\Api\DataConfigInterface;

class DataConfig implements DataConfigInterface
{
    protected $customerGroupId;

    protected $storeId;

    protected $customerSession;

    protected $storeManager;

    protected $configValue;
    
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Bss\Limitcartqty\Helper\ConfigValue $configValue
    ) {
        $this->customerSession = $customerSession;
        $this->storeManager = $storeManager;
        $this->configValue = $configValue;
    }
    public function getMinValue()
    {
        return $this->configValue->getMinConfigValue($this->getCustomerId());
    }

    public function getMaxValue()
    {
        return $this->configValue->getMaxConfigValue($this->getCustomerId());
    }

    public function isModuleEnable()
    {
        return $this->configValue->isModuleEnable();
    }

    public function getCustomerId()
    {
        return $this->customerSession->getCustomerGroupId();
    }

    public function getStoreId()
    {
        if ($this->storeId === null) {
            $this->storeId = $this->storeManager->getStore()->getId();
        }
        return $this->storeId;
    }
}
