<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $attribute
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Attribute'); ?> <small>
            <?php echo empty($attribute->id) ? __('Add New attribute') : __('Edit attribute'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="attributes">
    <div class="box box-info attributes">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($attribute->id) ? 'Add Attribute' : 'Edit Attribute') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($attribute, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('attribute_group_id', ['options' => $attributeGroups,'class' => 'form-control']);
                echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                echo $this->Form->control('sort_order',['class' => 'form-control', 'placeholder' => __('Sort Order')]);
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
