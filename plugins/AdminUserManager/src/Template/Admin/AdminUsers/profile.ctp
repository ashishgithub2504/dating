<section class="content-header">
    <h1>
        User Profile 
    </h1>
    <?php echo $this->element('breadcrumb', array('pageName' => $this->request->params['controller'] . (empty($adminUser->id) ? '_add' : '_edit'))); ?>
</section>
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($adminUser->id) ? 'Add Admin User' : "Edit Admin User") ?></h3>
        </div><!-- /.box-header -->
        <?php
        $myTemplates = [
            'inputContainerError' => '<div class="input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="text-danger">{{content}}</div>',
        ];
        $this->Form->templates($myTemplates);
        echo $this->Form->create($adminUser, ['role' => 'form', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']);
        ?>
        <div class="box-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('name', ['class' => 'form-control', 'placeholder' => 'Name', 'label' => ['text' => "Name"]]); ?>
                    </div><!-- /.form-group -->

                </div><!-- /.col -->


                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'placeholder' => 'Phone Number', 'label' => ['text' => "Phone Number"]]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-6">

                    <div class="form-group">
                        <?php echo $this->Form->control('dob', ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'YYYY-mm-dd', 'label' => ['text' => "Date Of Birth"], 'readonly' => true]); ?>
                    </div><!-- /.form-group -->

                </div><!-- /.col -->


                <div class="col-md-6">

                    <div class="form-group">
                        <?php echo $this->Form->control('email', ['type' => 'email', 'readonly' => true, 'class' => 'form-control', 'placeholder' => 'Enter email','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$', 'label' => ['text' => "Email"]]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->


                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => (isset($this->request->data['password']) && $this->request->data['password'] != "") ? $this->request->data['password'] : "", 'required' => false, 'autocomplete' => 'off','readonly' => true,'onfocus' => 'if (this.hasAttribute(\'readonly\')) {  this.removeAttribute(\'readonly\'); this.blur(); this.focus(); }', 'label' => ['text' => "Password"], 'templateVars' => ['help' =>  '<div class="help-message">Leave blank if you dont want to change</div>']]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->control('confirm_password', ['type' => 'password', 'class' => 'form-control input-large', 'placeholder' => 'Confirm Password', 'label' => ['text' => "Confirm Password"], 'required' => false]); ?>
                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-6 imageBox" id="imageBox-0">
                            <div class="col-md-8">
                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                    <?php 
									echo $this->Glide->image(($adminUser->profile_photo != '' ? $adminUser->profile_photo : 'no_image.gif'), ['w'=>'150', 'h'=>'150'], ['style'=>'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                </a>
                                <?php echo $this->Form->control('profile_photo', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                            </div>

                </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer">
                <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>
                <?php echo $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-warning']); ?>
            </div>
            <?= $this->Form->end() ?>
        </div><!-- /.box -->
		</div>
</section>

<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['GalleryManager.common'], ['block' => true]);
?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    $('.datepicker').datetimepicker({
        minView: 2,
        format: 'yyyy-mm-dd',
        'showTimepicker': false,
        autoclose: true,
    });
<?php $this->Html->scriptEnd(); ?>
</script>	