<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $module
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Module'); ?>  <small>Module Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="modules">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= h($module->title) ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Title') ?></th>
                    <td><?= h($module->title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Controller') ?></th>
                    <td><?= h($module->controller) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Action') ?></th>
                    <td><?= h($module->action) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Json Path') ?></th>
                    <td>
						<?php
						$json_url = json_decode($module->json_path, true);
						$json_url['prefix'] = false;
						echo $this->Url->build($json_url, true) ?>
					</td>
                </tr>

                <tr>
                    <th scope="row"><?= __('Meta Title') ?></th>
                    <td><?= h($module->meta_title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Meta Keyword') ?></th>
                    <td><?= h($module->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= $module->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= $module->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $module->status ? __('Active') : __('Inactive'); ?></td>
                </tr>
				<tr>
                    <th scope="row"><?= __('Meta Description') ?></th>
                    <td><?= $this->Text->autoParagraph(h($module->meta_description)); ?></td>
                </tr>
            </table>
            
        </div>
    </div>
</section>
