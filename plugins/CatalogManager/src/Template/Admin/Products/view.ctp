<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Product'); ?>  <small>Product Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="products">
<div class="products box">
    <div class="box-header">
            <h3 class="box-title"><?= h($product->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($product->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($product->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= h($product->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sku') ?></th>
            <td><?= h($product->sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Upc') ?></th>
            <td><?= h($product->upc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Status') ?></th>
            <td><?= $product->has('stock_status') ? $this->Html->link($product->stock_status->title, ['controller' => 'StockStatuses', 'action' => 'view', $product->stock_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($product->short_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($product->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Title') ?></th>
            <td><?= h($product->meta_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Keyword') ?></th>
            <td><?= h($product->meta_keyword) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($product->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minimum Quantity') ?></th>
            <td><?= $this->Number->format($product->minimum_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($product->sort_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $product->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Meta Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->meta_description)); ?>
    </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Categories') ?></h4>
        <?php if (!empty($product->categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Banner') ?></th>
                <th scope="col"><?= __('Short Description') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Meta Title') ?></th>
                <th scope="col"><?= __('Meta Keyword') ?></th>
                <th scope="col"><?= __('Meta Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->categories as $categories): ?>
            <tr>
                <td><?= h($categories->id) ?></td>
                <td><?= h($categories->parent_id) ?></td>
                <td><?= h($categories->title) ?></td>
                <td><?= h($categories->slug) ?></td>
                <td><?= h($categories->image) ?></td>
                <td><?= h($categories->banner) ?></td>
                <td><?= h($categories->short_description) ?></td>
                <td><?= h($categories->description) ?></td>
                <td><?= h($categories->sort_order) ?></td>
                <td><?= h($categories->lft) ?></td>
                <td><?= h($categories->rght) ?></td>
                <td><?= h($categories->meta_title) ?></td>
                <td><?= h($categories->meta_keyword) ?></td>
                <td><?= h($categories->meta_description) ?></td>
                <td><?= h($categories->status) ?></td>
                <td><?= h($categories->created) ?></td>
                <td><?= h($categories->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Categories', 'action' => 'view', $categories->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'Categories', 'action' => 'edit', $categories->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'Categories', 'action' => 'delete', $categories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categories->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($product->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->title) ?></td>
                <td><?= h($tags->created) ?></td>
                <td><?= h($tags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Tags', 'action' => 'view', $tags->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'Tags', 'action' => 'edit', $tags->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Product Discounts') ?></h4>
        <?php if (!empty($product->product_discounts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Priority') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Date Start') ?></th>
                <th scope="col"><?= __('Date End') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_discounts as $productDiscounts): ?>
            <tr>
                <td><?= h($productDiscounts->id) ?></td>
                <td><?= h($productDiscounts->product_id) ?></td>
                <td><?= h($productDiscounts->quantity) ?></td>
                <td><?= h($productDiscounts->priority) ?></td>
                <td><?= h($productDiscounts->price) ?></td>
                <td><?= h($productDiscounts->sort_order) ?></td>
                <td><?= h($productDiscounts->date_start) ?></td>
                <td><?= h($productDiscounts->date_end) ?></td>
                <td><?= h($productDiscounts->created) ?></td>
                <td><?= h($productDiscounts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'ProductDiscounts', 'action' => 'view', $productDiscounts->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'ProductDiscounts', 'action' => 'edit', $productDiscounts->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'ProductDiscounts', 'action' => 'delete', $productDiscounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productDiscounts->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Product Images') ?></h4>
        <?php if (!empty($product->product_images)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Caption') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_images as $productImages): ?>
            <tr>
                <td><?= h($productImages->id) ?></td>
                <td><?= h($productImages->product_id) ?></td>
                <td><?= h($productImages->image) ?></td>
                <td><?= h($productImages->caption) ?></td>
                <td><?= h($productImages->sort_order) ?></td>
                <td><?= h($productImages->created) ?></td>
                <td><?= h($productImages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'ProductImages', 'action' => 'view', $productImages->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'ProductImages', 'action' => 'edit', $productImages->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'ProductImages', 'action' => 'delete', $productImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productImages->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Product Options') ?></h4>
        <?php if (!empty($product->product_options)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Option Id') ?></th>
                <th scope="col"><?= __('Option Value') ?></th>
                <th scope="col"><?= __('Is Required') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_options as $productOptions): ?>
            <tr>
                <td><?= h($productOptions->id) ?></td>
                <td><?= h($productOptions->product_id) ?></td>
                <td><?= h($productOptions->option_id) ?></td>
                <td><?= h($productOptions->option_value) ?></td>
                <td><?= h($productOptions->is_required) ?></td>
                <td><?= h($productOptions->created) ?></td>
                <td><?= h($productOptions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'ProductOptions', 'action' => 'view', $productOptions->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'ProductOptions', 'action' => 'edit', $productOptions->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'ProductOptions', 'action' => 'delete', $productOptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productOptions->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Product Specials') ?></h4>
        <?php if (!empty($product->product_specials)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Priority') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Date Start') ?></th>
                <th scope="col"><?= __('Date End') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_specials as $productSpecials): ?>
            <tr>
                <td><?= h($productSpecials->id) ?></td>
                <td><?= h($productSpecials->product_id) ?></td>
                <td><?= h($productSpecials->priority) ?></td>
                <td><?= h($productSpecials->price) ?></td>
                <td><?= h($productSpecials->sort_order) ?></td>
                <td><?= h($productSpecials->date_start) ?></td>
                <td><?= h($productSpecials->date_end) ?></td>
                <td><?= h($productSpecials->created) ?></td>
                <td><?= h($productSpecials->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'ProductSpecials', 'action' => 'view', $productSpecials->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'ProductSpecials', 'action' => 'edit', $productSpecials->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'ProductSpecials', 'action' => 'delete', $productSpecials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productSpecials->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Related Products') ?></h4>
        <?php if (!empty($product->related_products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Related Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->related_products as $relatedProducts): ?>
            <tr>
                <td><?= h($relatedProducts->id) ?></td>
                <td><?= h($relatedProducts->product_id) ?></td>
                <td><?= h($relatedProducts->related_id) ?></td>
                <td><?= h($relatedProducts->created) ?></td>
                <td><?= h($relatedProducts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'RelatedProducts', 'action' => 'view', $relatedProducts->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'RelatedProducts', 'action' => 'edit', $relatedProducts->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'RelatedProducts', 'action' => 'delete', $relatedProducts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedProducts->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    </div>

</div>
</section>
