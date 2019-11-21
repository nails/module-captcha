<?php

namespace Nails\Captcha\Event\Listener\System;

use Nails\Captcha\Constants;
use Nails\Captcha\Service\Captcha;
use Nails\Common\Events;
use Nails\Common\Events\Subscription;
use Nails\Common\Exception\FactoryException;
use Nails\Factory;

/**
 * Class Ready
 *
 * @package Nails\Captcha\Event\Listener\System
 */
class Ready extends Subscription
{
    /**
     * Ready constructor.
     */
    public function __construct()
    {
        $this
            ->setEvent(Events::SYSTEM_READY)
            ->setCallback([$this, 'execute']);
    }

    // --------------------------------------------------------------------------

    /**
     * @throws FactoryException
     */
    public function execute(): void
    {
        /** @var Captcha $oCaptchaService */
        $oCaptchaService = Factory::service('Captcha', Constants::MODULE_SLUG);
        $oCaptchaService->boot();
    }
}
