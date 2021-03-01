<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Audit Logs'), ['controller' => 'AuditLogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Audit Log'), ['controller' => 'AuditLogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Tokens'), ['controller' => 'UserTokens', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Token'), ['controller' => 'UserTokens', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Account Types'), ['controller' => 'AccountTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Account Type'), ['controller' => 'AccountTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
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
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fake Pass') ?></th>
            <td><?= h($user->fake_pass) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile Photo') ?></th>
            <td><?= h($user->profile_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo Dir') ?></th>
            <td><?= h($user->photo_dir) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo Type') ?></th>
            <td><?= h($user->photo_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo Size') ?></th>
            <td><?= $this->Number->format($user->photo_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Count') ?></th>
            <td><?= $this->Number->format($user->login_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= h($user->dob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $user->status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Verified') ?></th>
            <td><?= $user->is_verified ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Account Types') ?></h4>
        <?php if (!empty($user->account_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->account_types as $accountTypes): ?>
            <tr>
                <td><?= h($accountTypes->id) ?></td>
                <td><?= h($accountTypes->title) ?></td>
                <td><?= h($accountTypes->created) ?></td>
                <td><?= h($accountTypes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AccountTypes', 'action' => 'view', $accountTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AccountTypes', 'action' => 'edit', $accountTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AccountTypes', 'action' => 'delete', $accountTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Audit Logs') ?></h4>
        <?php if (!empty($user->audit_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Loged Id') ?></th>
                <th scope="col"><?= __('Transaction') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Primary Key') ?></th>
                <th scope="col"><?= __('Source') ?></th>
                <th scope="col"><?= __('Parent Source') ?></th>
                <th scope="col"><?= __('Original') ?></th>
                <th scope="col"><?= __('Changed') ?></th>
                <th scope="col"><?= __('Meta') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->audit_logs as $auditLogs): ?>
            <tr>
                <td><?= h($auditLogs->id) ?></td>
                <td><?= h($auditLogs->user_id) ?></td>
                <td><?= h($auditLogs->loged_id) ?></td>
                <td><?= h($auditLogs->transaction) ?></td>
                <td><?= h($auditLogs->type) ?></td>
                <td><?= h($auditLogs->primary_key) ?></td>
                <td><?= h($auditLogs->source) ?></td>
                <td><?= h($auditLogs->parent_source) ?></td>
                <td><?= h($auditLogs->original) ?></td>
                <td><?= h($auditLogs->changed) ?></td>
                <td><?= h($auditLogs->meta) ?></td>
                <td><?= h($auditLogs->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AuditLogs', 'action' => 'view', $auditLogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AuditLogs', 'action' => 'edit', $auditLogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AuditLogs', 'action' => 'delete', $auditLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $auditLogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Tokens') ?></h4>
        <?php if (!empty($user->user_tokens)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('User Type') ?></th>
                <th scope="col"><?= __('Token Type') ?></th>
                <th scope="col"><?= __('Token') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_tokens as $userTokens): ?>
            <tr>
                <td><?= h($userTokens->id) ?></td>
                <td><?= h($userTokens->user_id) ?></td>
                <td><?= h($userTokens->user_type) ?></td>
                <td><?= h($userTokens->token_type) ?></td>
                <td><?= h($userTokens->token) ?></td>
                <td><?= h($userTokens->status) ?></td>
                <td><?= h($userTokens->created) ?></td>
                <td><?= h($userTokens->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserTokens', 'action' => 'view', $userTokens->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserTokens', 'action' => 'edit', $userTokens->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserTokens', 'action' => 'delete', $userTokens->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userTokens->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
