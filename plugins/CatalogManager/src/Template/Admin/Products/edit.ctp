<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Product'); ?> <small>
            <?php echo empty($product->id) ? __('Add New product') : __('Edit product'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="products">
    <div class="box box-info products">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($product->id) ? 'Add Product' : 'Edit Product') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($product, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                echo $this->Form->control('slug',['class' => 'form-control', 'placeholder' => __('Slug')]);
                echo $this->Form->control('model',['class' => 'form-control', 'placeholder' => __('Model')]);
                echo $this->Form->control('sku',['class' => 'form-control', 'placeholder' => __('Sku')]);
                echo $this->Form->control('upc',['class' => 'form-control', 'placeholder' => __('Upc')]);
                echo $this->Form->control('price',['class' => 'form-control', 'placeholder' => __('Price')]);
                echo $this->Form->control('quantity',['class' => 'form-control', 'placeholder' => __('Quantity')]);
                echo $this->Form->control('minimum_quantity',['class' => 'form-control', 'placeholder' => __('Minimum Quantity')]);
            echo $this->Form->control('stock_status_id', ['options' => $stockStatuses, 'empty' => true, 'class' => 'form-control']);
                echo $this->Form->control('short_description',['class' => 'form-control', 'placeholder' => __('Short Description')]);
                echo $this->Form->control('description',['class' => 'form-control', 'placeholder' => __('Description')]);
                echo $this->Form->control('image',['class' => 'form-control', 'placeholder' => __('Image')]);
                echo $this->Form->control('meta_title',['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                echo $this->Form->control('meta_keyword',['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                echo $this->Form->control('meta_description',['class' => 'form-control', 'placeholder' => __('Meta Description')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
                echo $this->Form->control('sort_order',['class' => 'form-control', 'placeholder' => __('Sort Order')]);
            echo $this->Form->control('categories._ids', ['options' => $categories]);
            echo $this->Form->control('tags._ids', ['options' => $tags]);
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
