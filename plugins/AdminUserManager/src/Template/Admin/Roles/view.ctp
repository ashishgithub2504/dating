<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Role'); ?>  <small>Role Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="roles">
<div class="roles box">
    <div class="box-header">
            <h3 class="box-title"><?= h($role->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($role->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($role->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($role->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($role->modified) ?></td>
        </tr>
    </table>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Admin Users') ?></h4>
        <?php if (!empty($role->admin_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Profile Photo') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Verified') ?></th>
                <th scope="col"><?= __('Login Count') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($role->admin_users as $adminUsers): ?>
            <tr>
                <td><?= h($adminUsers->id) ?></td>
                <td><?= h($adminUsers->role_id) ?></td>
                <td><?= h($adminUsers->name) ?></td>
                <td><?= h($adminUsers->mobile) ?></td>
                <td><?= h($adminUsers->dob) ?></td>
                <td><?= h($adminUsers->email) ?></td>
                <td><?= h($adminUsers->password) ?></td>
                <td><?= h($adminUsers->profile_photo) ?></td>
                <td><?= h($adminUsers->status) ?></td>
                <td><?= h($adminUsers->is_verified) ?></td>
                <td><?= h($adminUsers->login_count) ?></td>
                <td><?= h($adminUsers->created) ?></td>
                <td><?= h($adminUsers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'AdminUsers', 'action' => 'view', $adminUsers->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'AdminUsers', 'action' => 'edit', $adminUsers->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'AdminUsers', 'action' => 'delete', $adminUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminUsers->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
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
