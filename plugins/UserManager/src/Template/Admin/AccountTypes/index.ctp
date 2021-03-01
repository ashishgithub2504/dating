<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $accountTypes
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Account Type') ?>  
        <small><?php echo __('Here you can manage the account types'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="accountTypes">   
    <div class="row accountTypes">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Account Types') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Account Type'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
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
                <?php if (!empty($accountTypes->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($accountTypes as $accountType): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= h($accountType->title) ?></td>
            <td>
        <?php if ($accountType->created != "") {
                echo $accountType->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                }
                ?>
    </td>
                    <td class="actions">
                        <div class="btn-group">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $accountType->id],['class' => 'btn btn-warning btn-sm', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View account type'),'title'=>__('View account type')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $accountType->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit account type'),'title'=>__('Edit account type')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $accountType->id], ['onClick' => 'confirmDelete(this, \''.$accountType->id.'\')','class' => 'btn btn-danger btn-sm','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete account type'),'title'=>__('Delete account type')]) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
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