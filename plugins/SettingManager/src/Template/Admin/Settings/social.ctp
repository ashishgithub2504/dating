<section class="content-header">
    <h1>
        <?php echo __('Manage Social links'); ?> <small>
            <?php echo __('Here you can manage the social website links'); ?>
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
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Icon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $k = 0;
                                    if (!empty($setting->config_value)) {
                                        $config_array = json_decode($setting->config_value, true);
                                        echo $this->Form->control('id', ['type' => 'hidden']);
                                        echo $this->Form->control('field_type', ['type' => 'hidden', 'value' => 'text']);
                                        echo $this->Form->control('manager', ['type' => 'hidden', 'value' => 'social']);
                                        foreach ($config_array as $k => $file) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $this->Form->control('title[]', ['class' => 'form-control','value'=>$file['title'], 'placeholder' => 'Social Title', 'label' => false]); ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('url[]', ['class' => 'form-control','value'=>$file['url'], 'placeholder' => 'Social URL', 'label' => false]); ?>
                                                </td>

                                                <td>
                                                    <?php echo $this->Form->control('icon[]', ['class' => 'form-control', 'value' => $file['icon'], 'placeholder' => 'Icon Class', 'label' => false]); ?>
                                                </td>
                                                <td class="form-inline">
                                                    <?= $this->Html->link("<i class=\"fa fa-minus-circle\"></i>", ['action' => 'deleteSocial', $setting->id,$k], ['class' => 'btn btn-danger pull-right', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete'), 'title' => __('Delete')]) ?>


                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>

                                        <?php
                                        $k = 0;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
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
                                SOCIAL_FACEBOOK
                            </small> - Will be replaced by facebook url from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SOCIAL_GOOGLE_PLUS
                            </small> - Will be replaced by google plus url from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SOCIAL_TWITTER
                            </small> - Will be replaced by twitter url from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SOCIAL_LINKEDIN
                            </small> - Will be replaced by linkedin url from the admin settings.
                        </li>
                        <li>
                            <small class="label bg-yellow">
                                SOCIAL_YOUTUBE
                            </small> - Will be replaced by youtube url from the admin settings.
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

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

    $(document).on('click', '.button-upload', function() {
        var _this = $(this);
        var inputValue = _this.closest("tr").find("input.file_val");
        var iconBox = _this.closest("tr").find("img");
        $('#form-upload').remove();
        var fields = '<input type="file" name="file" />';
        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;">' + fields + '</form>');
        $('#form-upload input[name=\'file\']').trigger('click');
        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);
                $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Settings', 'action' => 'uploads']); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                        _this.closest("tr").find(".button-upload").button('loading');
                    },
                    complete: function() {
                        _this.closest("tr").find(".button-upload").button('reset');
                    },
                    success: function(json) {
                        if (json.success === true) {
                            inputValue.val(json.filename);
                            iconBox.attr('src', json.image_path);
                        } else {
                            inputValue.val('');
                            iconBox.attr('src', "<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif");
                            wowMsg(json.message);
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });

    var file_row = <?php echo ($k + 1); ?>;

    function addMoreRow() {
        html = '<tr id="file-row' + file_row + '">';
        html += '  <td>';
        html += '  <input name="title[]" id="' + file_row + '-title" class="form-control"  placeholder="Social Title"><input name="field_type" id="' + file_row + '-field-type" value="text" type="hidden"><input name="manager" id="' + file_row + '-manager" value="social" type="hidden">';
        html += '  </td>';

        html += '  <td>';
        html += '<input name="url[]" class="form-control" id="' + file_row + '-config-value" placeholder="Social URL">';
        html += '  </td>';

        html += '  <td>';
        html += '<input name="icon[]" class="form-control" id="' + file_row + '-config-value" placeholder="Icon Class">';
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
