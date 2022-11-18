<?php
/**
 * Abhay
 * 
 * PHP version 7
 * 
 * @category  Abhay
 * @package   Abhay_MobileNumberLogin
 * @author    Abhay Agrawal <abhay@gmail.com>
 * @copyright 2022 Copyright © Abhay
 * @license   See COPYING.txt for license details.
 * @link      https://github.com/abhay1198/mobile-number-login
 */

namespace Abhay\MobileNumberLogin\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class MobileNumberRegister implements ObserverInterface
{
    public $customerRepository;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function execute(Observer $observer)
    {
        $accountController = $observer->getAccountController();
        $customer = $observer->getCustomer();
        $request = $accountController->getRequest();
        $customer_register_number = $request->getParam('mobile_number');

        if ($customer_register_number && $customer_register_number != '') {
            $customer->setCustomAttribute('mobile_number', $customer_register_number);
            $this->customerRepository->save($customer);
        }
    }
}
