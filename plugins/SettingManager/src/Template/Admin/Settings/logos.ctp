<section class="content-header">
    <h1>
        <?php echo __('Manage Theme images'); ?> <small>
            <?php echo __('Here you can manage the logo and fav icons Option'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-default settings">
                <div class="box-header with-border">
                    <h3 class="box-title">Theme Options</h3>
                </div><!-- /.box-header -->
                <?= $this->Form->create($setting, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-striped table-bordered" id="tab-theme-files">
                                <thead>
                                    <tr>
                                        <th >Constant/Slug</th>
                                        <th width="17%">Config Value</th>
                                        <th width="22%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($setting)) {
                                        foreach ($setting as $k => $file) {
                                            $config_err = $file->getErrors('config_value');
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group <?php echo !empty($file->getErrors('slug')) ? 'has-error' : ''; ?>">
                                                        <?php
                                                        echo $this->Form->control($k . '.slug', ['class' => 'form-control', 'readonly' => empty($file->id) ? false : true, 'label' => false]);
                                                        echo $this->Form->control($k . '.title', ['type' => 'hidden']);
                                                        echo $this->Form->control($k . '.id', ['type' => 'hidden']);
                                                        echo $this->Form->control($k . '.field_type', ['type' => 'hidden', 'value' => 'text']);
                                                        echo $this->Form->control($k . '.manager', ['type' => 'hidden', 'value' => 'theme_images']);
                                                        if (!empty($config_err)) {
                                                            echo '<div class="form-group has-error">';
                                                            echo "<div class='help-block'>";
                                                            foreach ($config_err as $error) {
                                                                if (is_array($error)) {
                                                                    foreach ($error as $err) {
                                                                        echo $err . "<br>";
                                                                    }
                                                                } else {
                                                                    echo $error . "<br>";
                                                                }
                                                            }
                                                            echo "</div></div>";
                                                        }
                                                        ?>
                                                    </div>

                                                </td>
                                                <td <?php //echo !empty($config_err)?'class="error-occur"':'';  ?>>
                                                    <div class="form-group <?php echo!empty($config_err) ? 'error-occur' : ''; ?> imageBox" id="imageBox-<?php echo $k; ?>">
                                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                                            <?php echo $this->Html->image(($file->config_value != '' ? $file->config_value : 'no_image.gif'), ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                        </a>
                                                        <?php echo $this->Form->control($k . '.config_value', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image']); ?>
                                                    </div>
                                                </td>
                                                <td class="form-inline">
                                                    <?php
                                                    if ($k > 1) {
                                                        echo $this->Html->link("<i class=\"fa fa-minus-circle\"></i> ", ['action' => 'delete', $file->id], ['class' => 'btn btn-danger pull-right', 'escape' => false, 'onclick' => 'return confirmAction(this.href,\'' . $file->title . '\');', 'title' => __('Delete')]);
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $this->Form->control('0.slug', ['class' => 'form-control', 'value' => 'MAIN_LOGO', 'readonly' => true, 'label' => false]);
                                                echo $this->Form->control('0.title', ['type' => 'hidden', 'value' => 'Main Logo']);
                                                echo $this->Form->control('0.id', ['type' => 'hidden']);
                                                echo $this->Form->control('0.field_type', ['type' => 'hidden', 'value' => 'text']);
                                                echo $this->Form->control('0.manager', ['type' => 'hidden', 'value' => 'theme_images']);

                                                ?>
                                            </td>
                                            <td>
                                                <div class="form-group imageBox" id="imageBox-0">
                                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                                            <?php echo $this->Html->image('no_image.gif', ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                        </a>
                                                        <?php echo $this->Form->control('0.config_value', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image']); ?>
                                                    </div>
                                            </td>
                                            <td>
                                              
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $this->Form->control('1.slug', ['class' => 'form-control', 'value' => 'MAIN_FAVICON', 'readonly' => true, 'label' => false]);
                                                echo $this->Form->control('1.title', ['type' => 'hidden', 'value' => 'Main Fav Icon']);
                                                echo $this->Form->control('1.id', ['type' => 'hidden']);
                                                echo $this->Form->control('1.field_type', ['type' => 'hidden', 'value' => 'text']);
                                                echo $this->Form->control('1.manager', ['type' => 'hidden', 'value' => 'theme_images']);

                                                ?>
                                            </td>
                                            <td>
                                                <div class="form-group imageBox" id="imageBox-1">
                                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                                            <?php echo $this->Html->image('no_image.gif', ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                        </a>
                                                        <?php echo $this->Form->control('1.config_value', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image']); ?>
                                                    </div>
                                             </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <?php $k = 2;
                                            }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary pull-right" data-toggle="tooltip" title="Add New" onclick="addMoreRow()"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
<?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  

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
                                MAIN_LOGO
                            </small> - Will be replaced by logo from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                MAIN_FAVICON
                            </small> - Will be replaced by favicon icon image from the admin settings.
                        </li>

                    </ul>
                </div><!-- ./box-body -->
            </div>
        </div>
    </div>
<?php
//$this->Html->css(['/assets/dropzone-master/dist/basic', '/assets/dropzone-master/dist/dropzone'], ['block' => true]);
//$this->Html->script(['/assets/dropzone-master/dist/dropzone'], ['block' => true]);

?>
</section>
<?php $this->Html->script(['GalleryManager.common'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

    var file_row = <?php echo ($k + 1); ?>;

    function addMoreRow() {
        html = '<tr id="file-row' + file_row + '">';
        html += '  <td>';
        html += '    <input name="' + file_row + '[slug]" class="form-control" required="required" maxlength="255" id="' + file_row + '-slug" value="MAIN_LOGO_' + file_row + '" type="text">';
        html += '  <input name="' + file_row + '[title]" id="' + file_row + '-title" value="Logo ' + file_row + '" type="hidden"><input name="' + file_row + '[field_type]" id="' + file_row + '-field-type" value="text" type="hidden"><input name="' + file_row + '[manager]" id="' + file_row + '-manager" value="theme_images" type="hidden">';
        html += '  </td>';
        html += '  <td>';
        html += '<div class="form-group imageBox" id="imageBox-' + file_row + '">';
        html += '<a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>';
        html += ' <img src="<?php echo $this->request->getAttribute("webroot"); ?>img/no_image.gif" class="img-thumbnail" data-placeholder="<?php echo $this->Url->image('no_image.gif'); ?>" style="max-height:150px;" alt="">';
        html += '</a>';
        html += '<input name="' + file_row + '[config_value]" class="config_value input-image" id="' + file_row + '-config-value" value="" type="hidden">';
        html += '</div>';
        html += '  </td>';
        html += '  <td>';
        html += '<a onclick="$(\'#file-row' + file_row + '\').remove()" data-toggle="tooltip" title="Remove" class="btn btn-danger pull-right"><i class="fa fa-minus-circle"></i></a>';
        html += '  </td>';
        html += '</tr>';

        $('table#tab-theme-files tbody').append(html);

        file_row++;
    }

<?php $this->Html->scriptEnd(); ?>
</script>
