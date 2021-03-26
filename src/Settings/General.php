<?php

namespace Nails\Captcha\Settings;

use Nails\Captcha\Service\Driver;
use Nails\Common\Helper\Form;
use Nails\Common\Interfaces;
use Nails\Common\Service\FormValidation;
use Nails\Components\Setting;
use Nails\Captcha\Constants;
use Nails\Factory;

/**
 * Class General
 *
 * @package Nails\Captcha\Settings
 */
class General implements Interfaces\Component\Settings
{
    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return 'Captcha';
    }

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function getPermissions(): array
    {
        return [];
    }

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function get(): array
    {
        /** @var Driver $oDriverService */
        $oDriverService = Factory::service('CaptchaDriver', Constants::MODULE_SLUG);

        /** @var Setting $oDriver */
        $oDriver = Factory::factory('ComponentSetting');
        $oDriver
            ->setKey($oDriverService->getSettingKey())
            ->setType($oDriverService->isMultiple()
                ? Form::FIELD_DROPDOWN_MULTIPLE
                : Form::FIELD_DROPDOWN
            )
            ->setLabel('Driver')
            ->setFieldset('Driver')
            ->setClass('select2')
            ->setOptions(['' => 'No Driver Selected'] + $oDriverService->getAllFlat())
            ->setValidation([
                FormValidation::RULE_REQUIRED,
            ]);

        return [
            $oDriver,
        ];
    }
}
