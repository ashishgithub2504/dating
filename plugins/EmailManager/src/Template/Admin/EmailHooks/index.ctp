<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emailHooks
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Hook'); ?>  
        <small><?php echo __('Here you can manage the email hooks'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="emailHooks">
    <div class="row emailHooks">
        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Email Hooks'); ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Hook'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?php if (!empty($emailHooks->toArray())) { ?>
                        <ul class="timeline">
                            <?php
                            $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                            foreach ($emailHooks as $hook):
                                ?>
                                <li class="time-label">
                                    <span class="bg-navy">
                                        <?php echo $hook->created->format('d M, Y'); ?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-anchor bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $hook->created->format('H:i A'); ?></span>

                                        <h3 class="timeline-header"><?php echo $this->Html->link($hook->title, ['controller' => 'EmailHooks', 'action' => 'view', $hook->id]); ?></h3>

                                        <div class="timeline-body">
                                            <?php echo $hook->description; ?>
                                        </div>
                                        <div class="timeline-footer form-inline">
                                            <label class="css-input switch switch-sm switch-primary">
                                                <?= $this->Form->checkbox('status', ['checked' => $hook->status == 1 ? true : false, 'class' => 'switch-status change-request','data-field' => 'status','data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-id' => $hook->id, 'data-size' => 'mini']); ?>
                                                <span></span>
                                            </label>
                                            <?php echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'view', $hook->id], ['class' => 'btn btn-default btn-xs btn-flat', 'escape' => false]);
                                            ?>

                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'add', $hook->id], ['class' => 'btn btn-primary btn-xs btn-flat', 'escape' => false]); ?>
                                            <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $hook->id], ['onClick' => 'confirmDelete(this, \'' . $hook->title . '\')', 'class' => 'btn btn-danger btn-xs btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete hook'), 'title' => __('Delete hook')]) ?>

                                        </div>
                                    </div>
                                </li>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                        <?php
                    } else {
                        echo "<div style='align:center;'>  <strong>Record Not Available</strong> </div>";
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-anchor"></i> Quick Start</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create(null, ['url' => ['action' => 'add'], 'id' => 'quickStartForm', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => false, 'placeholder' => __('Hook'), 'label' => ['text' => 'Hook']]); ?>
                                <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('description', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => __('Description')]); ?>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php echo $this->Form->button("<span class='ladda-label'><i class='fa fa-fw fa-save'></i> " . __('Submit').'</span>', ['class' => 'btn btn-primary l-button','data-size'=>'xs', 'title' => __('Submit')]); ?>  
                </div>
                <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</section>