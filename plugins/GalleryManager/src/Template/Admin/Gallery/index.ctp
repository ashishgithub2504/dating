<?php 
use Cake\Routing\Router;
?>
<style>
    #filemanager input[type="checkbox"]{margin-top: 4px;
                                        float: left;
                                        margin-right: 4px;}
    #filemanager label{
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: bold;
        word-wrap: break-word;
    }
</style>
<div id="filemanager">
    <div class="row">
        <div class="col-sm-5">
            <a href="<?php echo $this->Url->build(["action" => "index", "?" => ["directory" => $parent, 'imageBoxId' => $imageBoxId], TRUE]); ?>" data-toggle="tooltip" title=" button_parent " id="button-parent" class="btn btn-default">
                <i class="fa fa-level-up"></i>
            </a>
            <a href="<?php echo $this->Url->build(["action" => "index", "?" => ["directory" => $currentFolder, 'imageBoxId' => $imageBoxId], TRUE]); ?>" data-toggle="tooltip" title="button_refresh" id="button-refresh" class="btn btn-default">
                <i class="fa fa-refresh"></i>
            </a>
            <button type="button" data-toggle="tooltip" title="button_upload" id="button-upload" class="btn btn-primary"><i class="fa fa-upload"></i></button>
            <button type="button" data-toggle="tooltip" title="button_folder" id="button-folder" class="btn btn-default"><i class="fa fa-folder"></i></button>
            <button type="button" data-toggle="tooltip" title="button_delete" id="button-delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
    <hr />
    <?php
    $num_fl = 0;
    foreach ($gallaries[0] as $folders):
        ?>
        <?php
        if ($num_fl % 4 == 0) {
            echo '<div class="row">';
        }

        ?>
        <div class="col-sm-3 col-xs-6 text-center">
            <div class="text-center">
                <a href="<?php echo $this->Url->build(["action" => "index", "?" => ["directory" => $currentFolder . '/' . $folders, 'imageBoxId' => $imageBoxId], TRUE]); ?>" rel="" class="directory" style="vertical-align: middle;"><i class="fa fa-folder fa-5x"></i></a></div>
            <label>
                <input type="checkbox" name="path[]" value="<?php echo $folders; ?>" />
                <?php echo $folders; ?></label>
        </div>
        <?php
        $num_fl++;
        if (($num_fl % 4 == 0 && $num_fl > 0) || ($num_fl == count($gallaries[0]))) {
            echo '</div>';
        }

        ?>
    <?php endforeach; ?>
    <?php
    $galleryCounter = 0;
    foreach ($gallaries[1] as $file):
        ?>
        <?php
        if ($galleryCounter % 4 == 0) {
            echo '<div class="row">';
        }

        ?>
        <div class="col-sm-3 col-xs-6 text-center">
            <a href="<?php echo $file; ?>" class="uploadImage thumbnail" rel="<?php echo $galleryCounter; ?>">
    <?php echo $this->Html->image('/' . $basepath . '/' . $currentFolder . '/' . $file, ['alt' => '', 'width' => '100', 'class' => '']); ?>
                <input type="hidden" class="imageWithUrl" id="Image-Path-<?php echo $galleryCounter; ?>" value="<?php echo 'uploads' . $currentFolder . '/' . $file; ?>" />
            </a>
            <label>
                <input type="checkbox" name="path[]" value="<?php echo $file; ?>" />
    <?php echo $file; ?>
            </label>
        </div>
        <?php
        $galleryCounter++;
        if (($galleryCounter % 4 == 0 && $galleryCounter > 0) || ($galleryCounter == count($gallaries[1]))) {
            echo '</div>';
        }
    endforeach;

    ?>
    <br />
    <?php $deleteUrl = Router::url(["controller" => 'Gallery', "action" => "delete", "plugin" => 'GalleryManager', "?" => ["directory" => $currentFolder, 'imageBoxId' => $imageBoxId]]); ?>
</div>
<input type="hidden" id="imageBoxId" value="<?php echo $imageBoxId; ?>" >
<script type="text/javascript">
    $('a.uploadImage').on('click', function (e) {
        e.preventDefault();
        var imageDisplayBoxId = $("#imageBoxId").val();
        var imageWithUrl = $(this).find('input.imageWithUrl').val();
        var filename = imageWithUrl.replace(/^.*[\\\/]/, '');
        var imageIndex = imageDisplayBoxId.split('-');
        $('#'+imageIndex[1]+'-config-value').val(filename);
        $('#' + imageDisplayBoxId).find('[data-gallery="thumb-image"]').find('img').attr('src', $(this).find('img').attr('src'));
        $('#' + imageDisplayBoxId).find('input.input-image').val(imageWithUrl);
        $('#manuModal').modal('hide');
       
    });
//{% endif %}

    $('a.directory').on('click', function (e) {
        e.preventDefault();
        $('#manuModal .modal-body').load($(this).attr('href'));
    });

    $('.pagination a').on('click', function (e) {
        e.preventDefault();

        $('#manuModal .modal-body').load($(this).attr('href'));
    });

    $('#button-parent').on('click', function (e) {
        e.preventDefault();

        $('#manuModal .modal-body').load($(this).attr('href'));
    });

    $('#button-refresh').on('click', function (e) {
        e.preventDefault();

        $('#manuModal .modal-body').load($(this).attr('href'));
    });

    $('input[name=\'search\']').on('keydown', function (e) {
        if (e.which == 13) {
            $('#button-search').trigger('click');
        }
    });
</script>
<script type="text/javascript">
  
    $('#button-upload').on('click', function () {
        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file[]" value="" multiple="multiple" /></form>');

        $('#form-upload input[name=\'file[]\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file[]\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: '<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "upload", "plugin" => 'GalleryManager', "?" => ["directory" => $currentFolder, 'imageBoxId' => $imageBoxId], TRUE]); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                            "accept": "application/json",
                        },
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                        $('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                        $('#button-upload').prop('disabled', true);
                    },
                    complete: function () {
                        $('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
                        $('#button-upload').prop('disabled', false);
                    },
                    success: function (json) {
                        console.log(json.message);
                        var html = '';

                        $.each( json.message, function( key, val ) {
                            html += val+'<br>';
                          });
                        
                     $.alert({
                            title: ((json.status === true) ? 'Success!' : 'Error!'),
                            icon: 'fa fa-'+ ((json.status === true) ? 'success' : 'error'),
                            type: ((json.status === true) ? 'green' : 'red'),
                            content: html,
                        });
                        
                        $('#button-refresh').trigger('click');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    $('#button-folder').popover({
        html: true,
        placement: 'bottom',
        trigger: 'click',
        title: 'New Folder',
        content: function () {
            html = '<div class="input-group">';
            html += '  <input type="text" name="folder" value="" placeholder="" class="form-control">';
            html += '  <span class="input-group-btn"><button type="button" title="New Folder" id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
            html += '</div>';

            return html;
        }
    });

    $('#button-folder').on('shown.bs.popover', function () {
        $('#button-create').on('click', function () {

            $.ajax({
                url: '<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "folder", "plugin" => 'GalleryManager', "?" => ["directory" => $currentFolder, 'imageBoxId' => $imageBoxId], TRUE]); ?>',
                type: 'post',
                dataType: 'json',
                data: 'folder=' + encodeURIComponent($('input[name=\'folder\']').val()),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    $('#button-create').prop('disabled', true);
                },
                complete: function () {
                    $('#button-create').prop('disabled', false);
                },
                success: function (json) {
                    if (json['error']) {
                        $.alert({
                            title: 'Warning!',
                            content: json['error'],
                        });
                        //alert(json['error']);
                    }

                    if (json['success']) {
                        $.alert({
                            title: 'Success!',
                            content: json['success'],
                        });

                        $('#button-refresh').trigger('click');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
    });

    $('#button-delete').on('click', function (e) {
        var totalDeleteItems = $('input[name^=\'path\']:checked').length;
        if (totalDeleteItems > 0) {
            $.confirm({
                theme: 'supervan',
                title: 'Delete Image!',
                content: 'Are you sure you want to delete items?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            url: '<?php echo $deleteUrl ?>',
                            type: 'post',
                            dataType: 'json',
                            data: $('input[name^=\'path\']:checked'),
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                                $('#button-delete').prop('disabled', true);
                            },
                            complete: function () {
                                $('#button-delete').prop('disabled', false);
                            },
                            success: function (json) {
                                if (json['error']) {
                                    $.alert({
                                        title: 'Warning!',
                                        content: json['error'],
                                    });
                                    //alert(json['error']);
                                }

                                if (json['success']) {
                                    $.alert({
                                        title: 'Success!',
                                        content: json['success'],
                                    });
                                    //alert(json['success']);

                                    $('#button-refresh').trigger('click');
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    },
                    cancel: function () {
                    }
                }
            });
        }
    });

</script>