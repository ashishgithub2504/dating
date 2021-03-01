<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailTemplate
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Template'); ?>  <small>Email Template Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailTemplates">
    <div class="box">

        <div class="box-header"><h3 class="box-title"><?= h($emailTemplate->subject) ?></h3>
        <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>

        <div class="box-body">

            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td>#<?= $this->Number->format($emailTemplate->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email Hook') ?></th>
                    <td><?= $emailTemplate->has('email_hook') ? $this->Html->link($emailTemplate->email_hook->title, ['controller' => 'EmailHooks', 'action' => 'view', $emailTemplate->email_hook->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Subject') ?></th>
                    <td><?= h($emailTemplate->subject) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email Preference') ?></th>
                    <td><?= $emailTemplate->has('email_preference') ? $this->Html->link($emailTemplate->email_preference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $emailTemplate->email_preference->id]) : '' ?></td>
                </tr>

                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($emailTemplate->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($emailTemplate->modified) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $emailTemplate->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Description') ?></h4>
                    <?= $this->Text->autoParagraph($emailTemplate->description); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Footer Text') ?></h4>
                    <?= $this->Text->autoParagraph($emailTemplate->footer_text); ?>
                </div>
            </div>
        </div>
    </div>
</section>
