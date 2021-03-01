<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Setting'); ?> <small>
            <?php echo empty($setting->id) ? __('Add New setting') : __('Edit setting'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="settings">
    <div class="box box-info settings">

        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($setting->id) ? 'Add Setting' : 'Edit Setting') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);
        ?>
        <?= $this->Form->create($setting,['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                     <?php
                                        echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                                                            echo $this->Form->control('slug',['class' => 'form-control', 'placeholder' => __('Slug')]);
                                                            echo $this->Form->control('config_value',['class' => 'form-control', 'placeholder' => __('Config Value')]);
                                                            echo $this->Form->control('manager',['class' => 'form-control', 'placeholder' => __('Manager')]);
                                                            echo $this->Form->control('field_type',['class' => 'form-control', 'placeholder' => __('Field Type')]);
                                                            ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</section>