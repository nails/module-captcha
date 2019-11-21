<?php

namespace Nails\Captcha\Interfaces;

use Nails\Captcha\Factory\CaptchaForm;

/**
 * Interface Driver
 *
 * @package Nails\Captcha\Interfaces
 */
interface Driver
{
    /**
     * Called during system boot, allows the driver to load assets etc
     */
    public function boot(): void;

    // --------------------------------------------------------------------------

    /**
     * Returns the form markup for the captcha
     *
     * @return CaptchaForm
     */
    public function generate(): CaptchaForm;

    // --------------------------------------------------------------------------

    /**
     * Verifies a user's captcha entry
     *
     * @param string|null $sToken The token to verify
     *
     * @return bool
     */
    public function verify(string $sToken = null): bool;
}
