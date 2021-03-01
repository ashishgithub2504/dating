<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $pages
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Page'); ?>  
        <small><?php echo __('Here you can manage the pages'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="pages">
    <div class="row pages">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Pages'); ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Page'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                
                                            
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                                <th scope="col" width="30%"><?= $this->Paginator->sort('short_description') ?></th>
<!--                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>-->
                                <th scope="col" width="18%"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions" width="12%"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($pages->toArray())) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($pages as $page):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($page->title) ?></td>  
                                        <td><?= h($page->slug) ?></td>  
                                        <td>
                                            <?php
                                                echo $this->Text->truncate(
                                                     $page->short_description != NULL ? $page->short_description : strip_tags($page->description),
                                                    100,
                                                    [
                                                        'ellipsis' => '...',
                                                        'exact' => true,
                                                        'html' => false
                                                    ]
                                                );
                                            ?>
                                        </td>  
                                       <?php /* ?> <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $page->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $page->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                                          </td>
                                               <?php */ ?>
                                       


                                        <td>
                                            <?php
                                            if ($page->created != "") {
                                                echo $page->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>

                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $page->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View page'), 'title' => __('View page')]) ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $page->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit page')]) ?>
                                             
		<?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $page->id], ['onClick' => 'confirmDelete(this, \''.$page->title.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete page'),'title'=>__('Delete page')]) ?>
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
