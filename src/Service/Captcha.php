<?php

/**
 * This model manages the production and verification of captchas
 *
 * @package     Nails
 * @subpackage  module-captcha
 * @category    Service
 * @author      Nails Dev Team
 */

namespace Nails\Captcha\Service;

use Nails\Factory;
use Nails\Captcha\Exception\CaptchaDriverException;
use Nails\Captcha\Factory\CaptchaForm;

class Captcha
{
    use \Nails\Common\Traits\ErrorHandling;

    // --------------------------------------------------------------------------

    public function __construct()
    {
        $oDriverModel = Factory::model('CaptchaDriver', 'nailsapp/module-captcha');
        $sEnabled     = $oDriverModel->getEnabledSlug();
        if (!empty($sEnabled)) {
            $this->oDriver = $oDriverModel->getInstance($sEnabled);
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the form markup for the captcha
     * @return CaptchaForm
     */
    public function generate()
    {
        try {

            if (!$this->isEnabled()) {
                throw new CaptchaDriverException(
                    'Captcha driver has not been configured.'
                );
            }

            $oResponse = $this->oDriver->generate();

            if (!($oResponse instanceof CaptchaForm)) {
                throw new CaptchaDriverException(
                    'Driver must return an instance of \Nails\Captcha\Factory\CaptchaForm.'
                );
            }

        } catch (\Exception $e) {
            $oResponse = Factory::factory('CaptchaForm', 'nailsapp/module-captcha');
            $oResponse->setHtml(
                '<p style="color: red; padding: 1rem; border: 1px solid red;">ERROR: ' . $e->getMessage() . '</p>'
            );
        }

        return $oResponse;
    }

    // --------------------------------------------------------------------------

    /**
     * Verifies a user's captcha entry
     * @return boolean
     */
    public function verify()
    {
        if ($this->isEnabled()) {
            return $this->oDriver->verify();
        } else {
            throw new CaptchaDriverException('Captcha driver has not been configured.', 1);
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Determines whether a driver has been enabled
     * @return boolean
     */
    public function isEnabled()
    {
        return !empty($this->oDriver);
    }
}
