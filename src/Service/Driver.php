<?php

/**
 * This service manages the GeoCoding drivers
 *
 * @package     Nails
 * @subpackage  module-geo-code
 * @category    Service
 * @author      Nails Dev Team
 * @link
 */

namespace Nails\Captcha\Service;

use Nails\Captcha\Constants;
use Nails\Common\Model\BaseDriver;

/**
 * Class Driver
 *
 * @package Nails\Captcha\Service
 */
class Driver extends BaseDriver
{
    protected $sModule         = Constants::MODULE_SLUG;
    protected $sType           = 'captcha';
    protected $bEnableMultiple = false;
}
