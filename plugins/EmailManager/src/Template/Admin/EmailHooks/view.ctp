<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailHook
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Hook'); ?>  <small>Email Hook Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailHooks">
    <div class="box">
        <div class="box-header"><h3 class="box-title"><?= h($emailHook->title) ?></h3>
        <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('ID') ?></th>
                    <td>#<?= $this->Number->format($emailHook->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Title') ?></th>
                    <td><?= h($emailHook->title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Hook') ?></th>
                    <td><?= h($emailHook->slug) ?></td>
                </tr>

                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= $emailHook->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= $emailHook->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $emailHook->status ? __('Active') : __('Inactive'); ?></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Description') ?></h4>
                    <?= $this->Text->autoParagraph(h($emailHook->description)); ?>
                </div>
            </div>
            
        </div>
    </div>
</section>
