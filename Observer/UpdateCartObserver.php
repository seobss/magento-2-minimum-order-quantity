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
namespace Bss\Limitcartqty\Observer;

use Bss\Limitcartqty\Helper\CheckoutFlag;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class UpdateCartObserver
 *
 * @package Bss\Limitcartqty\Observer
 */
class UpdateCartObserver implements ObserverInterface
{
    /**
     * @var CheckoutFlag
     */
    protected $checkoutFlag;

    /**
     * UpdateCartObserver constructor.
     *
     * @param CheckoutFlag $checkoutFlag
     */
    public function __construct(
        CheckoutFlag $checkoutFlag
    ) {
        $this->checkoutFlag = $checkoutFlag;
    }

    /**
     * Execute
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $this->checkoutFlag->resetCart();
    }
}
