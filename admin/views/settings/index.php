<?php

//  Get any additional libraries we'll need
$oInput = nailsFactory('service', 'Input');

?>
<div class="group-invoice settings">
    <?php

        echo form_open();
        $sActiveTab = $this->input->post('active_tab') ?: 'tab-drivers';
        echo '<input type="hidden" name="active_tab" value="' . $sActiveTab . '" id="active-tab">';

    ?>
    <ul class="tabs" data-active-tab-input="#active-tab">
        <?php

        if (userHasPermission('admin:captcha:settings:drivers')) {

            ?>
            <li class="tab">
                <a href="#" data-tab="tab-drivers">Drivers</a>
            </li>
            <?php
        }

        ?>
    </ul>
    <section class="tabs">
        <?php

        if (userHasPermission('admin:captcha:settings:drivers')) {

            ?>
            <div class="tab-page tab-drivers">
                <?=adminHelper(
                    'loadSettingsDriverTable',
                    'enabled_drivers',
                    $captcha_drivers,
                    $captcha_drivers_enabled
                )?>
            </div>
            <?php
        }

    ?>
    </section>
    <p>
        <?=form_submit('submit', lang('action_save_changes'), 'class="btn btn-primary"')?>
    </p>
    <?=form_close()?>
</div>
