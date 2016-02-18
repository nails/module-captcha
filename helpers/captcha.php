<?php

use Nails\Factory;

/**
 * This helper brings some convinient functions for interacting with the captcha module
 *
 * @package     Nails
 * @subpackage  module-captcha
 * @category    Helper
 * @author      Nails Dev Team
 * @link
 */

if (!function_exists('captchaGenerate')) {

    /**
     * Returns the form markup for the captcha
     * @return string
     */
    function captchaGenerate()
    {
        $oCaptcha = Factory::model('Captcha', 'nailsapp/module-captcha');
        return $oCaptcha->generate();
    }
}

if (!function_exists('captchaVerify')) {

    /**
     * Verifies a user's captcha entry
     * @return string
     */
    function captchaVerify()
    {
        $oCaptcha = Factory::model('Captcha', 'nailsapp/module-captcha');
        return $oCaptcha->verify();
    }
}