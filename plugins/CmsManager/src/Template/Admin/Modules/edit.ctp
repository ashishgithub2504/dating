<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Module'); ?> <small>
            <?php echo empty($module->id) ? __('Add New module') : __('Edit module'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="modules">
    <div class="box box-info modules">

        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($module->id) ? 'Add Module' : 'Edit Module') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);
        ?>
        <?= $this->Form->create($module,['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                     <?php
                                        echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                                                            echo $this->Form->control('controller',['class' => 'form-control', 'placeholder' => __('Controller')]);
                                                            echo $this->Form->control('action',['class' => 'form-control', 'placeholder' => __('Action')]);
                                                            echo $this->Form->control('json_path',['class' => 'form-control', 'placeholder' => __('Json Path')]);
                                                            echo $this->Form->control('banner',['class' => 'form-control', 'placeholder' => __('Banner')]);
                                                            echo $this->Form->control('meta_title',['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                                                            echo $this->Form->control('meta_keyword',['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                                                            echo $this->Form->control('meta_description',['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                                                            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
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