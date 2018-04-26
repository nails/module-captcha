<?php

return [
    'services'    => [
        'Captcha'       => function () {
            if (class_exists('\App\Captcha\Model\Captcha')) {
                return new \App\Captcha\Model\Captcha();
            } else {
                return new \Nails\Captcha\Model\Captcha();
            }
        },
    ],
    'models'  => [
        'CaptchaDriver' => function () {
            if (class_exists('\App\Captcha\Model\Captcha')) {
                return new \App\Captcha\Model\Driver();
            } else {
                return new \Nails\Captcha\Model\Driver();
            }
        },
    ],
    'factories' => [
        'CaptchaForm' => function () {
            if (class_exists('\App\Captcha\Factory\CaptchaForm')) {
                return new \App\Captcha\Factory\CaptchaForm();
            } else {
                return new \Nails\Captcha\Factory\CaptchaForm();
            }
        },
    ],
];
