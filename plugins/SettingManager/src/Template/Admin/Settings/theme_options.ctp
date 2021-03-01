<section class="content-header">
    <h1>
        <?php echo __('Manage Theme Option'); ?> <small>
            <?php echo __('Here you can manage the Theme Option'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb', array('pageName' => 'Add Theme Detail')); ?>
</section>

<section class="content">
    <div class="box box-default settings">
        <div class="box-header with-border">
            <h3 class="box-title">Theme Options</h3>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);
        ?>
        <?= $this->Form->create($settings, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div style="position: relative; width: 50%">
                            <div class="dropzone" id='dropfile'>
                                <div class="fallback">
                                    <input name="file" type="file" />
                                </div>

                                <div class="dz-default dz-message" data-dz-message="">
                                    <span>Drop files here to upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($settings as $k => $setting) {
                        if ($setting->field_type == "file") {
                            ?>
                            <div class="row">
                                <div class="col-md-2"><label class="control-label"><strong><?php echo $setting->config_name; ?></strong></label></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row inputs">
                                            <div class="col-md-3 iconfile">
                                                <?php
                                                if (!empty($setting->config_value) && file_exists($_dir . $setting->config_value)) {
                                                    echo $this->html->image(str_replace("img/", "", $_dir) . $setting->config_value, ['class' => 'img-responsive', 'id' => 'logo_responce']);
                                                } else {
                                                    echo $this->html->image("noimage.jpg", ['class' => 'img-responsive', 'id' => 'logo_responce']);
                                                }
                                                echo $this->Form->input($k . '.id', ['type' => 'hidden', 'class' => 'inputId']);
                                                echo $this->Form->input($k . '.config_key', ['type' => 'hidden', 'class' => 'inputKey']);
                                                ?>
                                            </div>
                                            <div class="col-md-3" style="padding-top: 20px;">
                                                <label class="control-label"><strong><?php echo $setting->config_name; ?></strong></label>
                                                <div class="input-group">
                                                    <button class="btn btn-primary button-upload" data-loading-text="Loading..." type="button">
                                                        <i class="fa fa-upload"></i>
                                                        Upload
                                                    </button>
                                                    <?php echo $this->Form->input($k . '.config_value_file', array('id' => $setting->config_key . "_file", 'type' => 'hidden')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        } else {
                            //echo "Hanuman";
                        }
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.box-body -->

        <?= $this->Form->end() ?>
    </div>
    <?php
    $this->Html->css(['/assets/dropzone-master/dist/basic', '/assets/dropzone-master/dist/dropzone'], ['block' => true]);
    $this->Html->script(['/assets/dropzone-master/dist/dropzone'], ['block' => true]);
    ?>
</section>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    Dropzone.autoDiscover = false;
    $("div#dropfile").dropzone({
        url: "<?php echo $this->Url->build(['controller' => 'Settings', 'action' => 'dropzone']) ?>",
        maxFilesize: 5000000,
        maxFiles: 1,
        addRemoveLinks: true,
        dictResponseError: 'Server not Configured',
        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.mp4",
        init: function () {
            var self = this;
            // config
            self.options.addRemoveLinks = true;
            self.options.dictRemoveFile = "Delete";
            //New file added
            self.on("addedfile", function (file) {
                //console.log('new file added ', file);
            });
            // Send file starts
            self.on("sending", function (file) {
                //console.log('upload started', file);
                $('.meter').show();
            });

            this.on("maxfilesexceeded", function (file) {
                console.log(file);
                if (this.files[1]!=null){
                    this.removeFile(this.files[1]);
                  }
                alert("No moar files please!");
            });

            // File upload Progress
            self.on("totaluploadprogress", function (progress) {
                //console.log("progress ", progress);
                $('.roller').width(progress + '%');
            });

            self.on("queuecomplete", function (progress) {
                $('.meter').delay(999).slideUp(999);
            });

            // On removing file
            self.on("removedfile", function (file) {
                console.log("removedFile");
                console.log(file);
                x = confirm('Are you sure you want to delete this file?');
                if (x) {
                    if (typeof file.filename != "undefined") {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo $this->Url->build(['controller' => 'Settings', 'action' => 'drop']) ?>',
                            data: {filename: file.filename, file_path: file.file_path, file_loc: file.file_loc},
                            dataType: 'json'
                        });
                    }
                } else {
                    return false;
                }
            });
        },
        success: function (file, response) {
            response = JSON.parse(response);
            console.log(response);
            file.filename = response.filename;
            file.file_path = response.file_path;
            file.file_loc = response.file_loc;
            file.previewElement.classList.add("dz-success");
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });
    $('.button-upload').on('click', function () {
        var _this = $(this);
        var inputValue = _this.closest("div.input-group").find("input");
        var inputId = _this.closest("div.inputs").find("input.inputId").val();
        var inputKey = _this.closest("div.inputs").find("input.inputKey").val();
        var iconBox = _this.closest("div.inputs").find("img");
        $('#form-upload').remove();
        var fields = '<input type="text" name="config_id" value="' + inputId + '"/>';
        fields += '<input type="text" name="config_key" value="' + inputKey + '"/>';
        fields += '<input type="file" name="file" />';
        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;">' + fields + '</form>');
        $('#form-upload input[name=\'file\']').trigger('click');
        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
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
                    beforeSend: function () {
                        $('#button-upload').button('loading');
                    },
                    complete: function () {
                        $('#button-upload').button('reset');
                    },
                    success: function (json) {
                        if (json.success === true) {
                            inputValue.val(json.filename);
                            iconBox.attr('src', json.image_path);
                        } else {
                            inputValue.val('');
                            iconBox.attr('src', "<?php echo $this->request->webroot; ?>img/no_image.gif");
                        }
                        wowMsg(json.message);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });

    $('#button-favicon-upload').on('click', function () {
        $('#form-upload').remove();
        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);
                $.ajax({
                    url: '<?php echo $this->request->webroot; ?>app/uploads',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#button-favicon-upload').button('loading');
                    },
                    complete: function () {
                        $('#button-favicon-upload').button('reset');
                    },
                    success: function (json) {
                        if (json.success === true) {
                            $("#fav_icon").val(json.filename);
                            $('#fav_responce').attr('src', "<?php echo $this->request->webroot; ?>img/tmp/" + json.filename);
                        } else {
                            $("#fav_icon").val('');
                            $('#fav_responce').attr('src', "<?php echo $this->request->webroot; ?>img/no_image.gif");
                        }
                        wowMsg(json.message);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
<?php $this->Html->scriptEnd(); ?>
</script>
