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
use Nails\Captcha\Exception\CaptchaDriverException;

class Captcha
{
    use \Nails\Common\Traits\ErrorHandling;

    // --------------------------------------------------------------------------

    public function __construct()
    {
        $oDriverModel = Factory::model('CaptchaDriver', 'nailsapp/module-captcha');
        $aEnabled = $oDriverModel->getEnabled();
        if (!empty($aEnabled)) {
            $this->oDriver = $oDriverModel->getInstance($aEnabled[0]->slug);
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the form markup for the captcha
     * @return \stdClass
     */
    public function generate()
    {
        if (!empty($this->oDriver)) {

            $oResult = $this->oDriver->generate();

            if (!property_exists($oResult, 'label')) {
                throw new CaptchaDriverException('Driver must return an object with a label property.', 1);
            }

            if (!property_exists($oResult, 'html')) {
                throw new CaptchaDriverException('Driver must return an object with a html property.', 1);
            }

            return $oResult;

        } else {

            $this->setError('No driver loaded.');
            return null;
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Verifies a user's captcha entry
     * @return boolean
     */
    public function verify()
    {
        if (!empty($this->oDriver)) {
            return $this->oDriver->verify();
        } else {
            throw new CaptchaDriverException('No Captcha driver is enabled.', 1);
        }
    }
}
