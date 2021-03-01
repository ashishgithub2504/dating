<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Navigation'); ?> <small>
            <?php echo empty($navigation->id) ? __('Add New navigation') : __('Edit navigation'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="navigations">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info navigations">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __(empty($navigation->id) ? 'Add Navigation' : 'Edit Navigation') ?></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->
                <?php
                $this->loadHelper('Form', [
                    'templates' => 'horizontal_form',
                ]);
                ?>
                <?= $this->Form->create($navigation, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                            echo $this->Form->control('parent_id', ['options' => $parentNavigations, 'class' => 'form-control', 'empty' => '[ Parent Menu ]']);
                            echo $this->Form->control('is_nav_type', ['type' => 'radio', 'default'=>1,'options' => ['1' => 'CMS Pages', '2' => 'Custom Menu', '3' => 'Modules'], 'hiddenField' => false, 'label' => 'Type', 'templates' => [
                                    'radioWrapper' => '<div class="radio-inline screen-center screen-radio menu-type">{{label}}</div>',
                                    'inputContainer' => '<div class="form-group input {{required}}"><div class="row">{{content}}</div></div>'
                            ]]);
                            ?>
                            <div id="cms_pages">
                                <?php echo $this->Form->control('page_id', ['options' => $pages, 'default' => isset($navigation->menu_link) &&  $navigation->is_nav_type == 1 ? $navigation->menu_link : '', 'class' => 'form-control menu_type','empty' => 'Select Page', 'label' => 'CMS Pages']); ?>
                            </div>
                            <div id="modules">
                                <?php echo $this->Form->control('module_id', ['options' => $modules, 'default' => isset($navigation->menu_link) &&  $navigation->is_nav_type == 3 ? $navigation->menu_link : '', 'class' => 'form-control menu_type','empty' => 'Select Module',  'label' => 'Modules']); ?>
                            </div>
                            <div id="custom_link">
                                <?php echo $this->Form->control('menu_link', ['class' => 'form-control menu_link', 'placeholder' => __('Menu Link')]); ?>
                            </div>
                            <?php
                            echo $this->Form->control('sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order')]);
                            ?>
                            <?php
                            echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                            ?>
                        </div>
                       
                        <div class="col-md-6 col-md-offset-2">
                            <div class="form-group">
                                <div class="checkbox icheck">
                                        <?php
                                        echo $this->Form->control('is_top', ['type' => 'checkbox', 'class'=>'minimal','label'=>['text'=>' &nbsp; Top','style'=>'display:block; font-weight:bold;','escape' => false],
                                            'templates' => [
                                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                                'inputContainer' => '{{content}}',
                                                'error' => '<div class="col-md-8 error-message text-danger">{{content}}</div>',
                                        ]]);

                                        ?>
                                </div>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <div class="checkbox icheck">
                                        <?php
                                        echo $this->Form->control('is_bottom', ['type' => 'checkbox','label'=>['text'=>' &nbsp; Bottom','style'=>'display:block; font-weight:bold;','escape' => false], 
                                            'templates' => [
                                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                                'inputContainer' => '{{content}}',
                                                'error' => '<div class="col-md-8 error-message text-danger">{{content}}</div>',
                                        ]]);
                                        ?> 
                                </div>
                            </div><!-- /.form-group -->
                          
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
                    <p>For each navigation that would be added by this section, please follow these rules:</p>
                    <ul>
                        <li>
                            Use <small class="label bg-yellow">CMS Pages</small> 
                            for list those added from cms page manager.
                        </li>
                        <li>
                            Use <small class="label bg-yellow">Custom Menu</small> 
                            for external links or any downloadable file link.
                        </li>
                        <li>
                            Use <small class="label bg-yellow">Modules</small> 
                            for other static pages those added by Module manager.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->Html->css(['/assets/plugins/iCheck/square/blue.css'], ['block' => true]);
$this->Html->script(['/assets/plugins/iCheck/icheck.min'], ['block' => true]);
?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    $(document).ready(function () {
        //on load
         $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass   : 'iradio_minimal-blue',
            increaseArea: '20%' // optional
          })
//         $('input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//          });
        option = $(".menu-type input[type=radio]:checked").val();
        show_menu_type(option);
        $(".menu-type input[type=radio]").change(function () {
            var option = $(this).val();
            $(".menu_link").val('');
            show_menu_type(option);
        });

        function show_menu_type(option)
        {
            $("#modules").hide();
            $("#cms_pages").hide();
            $("#custom_link").hide();

            if (option == 1)
                $("#cms_pages").show();
            else if (option == 2) {
                $("#custom_link").show();
            } else if (option == 3)
                $("#modules").show();
        }

        $(".menu_type").on('change', function () {
            $(".menu_link").val($(this).val());
        })
    });
<?php $this->Html->scriptEnd(); ?>
</script>