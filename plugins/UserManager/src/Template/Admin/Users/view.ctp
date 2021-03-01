<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage User'); ?>  <small>User Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="users">
<div class="users box">
    <div class="box-header">
            <h3 class="box-title"><?= h($user->name) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Display Name') ?></th>
            <td><?= h($user->display_name) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($user->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
    
      
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= !empty($user->dob) ? $user->dob->format($ConfigSettings['ADMIN_DATE_FORMAT']): '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $user->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $user->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Verified') ?></th>
            <td><?= $user->is_verified ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
 
    </div>

</div>
</section>
