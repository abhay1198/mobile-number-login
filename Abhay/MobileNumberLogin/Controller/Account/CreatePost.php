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
namespace Abhay\MobileNumberLogin\Controller\Account;

use Magento\Customer\Model\CustomerFactory;

/**
 * Check Mobile Number exist or not
 */
class CreatePost extends \Magento\Customer\Controller\Account\CreatePost
{
    /**
     * Execute Method
     * 
     * @return execute()
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $mobile = $this->getRequest()->getParam('mobile_number');
        $collection = $this->_getCustomer()->getCollection()
            ->addAttributeToFilter('mobile_number', $mobile);
        $flag = 0;
        foreach ($collection as $customer) {
            if ($customer->getEmail()) {
                $flag = 1;
            }
        }
        if ($flag) {
            $message = __(
                'There is already an account with this mobile number.'
            );
            $this->messageManager->addError($message);
            $url = $this->urlModel->getUrl('*/*/create', ['_secure' => true]);
            $resultRedirect->setUrl($this->_redirect->error($url));
            return $resultRedirect;
        }
        return parent::execute();
    }
    /**
     * Get Customer Details
     * 
     * @return customerData
     */
    private function _getCustomer()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get(
            \Magento\Customer\Model\Customer::class
        );
    }
}
