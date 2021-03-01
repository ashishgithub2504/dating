<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $roles
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Role') ?>  
        <small><?php echo __('Here you can manage the roles'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="roles">   
    <div class="row roles">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Roles') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Role'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
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
                <?php if (!empty($roles->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($roles as $role): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= h($role->title) ?></td>
            <td>
        <?php if ($role->created != "") {
                echo $role->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                }
                ?>
    </td>
                    <td class="actions">
                        <div class="btn-group">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $role->id],['class' => 'btn btn-warning btn-sm', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View role'),'title'=>__('View role')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $role->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit role'),'title'=>__('Edit role')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $role->id], ['onClick' => 'confirmDelete(this, '.$role->id.')','class' => 'btn btn-danger btn-sm','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete role'),'title'=>__('Delete role')]) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
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