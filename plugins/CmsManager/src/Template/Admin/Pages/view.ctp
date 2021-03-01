<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
?>
<section class="content-header">
    <h1>
       <?php echo __('Manage Page'); ?>  <small>Page Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="pages">
    <div class="box">
        
    <div class="box-header"><h3 class="box-title"><?= h($page->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    
    <div class="box-body">
    
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($page->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Title') ?></th>
            <td><?= h($page->sub_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($page->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($page->short_description) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Meta Title') ?></th>
            <td><?= h($page->meta_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Keyword') ?></th>
            <td><?= h($page->meta_keyword) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Description') ?></th>
            <td>
            <?= $this->Text->autoParagraph(h($page->meta_description)); ?>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($page->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($page->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $page->status ? __('Active') : __('Inactive'); ?></td>
        </tr>
    </table>
    
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph($page->description); ?>
    </div>
    </div>
    
        </div>
    </div>
</section>
