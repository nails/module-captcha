<?php

/**
 * This class registers some handlers for Invoicing & Payment settings
 *
 * @package     Nails
 * @subpackage  module-captcha
 * @category    AdminController
 * @author      Nails Dev Team
 * @link
 */

namespace Nails\Admin\Captcha;

use Exception;
use Nails\Admin\Controller\Base;
use Nails\Admin\Helper;
use Nails\Captcha\Constants;
use Nails\Common\Exception\FactoryException;
use Nails\Factory;

/**
 * Class Settings
 *
 * @package Nails\Admin\Captcha
 */
class Settings extends Base
{
    /**
     * Announces this controller's navGroups
     *
     * @return object
     * @throws FactoryException
     */
    public static function announce()
    {
        $oNavGroup = Factory::factory('Nav', 'nails/module-admin');
        $oNavGroup->setLabel('Settings');
        $oNavGroup->setIcon('fa-wrench');

        if (userHasPermission('admin:captcha:settings:*')) {
            $oNavGroup->addAction('Captcha');
        }

        return $oNavGroup;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns an array of permissions which can be configured for the user
     *
     * @return array
     */
    public static function permissions(): array
    {
        $aPermissions = parent::permissions();

        $aPermissions['driver'] = 'Can update driver settings';

        return $aPermissions;
    }

    // --------------------------------------------------------------------------

    /**
     * Manage Captcha settings
     *
     * @return void
     * @throws FactoryException
     */
    public function index()
    {
        if (!userHasPermission('admin:captcha:settings:*')) {
            unauthorised();
        }

        $oDb                   = Factory::service('Database');
        $oInput                = Factory::service('Input');
        $oCaptchaDriverService = Factory::service('CaptchaDriver', Constants::MODULE_SLUG);

        if ($oInput->post()) {

            //  Settings keys
            $sKeyCaptchaDriver = $oCaptchaDriverService->getSettingKey();

            //  Validation
            $oFormValidation = Factory::service('FormValidation');

            $oFormValidation->set_rules($sKeyCaptchaDriver, '', 'required');

            if ($oFormValidation->run()) {

                try {

                    $oDb->trans_begin();

                    //  Drivers
                    $oCaptchaDriverService->saveEnabled($oInput->post($sKeyCaptchaDriver));

                    $oDb->trans_commit();
                    $this->data['success'] = 'Captcha settings were saved.';

                } catch (Exception $e) {
                    $oDb->trans_rollback();
                    $this->data['error'] = 'There was a problem saving settings. ' . $e->getMessage();
                }

            } else {

                $this->data['error'] = lang('fv_there_were_errors');
            }
        }

        // --------------------------------------------------------------------------

        //  Get data
        $this->data['settings']                = appSetting(null, Constants::MODULE_SLUG, true);
        $this->data['captcha_drivers']         = $oCaptchaDriverService->getAll();
        $this->data['captcha_drivers_enabled'] = $oCaptchaDriverService->getEnabledSlug();

        Helper::loadView('index');
    }
}
