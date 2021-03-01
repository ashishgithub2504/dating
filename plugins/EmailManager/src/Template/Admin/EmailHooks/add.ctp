<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Hook'); ?> <small>
            <?php echo empty($emailHook->id) ? __('Add New email hook') : __('Edit email hook'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailHooks">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info emailHooks">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __(empty($emailHook->id) ? 'Add Email Hook' : 'Edit Email Hook') ?></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->
                <?= $this->Form->create($emailHook, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => false, 'placeholder' => __('Hook'), 'label' => ['text' => 'Hook']]); ?>
                                <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]); ?>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-anchor"></i> Last updated email hooks</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <?php if (!empty($hooks)) { ?>
                        <ul class="timeline">
                            <!-- timeline time label -->
                            <?php foreach ($hooks as $hook) { ?>
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
                                        <div class="timeline-footer">
                                            <?php echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'view', $hook->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]);
                                            ?>

                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'add', $hook->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false]); ?>

                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                            <?php } ?>

                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    <?php } ?>
                </div>

            </div>
            <!-- /.box -->
        </div>
    </div>
</section>