<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gift $gift
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Gift'); ?>  <small>Gift Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="gifts">
<div class="gifts box">
    <div class="box-header">
            <h3 class="box-title"><?= h($gift->name) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($gift->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($gift->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($gift->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($gift->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coin') ?></th>
            <td><?= $this->Number->format($gift->coin) ?></td>
        </tr>
    </table>
    </div>

</div>
</section>
