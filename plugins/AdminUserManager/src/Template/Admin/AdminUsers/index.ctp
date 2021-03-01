<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $adminUsers
 */

?>
<section class="content-header">
    <h1>
        <?= __('Manage Admin User') ?>  
        <small><?php echo __('Here you can manage the admin users'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="adminUsers">   
    <div class="row adminUsers">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Admin Users') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Admin User'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
<!--                                <th>Photo</th>-->
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('email') ?></th>
                                <!-- <th><?= $this->Paginator->sort('mobile') ?></th> -->
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= $this->Paginator->sort('is_verified', 'Verified') ?></th>
                                <!-- <th><?= $this->Paginator->sort('created', 'Add Date') ?></th> -->
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($adminUsers->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($adminUsers as $adminUser):

                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <?php /* ?> <td><?php
                                            if (!empty($adminUser->profile_photo) && file_exists(WWW_ROOT . "img/" . $adminUser->profile_photo)) {
                                                echo $this->Glide->image($adminUser->profile_photo, ['w' => '50', 'h' => '50', 'fit' => 'fill']);
                                            } else {
                                                echo $this->Glide->image("no_image.gif", ['w' => '50', 'h' => '50', 'fit' => 'fill']);
                                            }

                                            ?>
                                        </td>
                                         <?php */ ?>
                                        <td>
                                            <?= h($adminUser->name) ?>
                                            <br />
                                            <?php
                                            foreach ($adminUser->roles as $act) {
                                                echo "<a href='javascript:void(0)'>" . $act->title . "</a><br>";
                                            }

                                            ?>
                                        </td>
                                        <td><?= h($adminUser->email) ?></td>
                                        <!-- <td><?= h($adminUser->mobile) ?></td> -->
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $adminUser->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $adminUser->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
                                            <?= $this->Form->checkbox('is_verified', ['checked' => $adminUser->is_verified == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $adminUser->id, 'data-field' => 'is_verified', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <!-- <td>
                                        <?php
                                        if ($adminUser->created != "") {
                                            echo $adminUser->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                        }

                                        ?>
                                </td> -->
                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $adminUser->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View admin user'), 'title' => __('View admin user')]) ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $adminUser->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit admin user'), 'title' => __('Edit admin user')]) ?>
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $adminUser->id], ['onClick' => 'confirmDelete(this, \'' . $adminUser->name . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete admin user'), 'title' => __('Delete admin user')]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;

                                ?>
                            <?php else: ?>
                                <tr> <td colspan='11' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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