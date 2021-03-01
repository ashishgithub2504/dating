<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $adminUser
 */

?>
<section class="content-header">
    <h1>
            <?php echo __('Manage Admin User'); ?> <small>
<?php echo empty($adminUser->id) ? __('Add New admin user') : __('Edit admin user'); ?>
        </small>
    </h1>
<?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="adminUsers">
    <div class="box box-info adminUsers">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($adminUser->id) ? 'Add Admin User' : 'Edit Admin User') ?></h3>
        <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
<?= $this->Form->create($adminUser, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    echo $this->Form->control('name', ['class' => 'form-control', 'placeholder' => __('Name')]);
                    echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    echo $this->Form->control('roles._ids', ['options' => $roles, 'class' => 'form-control']);

                    ?>
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
