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

use Bss\Limitcartqty\Api\DataConfigInterface;

class CheckoutFlag extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $dataConfig;

    protected $customerSession;

    protected $messageManager;

    protected $customMessage;

    public function __construct(
        DataConfigInterface $dataConfig,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Bss\Limitcartqty\Helper\CustomMessage $customMessage
    ) {
        $this->dataConfig = $dataConfig;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        $this->customMessage = $customMessage;
    }

    /*
        Check with pop out message
    */
    public function validateCheckout()
    {
        return $this->validateMax() && $this->validateMin();
    }

    /*
        Check without pop out message
    */
    public function isEnableToCheckout()
    {
        return $this->checkMax() && $this->checkMin();
    }

    public function validateMin()
    {
        if ($this->checkMin()) {
            return true;
        } else {
            $this->messageManager->addError(
                $this->customMessage->getMinMessage(
                    round($this->getMinConfigCartQty()),
                    round($this->getCartQty())
                )
            );
            return false;
        }
    }

    public function validateMax()
    {
        if ($this->checkMax()) {
            return true;
        } else {
            $this->messageManager->addError(
                $this->customMessage->getMaxMessage(
                    round($this->getMaxConfigCartQty()),
                    round($this->getCartQty())
                )
            );
            return false;
        }
    }

    public function checkMax()
    {
        $this->customerSession->setMaxConfigCartQty($this->dataConfig->getMaxValue());
        return !($this->getMaxConfigCartQty()
            && $this->getCartQty() > $this->getMaxConfigCartQty())
            || !$this->dataConfig->isModuleEnable();
    }

    public function checkMin()
    {
        $this->customerSession->setMinConfigCartQty($this->dataConfig->getMinValue());
        return !($this->getMinConfigCartQty()
            && $this->getCartQty() < $this->getMinConfigCartQty())
            || !$this->dataConfig->isModuleEnable();
    }

    public function getMinConfigCartQty()
    {
        return $this->customerSession->getMinConfigCartQty();
    }

    public function getMaxConfigCartQty()
    {
        return $this->customerSession->getMaxConfigCartQty();
    }

    public function getCartQty()
    {
        if (!$this->customerSession->getCartQty()) {
            $cart = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Checkout\Model\Cart');
            $this->customerSession->setCartQty($cart->getQuote()->getItemsQty());
        }
        return $this->customerSession->getCartQty();
    }

    public function resetCart()
    {
        $this->customerSession->setCartQty(null);
    }
}
