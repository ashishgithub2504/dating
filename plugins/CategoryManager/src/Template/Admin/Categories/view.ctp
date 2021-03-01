<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $category
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Category'); ?>  <small>Category Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="categories">
<div class="categories box">
    <div class="box-header">
            <h3 class="box-title"><?= h($category->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Parent Category') ?></th>
            <td><?= $this->cell('CategoryManager.Category::getParentCategories', [$category->id],[ 'cache' => ['key' => 'cell_category_' . $category->id]]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($category->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($category->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($category->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Banner') ?></th>
            <td><?= h($category->banner) ?></td>
        </tr>
        
       <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $category->status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($category->sort_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($category->short_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Title') ?></th>
            <td><?= h($category->meta_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Keyword') ?></th>
            <td><?= h($category->meta_keyword) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Meta Description') ?></th>
            <td><?= h($category->meta_description) ?></td>
        </tr>
        
        
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $category->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $category->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); ?></td>
        </tr>
        
    </table>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($category->description)); ?>
    </div>
    </div>
    
    
    </div>

</div>
</section>
