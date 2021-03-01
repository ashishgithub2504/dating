<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Order'); ?> <small>
            <?php echo empty($order->id) ? __('Add New order') : __('Edit order'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="orders">
    <div class="box box-info orders">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($order->id) ? 'Add Order' : 'Edit Order') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($order, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('user_id', ['options' => $users,'class' => 'form-control']);
                echo $this->Form->control('order_no',['class' => 'form-control', 'placeholder' => __('Order No')]);
                echo $this->Form->control('instruction',['class' => 'form-control', 'placeholder' => __('Instruction')]);
                echo $this->Form->control('order_amount',['class' => 'form-control', 'placeholder' => __('Order Amount')]);
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
