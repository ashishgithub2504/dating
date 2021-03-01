<?php
/**
 * @var \App\View\AppView $this
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Setting'); ?> <small>
            update smtp configuration details
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="settings">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info settings">

                <div class="box-header with-border">
                    <h3 class="box-title">SMTP Detail</h3>
                </div><!-- /.box-header -->

                <?= $this->Form->create($setting, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('0.slug', ['class' => 'form-control', 'value' => 'SMTP_ALLOW', 'readonly' => true, 'placeholder' => __('SMTP Tls'), 'label' => ['text' => 'Constant/Slug']]);
                                echo $this->Form->control('0.title', ['type' => 'hidden', 'value' => 'SMTP Allowed']);
                                echo $this->Form->control('0.id', ['type' => 'hidden']);
                                echo $this->Form->control('0.field_type', ['type' => 'hidden', 'value' => 'text']);

                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="4-config-value">Config Value</label>
                                <div class="form-group field-switch-type">
                                    <label class="css-input switch switch-sm switch-primary">
                                        <?= $this->Form->checkbox('0.config_value', ['class' => 'switch-status', 'id' => 'setting_checkbox', 'data-size' => 'mini', 'required' => false]); ?>
                                        <span></span>
                                    </label>
                                </div>
                                <?php
                                echo $this->Form->control('0.manager', ['type' => 'hidden', 'value' => 'smtp']);

                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('1.slug', ['class' => 'form-control', 'value' => 'SMTP_EMAIL_HOST', 'readonly' => true, 'placeholder' => __('Host'), 'label' => ['text' => 'Constant/Slug']]);
                                echo $this->Form->control('1.title', ['type' => 'hidden', 'value' => 'Email Host Name']);
                                echo $this->Form->control('1.id', ['type' => 'hidden']);
                                echo $this->Form->control('1.field_type', ['type' => 'hidden', 'value' => 'text']);

                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('1.config_value', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('SMTP server Host')]);
                                echo $this->Form->control('1.manager', ['type' => 'hidden', 'value' => 'smtp']);

                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('2.slug', ['class' => 'form-control', 'value' => 'SMTP_USERNAME', 'readonly' => true, 'placeholder' => __('SMTP Username'), 'label' => ['text' => 'Constant/Slug']]);
                                echo $this->Form->control('2.title', ['type' => 'hidden', 'value' => 'SMTP Username']);
                                echo $this->Form->control('2.id', ['type' => 'hidden']);
                                echo $this->Form->control('2.field_type', ['type' => 'hidden', 'value' => 'text']);

                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('2.config_value', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('SMTP username')]);
                                echo $this->Form->control('2.manager', ['type' => 'hidden', 'value' => 'smtp']);

                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('3.slug', ['class' => 'form-control', 'value' => 'SMTP_PASSWORD', 'readonly' => true, 'placeholder' => __('SMTP password'), 'label' => ['text' => 'Constant/Slug']]);
                                echo $this->Form->control('3.title', ['type' => 'hidden', 'value' => 'SMTP password']);
                                echo $this->Form->control('3.id', ['type' => 'hidden']);
                                echo $this->Form->control('3.field_type', ['type' => 'hidden', 'value' => 'text']);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('3.config_value', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('SMTP password')]);
                                echo $this->Form->control('3.manager', ['type' => 'hidden', 'value' => 'smtp']);

                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('4.slug', ['class' => 'form-control', 'value' => 'SMTP_PORT', 'readonly' => true, 'placeholder' => __('SMTP Port'), 'label' => ['text' => 'Constant/Slug']]);
                                echo $this->Form->control('4.title', ['type' => 'hidden', 'value' => 'SMTP port']);
                                echo $this->Form->control('4.id', ['type' => 'hidden']);
                                echo $this->Form->control('4.field_type', ['type' => 'hidden', 'value' => 'checkbox']);

                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('4.config_value', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('SMTP Port')]);
                                echo $this->Form->control('4.manager', ['type' => 'hidden', 'value' => 'smtp']);

                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('5.slug', ['class' => 'form-control', 'value' => 'SMTP_TLS', 'readonly' => true, 'placeholder' => __('SMTP Tls'), 'label' => ['text' => 'Constant/Slug']]);
                                echo $this->Form->control('5.title', ['type' => 'hidden', 'value' => 'SMTP Tls']);
                                echo $this->Form->control('5.id', ['type' => 'hidden']);
                                echo $this->Form->control('5.field_type', ['type' => 'hidden', 'value' => 'text']);

                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="5-config-value">Config Value</label>
                                <div class="form-group field-switch-type">
                                    <label class="css-input switch switch-sm switch-primary">
                                        <?= $this->Form->checkbox('5.config_value', ['class' => 'switch-status', 'id' => 'setting_checkbox', 'data-size' => 'mini', 'required' => false]); ?>
                                        <span></span>
                                    </label>
                                </div>
                                <?php
                                echo $this->Form->control('5.manager', ['type' => 'hidden', 'value' => 'smtp']);
                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  

                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>
                        For each config settings that would be added to the system, make sure it has these constant/slug:
                    </p>
                    <ul>
                        <li>
                            <small class="label bg-yellow">
                                SMTP_ALLOW
                            </small> - Will be replaced by SMTP allow flag from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SMTP_EMAIL_HOST
                            </small> - Will be replaced by SMTP email host from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SMTP_USERNAME
                            </small> - Will be replaced by SMTP username from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SMTP_PASSWORD
                            </small> - Will be replaced by SMTP Password from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SMTP_PORT
                            </small> - Will be replaced by SMTP Port from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SMTP_TLS
                            </small> - Will be replaced by SMTP tls from admin settings.
                        </li>

                    </ul>
                </div><!-- ./box-body -->
            </div>
        </div>
    </div>
</section>