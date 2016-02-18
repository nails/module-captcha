<?php

namespace Nails\Captcha\Interfaces;

interface Driver
{
    /**
     * Returns the form markup for the captcha
     * @return \stdClass
     */
    public function generate();

    // --------------------------------------------------------------------------

    /**
     * Verifies a user's captcha entry from POST Data
     * @return boolean
     */
    public function verify();
}
