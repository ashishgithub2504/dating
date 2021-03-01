<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Audit Logs'), ['controller' => 'AuditLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Audit Log'), ['controller' => 'AuditLogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Tokens'), ['controller' => 'UserTokens', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Token'), ['controller' => 'UserTokens', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Account Types'), ['controller' => 'AccountTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account Type'), ['controller' => 'AccountTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('username');
            echo $this->Form->control('mobile');
            echo $this->Form->control('dob');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('fake_pass');
            echo $this->Form->control('profile_photo');
            echo $this->Form->control('photo_dir');
            echo $this->Form->control('photo_size');
            echo $this->Form->control('photo_type');
            echo $this->Form->control('status');
            echo $this->Form->control('is_verified');
            echo $this->Form->control('login_count');
            echo $this->Form->control('account_types._ids', ['options' => $accountTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
