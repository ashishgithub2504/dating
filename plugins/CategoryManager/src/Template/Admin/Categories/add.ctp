<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $category
 */

?>
<section class="content-header">
    <h1>
            <?php echo __('Manage Category'); ?> <small>
<?php echo empty($category->id) ? __('Add New category') : __('Edit category'); ?>
        </small>
    </h1>
<?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="categories">
    <div class="box box-info categories">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($category->id) ? 'Add Category' : 'Edit Category') ?></h3>
        <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
<?= $this->Form->create($category, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        echo $this->Form->control('parent_id', ['options' => $parentCategories, 'class' => 'form-control', 'empty' => 'Select Parent']);

                        ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                    </div>
                    
                    <div class="form-group">
                            <?php
                            echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);

                            ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']); ?> 
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order'),'min'=>0]); ?>
                            </div>  
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);

                        ?>
                    </div>
                    <div class="form-group">
<?php
echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);

?>
                    </div>
                    <div class="form-group">
                    <?php
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);

                    ?>
                    </div>
                </div>
            </div>  

            <div class="row">
                <div class="col-md-12">
<?php
echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]);

?>
                </div>
            </div>
        </div>
        <div class="box-footer">
<?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
<?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
    </div>


<?= $this->Form->end() ?>
</div>
</section>
