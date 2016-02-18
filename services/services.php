<?php

return array(
    'models' => array(
        'Captcha' => function () {
            if (class_exists('\App\Captcha\Model\Captcha')) {
                return new \App\Captcha\Model\Captcha();
            } else {
                return new \Nails\Captcha\Model\Captcha();
            }
        },
        'CaptchaDriver' => function () {
            if (class_exists('\App\Captcha\Model\Captcha')) {
                return new \App\Captcha\Model\Driver();
            } else {
                return new \Nails\Captcha\Model\Driver();
            }
        }
    )
);
