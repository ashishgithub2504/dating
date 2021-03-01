<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $categories
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Category') ?>  
        <small><?php echo __('Here you can manage the categories'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="categories"> 
    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get']) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('parent_id', ['options' => $parentCategories, 'class' => 'form-control', 'empty' => 'Select Parent', 'label' => false]);

                            ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select(
                                'status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control', 'empty' => 'Select Status']
                            );

                            ?>
                        </div>
                    </div>
                    

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->input("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'Keyword e.g: title', 'label' => false]); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->button(__('<i class="fa fa-filter"></i> Filter'), ['class' => 'btn btn-success', 'title' => __('Search')]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> " . __('Reset'), ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);

                            ?>
                        </div>
                    </div>
                    
                </div>

                
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <div class="row categories">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Categories') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Category'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($categories->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($categories as $category): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                    <td><?= $this->cell('CategoryManager.Category::getParentCategories', [$category->id],[ 'cache' => ['key' => 'cell_category_' . $category->id]]) ?>
                
                <td><?= h($category->title) ?></td>
                
                <td>
                    <?= $this->Form->checkbox('status', ['checked' => $category->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $category->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                   
            </td>
            <td>
        <?php if ($category->created != "") {
                echo $category->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                }
                ?>
    </td>
                    <td class="actions">
                        <div class="form-group">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $category->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View category'),'title'=>__('View category')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $category->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit category'),'title'=>__('Edit category')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $category->id], ['onClick' => 'confirmDelete(this, \''.$category->title.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete category'),'title'=>__('Delete category')]) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='13' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>            

                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>            

            </div>
        </div>
    </div>
</section>