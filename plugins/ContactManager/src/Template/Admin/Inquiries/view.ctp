<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Contact Enquiry'); ?>  <small>Contact Enquiry</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="pages">
    <div class="box">
        <div class="box-header"><?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?></div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($inquiry->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Mobile Number') ?></th>
                    <td><?= h($inquiry->mobile) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Product Name') ?></th>
                    <td>
                        <?= $this->Html->link(h($inquiry->Products['title']),['controller' => 'Products','action'=>'view',$inquiry->Products['id'], 'plugin' => 'CatalogManager' ]) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><a href="mailto:<?= h($inquiry->email) ?>"><?= h($inquiry->email) ?></a></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($inquiry->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($inquiry->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Message') ?></h4>
                    <?= $this->Text->autoParagraph(h($inquiry->message)); ?>
                </div>
            </div>
        </div>
    </div>
</section>
