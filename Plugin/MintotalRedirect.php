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
namespace Bss\Limitcartqty\Plugin;

/**
 * Class MintotalRedirect
 * @package Bss\Limitcartqty\Plugin
 */
class MintotalRedirect
{
    /**
     * @var \Bss\Limitcartqty\Helper\CheckoutFlag
     */
    protected $checkoutFlag;

    /**
     * @var \Magento\Framework\App\Response\Http
     */
    protected $response;

    /**
     * MintotalRedirect constructor.
     * @param \Bss\Limitcartqty\Helper\CheckoutFlag $checkoutFlag
     * @param \Magento\Framework\App\Response\Http $response
     */
    public function __construct(
        \Bss\Limitcartqty\Helper\CheckoutFlag $checkoutFlag,
        \Magento\Framework\App\Response\Http $response
    ) {
        $this->checkoutFlag = $checkoutFlag;
        $this->response = $response;
    }

    /**
     * @param \Magento\Checkout\Controller\Index\Index $subject
     * @param $result
     * @return \Magento\Framework\App\Response\Http|\Magento\Framework\App\Response\HttpInterface
     */
    public function afterExecute(\Magento\Checkout\Controller\Index\Index $subject, $result)
    {
        if ($this->checkoutFlag->isEnableToCheckout()) {
            return $result;
        } else {
            return $this->response->setRedirect('cart');
        }
    }

    /**
     * @param \Magento\Multishipping\Helper\Data $subject
     * @param $result
     * @return bool
     */
    public function afterIsMultishippingCheckoutAvailable(\Magento\Multishipping\Helper\Data $subject, $result)
    {
        return $this->checkoutFlag->validateCheckout() && $result;
    }
}
