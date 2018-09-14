<?php

/**
 * This model manages the GeoCoding drivers
 *
 * @package     Nails
 * @subpackage  module-geo-code
 * @category    Model
 * @author      Nails Dev Team
 * @link
 */

namespace Nails\Captcha\Model;

use Nails\Common\Model\BaseDriver;

class Driver extends BaseDriver
{
    protected $sModule         = 'nails/module-captcha';
    protected $sType           = 'captcha';
    protected $bEnableMultiple = false;
}
