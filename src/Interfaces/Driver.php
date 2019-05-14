<?php

namespace Nails\Captcha\Interfaces;

use Nails\Captcha\Factory\CaptchaForm;

interface Driver
{
    /**
     * Returns the form markup for the captcha
     *
     * @return \CaptchaForm
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
