<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */

?>
<section class="content-header">
    <h1>
        <?= __('Manage User') ?>  
        <small><?php echo __('Here you can manage the users'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="users"> 

    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select(
                                'account_type_id', $accountTypes, ['class' => 'form-control', 'empty' => 'User Type']
                            );

                            ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select(
                                'status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control', 'empty' => 'Select Status']
                            );

                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select(
                                'is_verified', [1 => "Verified", 0 => "Un-verified"], ['class' => 'form-control', 'empty' => 'Select']
                            );

                            ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'Keyword e.g: name, email, town, city', 'label' => false]); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("start_date", ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'Start date', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("end_date", ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'End date', 'label' => false]); ?>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->button(__('<i class="fa fa-filter"></i> Filter'), ['class' => 'btn btn-success', 'title' => __('Search')]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> " . __('Reset'), ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);

                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>

    <div class="row users">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Users') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New User'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th scope="col"><?= $this->Paginator->sort('first_name', 'Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_verified', 'Verified') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions" width="12%"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($users->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($users as $user):

                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td>
                                            
                                            <?php 
                                            if (!empty($user->profile_photo) && file_exists("img/".$user->image_path . $user->profile_photo)) { 
                                                 echo $this->Glide->image($user->image_path . $user->profile_photo, ['w'=>'50', 'h'=>'50','fit'=>'fill']);
                                            }else{
                                                echo $this->Glide->image("no_image.gif", ['w'=>'50', 'h'=>'50','fit'=>'fill']);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= h($user->name) ?>
                                            <br />
                                            <?php
                                            foreach ($user->account_types as $act) {
                                                echo "<a href='javascript:void(0)'>" . $act->title . "</a><br>";
                                            }

                                            ?>
                                        </td>
                                        <td><?= h($user->email) ?></td>
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $user->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $user->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
                                            <?= $this->Form->checkbox('is_verified', ['checked' => $user->is_verified == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $user->id, 'data-field' => 'is_verified', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($user->created != "") {
                                                echo $user->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }

                                            ?>
                                        </td>
                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $user->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View user'), 'title' => __('View user')]) ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $user->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit user'), 'title' => __('Edit user')]) ?> 
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $user->id], ['onClick' => 'confirmDelete(this, \'' . $user->name . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete user'), 'title' => __('Delete user')]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach;

                                ?>
                            <?php else: ?>
                                <tr> <td colspan='16' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);

?>
<?php $this->Html->scriptStart(['block' => true]); ?>
$('.datepicker').datetimepicker({
minView: 2,
format: 'yyyy-mm-dd', 
'showTimepicker': false,
autoclose: true, 
});

<?php $this->Html->scriptEnd(); ?>