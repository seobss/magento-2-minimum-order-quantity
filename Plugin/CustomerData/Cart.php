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
namespace Bss\Limitcartqty\Plugin\CustomerData;

use Bss\Limitcartqty\Api\DataConfigInterface;

class Cart
{

    /**
     * @var \Bss\Limitcartqty\Helper\CheckoutFlag
     */
    protected $checkoutFlag;
    /**
     * @var DataConfigInterface
     */
    protected $dataConfig;
    /**
     * @var \Bss\Limitcartqty\Helper\ConfigValue
     */
    protected $helper;

    /**
     * Cart constructor.
     * @param DataConfigInterface $dataConfig
     * @param \Bss\Limitcartqty\Helper\CheckoutFlag $checkoutFlag
     * @param \Bss\Limitcartqty\Helper\ConfigValue $helper
     */
    public function __construct(
        DataConfigInterface $dataConfig,
        \Bss\Limitcartqty\Helper\CheckoutFlag $checkoutFlag,
        \Bss\Limitcartqty\Helper\ConfigValue $helper
    ) {
        $this->helper = $helper;
        $this->checkoutFlag = $checkoutFlag;
        $this->dataConfig = $dataConfig;
    }

    /**
     * @param \Magento\Checkout\CustomerData\Cart $subject
     * @param $result
     * @return mixed
     */
    public function afterGetSectionData(\Magento\Checkout\CustomerData\Cart $subject, $result)
    {
        if ($this->helper->isModuleEnable() == 1) {
            if ($result['summary_count'] > $this->dataConfig->getMaxValue() ||
                $result['summary_count'] < $this->dataConfig->getMinValue()
            ) {
                $result['possible_onepage_checkout'] = false;
            }
        }
        return $result;
    }
}
