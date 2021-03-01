<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $adminUser
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Admin User'); ?>  <small>Admin User Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="adminUsers">
<div class="adminUsers box">
    <div class="box-header">
            <h3 class="box-title"><?= h($adminUser->name) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($adminUser->name) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($adminUser->mobile) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($adminUser->email) ?></td>
        </tr>
     
        
<!--        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= $adminUser->dob != "" ? $adminUser->dob->format($ConfigSettings['ADMIN_DATE_FORMAT']) : 'N/A' ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $adminUser->created != "" ? $adminUser->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) : 'N/A' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $adminUser->modified != "" ? $adminUser->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) : 'N/A' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $adminUser->status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Verified') ?></th>
            <td><?= $adminUser->is_verified ? __('Yes') : __('No'); ?> <?= $this->Html->link('<span class="label label-success"><i class="fa fa-fw fa-mail-forward"></i>Resend email</span>',['action'=>'resend',$adminUser->id],['escape' => false]); ?></td>
        </tr>
    </table>
    </div>

</div>
</section>
