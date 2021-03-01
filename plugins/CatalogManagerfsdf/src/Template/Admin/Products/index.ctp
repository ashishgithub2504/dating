<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $products
 */

?>
<section class="content-header">
    <h1>
<?= __('Manage Product') ?>  
        <small><?php echo __('Here you can manage the products'); ?></small>
    </h1>
<?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="products">   
    <div class="row products">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Products') ?></span></h3>
                    <div class="box-tools">
<?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Product'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('model') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('minimum_quantity') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($products->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($products as $product):

                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($product->title) ?></td>
                                        <td><?= h($product->model) ?></td>
                                        <td><?= $this->Number->format($product->price) ?></td>
                                        <td><?= $this->Number->format($product->quantity) ?></td>
                                        <td><?= $this->Number->format($product->minimum_quantity) ?></td>
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $product->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $product->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
        <?php
        if ($product->created != "") {
            echo $product->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
        }

        ?>
                                        </td>
                                        <td class="actions">
                                            <div class="form-group">
                                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $product->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View product'), 'title' => __('View product')]) ?>
                                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $product->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit product'), 'title' => __('Edit product')]) ?>
                                    <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $product->id], ['onClick' => 'confirmDelete(this, \'' . $product->id . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete product'), 'title' => __('Delete product')]) ?>
                                            </div>
                                        </td>
                                    </tr>
        <?php $i++;
    endforeach; ?>
<?php else: ?>
                                <tr> <td colspan='18' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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