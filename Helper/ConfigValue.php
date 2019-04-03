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
namespace Bss\Limitcartqty\Helper;

use Magento\Customer\Api\GroupManagementInterface;
use Magento\Store\Model\Store;

class ConfigValue
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Magento\Framework\Math\Random
     */
    protected $mathRandom;
    /**
     * @var GroupManagementInterface
     */
    protected $groupManagement;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * ConfigValue constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Math\Random $mathRandom
     * @param GroupManagementInterface $groupManagement
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Math\Random $mathRandom,
        GroupManagementInterface $groupManagement,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->mathRandom = $mathRandom;
        $this->groupManagement = $groupManagement;
        $this->storeManager = $storeManager;
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreId()
    {
        return $this->storeId = $this->storeManager->getStore()->getId();
    }

    /**
     * @param $qty
     * @return float|null
     */
    protected function fixQty($qty)
    {
        return !empty($qty) ? (float) $qty : null;
    }

    /**
     * @param $value
     * @return string
     */
    protected function serializeValue($value)
    {
        if (is_numeric($value)) {
            $data = (float) $value;
            return (string) $data;
        } elseif (is_array($value)) {
            $data = [];
            foreach ($value as $groupId => $qty) {
                if (!array_key_exists($groupId, $data)) {
                    $data[$groupId] = $this->fixQty($qty);
                }
            }
            if (count($data) == 1 && array_key_exists($this->getAllCustomersGroupId(), $data)) {
                return (string) $data[$this->getAllCustomersGroupId()];
            }
            return serialize($data);
        } else {
            return '';
        }
    }

    /**
     * @param $value
     * @return array|mixed
     */
    protected function unserializeValue($value)
    {
        if (is_numeric($value)) {
            return [$this->getAllCustomersGroupId() => $this->fixQty($value)];
        } elseif (is_string($value) && !empty($value)) {
            return unserialize($value);
        } else {
            return [];
        }
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isEncodedArrayFieldValue($value)
    {
        if (!is_array($value)) {
            return false;
        }
        unset($value['__empty']);
        foreach ($value as $row) {
            if (!is_array($row)
                || !array_key_exists('customer_group_id', $row)
                || !array_key_exists('config_value', $row)
            ) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array $value
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function encodeArrayFieldValue(array $value)
    {
        $result = [];
        foreach ($value as $groupId => $qty) {
            $resultId = $this->mathRandom->getUniqueHash('_');
            $result[$resultId] = ['customer_group_id' => $groupId, 'config_value' => $this->fixQty($qty)];
        }
        return $result;
    }

    /**
     * @param array $value
     * @return array
     */
    protected function decodeArrayFieldValue(array $value)
    {
        $result = [];
        unset($value['__empty']);
        foreach ($value as $row) {
            if (!is_array($row)
                || !array_key_exists('customer_group_id', $row)
                || !array_key_exists('config_value', $row)
            ) {
                continue;
            }
            $groupId = $row['customer_group_id'];
            $qty = $this->fixQty($row['config_value']);
            $result[$groupId] = $qty;
        }
        return $result;
    }

    /**
     * @param $_customerGroupId
     * @return float|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMinConfigValue($_customerGroupId)
    {
        $value = $this->scopeConfig->getValue(
            'Bss_Commerce/item_options/Bss_min_total_qty',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        $value = $this->unserializeValue($value);
        if ($this->isEncodedArrayFieldValue($value)) {
            $value = $this->decodeArrayFieldValue($value);
        }
        $result = null;
        foreach ($value as $groupId => $qty) {
            if ($groupId == $_customerGroupId) {
                $result = $qty;
                break;
            } elseif ($groupId == $this->getAllCustomersGroupId()) {
                $result = $qty;
            }
        }
        return $this->fixQty($result);
    }

    /**
     * @param $_customerGroupId
     * @return float|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMaxConfigValue($_customerGroupId)
    {
        $value = $this->scopeConfig->getValue(
            'Bss_Commerce/item_options/Bss_max_total_qty',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        $value = $this->unserializeValue($value);
        if ($this->isEncodedArrayFieldValue($value)) {
            $value = $this->decodeArrayFieldValue($value);
        }
        $result = null;
        foreach ($value as $groupId => $qty) {
            if ($groupId == $_customerGroupId) {
                $result = $qty;
                break;
            } elseif ($groupId == $this->getAllCustomersGroupId()) {
                $result = $qty;
            }
        }
        return $this->fixQty($result);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isModuleEnable()
    {
        return $this->scopeConfig->getValue(
            'Bss_Commerce/Limitcartqty/Enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }

    /**
     * @param $value
     * @return array|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function makeArrayFieldValue($value)
    {
        $value = $this->unserializeValue($value);
        if (!$this->isEncodedArrayFieldValue($value)) {
            $value = $this->encodeArrayFieldValue($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return array|string
     */
    public function makeStorableArrayFieldValue($value)
    {
        if ($this->isEncodedArrayFieldValue($value)) {
            $value = $this->decodeArrayFieldValue($value);
        }
        $value = $this->serializeValue($value);
        return $value;
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getAllCustomersGroupId()
    {
        return $this->groupManagement->getAllCustomersGroup()->getId();
    }
}
