<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Page'); ?> <small>
            <?php echo empty($page->id) ? __('Add New page') : __('Edit page'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="pages">
    <div class="box box-info pages">

        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($page->id) ? 'Add Page' : 'Edit Page') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);
        ?>
        <?= $this->Form->create($page,['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                     <?php
                                        echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                                                            echo $this->Form->control('sub_title',['class' => 'form-control', 'placeholder' => __('Sub Title')]);
                                                            echo $this->Form->control('slug',['class' => 'form-control', 'placeholder' => __('Slug')]);
                                                            echo $this->Form->control('short_description',['class' => 'form-control', 'placeholder' => __('Short Description')]);
                                                            echo $this->Form->control('description',['class' => 'form-control', 'placeholder' => __('Description')]);
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