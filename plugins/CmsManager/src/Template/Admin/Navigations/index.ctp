<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $navigations
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Navigation'); ?>  
        <small><?php echo __('Here you can manage the navigations'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="navigations">
    <div class="row navigations">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Navigations'); ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Navigation'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Parent Menu</th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('menu_link') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($navigations->toArray())) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($navigations as $navigation):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?php echo $this->cell('CmsManager.Navigations::getParentMenus', [$navigation->id]); ?></td>  
                                        <td><?= h($navigation->title) ?></td>  
                                        <td>
                                            <?php
                                            $json_url = json_decode($navigation->menu_link, true);
                                            if (empty($json_url)) {
                                               $json_url = $navigation->menu_link;
                                            } else {
                                                $json_url['prefix'] = FALSE;
                                            }
                                           echo $this->Url->build($json_url, true);
                                            ?>
                                        </td>  
                                        <td>
                                             <?= $this->Form->checkbox('status', ['checked' => $navigation->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $navigation->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($navigation->created != "") {
                                                echo $navigation->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $navigation->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit navigation')]) ?>
                                             
												<?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $navigation->id], ['onClick' => 'confirmDelete(this, \''.$navigation->title.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete navigation'),'title'=>__('Delete navigation')]) ?>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                            } else {
                                echo "<tr> <td colspan='9' align='center'> <strong>Record Not Available</strong> </td> </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
