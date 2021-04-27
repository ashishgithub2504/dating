<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Playwin[]|\Cake\Collection\CollectionInterface $playwins
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Playwin') ?>  
        <small><?php echo __('Here you can manage the playwins'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="playwins">   
    <div class="row playwins">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Playwins') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Playwin'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('return_coin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('win_coin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($playwins->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($playwins as $playwin): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= h($playwin->name) ?></td>
                <td><?= $this->Number->format($playwin->max) ?></td>
                <td><?= $this->Number->format($playwin->coin) ?></td>
                <td><?= $this->Number->format($playwin->return_coin) ?></td>
                <td><?= $this->Number->format($playwin->win_coin) ?></td>
                <td>
                    <?= $this->Form->checkbox('status', ['checked' => $playwin->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $playwin->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                   
            </td>
                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $playwin->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View playwin'),'title'=>__('View playwin')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $playwin->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit playwin'),'title'=>__('Edit playwin')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $playwin->id], ['onClick' => 'confirmDelete(this, \''.$playwin->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete playwin'),'title'=>__('Delete playwin')]) ?>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='8' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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