<?php

/**
 * This class registers some handlers for Invoicing & Payment settings
 *
 * @package     Nails
 * @subpackage  module-invoice
 * @category    AdminController
 * @author      Nails Dev Team
 * @link
 */

namespace Nails\Admin\Captcha;

use Nails\Factory;
use Nails\Admin\Helper;
use Nails\Admin\Controller\Base;

class Settings extends Base
{
    /**
     * Announces this controller's navGroups
     * @return stdClass
     */
    public static function announce()
    {
        $oNavGroup = Factory::factory('Nav', 'nailsapp/module-admin');
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
     * @return array
     */
    public static function permissions()
    {
        $aPermissions = parent::aPermissions();

        $aPermissions['driver'] = 'Can update driver settings';

        return $aPermissions;
    }

    // --------------------------------------------------------------------------

    /**
     * Manage Captcha settings
     * @return void
     */
    public function index()
    {
        //  Process POST
        if ($this->input->post()) {

            $aSettings = array(

                //  Captcha Drivers
                'enabled_drivers' => $this->input->post('enabled_drivers') ?: array(),
            );

            // --------------------------------------------------------------------------

            //  Validation
            $oFormValidation = Factory::service('FormValidation');

            $oFormValidation->set_rules('enabled_payment_drivers', '', '');

            if ($oFormValidation->run()) {

                $oDb = Factory::service('Database');

                try {

                    $oDb->trans_begin();

                    $oAppSettingModel = Factory::model('AppSetting');

                    if (!$oAppSettingModel->set($aSettings, 'nailsapp/module-invoice')) {
                        throw new \Exception($oAppSettingModel->lastError(), 1);
                    }

                    $oDb->trans_commit();
                    $this->data['success'] = 'Invoice &amp; Payment settings were saved.';

                } catch (\Exception $e) {

                    $oDb->trans_rollback();
                    $this->data['error'] = 'There was a problem saving settings. ' . $e->getMessage();
                }

            } else {

                $this->data['error'] = lang('fv_there_were_errors');
            }
        }

        // --------------------------------------------------------------------------

        //  Get data
        $this->data['settings'] = appSetting(null, 'nailsapp/module-captcha', true);

        //  Captcha drivers
        $oDriverModel                          = Factory::model('CaptchaDriver', 'nailsapp/module-captcha');
        $this->data['captcha_drivers']         = $oDriverModel->getAll();
        $this->data['captcha_drivers_enabled'] = $oDriverModel->getEnabledSlugs();
dumpanddie($this->data['captcha_drivers']);
        Helper::loadView('index');
    }
}
