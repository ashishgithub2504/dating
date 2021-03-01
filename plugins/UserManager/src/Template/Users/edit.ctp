<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage User'); ?> <small>
            <?php echo empty($user->id) ? __('Add New user') : __('Edit user'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="users">
    <div class="box box-info users">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($user->id) ? 'Add User' : 'Edit User') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($user, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('first_name',['class' => 'form-control', 'placeholder' => __('First Name')]);
                echo $this->Form->control('last_name',['class' => 'form-control', 'placeholder' => __('Last Name')]);
                echo $this->Form->control('display_name',['class' => 'form-control', 'placeholder' => __('Display Name')]);
                echo $this->Form->control('age',['class' => 'form-control', 'placeholder' => __('Age')]);
            echo $this->Form->control('dob', ['empty' => true,'type'=>'text', 'class' => 'form-control datepicker', 'placeholder' => __('Dob')]);
                echo $this->Form->control('town',['class' => 'form-control', 'placeholder' => __('Town')]);
            echo $this->Form->control('state_id', ['options' => $states, 'empty' => true, 'class' => 'form-control']);
            echo $this->Form->control('country_id', ['options' => $countries, 'empty' => true, 'class' => 'form-control']);
                echo $this->Form->control('zipcode',['class' => 'form-control', 'placeholder' => __('Zipcode')]);
                echo $this->Form->control('mobile',['class' => 'form-control', 'placeholder' => __('Mobile')]);
                echo $this->Form->control('email',['class' => 'form-control', 'placeholder' => __('Email')]);
                echo $this->Form->control('password',['class' => 'form-control', 'placeholder' => __('Password')]);
                echo $this->Form->control('banner',['class' => 'form-control', 'placeholder' => __('Banner')]);
                echo $this->Form->control('profile_photo',['class' => 'form-control', 'placeholder' => __('Profile Photo')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
                echo $this->Form->control('is_verified',['class' => 'form-control', 'placeholder' => __('Is Verified')]);
                echo $this->Form->control('fake_pass',['class' => 'form-control', 'placeholder' => __('Fake Pass')]);
            echo $this->Form->control('account_types._ids', ['options' => $accountTypes]);
        ?>
</div>
</div>
    </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
    <?= $this->Form->end() ?>
</div>
        </section>
