<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Page'); ?> <small>
            <?php echo empty($page->id) ? __('Add New page') : __('Edit page'); ?>
        </small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="pages">
    <div class="box box-info pages">

        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($page->id) ? 'Add Page' : 'Edit Page') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $myTemplates = [
            'inputContainerError' => '<div class="input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="text-danger">{{content}}</div>',
        ];
        $this->Form->setTemplates($myTemplates);
        ?>
        <?= $this->Form->create($page, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('sub_title', ['class' => 'form-control', 'placeholder' => __('Sub Title')]); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug'), 'required'=>false]); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('short_description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Short Description','rows'=> 8, 'label' => ['text' => "Short Description"]]); ?>

                    </div><!-- /.form-group -->

                    <div class="form-group" style="display:none;">
                        <label>Status</label>
                        <?php
                        echo $this->Form->select(
                                'status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control']
                        );
                        ?>
                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => 'Meta Title', 'label' => ['text' => "Meta Title"]]); ?>

                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => 'Meta Keyword', 'label' => ['text' => "Meta Keyword"]]); ?>

                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->control('meta_description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Meta Description', 'label' => ['text' => "Meta Description"]]); ?>

                    </div><!-- /.form-group -->



                    <div class="form-group">
                        <div class="imageBox" id="imageBox-0">
                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                    <?php 
									echo $this->Glide->image(($page->banner != '' ? $page->banner : 'no_image.gif'), ['w'=>'200', 'h'=>'100','fit' => 'fill'], ['style'=>'max-width:200px','alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                </a>
                                <?php echo $this->Form->control('banner', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                            </div>
                    </div><!-- /.form-group -->

                </div>
            </div><!-- /.row -->


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control ckeditor withImage', 'id' => 'ckEditorImageOption', 'placeholder' => 'Description', 'label' => ['text' => "Description"]]); ?>

                    </div><!-- /.form-group -->
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</section>
<?= $this->Html->script(['GalleryManager.common'], ['block' => true]) ?>