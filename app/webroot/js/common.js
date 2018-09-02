$(function() {

    // HEADER TOGGLE MENU
    $('.arrow-down').click(function() {
        $('.toggle-menu').slideToggle();
    });

    // Datepicker
    $('.datepicker').datepicker();

    // Toggle Modal
    $('.search-item').click(function() {
        $('#showModal').addClass('modalShow');
    });

    $('.button-close').click(function() {
        $('#showModal').removeClass('modalShow');
    });

    // Datatable
    $('#activity-table').dataTable({
        "lengthMenu": [ 10, 50, 100 ],
        "lengthChange": true,
        "searching": false,
        "info": true,
        "iDisplayLength":10,
        'pagingType': 'full_numbers',
    });

    // Image Upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                let imageType = input.files[0]['type'];
                if ( imageType == 'image/jpeg' || imageType == 'image/png' ) {
                    $('.js-file-name').val(input.files[0]['name']);
                    $('.js-error-image').hide().text('')
                } else {
                    $('.js-file-name').val('');
                    $('.js-upload-image').val('')
                    $('.js-error-image').show().text('uploaded file type is invalid')
                }
            }
            reader.readAsDataURL(input.files[0]);
         }
    }

    $(".js-upload-image").change(function(){
        readURL(this);
    });
});

