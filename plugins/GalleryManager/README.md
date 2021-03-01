# GalleryManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/GalleryManager
```

GalleryManager
----------------------------------------------------------------------------------------------------
bin\cake bake plugin GalleryManager

Description: 
This is gallery manager plugin. so please follow below steps.

Add GalleryManager.common script in footer section

$this->Html->script(['GalleryManager.common'], ['block' => true]);

In the Html we need to put  id="imageBox-{inc}" on closest parent element(div) there system find image and input in this element


<div class="row imageBox" id="imageBox-0">
                            <label class="col-md-12 control-label" for="image">Profile Photo</label>
                            <div class="col-md-8">
                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                    <?php 
									echo $this->Glide->image(($user->profile_photo != '' ? $user->profile_photo : 'no_image.gif'), ['w'=>'150', 'h'=>'150'], ['style'=>'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                </a>
                                <?php echo $this->Form->control('profile_photo', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                            </div>
                        </div>