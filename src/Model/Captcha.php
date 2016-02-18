<?php

/**
 * This model manages the production and verification of captchas
 *
 * @package     Nails
 * @subpackage  module-captcha
 * @category    Model
 * @author      Nails Dev Team
 */

namespace Nails\Captcha\Model;

use Nails\Factory;

class Captcha
{
    public function __construct()
    {
        $oDriverModel = Factory::model('CaptchaDriver', 'nailsapp/module-captcha');
        $aEnabled = $oDriverModel->getEnabled();
        dump($aEnabled);
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the form markup for the captcha
     * @return string
     */
    public function generate()
    {
        $sSiteKey = appSetting('site_key', 'nailsapp/module-captcha');

        if ($sSiteKey) {

        } else {
            return 'CAPTCHA HTML';
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Verifies a user's captcha entry
     * @return string
     */
    public function verify()
    {

    }
}
