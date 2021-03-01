<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $contacts
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Contact Enquiries'); ?>  
        <small><?php echo __('Here you can manage the Contact Enquiries'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="pages">
    <div class="row pages">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Contact Enquiries'); ?></span></h3>
                    <div class="box-tools"></div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('first_name', 'Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('mobile', 'Mobile Number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('product_id', 'Product Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col" width="18%"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions" width="12%"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($inquiries->toArray())) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($inquiries as $inquiry):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($inquiry->name); ?></td>  
                                        <td><?= h($inquiry->mobile) ?></td> 
                                        <td><?= $this->Html->link(h($inquiry->Products['title']),['controller' => 'Products','action'=>'view',$inquiry->Products['id'], 'plugin' => 'CatalogManager' ]) ?></td> 
                                        <td><a href="mailto:<?= h($inquiry->email) ?>"><?= h($inquiry->email) ?></a></td>   
                                        <td>
                                            <?php
                                            if ($inquiry->created != "") {
                                                echo $inquiry->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>

                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $inquiry->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View Enquiry'), 'title' => __('View Enquiry')]) ?>
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $inquiry->id], ['onClick' => 'confirmDelete(this, \'this enquiry\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete Enquiry'), 'title' => __('Delete Enquiry')]) ?>
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
