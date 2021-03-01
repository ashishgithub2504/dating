<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $modules
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Module'); ?>  
        <small><?php echo __('Here you can manage the modules'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="modules">
    <div class="row modules">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Modules'); ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Module'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('json_path','URL') ?></th>
<!--                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($modules->toArray())) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($modules as $module):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($module->title) ?></td>  
                                        <td>
                                            <?php
                                            $json_url = json_decode($module->json_path, true);
                                            $json_url['prefix'] = false;
                                            echo $this->Url->build($json_url, true);
                                            ?>
                                        </td>  
                                        <?php /* ?><td>
                                             <?= $this->Form->checkbox('status', ['checked' => $module->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $module->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                                        </td>
                                        <?php */ ?>

                                        <td>
                                            <?php
                                            if ($module->created != "") {
                                                echo $module->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>

                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $module->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View module'), 'title' => __('View module')]) ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $module->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit module')]) ?>
												<?php /* $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $module->id], ['onClick' => 'confirmDelete(this, \''.$module->title.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete module'),'title'=>__('Delete module')]); */ ?>
                                                </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                            } else {
                                echo "<tr> <td colspan='11' align='center'> <strong>Record Not Available</strong> </td> </tr>";
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
