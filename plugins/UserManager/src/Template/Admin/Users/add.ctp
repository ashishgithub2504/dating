<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage User'); ?> <small>
            <?php echo empty($user->id) ? __('Add New user') : __('Edit user'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="users">
    <div class="box box-info users">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($user->id) ? 'Add User' : 'Edit User') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
        <?= $this->Form->create($user, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => __('First Name')]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => __('Last Name')]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('dob', ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'YYYY-mm-dd', 'label' => ['text' => "Date Of Birth"], 'readonly' => true]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']); ?>
                    <?php echo $this->Form->control('account_types._ids', ['options' => $accountTypes, 'class' => 'form-control']); ?>
                </div>
                 <div class="col-md-6">
                     <?php echo $this->Form->control('profile_photo', ['type' => 'file']); ?>
                       <?php 
                       if (!empty($user->profile_photo) && file_exists("img/".$user->image_path . $user->profile_photo)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($user->image_path . $user->profile_photo, ['id'=>'user_profile','class' => 'img-thumbnail', 'id' => 'logo_responce', 'alt' => 'Image', 'style' => 'max-height:100px']);
                            ?>

                            <?php
                            echo $this->Html->link("<i class=\"fa fa-trash\"></i> ", ['action' => 'deleteimg', $user->id], ['id'=>'confirmDeletePhoto', 'class' => 'btn btn-danger btn-sm', 'escape' => false,'style'=>'margin-left:10px;']);
                            ?>
                             </div>
                        <?php } ?>
                </div>
            </div>

        </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</section>
<?php
$this->Html->script(['GalleryManager.common'], ['block' => true]);
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);

?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    $('.datepicker').datetimepicker({
        minView: 2,
        format: 'yyyy-mm-dd',
        'showTimepicker': false,
        autoclose: true,
        endDate: "+0d"
    });
<?php $this->Html->scriptEnd(); ?>
</script>	