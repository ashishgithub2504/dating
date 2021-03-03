<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Category'); ?>  <small>Category Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="categories">
<div class="categories box">
    <div class="box-header">
            <h3 class="box-title"><?= h($category->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($category->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($category->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($category->short_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($category->sort_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($category->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($category->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $category->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($category->description)); ?>
    </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($category->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Fake Pass') ?></th>
                <th scope="col"><?= __('Profile Photo') ?></th>
                <th scope="col"><?= __('Photo Dir') ?></th>
                <th scope="col"><?= __('Photo Size') ?></th>
                <th scope="col"><?= __('Photo Type') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Country') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Eye Color') ?></th>
                <th scope="col"><?= __('Hair Color') ?></th>
                <th scope="col"><?= __('Height') ?></th>
                <th scope="col"><?= __('Is Verified') ?></th>
                <th scope="col"><?= __('Login Count') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->mobile) ?></td>
                <td><?= h($users->dob) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->fake_pass) ?></td>
                <td><?= h($users->profile_photo) ?></td>
                <td><?= h($users->photo_dir) ?></td>
                <td><?= h($users->photo_size) ?></td>
                <td><?= h($users->photo_type) ?></td>
                <td><?= h($users->type) ?></td>
                <td><?= h($users->status) ?></td>
                <td><?= h($users->country) ?></td>
                <td><?= h($users->state) ?></td>
                <td><?= h($users->city) ?></td>
                <td><?= h($users->eye_color) ?></td>
                <td><?= h($users->hair_color) ?></td>
                <td><?= h($users->height) ?></td>
                <td><?= h($users->is_verified) ?></td>
                <td><?= h($users->login_count) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Users', 'action' => 'view', $users->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'Users', 'action' => 'edit', $users->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
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
