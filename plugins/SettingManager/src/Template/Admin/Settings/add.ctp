<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Setting'); ?> <small>
            <?php echo empty($setting->id) ? __('Add New setting') : __('Edit setting'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="settings">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info settings">

                <div class="box-header with-border">
                    <h3 class="box-title"><?= __(empty($setting->id) ? 'Add Setting' : 'Edit Setting') ?></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->

                <?= $this->Form->create($setting, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Constant/Slug'),'label'=>['text'=>'Constant/Slug']]); ?>
                                <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('field_type', ['options'=>['text'=>'Text','checkbox'=>'Yes/No'],'class' => 'form-control', 'placeholder' => __('Field Type')]); ?>
                            </div>
                            <div class="form-group field-switch-type" style="display: none">
                                <label class="css-input switch switch-sm switch-primary">
                                                <?= $this->Form->checkbox('config_value', ['class' => 'switch-status','id'=>'setting_checkbox', 'data-size' => 'mini','required'=>false]); ?>
                                                <span></span>
                                            </label>
                            </div>
                            <div class="form-group field-textarea-type" style="display: none">
                                <?php echo $this->Form->control('config_value', ['class' => 'form-control','id'=>'setting_textarea','required'=>false, 'placeholder' => __('Config Value')]); ?>
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
        </div>

    </div>
</section>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    fieldType();
    $(function () {
       $("select[name='field_type']").on("change",function(){
           fieldType();
       });
    });
    function fieldType(){
        var _type = $("select[name='field_type']").val();
        console.log(_type);
        if(_type=="checkbox"){
            $(".field-switch-type").show();
            $(".field-textarea-type").hide();
            $(".field-switch-type").find("input").attr('name', 'config_value');
            $(".field-textarea-type").find("textarea").attr('name', 'setting_hidden');
        }else{
            $(".field-textarea-type").show();
            $(".field-switch-type").hide();
            $(".field-switch-type").find("input").attr('name', 'setting_hidden');
            $(".field-textarea-type").find("textarea").attr('name', 'config_value');
        }
    }
<?php $this->Html->scriptEnd(); ?>
</script>