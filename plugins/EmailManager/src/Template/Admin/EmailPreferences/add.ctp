<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Preference'); ?> 
        <small>
            <?php echo empty($emailPreference->id) ? __('Add New email preference') : __('Edit email preference'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailPreferences">
    <div class="row">

        <div class="col-md-8">
            <div class="box box-info emailPreferences">

                <div class="box-header with-border">
                    <h3 class="box-title"><?= __(empty($emailPreference->id) ? 'Add Email Preference' : 'Edit Email Preference') ?></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->
                <?php
//                $this->loadHelper('Form', [
//                    'templates' => 'horizontal_form',
//                ]);
                ?>
                <?= $this->Form->create($emailPreference, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('layout_html', ['class' => 'form-control', 'rows' => 13, 'placeholder' => __('Layout Html')]);
                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="col-md-4">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>
                        For each email style or email preference that would be added to the system, make sure it has these hooks:
                    </p>
                    <ul>
                        <li>
                            <small class="label bg-yellow">
                                ##SYSTEM_LOGO##
                            </small> - Will be replaced by logo from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ##SYSTEM_APPLICATION_NAME##
                            </small> - Will be replaced by application name from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ##EMAIL_CONTENT##
                            </small> - Will be replaced by email message from email hook settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ##EMAIL_FOOTER##
                            </small> - Will be replaced by email footer from email hook settings.
                        </li>
                    </ul>
                </div><!-- ./box-body -->
            </div>

        </div>
    </div>

</section>