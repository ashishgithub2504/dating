$(document).ready(function() { 
	// Image Manager
	$(document).on('click', 'a[data-toggle=\'image\']', function(e) {
            var $element =  $(this);
            var $popover =  $element.data('bs.popover'); // element has bs popover?
            var url      =  $element.attr('data-url');
            var imageBoxId  =   $element.closest('.imageBox').attr('id');
            e.preventDefault();
            // destroy all image popovers
            $('a[data-toggle="image"]').popover('destroy');

            // remove flickering (do not re-add popover when clicking for removal)
            if ($popover) {
                    return;
            }

            $element.popover({
                html: true,
                placement: 'right',
                trigger: 'manual',
                content: function() {
                        return '<button type="button" id="button-image-'+imageBoxId+'" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear-'+imageBoxId+'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
                }
            });
            $element.popover('show');
            
            $("[id^=button-image-]").on('click', function() {
                var $button = $(this);
            var $icon = $button.find('> i');
            $('#manuModal .modal-dialog').addClass('modal-lg');
            $('#manuModal .modal-body').html('Loading....');
            $('#manuModal h4.modal-title').html('Gallery Manager');
            $('#manuModal .modal-footer').remove();
            $.ajax({
                url: url,
                data: {imageBoxId: imageBoxId},
                dataType: 'html',
                beforeSend: function() {
                    $button.prop('disabled', true);
                    if ($icon.length) {
                        $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
                    }
                },
                complete: function() {
                    $button.prop('disabled', false);
                    if ($icon.length) {
                        $icon.attr('class', 'fa fa-pencil');
                    }
                },
                success: function(responce) {
                    $("div#manuModal").find(".modal-body").html(responce);
                }
            });
            $('#manuModal').modal('show');
            $element.popover('destroy');
            });
            
            $("[id^=button-clear-]").on('click', function() {
                    $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

                    $element.parent().find('input').val('');

                    $element.popover('destroy');
            });
	});
});
 