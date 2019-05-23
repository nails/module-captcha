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

use Nails\Common\Model\BaseDriver;

/**
 * Class Driver
 *
 * @package Nails\Captcha\Service
 */
class Driver extends BaseDriver
{
    protected $sModule         = 'nails/module-captcha';
    protected $sType           = 'captcha';
    protected $bEnableMultiple = false;
}
