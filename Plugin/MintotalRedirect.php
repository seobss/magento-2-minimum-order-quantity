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

use Bss\Limitcartqty\Helper\CheckoutFlag;
use Magento\Checkout\Controller\Index\Index;
use Magento\Framework\App\Response\Http;
use Magento\Framework\App\Response\HttpInterface;
use Magento\Multishipping\Helper\Data;

/**
 * Class MintotalRedirect
 *
 * @package Bss\Limitcartqty\Plugin
 */
class MintotalRedirect
{
    /**
     * @var CheckoutFlag
     */
    protected $checkoutFlag;

    /**
     * @var Http
     */
    protected $response;

    /**
     * MintotalRedirect constructor.
     *
     * @param CheckoutFlag $checkoutFlag
     * @param Http $response
     */
    public function __construct(
        CheckoutFlag $checkoutFlag,
        Http $response
    ) {
        $this->checkoutFlag = $checkoutFlag;
        $this->response = $response;
    }

    /**
     * AfterExecute
     *
     * @param Index $subject
     * @param array $result
     * @return Http|HttpInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterExecute(Index $subject, $result)
    {
        if ($this->checkoutFlag->isEnableToCheckout()) {
            return $result;
        } else {
            return $this->response->setRedirect('cart');
        }
    }

    /**
     * MultishippingCheckout
     *
     * @param Data $subject
     * @param array $result
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterIsMultishippingCheckoutAvailable(Data $subject, $result)
    {
        return $this->checkoutFlag->validateCheckout() && $result;
    }
}
