<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emailTemplates
 */

?>
<section class="content-header">
    <h1>
<?php echo __('Manage Email Template'); ?>  
        <small><?php echo __('Here you can manage the email templates'); ?></small>
    </h1>
<?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="emailTemplates">
    <div class="row emailTemplates">
        <div class="col-md-7">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Email Templates'); ?></span></h3>
                        <div class="box-tools">
<?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Template'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]); ?>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                            <?php if (!empty($emailTemplates->toArray())) { ?>
                            <ul class="timeline">
                                <?php
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($emailTemplates as $emailTemplate):

                                    ?>
                                    <li class="time-label">
                                        <span class="bg-navy">
        <?php echo $emailTemplate->created->format('d M, Y'); ?>
                                        </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-anchor bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $emailTemplate->created->format('H:i A'); ?></span>

                                            <h3 class="timeline-header"><?= $this->Html->link($emailTemplate->email_hook->title . " (" . $emailTemplate->email_hook->slug . ")", ['controller' => 'EmailHooks', 'action' => 'view', $emailTemplate->email_hook->id]) ?></h3>
                                            <div class="timeline-body">
                                                <h3 style="margin-top: 0px;"> <small>
                                                <?= $emailTemplate->has('email_preference') ? $this->Html->link($emailTemplate->email_preference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $emailTemplate->email_preference->id]) : '' ?>
                                                    </small>
                                                </h3>
                                                <?php echo $emailTemplate->subject; ?>
                                            </div>
                                            <div class="timeline-footer form-inline">
                                                <?php echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['action' => 'view', $emailTemplate->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]);

                                                ?>

        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['action' => 'add', $emailTemplate->id], ['class' => 'btn btn-primary btn-xs btn-flat', 'escape' => false]); ?>
        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $emailTemplate->id], ['onClick' => 'confirmDelete(this, \'' . $emailTemplate->email_hook->title . '\')', 'class' => 'btn btn-danger btn-xs btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete Email Templates'), 'title' => __('Delete Email Templates')]) ?>

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
        </div>
        <div class="col-md-5">
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
                                <?php echo $this->Form->control('email_hook_id', ['options' => $emailHooks, 'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('subject', ['class' => 'form-control', 'placeholder' => __('Subject')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('description', ['type' => 'textarea', 'rows' => 6, 'class' => 'form-control', 'placeholder' => __('Description')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('footer_text', ['type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'placeholder' => __('Footer Text')]); ?>
                            </div>
                            <div class="form-group">
<?php echo $this->Form->control('email_preference_id', ['options' => $emailPreferences, 'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
<?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);

?>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
<?php echo $this->Form->button("<span class='ladda-label'><i class='fa fa-fw fa-save'></i> " . __('Submit') . '</span>', ['class' => 'btn btn-primary l-button', 'data-size' => 'xs', 'title' => __('Submit')]); ?>  
                </div>
<?= $this->Form->end() ?>

            </div>

        </div>
    </div>
</section>
