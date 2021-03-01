<?php if(!empty($banner)): 
    foreach($banner->banner_images as $bannerImg):
    ?>
<li>
    <?php 
    if(!empty($bannerImg->external_link)):
        echo $this->Html->link($this->Glide->image(($bannerImg->image != '' ? $bannerImg->image : 'no_image.gif'), ['w' => '1920', 'h' => '700','fit'=>'crop']),$bannerImg->external_link,['escape'=>false]);
    else:
        echo $this->Glide->image(($bannerImg->image != '' ? $bannerImg->image : 'no_image.gif'), ['w' => '1920', 'h' => '700']);
    endif;
    ?>
    <div class="flex-caption">
        <h3><?= $bannerImg->title ?></h3> 
        <?php if(!empty($bannerImg->description)): ?>
        <p><?= $bannerImg->description ?></p> 
        <?php endif; ?>
    </div>
</li>
<?php endforeach; ?>
<?php endif; ?>