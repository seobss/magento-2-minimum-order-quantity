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

class CustomMessage
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var
     */
    protected $storeId;

    /**
     * CustomMessage constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * @param $text
     * @param $conf
     * @param $cart
     * @return mixed
     */
    public function replaceData($text, $conf, $cart)
    {
        $text1 = str_replace("-conf-", $conf, $text);
        $text2 = str_replace("-cart-", $cart, $text1);
        return $text2;
    }

    /**
     * @param $conf
     * @param $cart
     * @return \Magento\Framework\Phrase|mixed
     */
    public function getMinMessage($conf, $cart)
    {
        $value = $this->scopeConfig->getValue(
            'Bss_Commerce/item_options/Bss_min_total_qty_message',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        if ($value === null) {
            return __('The fewest you may purchase is %1, you have %2 !', $conf, $cart);
        } else {
            return $this->replaceData($value, $conf, $cart);
        }
    }

    /**
     * @param $conf
     * @param $cart
     * @return \Magento\Framework\Phrase|mixed
     */
    public function getMaxMessage($conf, $cart)
    {
        $value = $this->scopeConfig->getValue(
            'Bss_Commerce/item_options/Bss_max_total_qty_message',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        if ($value === null) {
            return __('The most you may purchase is %1, you have %2 !', $conf, $cart);
        } else {
            return $this->replaceData($value, $conf, $cart);
        }
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreId()
    {
        if ($this->storeId === null) {
            $this->storeId = $this->storeManager->getStore()->getId();
        }
        return $this->storeId;
    }
}
