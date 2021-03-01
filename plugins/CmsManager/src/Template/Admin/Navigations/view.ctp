<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $navigation
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Navigation'); ?>  <small>Navigation Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="navigations">
    <div class="box">

        <div class="box-header"><h3 class="box-title"><?= h($navigation->title) ?></h3></div>

        <div class="box-body">

            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Title') ?></th>
                    <td><?= h($navigation->title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Slug') ?></th>
                    <td><?= h($navigation->slug) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Parent Navigation') ?></th>
                    <td><?= $navigation->has('parent_navigation') ? $this->Html->link($navigation->parent_navigation->title, ['controller' => 'Navigations', 'action' => 'view', $navigation->parent_navigation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Menu Link') ?></th>
                    <td><?= h($navigation->menu_link) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Module') ?></th>
                    <td><?= $navigation->has('module') ? $this->Html->link($navigation->module->title, ['controller' => 'Modules', 'action' => 'view', $navigation->module->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($navigation->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($navigation->lft) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($navigation->rght) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($navigation->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($navigation->modified) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $navigation->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <div class="row related">
                <div class="col-md-12">
                    <h4><?= __('Related Navigations') ?></h4>
                    <?php if (!empty($navigation->child_navigations)): ?>
                        <table class="table table-hover table-striped">
                            <tr>
                                <th scope="col"><?= __('Id') ?></th>
                                <th scope="col"><?= __('Title') ?></th>
                                <th scope="col"><?= __('Slug') ?></th>
                                <th scope="col"><?= __('Parent Id') ?></th>
                                <th scope="col"><?= __('Menu Link') ?></th>
                                <th scope="col"><?= __('Module Id') ?></th>
                                <th scope="col"><?= __('Lft') ?></th>
                                <th scope="col"><?= __('Rght') ?></th>
                                <th scope="col"><?= __('Status') ?></th>
                                <th scope="col"><?= __('Created') ?></th>
                                <th scope="col"><?= __('Modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($navigation->child_navigations as $childNavigations): ?>
                                <tr>
                                    <td><?= h($childNavigations->id) ?></td>
                                    <td><?= h($childNavigations->title) ?></td>
                                    <td><?= h($childNavigations->slug) ?></td>
                                    <td><?= h($childNavigations->parent_id) ?></td>
                                    <td><?= h($childNavigations->menu_link) ?></td>
                                    <td><?= h($childNavigations->module_id) ?></td>
                                    <td><?= h($childNavigations->lft) ?></td>
                                    <td><?= h($childNavigations->rght) ?></td>
                                    <td><?= h($childNavigations->status) ?></td>
                                    <td><?= h($childNavigations->created) ?></td>
                                    <td><?= h($childNavigations->modified) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Navigations', 'action' => 'view', $childNavigations->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View Detail'), 'title' => __('View Detail')]) ?>

                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'Navigations', 'action' => 'edit', $childNavigations->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit Detail')]) ?>

                                        <?= $this->Form->postButton('<i class="fa fa-trash-o btn-xs" data-toggle="tooltip" data-placement="right" data-title="Delete hook" data-original-title="Delete hook" title=""></i>', ['controller' => 'Navigations', 'action' => 'delete', $childNavigations->id], [ 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>


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
