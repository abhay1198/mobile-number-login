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
use Magento\Customer\Model\Customer;

class MobileNumberLogin implements ObserverInterface
{
    public $customers;

    public function __construct(
        \Magento\Customer\Model\Customer $customers
    ) {
        $this->customers = $customers;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getControllerAction()->getRequest();
        $username = $request->getPost('login');

        if (false === strpos($username['username'], '@')) {
            $collection = $this->customers->getCollection()
                ->addAttributeToFilter('mobile_number', $username['username']);
            if (count($collection) > 0) {
                foreach ($collection as $customer) {
                    $username['username'] = $customer->getEmail();
                    $request->setPostValue('login', $username);
                }
            }
        }
    }
}
