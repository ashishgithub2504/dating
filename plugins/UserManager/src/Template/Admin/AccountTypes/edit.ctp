<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $accountType
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Account Type'); ?> <small>
            <?php echo empty($accountType->id) ? __('Add New account type') : __('Edit account type'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="accountTypes">
    <div class="box box-info accountTypes">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($accountType->id) ? 'Add Account Type' : 'Edit Account Type') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($accountType, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
            echo $this->Form->control('users._ids', ['options' => $users]);
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
