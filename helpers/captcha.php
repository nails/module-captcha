<?php

use Nails\Captcha\Factory\CaptchaForm;
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
    function captchaGenerate(): CaptchaForm
    {
        $oCaptcha = Factory::service('Captcha', 'nails/module-captcha');
        return $oCaptcha->generate();
    }
}

if (!function_exists('captchaVerify')) {
    function captchaVerify(string $sToken = null): bool
    {
        $oCaptcha = Factory::service('Captcha', 'nails/module-captcha');
        return $oCaptcha->verify($sToken);
    }
}

if (!function_exists('captchaError')) {
    function captchaError(): string
    {
        $oCaptcha = Factory::service('Captcha', 'nails/module-captcha');
        return $oCaptcha->lastError();
    }
}
