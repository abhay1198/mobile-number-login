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

namespace Abhay\MobileNumberLogin\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Mobile NumberLogin Helper Class
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }
    
    /**
     * Get Module Status
     *
     * @return bool|0|1
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            'mobile_number_login/general/enable',
            ScopeInterface::SCOPE_STORE
        );
    }
}
