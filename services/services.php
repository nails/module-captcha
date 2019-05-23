<?php

return [
    'services'  => [
        'Captcha'       => function () {
            if (class_exists('\App\Captcha\Service\Captcha')) {
                return new \App\Captcha\Service\Captcha();
            } else {
                return new \Nails\Captcha\Service\Captcha();
            }
        },
        'CaptchaDriver' => function () {
            if (class_exists('\App\Captcha\Service\Captcha')) {
                return new \App\Captcha\Service\Driver();
            } else {
                return new \Nails\Captcha\Service\Driver();
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
