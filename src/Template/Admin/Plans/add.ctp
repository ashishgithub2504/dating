<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Plan $plan
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Plan'); ?> <small>
            <?php echo empty($plan->id) ? __('Add New plan') : __('Edit plan'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="plans">
    <div class="box box-info plans">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($plan->id) ? 'Add Plan' : 'Edit Plan') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($plan, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('name',['class' => 'form-control', 'placeholder' => __('Name')]);
                echo $this->Form->control('amount',['class' => 'form-control', 'placeholder' => __('Amount')]);
                echo $this->Form->control('no_of_coin',['class' => 'form-control', 'placeholder' => __('No Of Coin')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
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
