<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $banner
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Banner'); ?> <small>
            <?php echo empty($banner->id) ? __('Add New banner') : __('Edit banner'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="banners">
    <div class="box box-info banners">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($banner->id) ? 'Add Banner' : 'Edit Banner') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);

        ?>
        <?= $this->Form->create($banner, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    echo $this->Form->control('sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order')]);

                    ?>
                </div>
                <div class="col-md-12">
                    <table id="bannewrImages" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 20%;">Title</th>
                                <th class="text-left" style="width: 20%;">Link</th>
                                <th class="text-center" style="width: 20%;">Description</th>
                                <th class="text-right" style="width: 10%;">Image</th>
                                <th class="text-right" style="width: 10%;">Sort Order</th>
                                <th  style="width: 8%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $key = 0;
                            if (!empty($banner->banner_images)) {
                                foreach ($banner->banner_images as $key => $bannerImg) {

                                    ?>
                                    <tr id="imageBox-<?= $key; ?>" class="row-<?= $bannerImg->id; ?> imageBox">
                                        <td class="text-left">
                                            <?php
                                            echo $this->Form->control('banner_images.' . $key . '.id', ['type' => 'hidden', 'class' => 'form-control','label' => false]);
                                            echo $this->Form->control('banner_images.' . $key . '.title', ['class' => 'form-control', 'placeholder' => __('Title'),'label' => false]);

                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            echo $this->Form->control('banner_images.' . $key . '.external_link', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('External Link'),'label' => false]);
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            echo $this->Form->control('banner_images.' . $key . '.description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('Description'),'rows'=>2,'label' => false,'templates' => [
                                                    'error' => '<div class="col-md-12 error-message text-danger">{{content}}</div>',
                                                    'textarea' => '<div class="col-md-12"><textarea name="{{name}}"{{attrs}}>{{value}}</textarea></div>',
                                                ]]);
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>">
                                            <?php echo $this->Glide->image(($bannerImg->image != '' ? $bannerImg->image : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                            </a>
        <?php echo $this->Form->control('banner_images.' . $key . '.image', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $this->Form->control('banner_images.' . $key . '.sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order'),'label' => false,'templates' => [
                                                    'error' => '<div class="col-md-12 error-message text-danger">{{content}}</div>',
                                                    'input' => '<div class="col-md-12"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
                                                ]]); ?>
                                        </td>
                                        <td class="text-left">
                                            <button type="button" data-url="<?php echo $this->Url->build(["controller" => 'Banners', "action" => "deleteImages", $bannerImg->id]); ?>" data-toggle="tooltip" data-title="<?= $bannerImg->title; ?>" title="Remove" class="btn btn-danger deleteTableData">
                                                <i class="fa fa-minus-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"></td>
                                <td class="text-left">
                                    <button type="button" onclick="addImage();" data-toggle="tooltip" title="<?= __('Add Banner') ?>" class="btn btn-primary">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
        <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
<?= $this->Form->end() ?>
    </div>
</section>
<?php $this->Html->script(['GalleryManager.common'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    var image_row = <?= ($key+1)?>;
    function addImage(language_id) {
    html = '<tr id="imageBox-' + image_row + '" class="imageBox">';
    html += '  <td class="text-left"><input type="text" name="banner_images[' + image_row + '][title]" placeholder="Title" class="form-control" /></td>';
    html += '  <td class="text-left"><input type="text" name="banner_images[' + image_row + '][external_link]" placeholder="Link" class="form-control" /></td>';
    html += '  <td class="text-left"><textarea name="banner_images[' + image_row + '][description]" placeholder="Description" class="form-control"></textarea></td>';
    
    html += '  <td class="text-center"><a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>"><img src="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" style="width:100px" data-placeholder="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" /></a><input type="hidden" name="banner_images[' + image_row + '][image]" value="" id="input-image' + image_row + '" class="input-image" /></td>';
    
    html += '  <td class="text-right"><input type="text" name="banner_images[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
    
    html += '  <td class="text-left"><button type="button" onclick="$(\'#imageBox-' + image_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    $('table#bannewrImages tbody').append(html);
    image_row++;
    }
<?php $this->Html->scriptEnd(); ?>
</script>