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

use Exception;
use Nails\Captcha\Exception\CaptchaDriverException;
use Nails\Captcha\Factory\CaptchaForm;
use Nails\Common\Exception\FactoryException;
use Nails\Common\Traits\ErrorHandling;
use Nails\Factory;

/**
 * Class Captcha
 *
 * @package Nails\Captcha\Service
 */
class Captcha
{
    use ErrorHandling;

    // --------------------------------------------------------------------------

    /**
     * The enabled captcha driver
     *
     * @var \Nails\Captcha\Interfaces\Driver
     */
    protected $oDriver;

    // --------------------------------------------------------------------------

    /**
     * Captcha constructor.
     *
     * @throws FactoryException
     */
    public function __construct()
    {
        /** @var Driver $oDriverService */
        $oDriverService = Factory::service('CaptchaDriver', 'nails/module-captcha');
        $sEnabled       = $oDriverService->getEnabledSlug();
        if (!empty($sEnabled)) {
            $this->oDriver = $oDriverService->getInstance($sEnabled);
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the form markup for the captcha
     *
     * @return CaptchaForm
     * @throws FactoryException
     */
    public function generate(): CaptchaForm
    {
        try {

            if (!$this->isEnabled()) {
                throw new CaptchaDriverException(
                    'Captcha driver has not been configured.'
                );
            }

            $oResponse = $this->oDriver->generate();

        } catch (Exception $e) {
            $oResponse = Factory::factory('CaptchaForm', 'nails/module-captcha');
            $oResponse->setHtml(
                '<p style="color: red; padding: 1rem; border: 1px solid red;">ERROR: ' . $e->getMessage() . '</p>'
            );
        }

        return $oResponse;
    }

    // --------------------------------------------------------------------------

    /**
     * Verifies a user's captcha entry
     *
     * @param string|null $sToken The token to verify
     *
     * @return bool
     * @throws CaptchaDriverException
     */
    public function verify(string $sToken = null): bool
    {
        if ($this->isEnabled()) {
            return $this->oDriver->verify($sToken);
        } else {
            throw new CaptchaDriverException('Captcha driver has not been configured.', 1);
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Determines whether a driver has been enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return !empty($this->oDriver);
    }
}
