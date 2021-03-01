<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $settings
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Setting'); ?>  
        <small><?php echo __('Here you can manage the settings'); ?></small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="settings">
    <div class="row settings">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Settings'); ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Setting'), ["action" => "add"], ["class" => "btn btn-success btn-flat btn-sm", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('slug', 'Constant') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('config_value', 'Value') ?></th>
                                <th scope="col" class="actions" style="width: 15%;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($settings->toArray())) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($settings as $setting):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($setting->title) ?></td>  
                                        <td><?= h($setting->slug) ?></td>  
                                        <td>
                                            <?php
                                            if ($setting->field_type == "checkbox") {
                                                if ($setting->config_value == 1) {
                                                    echo '<span class="label label-success btn-flat">Enable</span>';
                                                }else{
                                                    echo '<span class="label label-danger btn-flat">Disable</span>';
                                                }
                                            } else {
                                                echo h($setting->config_value);
                                            }
                                            ?>
                                        </td>  
                                        <td class="actions">
                                            <div class="btn-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $setting->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View setting'), 'title' => __('View')]) ?>
        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $setting->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit')]) ?>
        <?php /* <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id), 'class' => 'btn btn-danger btn-sm', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete'), 'title' => __('Delete setting')]) ?>
         */ ?>


                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                            } else {
                                echo "<tr> <td colspan='7' align='center'> <strong>Record Not Available</strong> </td> </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
<?php echo $this->element('pagination'); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>
                        For each config settings that would be added to the system, make sure it has these constant/slug:
                    </p>
                    <ul>
                        <li>
                            <small class="label bg-yellow">
                                SITE_TITLE
                            </small> - Will be replaced by website title from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ADMIN_EMAIL
                            </small> - Will be replaced by admin email from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                FROM_EMAIL
                            </small> - Will be replaced by email from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                WEBSITE_OWNER
                            </small> - Will be replaced by Owner name from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                TELEPHONE
                            </small> - Will be replaced by phone number from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ADMIN_PAGE_LIMIT
                            </small> - Will be replaced by admin page limit from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                FRONT_PAGE_LIMIT
                            </small> - Will be replaced by front page limit from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ADMIN_DATE_FORMAT
                            </small> - Will be replaced by admin date format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                ADMIN_DATE_TIME_FORMAT
                            </small> - Will be replaced by admin date time format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                FRONT_DATE_FORMAT
                            </small> - Will be replaced by front date format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                FRONT_DATE_TIME_FORMAT
                            </small> - Will be replaced by front date time format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                CONTACT_US_TEXT
                            </small> - Will be replaced by front date time format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                GOOGLE_MAP_KEY
                            </small> - Will be replaced by front date time format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                OFFICE_ADDRESS
                            </small> - Will be replaced by front date time format from admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                DEVELOPMENT_MODE
                            </small> - Will be replaced by debug mode from admin settings.
                        </li>
                        

                    </ul>
                </div><!-- ./box-body -->
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
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>     
                            <div class="form-group">
                                <?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => false, 'placeholder' => __('Constant/Slug'), 'label' => ['text' => 'Constant/Slug']]); ?>
                                <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>
                            </div>     
                            <div class="form-group">
                                <?php
                                echo $this->Form->control('field_type', ['value' => 'text', 'type' => 'hidden']);
                                echo $this->Form->control('config_value', ['class' => 'form-control', 'type' => 'textarea', 'required' => false, 'placeholder' => __('Config Value')]);
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
