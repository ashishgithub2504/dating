<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailPreference
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Preference'); ?>  <small>Email Preference Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailPreferences">
    <div class="box">

        <div class="box-header"><h3 class="box-title"><?= h($emailPreference->title) ?></h3>
        <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>

        <div class="box-body">

            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td>#<?= $this->Number->format($emailPreference->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Title') ?></th>
                    <td><?= h($emailPreference->title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= $emailPreference->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= $emailPreference->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $emailPreference->status ? __('Active') : __('Inactive'); ?></td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Layout Html') ?></h4>
                    <?= $emailPreference->layout_html ?>
                </div>
            </div>
            <div class="row related">
                <div class="col-md-12">
                    <h4><?= __('Related Email Templates') ?></h4>
                    <?php if (!empty($emailPreference->email_templates)): ?>
                        <table class="table table-hover table-striped">
                            <tr>
                                <th scope="col"><?= __('Id') ?></th>
                                <th scope="col"><?= __('Subject') ?></th>
                                <th scope="col"><?= __('Created') ?></th>
                                <th scope="col"><?= __('Modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($emailPreference->email_templates as $emailTemplates): ?>
                                <tr>
                                    <td><?= h($emailTemplates->id) ?></td>
                                    <td><?= h($emailTemplates->subject) ?></td>
                                    <td><?= $emailTemplates->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                                    <td><?= $emailTemplates->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'EmailTemplates', 'action' => 'view', $emailTemplates->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View Detail'), 'title' => __('View Detail')]) ?>

                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'EmailTemplates', 'action' => 'edit', $emailTemplates->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit Detail')]) ?>

                                   


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
