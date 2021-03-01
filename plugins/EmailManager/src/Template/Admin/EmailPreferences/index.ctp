<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emailPreferences
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Email Preference'); ?>  
        <small><?php echo __('Here you can manage the email preferences'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="emailPreferences">
    <div class="row emailPreferences">
        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Email Preferences'); ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Preference'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?php if (!empty($emailPreferences->toArray())) { ?>
                        <ul class="timeline">
                            <?php
                            $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                            foreach ($emailPreferences as $emailPreference):
                                ?>
                                <li class="time-label">
                                    <span class="bg-navy">
                                        <?php echo $emailPreference->created->format('d M, Y'); ?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-anchor bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $emailPreference->created->format('H:i A'); ?></span>

                                        <h3 class="timeline-header"><?php echo $this->Html->link($emailPreference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $emailPreference->id]); ?></h3>
                                        <div class="timeline-body">
                                            <?php echo $emailPreference->description; ?>
                                        </div>
                                        <div class="timeline-footer form-inline">
                                            <?php echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['controller' => 'EmailPreferences', 'action' => 'view', $emailPreference->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]);             ?>
                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['controller' => 'EmailPreferences', 'action' => 'add', $emailPreference->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false]); ?>
                                            <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $emailPreference->id], ['onClick' => 'confirmDelete(this, \'' . $emailPreference->title . '\')', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete Email Layout'), 'title' => __('Delete Email Layout')]) ?>
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
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>
                        For each email style or email preference that would be added to the system, make sure it has these hooks:
                    </p>
                    <ul>
                        <li>
                            <small class="label bg-yellow">
                                ##SYSTEM_LOGO##
                            </small> - Will be replaced by logo from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ##SYSTEM_APPLICATION_NAME##
                            </small> - Will be replaced by application name from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ##EMAIL_CONTENT##
                            </small> - Will be replaced by email message from email hook settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ##EMAIL_FOOTER##
                            </small> - Will be replaced by email footer from email hook settings.
                        </li>
                    </ul>
                </div><!-- ./box-body -->
            </div>
        </div>
    </div>
</section>
