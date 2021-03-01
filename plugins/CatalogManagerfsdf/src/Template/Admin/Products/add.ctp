<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */
use Cake\Routing\Router;
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Product'); ?> <small>
            <?php echo empty($product->id) ? __('Add New product') : __('Edit product'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="products">
    <div class="box box-info products">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($product->id) ? 'Add Product' : 'Edit Product') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
        <?= $this->Form->create($product, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                    <li><a href="#p_links" data-toggle="tab">Links</a></li>
                    <li><a href="#tab_banner" data-toggle="tab">Product Banner</a></li>
                    <li><a href="#_productimages" data-toggle="tab">Product Images</a></li>
                    <li><a href="#__productdiscount" data-toggle="tab">Product Discount</a></li>
                    <li><a href="#_productspecialdisc" data-toggle="tab">Special Discount</a></li>
                    <li><a href="#_producOptons" data-toggle="tab">Options</a></li>
                    <li><a href="#_attribute" data-toggle="tab">Attribute</a></li> 
                    <li><a href="#_productdescription" data-toggle="tab">Product Description</a></li>
                    <li><a href="#_metadata" data-toggle="tab">Meta Data</a></li>
                </ul>

            </div>
            <div class="tab-content">
                <div class="active tab-pane" id="general">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => 'Title', 'label' => ['text' => "Title"]]); ?>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('model', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Product Code', 'label' => ['text' => "Product Code"]]); ?>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('slug', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Slug', 'label' => ['text' => "Slug"]]); ?>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('model', ['class' => 'form-control', 'placeholder' => __('Model')]); ?>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('sku', ['class' => 'form-control', 'placeholder' => __('Sku')]); ?>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('upc', ['class' => 'form-control', 'placeholder' => __('Upc')]); ?>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('price', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Price', 'label' => ['text' => "Price"]]); ?>

                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('quantity', ['min' => 0, 'class' => 'form-control', 'placeholder' => 'Quantity', 'label' => ['text' => "Quantity"]]); ?>

                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('minimum_quantity', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Minimum Quantity')]); ?>

                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('stock_status_id', ['options' => $stockStatuses, 'empty' => FALSE, 'class' => 'form-control']); ?>

                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('status', ['type' => 'select', 'class' => 'form-control', 'options' => [1 => "Active", 0 => "Inactive"], 'label' => ['text' => "Status"]]); ?>
                            </div><!-- /.form-group -->
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo $this->Form->control('sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order')]); ?>

                            </div><!-- /.form-group -->
                        </div>

                    </div><!-- /.row -->
                </div>

                <div class="tab-pane" id="p_links">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label" for="input-related"><span >Categories</span></label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->control('categories._ids', ['options' => $categories, 'class' => 'form-control', 'style' => 'height:200px;', 'label' => false]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 control-label" for="input-related"><span >Related Products</span></label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->control("related", ['type' => 'text', 'class' => 'form-control', 'id' => 'input-related', 'autocomplete' => 'off', 'placeholder' => 'Related Products']); ?>
                            <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php
                                $related_row = 0;
                                if (!empty($product->related_products)) {
                                    foreach ($product->related_products as $ralate) {

                                        ?>
                                        <div id="product-related<?php echo $ralate->related_id; ?>" class="relat-id-<?php echo $ralate->id; ?>">
                                            <i class="fa fa-minus-circle" data-id="<?php echo $ralate->id; ?>"></i> <?php echo $ralate->related->title; ?>
                                            <?php
                                            echo $this->Form->control("related_products." . $related_row . ".id", ['type' => 'hidden', 'label' => false]);
                                            echo $this->Form->control("related_products." . $related_row . ".related_id", ['type' => 'hidden', 'class' => 'relatedp_id', 'label' => false]);

                                            ?>
                                        </div>
                                        <?php
                                        $related_row++;
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label" for="input-related"><span >Tags</span></label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->control('tags._ids', ['options' => $tags, 'class' => 'form-control', 'style' => 'height:200px;', 'label' => false]); ?>
                            </div>
                        </div>
                    </div>	
                </div>

                <div class="tab-pane" id="tab_banner">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-header">Banner</h4>
                            <div class="form-group">
                                <?php echo $this->Form->control('image_file', ['type' => 'file', 'class' => '', 'label' => false]); ?>
                            </div>
                            <?php if (!empty($product->image) && file_exists($_dir . $product->image)) { ?>
                                <div class="form-group">
                                    <?php
                                    echo $this->Html->image(str_replace("img/", "", $_dir) . $product->image, ['class' => 'img-thumbnail', 'id' => 'logo_responce', 'alt' => 'Image', 'width' => '200px']);

                                    ?>

                                    <?php
                                    echo $this->Html->link("<i class=\"fa fa-trash\"></i> ", ['action' => 'deleteimg', $product->id], ['confirm' => __('Are you sure you want to delete banner  image?'), 'class' => 'btn btn-danger btn-sm', 'escape' => false, 'style' => 'margin-left:10px;']);

                                    ?>
                                </div>
<?php } ?>
                            <p> For best view image size should be (1400x500) </p>		
                            <!-- /.form-group -->
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="_productimages">
                    <div class="row">
                        <div class="col-md-3 pull-left">
                            <div id="filecontainer">
<?php echo $this->html->link("<i class=\"fa fa-plus\"></i> " . __(' Select Images'), "javascript:;", ["class" => "btn btn-block btn-success", "id" => "pickfiles", "escape" => false]); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                    </div>
                    <table class="table table-bordered table-hover" style="margin-top: 30px;">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="20%"> Photo </th>
                                <th width="20%"> Sort Order </th>
                                <th width="10%"> </th>
                            </tr>
                        </thead>
                        <tbody id="productimage">
                            <?php
                            $inc = 0;
                            $product->product_images = !empty($product->product_images) ? $product->product_images : [];
                            foreach ($product->product_images as $limage) {
                                $idc = !empty($limage->id) ? $limage->id : $inc;
                                ?>
                                <tr id="limage_<?php echo $idc; ?>">
                                    <td>
                                        <?php
                                        $_tdir = $_dir . $product->id . "/"; 
                                        if(empty($limage->id)){
                                              $_tdir = "img/tmp/";
                                         }
                                       if (!empty($limage->image) && file_exists($_tdir .$limage->image)) {
											$photo = Router::url("/",true) . 'tim-thumb/timthumb.php?src=' . $this->request->webroot."webroot/". $_tdir . $limage->image . '&w=50&h=50&a=t&q=100';
										} else {
											$photo = Router::url("/",true) . 'tim-thumb/timthumb.php?src=' . $this->request->webroot.'webroot/img/noimage.jpg&w=50&h=50&a=t&q=100';
										}
                                        echo $this->Html->image($photo, ['class' => '', 'alt' => 'Image', 'style' => 'max-height:80px;']);
                                        echo $this->Form->control('product_images.' . $inc . '.image', ['type' => 'hidden']);
                                        echo $this->Form->control('product_images.' . $inc . '.id', ['type' => 'hidden']);

                                        ?>
                                    </td>
                                    <td>
    <?php echo $this->Form->control('product_images.' . $inc . '.sort_order', ['class' => 'form-control', 'placeholder' => 'Sort Order', 'label' => false, 'value' => $limage['orderId']]); ?></td>
                                    <td>
                                        <?php if(!empty($limage['id'])){ ?>
                                            <a href="javascript:;" onclick="deleteimage(<?php echo $limage['id']; ?>, '<?php echo $limage['image']; ?>');" class="btn btn-default btn-sm"><i class="fa fa-times"></i> Remove </a> 
                                          <?php }else{ ?>
                                            <a href="javascript:;" onclick="$('#limage_<?php echo $idc; ?>).remove();" class="btn btn-default btn-sm"><i class="fa fa-times"></i> Remove </a> 
                                          <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                $inc++;
                            }

                            ?>

                        </tbody>
<?php if ($inc == 1) { ?>
                            <tr id="chooseImg">
                                <td colspan="4" align="center"><strong>Please Select Images and Upload</strong></td>
                            </tr>
<?php } ?>
                    </table>

                </div>

                <div class="tab-pane" id="__productdiscount">
                    <h4 class="page-header">Discount</h4>

                    <div class="table-responsive">
                        <table id="discount" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-left">Quantity</td>
                                    <td class="text-right">Priority</td>
                                    <td class="text-right" style="display:none;">Discount Type</td>
                                    <td class="text-right">Price</td>
                                    <td class="text-right">Start Date</td>
                                    <td class="text-left">End Date</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $discount_row = 0;
                                if (!empty($product->product_discounts)) {
                                    foreach ($product->product_discounts as $product_discounts) {

                                        ?>

                                        <tr id="discount-row<?php echo $discount_row; ?>" class="discount-row-<?php echo $product_discounts->id; ?>">

                                            <td class="text-right">
                                                <?php
                                                echo $this->Form->control('product_discounts.' . $discount_row . '.id', [ 'type' => 'hidden']);
                                                echo $this->Form->control('product_discounts.' . $discount_row . '.quantity', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Quantity', 'label' => false]);

                                                ?></td>
                                            <td class="text-right"><?php echo $this->Form->control('product_discounts.' . $discount_row . '.priority', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Priority', 'label' => false]); ?></td>
                                            <td class="text-right" style="display:none;"><?php echo $this->Form->control('product_discounts.' . $discount_row . '.discount_type', ['class' => 'form-control', 'options' => ['fixed' => 'Fixed', 'percent' => 'Percent'], 'label' => false]); ?></td>
                                            <td class="text-right"><?php echo $this->Form->control('product_discounts.' . $discount_row . '.price', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Price', 'label' => false]); ?></td>
                                            <td class="text-left" style="width: 20%;">
                                                <?php echo $this->Form->control('product_discounts.' . $discount_row . '.date_start', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD', 'label' => false]); ?>
                                            </td>
                                            <td class="text-left" style="width: 20%;">
        <?php echo $this->Form->control('product_discounts.' . $discount_row . '.date_end', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD', 'label' => false]); ?>
                                            </td>
                                            <td class="text-left">
                                                <button type="button" onclick="deletediscount(<?php echo $product_discounts->id; ?>);" data-toggle="tooltip" title="Remove Discount" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                            </td>
                                        </tr>
                                        <?php $discount_row++; ?>
                                        <?php
                                    }
                                }

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="Add Discount" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- /.row -->
                </div>

                <div class="tab-pane" id="_productspecialdisc">
                    <h4 class="page-header">Special Discount</h4>

                    <div class="table-responsive">
                        <table id="special" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-right">Priority</td>
                                    <td class="text-right">Price</td>
                                    <td class="text-right">Start Date</td>
                                    <td class="text-left">End Date</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $special_row = 0;
                                if (!empty($product->product_specials)) {
                                    foreach ($product->product_specials as $product_special) {

                                        ?>

                                        <tr id="special-row<?php echo $special_row; ?>" class="spdiscount-row-<?php echo $product_special->id; ?>">


                                            <td class="text-right"><?php
                                                echo $this->Form->control('product_specials.' . $special_row . '.id', [ 'type' => 'hidden']);
                                                echo $this->Form->control('product_specials.' . $special_row . '.priority', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Priority', 'label' => false]);

                                                ?></td>
                                            <td class="text-right"><?php echo $this->Form->control('product_specials.' . $special_row . '.price', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Price', 'label' => false]); ?></td>
                                            <td class="text-left" style="width: 20%;">
                                                <?php echo $this->Form->control('product_specials.' . $special_row . '.date_start', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD', 'label' => false]); ?>
                                            </td>
                                            <td class="text-left" style="width: 20%;">
        <?php echo $this->Form->control('product_specials.' . $special_row . '.date_end', ['class' => 'form-control datetimepicker', 'type' => 'text', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD', 'label' => false]); ?>
                                            </td>
                                            <td class="text-left"><button type="button" onclick="deletespdiscount(<?php echo $product_special->id; ?>);"  data-toggle="tooltip" title="Remove Special" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>

                                        </tr>
                                        <?php $special_row++; ?>
                                        <?php
                                    }
                                }

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td class="text-left"><button type="button" onclick="addSpecial();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- /.row -->
                </div>

                <div class="tab-pane" id="_attribute">
                    <div class="table-responsive">
                        <table id="attributes-tbl" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>Option Value</td>
                                    <td>Subtract Stock</td>
                                    <td>Price</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $attribut_row = 0;
                                if (!empty($product->product_attributes)) {
                                    foreach ($product->product_attributes as $attribut) {

                                        ?>

                                        <tr id="attr-row<?php echo $attribut_row; ?>" class="attr-row-<?php echo $attribut->id; ?>">


                                            <td><?php
                                                echo $this->Form->control('product_attributes.' . $attribut_row . '.id', [ 'type' => 'hidden']);
                                                echo $this->Form->control('product_attributes.' . $attribut_row . '.title', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Priority', 'label' => false]);

                                                ?></td>
                                            <td>
        <?php echo $this->Form->control('product_attributes.' . $attribut_row . '.in_stock', ['options' => ['1' => 'Yes', '0' => 'No'], 'class' => 'form-control', 'label' => false]); ?>
                                            </td>

                                            <td>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <?php echo $this->Form->control('product_attributes.' . $attribut_row . '.price_prefix', ['options' => ['+' => '+', '-' => '-'], 'class' => 'form-control', 'label' => false]); ?>
                                                    </div>
                                                    <div class="col-md-8">
        <?php echo $this->Form->control('product_attributes.' . $attribut_row . '.price', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Price', 'label' => false]); ?>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="text-left"><button type="button" onclick="deleteattr(<?php echo $attribut->id; ?>);"  data-toggle="tooltip" title="Remove Attribut" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>

                                        </tr>
                                        <?php $attribut_row++; ?>
                                        <?php
                                    }
                                }

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-left"><button type="button" onclick="addAttr();" data-toggle="tooltip" title="Add Attribut" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- /.row -->
                </div>

                <div class="tab-pane" id="_producOptons">
                    <div class="row">
                        <div class="col-sm-2">
                            <ul class="nav nav-pills nav-stacked" id="option">
                                <?php $option_row = 0; ?>
                                <?php
                                if (isset($product_options)) {
                                    foreach ($product_options as $product_option) {

                                        ?>
                                        <li><a href="#tab-option<?php echo $option_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-option<?php echo $option_row; ?>\']').parent().remove(); $('#tab-option<?php echo $option_row; ?>').remove(); $('#option a:first').tab('show');"></i> <?php echo $product_option['name']; ?></a></li>
                                        <?php $option_row++; ?>
                                        <?php
                                    }
                                }

                                ?>
                                <li>
                                    <input type="text" name="option" value="" placeholder="Options" id="input-option" class="form-control" />
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-10">
                            <div class="tab-content">
                                hi hello
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="_productdescription">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
<?php echo $this->Form->control('short_description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Short Description', 'label' => ['text' => "Short Description"]]); ?>

                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-12">
                            <div class="form-group">
<?php echo $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control ckeditor', 'placeholder' => 'Description', 'label' => ['text' => "Description"]]); ?>

                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>

                <div class="tab-pane" id="_metadata">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
<?php echo $this->Form->control('meta_title', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Meta Title', 'label' => ['text' => "Meta Title"]]); ?>

                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-12">
                            <div class="form-group">
<?php echo $this->Form->control('meta_description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Meta Description', 'label' => ['text' => "Meta Description"]]); ?>

                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-12">
                            <div class="form-group">
<?php echo $this->Form->control('meta_keyword', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Meta Keyword', 'label' => ['text' => "Meta Keyword"]]); ?>
                            </div><!-- /.form-group -->
                        </div>
                    </div><!-- /.row -->
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
<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min','/assets/plugins/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload', '/assets/plugins/iCheck/square/blue.css', '/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min', '/assets/plugins/plupload/js/plupload.full.min', '/assets/plugins/iCheck/icheck.min', '/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', 'autocomplete'], ['block' => true]);

?>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    $('.datetimepicker').datetimepicker({
				minView: 2,
                format: 'yyyy-mm-dd', 
				'showTimepicker': false,
                autoclose: true,
                });
                
function deletespdiscount(id){
			$.ajax({
                type: "post",
                url: "<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'deletespdiscount']); ?>",
                data: {id: id},
                dataType: "JSON",
                success: function (data) {
                   if (data.success == true) {
                		$(".spdiscount-row-" + id).remove();
            		}
					alert(data.err_msg);
                }
            });
}

function deletediscount(id){
			$.ajax({
                type: "post",
                url: "<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'deletediscount']); ?>",
                data: {id: id},
                dataType: "JSON",
                success: function (data) {
                   if (data.success == true) {
                		$(".discount-row-" + id).remove();
            		}
					alert(data.err_msg);
                }
            });
}	
                
    var uploader = new plupload.Uploader({
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: 'pickfiles', // you can pass an id...
        container: document.getElementById('filecontainer'), // ... or DOM Element itself
        url: '<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'tempfiles']); ?>',
        flash_swf_url: '<?php echo $this->request->webroot; ?>assets/plugins/plupload/js/Moxie.swf',
        silverlight_xap_url: '<?php echo $this->request->webroot; ?>assets/plugins/plupload/js/Moxie.xap',
        filters: {
            max_file_size: '10mb',
            mime_types: [
                {title: "Image files", extensions: "jpg,gif,png,jpeg"},
                {title: "Zip files", extensions: "zip"}
            ]
        },
        dragdrop: true,
        init: {
            PostInit: function () {
                document.getElementById('filelist').innerHTML = '';
            },
            FilesAdded: function (up, files) {
                uploader.start();
                plupload.each(files, function (file) {
                    var imgHtm = '';
                    var imgpath = '';
                    imgHtm += '<tr id="limage_' + file.id + '"> ';
                    imgHtm += '<td> <img src="<?php echo $this->request->webroot; ?>img/noimage.jpg" width="50"> <span class="progress"></span></td>';
                    imgHtm += '<td><input class="form-control imgnm" type="hidden" name="product_images[' + file.id + '][image]"><input class="form-control" type="text" placeholder="Sort Order" name="product_images[' + file.id + '][sort_order]"></td>';
                    imgHtm += '<td><a class="btn btn-default btn-sm" onclick="$(\'#limage_' + file.id + '\').remove();" href="javascript:;"><i class="fa fa-times"></i> Remove </a></td>';
                    imgHtm += '</tr>';
                    $("tbody#productimage").append(imgHtm);
                    $("#chooseImg").remove('');

                });
            },
            FileUploaded: function (up, file, response) {
                var response = $.parseJSON(response.response);
                var imgHtm = '';
                var imgpath = '';
                if (response.success === true) {
                    if (response.data.imagepath) {
                        imgpath = response.data.imagepath;
                    }
                    $("#limage_" + file.id + " img").attr("src", imgpath);
                    $("#limage_" + file.id + " input[type='radio']").val(response.data.name);
                    $("#limage_" + file.id + " input.imgnm").val(response.data.name);
                } else {
                    $("#limage_" + file.id + " img").attr("src", "<?php echo $this->request->webroot; ?>img/noimage.jpg");
                }

            },
            UploadProgress: function (up, file) {
                $("#limage_" + file.id + " td span.progress").html(file.percent + "%");
                //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            Error: function (up, err) {
                document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
            }
        }
    });

    uploader.init();
    
    
    var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tr id="discount-row' + discount_row + '">';
    html += '  <td class="text-right"><input type="text" name="product_discounts[' + discount_row + '][quantity]" placeholder="Quantity" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_discounts[' + discount_row + '][priority]" placeholder="Priority" class="form-control" /></td>';
	html += '  <td class="text-right" style="display:none;"><select name="product_discounts[' + discount_row + '][discount_type]" class="form-control"><option value="fixed" selected="selected">Fixed</option><option value="percent">Percent</option></select></td>';
	html += '  <td class="text-right"><input type="text" name="product_discounts[' + discount_row + '][price]" placeholder="Price" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_discounts[' + discount_row + '][date_start]" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD" class="form-control datetimepicker" /></td>';
	html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_discounts[' + discount_row + '][date_end]" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD" class="form-control datetimepicker" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="Remove Discount" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#discount tbody').append(html);

	$('.datetimepicker').datetimepicker({
				minView: 2,
                format: 'yyyy-mm-dd', 
				'showTimepicker': false,
                autoclose: true,
                });

	discount_row++;
}


var special_row = <?php echo $special_row; ?>;

function addSpecial() {
	html  = '<tr id="special-row' + special_row + '">';
   
    html += '  <td class="text-right"><input type="text" name="product_specials[' + special_row + '][priority]" placeholder="Priority" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_specials[' + special_row + '][price]" placeholder="Price" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_specials[' + special_row + '][date_start]" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD" class="form-control datetimepicker" /></div></td>';
	html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_specials[' + special_row + '][date_end]" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD" class="form-control datetimepicker" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="Add Special" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#special tbody').append(html);

	$('.datetimepicker').datetimepicker({
				minView: 2,
                format: 'yyyy-mm-dd', 
				'showTimepicker': false,
                autoclose: true,
                });

	special_row++;
}

    
<?php $this->Html->scriptEnd(); ?>
</script>