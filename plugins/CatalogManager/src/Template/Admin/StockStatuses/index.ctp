<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $stockStatuses
 */

?>
<section class="content-header">
    <h1>
<?= __('Manage Stock Status') ?>  
        <small><?php echo __('Here you can manage the stock statuses'); ?></small>
    </h1>
<?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="stockStatuses">   
    <div class="row stockStatuses">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Stock Statuses') ?></span></h3>
                    <div class="box-tools">
<?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Stock Status'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($stockStatuses->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($stockStatuses as $stockStatus):

                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($stockStatus->title) ?></td>
                                        <td>
        <?php
        if ($stockStatus->created != "") {
            echo $stockStatus->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
        }

        ?>
                                        </td>
                                        <td class="actions">
                                            <div class="form-group">
                                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $stockStatus->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit stock status'), 'title' => __('Edit stock status')]) ?>
                                    <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $stockStatus->id], ['onClick' => 'confirmDelete(this, \'' . $stockStatus->title . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete stock status'), 'title' => __('Delete stock status')]) ?>
                                            </div>
                                        </td>
                                    </tr>
        <?php $i++;
    endforeach; ?>
<?php else: ?>
                                <tr> <td colspan='4' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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