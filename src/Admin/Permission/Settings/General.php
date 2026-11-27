<?php

namespace Nails\Captcha\Admin\Permission\Settings;

use Nails\Admin\Interfaces\Permission;

class General implements Permission
{
    public function label(): string
    {
        return 'Can manage Captcha settings';
    }

    public function group(): string
    {
        return 'Settings';
    }
}
