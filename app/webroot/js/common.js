$(function() {
    // populateSidebarFolder();


    let url = $('#url').val();
    // HEADER TOGGLE MENU
    $('.arrow-down').click(function() {
        $('.toggle-menu').slideToggle();
    });

    // Datepicker
    $('.datepicker').datepicker();

    // Toggle Modal
    $('.search-item').click(function() {
        $('#showModal').fadeIn(300);
    });

    $('.button-close').click(function() {
        $('#showModal').fadeOut(300);
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
    const addInput = `<input type="text" class="sidebar-input" value="New Folder" autofocus>`;
    let clickedFolder;
    let clickedFolderText = '';

    $('html').delegate('.sidebar-text', 'mousedown', function(e) {
        if(e.which == 3) {
            clickedFolder = $(this);
            $('.sidebar-text').find('.tooltip').remove();
            let tooltipPosition = $(this).offset().top + 25;
            let positionOfModal;
            clickedFolderText = clickedFolder.text();
            tooltipPosition >= 550 ? positionOfModal = tooltipPosition - 117 : positionOfModal = tooltipPosition;
            $(this).append(tooltip);

            $('.tooltip').css({
                top: positionOfModal + 'px'
            });
            return false;
        }
    });

    let folder_path = '';
    $('html').delegate('#create','click', function() {
        folder_path = $(this).parent().parent().parent().parent().data('id');
        $('.sidebar-item, .sidebar-item-sub').find('.tooltip').remove();
        $('.sidebar-input').remove();
        $('.sidebar-input').focus();
        clickedFolder.parent().append(addInput);
        $('.sidebar-input').focus();
    })

    $('html').delegate('#delete', 'click', function() {
        clickedFolder.parent().remove();
    });

    $('html').delegate('#rename', 'click', function() {
        $('.sidebar-item, .sidebar-item-sub').find('.tooltip').remove();
        let inputRenameTextBox = '<input type="text" class="sidebar-input-rename" value="'+ clickedFolderText + '" autofocus style="margin-left: 0">'
        clickedFolder.text('').append(inputRenameTextBox);
        clickedFolder.parent().find('.sidebar-input-rename').focus();
    });

    $('html').on('keyup','.sidebar-text[contentEditable]',function(e) {
        if( e.keyCode == 13 ) {
            $(this).attr('contentEditable',false);
        }
    });
    
    $('html').on('keyup','.sidebar-input', function(e) {
        if ( e.keyCode == 13 ) {
            let inputValue = '';
            if ( $(this).val().length > 1 ) {
                inputValue = $(this).val();
                $(this).parent().append('<div class="sidebar-item-sub" data-id="'+folder_path+'/'+inputValue+'"><i class="fa icon-folder-close sidebar-folder-icon"></i><div class="sidebar-text">'+ inputValue +'</div></div>');
                $(this).remove();
            } else {
                inputValue = 'New Folder';
                $(this).parent().append('<div class="sidebar-item-sub" data-id="'+folder_path+'/'+inputValue+'"><i class="fa icon-folder-close sidebar-folder-icon"></i><div class="sidebar-text">'+ inputValue +'</div></div>');
                $(this).remove();
            }
            add_folder(folder_path+'/'+inputValue, url);
        }
    });

    // RENAME INPUT TEXTBOX
    $('html').on('keyup','.sidebar-input-rename', function(e) {
        if ( e.keyCode == 13 ) {
            if ( $(this).val().length > 1 ) {
                let inputValue = $(this).val();
                $(this).parent().append(inputValue);
                $(this).val('').remove();
                
            } else {
                let inputValue = 'New Folder';
                $(this).parent().append(inputValue);
                $(this).val('').remove();
            }
        }
    });


    //add new main folder
    $('.sidebar-add').click(function(){
        let createMainFolder = `
            <div class="sidebar-list-main">
                <div class="sidebar-item" data-id="New Folder">
                    <i class="fa icon-folder-close sidebar-folder-icon"></i>
                    <div class="sidebar-text">New Folder</div>
                </div>
            </div>
        `;

        $('.sidebar-treeview-wrapper').append(createMainFolder);
        //save folder
        add_folder('New Folder', url);
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


function add_folder(name, url, location = '') {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url+"locations/add",
        data: {name},
        success: function(response) {

        }

    })
}

function populateSidebarFolder() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../files/sidebar_folder.json",
        success: function(response) {
            response['Folders'].forEach((value,key) => {
                console.log(value['childFolder'])
                $('.sidebar-treeview-wrapper').append(
                    `<div class="sidebar-list-main">
                        <div class="sidebar-item">
                            <i class="fa icon-folder-close sidebar-folder-icon"></i>
                            <div class="sidebar-text">` + value['name'] + `</div>
                        </div>
                        <div class="sidebar-item-sub">
                            <i class="fa icon-folder-close sidebar-folder-icon"></i>
                            <div class="sidebar-text">` + value['childFolder'][key]['name'] + `</div>
                        </div>
                    </div>`
                )
            });
        }
    })
}