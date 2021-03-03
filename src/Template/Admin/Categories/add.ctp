<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
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
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($category, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                echo $this->Form->control('slug',['class' => 'form-control', 'placeholder' => __('Slug')]);
                echo $this->Form->control('short_description',['class' => 'form-control', 'placeholder' => __('Short Description')]);
                echo $this->Form->control('description',['class' => 'form-control', 'placeholder' => __('Description')]);
                echo $this->Form->control('sort_order',['class' => 'form-control', 'placeholder' => __('Sort Order')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
            echo $this->Form->control('users._ids', ['options' => $users,'class'=>'form-control']);
        ?>
</div>
</div>
    </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
    <?= $this->Form->end() ?>
</div>
        </section>
