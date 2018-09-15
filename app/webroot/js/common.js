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
        $('body').css('overflow','hidden');
    });

    $('.button-close').click(function() {
        $('#showModal').removeClass('modalShow');
        $('body').css('overflow','auto');
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

    $(".js-upload-image").change(function() {
        readURL(this);
    });


    // Sidebar treeview
    const tooltip = `<div class="tooltip">
                        <div class="tooltip-text">
                            <span id="create">Create New Folder</span>
                            <span id="rename">Rename</span>
                            <span id="delete">Delete</span>
                        </div>
                    </div>`;
    const addInput = `<input type="text" class="sidebar-input" autofocus>`;
    let clickedFolder = '';
    
    $('.sidebar-item, .sidebar-item-sub').bind("contextmenu",function(e) {
        $('.sidebar-item, .sidebar-item-sub').find('.tooltip').remove();
        let tooltipPosition = $(this).offset().top + 25;
        $(this).append(tooltip);
        clickedFolder = $(this);
        $('.tooltip').css({
            top: tooltipPosition + 'px'
        });
        return false;
    });

    $('html').delegate('#create','click', function() {
        $('.sidebar-item, .sidebar-item-sub').find('.tooltip').remove();
        $('.sidebar-input').remove();
        $('.sidebar-input').focus();
        clickedFolder.append(addInput);
    })

    $('html').delegate('#delete', 'click', function() {
        clickedFolder.parent().remove();
    });
});


$(document).click(function(evt) {
    var target = evt.target.className;
    var inside = $(".sidebar-item, .sidebar-item-sub");
    if ($.trim(target) != '') {
        if ($("." + target) != inside) {
            $('.sidebar-item, .sidebar-item-sub').find('.tooltip').remove();
        }
    }
});