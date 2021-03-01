<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $option
 */
use Cake\Core\Configure;

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Option'); ?> <small>
            <?php echo empty($option->id) ? __('Add New option') : __('Edit option'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="options">
    <div class="box box-info options">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($option->id) ? 'Add Option' : 'Edit Option') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?= $this->Form->create($option, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="tab-pane active" id="categories">

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label" for="title">Title</label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => 'Option Name', 'label' => false]); ?>
                                </div>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label" for="option_type">Option Type</label>
                                <div class="col-md-6">
                                    <?php 
                                    pr(Configure::read("OptionsType"));
                                    echo $this->Form->input('option_type', ['options' => Configure::read("OptionsType"), 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label" for="sort_order">Sort Order</label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order'), 'min' => 0, 'label' => false]); ?>
                                </div>
                            </div>
                        </div><!-- /.form-group -->

                    </div>


                    <table id="option-value" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left required" width="20%">Option Value Name</th>
                                <th class="text-left">Sort Order</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $option_value_row = 0;
                            if (!empty($option->option_values)) {
                                foreach ($option->option_values as $opv) {
                                    $autoInc = !empty($opv->id) ? $opv->id : $option_value_row;

                                    ?>
                                    <tr id="option-value-row<?php echo $autoInc; ?>">
                                        <td>
                                            <?php
                                            echo $this->Form->input('option_values.' . $option_value_row . '.title', ['class' => 'form-control', 'placeholder' => __('Option Value Name'), 'label' => false]);
                                            echo $this->Form->input('option_values.' . $option_value_row . '.id', ['type' => 'hidden']);

                                            ?>
                                        </td>
                                        <td><?php echo $this->Form->input('option_values.' . $option_value_row . '.sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order'), 'label' => false]); ?></td>
                                        <td class="text-left">
                                            <?php
                                            if (!empty($opv->id)) {
                                               echo $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'optionValuedelete', $opv->id], ['onClick' => 'confirmDelete(this, \'' . $opv->title . '\')', 'class' => 'btn btn-danger btn-sm', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Remove'), 'title' => __('Remove')]);
                                            }else{
                                                echo $this->Html->link("<i class=\"fa fa-trash\"></i>", "javascript:void()", ['onClick' => '$(\'#option-value-row'.$autoInc.'\').remove();', 'class' => 'btn btn-danger btn-sm', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Remove'), 'title' => __('Remove')]);
                                            }

                                            ?>
                                        </td>
                                    </tr>
        <?php
        $option_value_row++;
    }
}

?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-left"><button type="button" onclick="addOptionValue();" data-toggle="tooltip" title="Add Option Value" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div><!-- /.row -->
        </div>
        <div class="box-footer">
<?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
<?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
<?= $this->Form->end() ?>
    </div>
</section>
<?php $this->Html->scriptStart(['block' => true]); ?>
$('select[name=\'option_type\']').on('change', function () {
if (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox' || this.value == 'image') {
$('#option-value').show();
} else {
$('#option-value').hide();
}
});

$('select[name=\'option_type\']').trigger('change');

var option_value_row = <?php echo $option_value_row; ?>;

function addOptionValue() {
    html = '<tr id="option-value-row' + option_value_row + '">';
    html += '<td>';
    html += '<input name="option_values['+option_value_row+'][title]" class="form-control" placeholder="Option Value Name" type="text">';
    html += '</td>';
    html += '<td>';
    html += '<input name="option_values['+option_value_row+'][sort_order]" class="form-control" placeholder="Sort Order" type="number">';
    html += '</td>';
    html += '<td class="text-left"><button type="button" onclick="$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

$('#option-value tbody').append(html);

option_value_row++;
}
<?php $this->Html->scriptEnd(); ?>