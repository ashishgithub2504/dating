<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playwin $playwin
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Playwin'); ?> <small>
            <?php echo empty($playwin->id) ? __('Add New playwin') : __('Edit playwin'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="playwins">
    <div class="box box-info playwins">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($playwin->id) ? 'Add Playwin' : 'Edit Playwin') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($playwin, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('name',['class' => 'form-control', 'placeholder' => __('Name')]);
                echo $this->Form->control('max',['class' => 'form-control', 'placeholder' => __('Max')]);
                echo $this->Form->control('coin',['class' => 'form-control', 'placeholder' => __('Coin')]);
                echo $this->Form->control('return_coin',['class' => 'form-control', 'placeholder' => __('Return Coin')]);
                echo $this->Form->control('win_coin',['class' => 'form-control', 'placeholder' => __('Win Coin')]);
                echo $this->Form->control('comment',['class' => 'form-control', 'placeholder' => __('Comment')]);
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
