<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $attributeGroups
 */

?>
<section class="content-header">
    <h1>
        <?= __('Manage Attribute Group') ?>  
        <small><?php echo __('Here you can manage the attribute groups'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="attributeGroups">   
    <div class="row attributeGroups">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Attribute Groups') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Attribute Group'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col" width="40%"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('sort_order') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($attributeGroups->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($attributeGroups as $attributeGroup):

                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($attributeGroup->title) ?></td>
                                        <td><?= $this->Number->format($attributeGroup->sort_order) ?></td>
                                        <td>
                                            <?php
                                            if ($attributeGroup->created != "") {
                                                echo $attributeGroup->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }

                                            ?>
                                        </td>
                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $attributeGroup->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit attribute group'), 'title' => __('Edit attribute group')]) ?>
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $attributeGroup->id], ['onClick' => 'confirmDelete(this, \'' . $attributeGroup->id . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete attribute group'), 'title' => __('Delete attribute group')]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach;

                                ?>
                            <?php else: ?>
                                <tr> <td colspan='5' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
<?php endif; ?>
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