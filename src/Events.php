<?php

/**
 * The class provides a summary of the events fired by this module
 *
 * @package     Nails
 * @subpackage  module-captcha
 * @category    Events
 * @author      Nails Dev Team
 */

namespace Nails\Captcha;

use Nails\Captcha\Event\Listener\System;
use Nails\Common\Events\Base;
use Nails\Common\Events\Subscription;

class Events extends Base
{
    /**
     * Subscribe to events
     *
     * @return Subscription[]
     */
    public function autoload(): array
    {
        return [
            new System\Ready(),
        ];
    }
}
