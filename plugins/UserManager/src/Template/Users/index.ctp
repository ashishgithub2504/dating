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
    <div class="row users">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Users') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New User'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('display_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dob') ?></th>
                <th scope="col"><?= $this->Paginator->sort('town') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('banner') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_verified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fake_pass') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($users->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->display_name) ?></td>
                <td><?= $this->Number->format($user->age) ?></td>
                <td><?= h($user->dob) ?></td>
                <td><?= h($user->town) ?></td>
                <td><?= $user->has('state') ? $this->Html->link($user->state->title, ['controller' => 'States', 'action' => 'view', $user->state->id]) : '' ?>
        </td>
                <td><?= $user->has('country') ? $this->Html->link($user->country->title, ['controller' => 'Countries', 'action' => 'view', $user->country->id]) : '' ?>
        </td>
                <td><?= h($user->zipcode) ?></td>
                <td><?= h($user->mobile) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->banner) ?></td>
                <td><?= h($user->profile_photo) ?></td>
                <td>
                    <?= $this->Form->checkbox('status', ['checked' => $user->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $user->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                   
            </td>
                <td>
                    <?= $this->Form->checkbox('is_verified', ['checked' => $user->is_verified == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $user->id, 'data-field' => 'is_verified', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                   
            </td>
            <td>
        <?php if ($user->created != "") {
                echo $user->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                }
                ?>
    </td>
                <td><?= h($user->fake_pass) ?></td>
                    <td class="actions">
                        <div class="btn-group">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $user->id],['class' => 'btn btn-warning btn-sm', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View user'),'title'=>__('View user')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit user'),'title'=>__('Edit user')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $user->id], ['onClick' => 'confirmDelete(this, \''.$user->id.'\')','class' => 'btn btn-danger btn-sm','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete user'),'title'=>__('Delete user')]) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='19' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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