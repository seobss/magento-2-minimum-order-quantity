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

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CheckPayPal implements ObserverInterface
{
    protected $logger;
    protected $cart;
    protected $helper;
    protected $dataConfig;
    protected $checkoutFlag;
    protected $customMessage;
    protected $messageManager;
    protected $redirect;
    protected $redirectHttp;
    protected $responseFactory;
    protected $session;
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Checkout\Helper\Cart $cart,
        \Bss\Limitcartqty\Helper\CustomMessage $customMessage,
        \Bss\Limitcartqty\Helper\ConfigValue $helper,
        \Bss\Limitcartqty\Api\DataConfigInterface $dataConfig,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Bss\Limitcartqty\Helper\CheckoutFlag $checkoutFlag,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\App\Response\Http $redirectHttp,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Customer\Model\Session $session
    )
    {
        $this->session = $session;
        $this->responseFactory = $responseFactory;
        $this->redirectHttp = $redirectHttp;
        $this->redirect = $redirect;
        $this->customMessage = $customMessage;
        $this->checkoutFlag = $checkoutFlag;
        $this->dataConfig = $dataConfig;
        $this->helper = $helper;
        $this->cart = $cart;
        $this->logger = $logger;
        $this->messageManager = $messageManager;
    }
    public function execute(Observer $observer)
    {

        if ($this->helper->isModuleEnable() == 1) {
            $qty = $this->cart->getItemsQty();
            if ($qty > $this->dataConfig->getMaxValue() || $qty < $this->dataConfig->getMinValue()) {
                $this->messageManager->addError(
                    $this->customMessage->getMinMessage(
                        round($this->checkoutFlag->getMinConfigCartQty()),
                        round($this->checkoutFlag->getCartQty())
                    )
                );
//                $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
//                $logger = new \Zend\Log\Logger();
//                $logger->addWriter($writer);
//                $logger->info($this->redirect->getRefererUrl());

                $this->redirectHttp->setRedirect($this->redirect->getRefererUrl())->sendResponse();
                die;
            }
        }
    }
}