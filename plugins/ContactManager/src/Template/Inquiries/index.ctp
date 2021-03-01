<?php //echo $this->element('breadcrumbs'); ?>

<div class="contacts cms-pages full-wdth clearfix padding-top50 padding-bottom50">
    <div class="container container-custom">
        <p class="text-center padding-bottom30"><?php echo $ConfigSettings['CONTACT_US_TEXT']; ?></p>

        <?= $this->Form->create($inquiry); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form">

                    <div class="form-group">
                        <?= $this->Form->input('first_name', ['placeHolder' => 'Your First Name', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div> 
                    <div class="form-group">
                        <?= $this->Form->input('last_name', ['placeHolder' => 'Your Last Name', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('email', ['placeHolder' => 'Your Email', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('mobile', ['placeHolder' => 'Your Mobile Number', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div> 	
                    <div class="form-group">
                        <?= $this->Form->input('message', ['placeHolder' => 'Your Message', 'type' => 'textarea', 'class' => 'form-control', 'div' => false, 'label' => false]); ?>
                    </div>	    

                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info full register_now">
                    <h2><span class="orange-color">Contact Detail</span></h2>
                    <?php if (isset($ConfigSettings['OFFICE_ADDRESS']) && (trim($ConfigSettings['OFFICE_ADDRESS'] != ""))): ?>
                        <p><?php echo $ConfigSettings['OFFICE_ADDRESS']; ?></p>
                    <?php endif; ?>

                    <?php if (isset($ConfigSettings['TELEPHONE']) && (trim($ConfigSettings['TELEPHONE'] != ""))): ?>
                        <div class="contact-dtl">
                            <div class="dtl-name"><i class="fa fa-mobile" aria-hidden="true"></i> Phone:</div>
                            <div class="dtls"><?php echo $ConfigSettings['TELEPHONE']; ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($ConfigSettings['FAX']) && (trim($ConfigSettings['FAX'] != ""))): ?>
                        <div class="contact-dtl">
                            <div class="dtl-name"><i class="fa fa-fax" aria-hidden="true"></i> Fax:</div>
                            <div class="dtls"><?php echo $ConfigSettings['FAX']; ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($ConfigSettings['CONTACT_EMAIL']) && (trim($ConfigSettings['CONTACT_EMAIL'] != ""))): ?>
                        <div class="contact-dtl">
                            <div class="dtl-name"><i class="fa fa-envelope" aria-hidden="true"></i> Email:</div>
                            <div class="dtls"><a href="mailto:<?php echo $ConfigSettings['CONTACT_EMAIL']; ?>"><u><?php echo $ConfigSettings['CONTACT_EMAIL']; ?></u></a></div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($ConfigSettings['CONTACT_WEBSITE']) && (trim($ConfigSettings['CONTACT_WEBSITE'] != ""))): ?>
                        <div class="contact-dtl">
                            <div class="dtl-name"><i class="fa fa-eye" aria-hidden="true"></i> Web URL:</div>
                            <div class="dtls"><a href="<?php echo $ConfigSettings['CONTACT_WEBSITE']; ?>" target='_blank'><u><?php echo $ConfigSettings['CONTACT_WEBSITE']; ?></u></a></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-group button-row full">
            <?= $this->Form->submit('Submit', ['class' => 'button-green', 'escape' => false]); ?>
        </div>
        <?= $this->Form->end(); ?>

        <div class="clear"></div>
        <div class="map-bx-contact">
            <div id="map" style="width: 100%;height: 350px;"></div>
        </div>
    </div>
</div>

<?php
$lat = isset($ConfigSettings['LATITUDE']) ? $ConfigSettings['LATITUDE'] : 37.0902;
$lng = isset($ConfigSettings['LONGITUDE']) ? $ConfigSettings['LONGITUDE'] : 37.0902;
?>
<?php $this->Html->script(['https://maps.googleapis.com/maps/api/js?key=' . $ConfigSettings['GOOGLE_MAP_KEY']], ['block' => true]); ?>
<?php $this->Html->scriptStart(['block' => true]); ?>

/** This section is for google map */
$(document).ready(function () {
    var lat = parseFloat(<?= $lat ?>);
    var lng = parseFloat(<?= $lng ?>);
    show_map('map', lat, lng);
});

/** used for map on contact us page and on villa detail page*/
function show_map(div_id, lat, lng, contentString) {
    map = new google.maps.Map(document.getElementById(div_id), {
        center: {lat: lat, lng: lng},
        zoom: 11,
        mapTypeId: 'roadmap'
    });

    var marker = new google.maps.Marker({
        map: map,
        position: {lat: lat, lng: lng},
        draggable: false
    });

    if (contentString) {
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
    }
}

<?php $this->Html->scriptEnd(); ?> 