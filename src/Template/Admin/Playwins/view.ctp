<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playwin $playwin
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Playwin'); ?>  <small>Playwin Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="playwins">
<div class="playwins box">
    <div class="box-header">
            <h3 class="box-title"><?= h($playwin->name) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($playwin->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($playwin->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($playwin->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max') ?></th>
            <td><?= $this->Number->format($playwin->max) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coin') ?></th>
            <td><?= $this->Number->format($playwin->coin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Return Coin') ?></th>
            <td><?= $this->Number->format($playwin->return_coin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Win Coin') ?></th>
            <td><?= $this->Number->format($playwin->win_coin) ?></td>
        </tr>
    </table>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($playwin->comment)); ?>
    </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Playwin Join') ?></h4>
        <?php if (!empty($playwin->playwin_join)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Playwin Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($playwin->playwin_join as $playwinJoin): ?>
            <tr>
                <td><?= h($playwinJoin->id) ?></td>
                <td><?= h($playwinJoin->user_id) ?></td>
                <td><?= h($playwinJoin->playwin_id) ?></td>
                <td><?= h($playwinJoin->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'PlaywinJoin', 'action' => 'view', $playwinJoin->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'PlaywinJoin', 'action' => 'edit', $playwinJoin->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'PlaywinJoin', 'action' => 'delete', $playwinJoin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playwinJoin->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
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
