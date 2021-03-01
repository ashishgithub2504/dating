<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $setting
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Setting'); ?>  <small>Setting Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="settings">
    <div class="box">

        <div class="box-header"><h3 class="box-title"><?= h($setting->title) ?></h3></div>

        <div class="box-body">

            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Title') ?></th>
                    <td><?= h($setting->title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Manager') ?></th>
                    <td><?= h($setting->manager) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Constant/Slug') ?></th>
                    <td><?= h($setting->slug) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Config Value') ?></th>
                    <td><?= h($setting->config_value) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Field Type') ?></th>
                    <td><?= h($setting->field_type) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($setting->created->format('d F, Y H:i A')) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($setting->modified->format('d F, Y H:i A')) ?></td>
                </tr>
            </table>

        </div>
    </div>
</section>
