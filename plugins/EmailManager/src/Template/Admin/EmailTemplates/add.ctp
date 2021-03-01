<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Template'); ?> <small>
            <?php echo empty($emailTemplate->id) ? __('Add New email template') : __('Edit email template'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailTemplates">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info emailTemplates">

                <div class="box-header with-border">
                    <h3 class="box-title"><?= __(empty($emailTemplate->id) ? 'Add Email Template' : 'Edit Email Template') ?></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->

                <?= $this->Form->create($emailTemplate, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('email_hook_id', ['options' => $emailHooks, 'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('subject', ['class' => 'form-control', 'placeholder' => __('Subject')]); ?>
                                </div>
                            <div class="form-group">
                           <?php echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]); ?>
                                </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('footer_text', ['class' => 'form-control', 'placeholder' => __('Footer Text')]); ?>
                                </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('email_preference_id', ['options' => $emailPreferences, 'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                            ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col-md-4">
            
             <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p>For each email hook that would be added to the sytem, make sure to follow these rules:</p>
                <ul>
                    <li>
                        Use <small class="label bg-yellow">##SYSTEM_APPLICATION_NAME##</small> 
                        on the subject or message to print application name defined by admin settings.
                    </li>
                    <li>
                        Use <small class="label bg-yellow">##USER_EMAIL##</small> 
                        on the subject or message to print user email.
                    </li>
                    <li>
                        Use <small class="label bg-yellow">##USER_NAME##</small> 
                        on the subject or message to print user name.
                    </li>
                    <li>Make sure the message contain <small class="label bg-yellow">##MESSAGE##</small>.</li>
                </ul>
            </div>
            </div>

            
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-anchor"></i> Last updated templates</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <?php if (!empty($templates)) { ?>
                        <ul class="timeline">
                            <!-- timeline time label -->
                            <?php foreach ($templates as $template) { ?>
                                <li class="time-label">
                                    <span class="bg-navy">
                                        <?php echo $template->created->format('d M, Y'); ?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-anchor bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $template->created->format('H:i A'); ?></span>

                                        <h3 class="timeline-header"><?php echo $this->Html->link($template->email_hook->title, ['action' => 'view', $template->id]); ?></h3>

                                        <div class="timeline-body">
                                            <?php echo $template->subject; ?>
                                        </div>
                                        <div class="timeline-footer">
                                            <?php echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'view', $template->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]);
                                            ?>

                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'add', $template->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false]); ?>

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