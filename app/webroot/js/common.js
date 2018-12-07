$(function() {
    let url = $('#url').val();
    // HEADER TOGGLE MENU
    $('.arrow-down').click(function() {
        $('.toggle-menu').slideToggle();
    });

    // Datepicker
    $('.datepicker').datepicker();

    // Toggle Modal
    $('.button-view').click(function() {
        let id = $(this).attr('id');
        $('#showModal-'+id).fadeIn(300);
    });

    $('.button-close').click(function() {
        let id = $(this).attr('id');
        $('#showModal-'+id).fadeOut(300);
    });

    $('.button-print').click(function() {
        $('.modal-image').print();
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
                    $('.js-image-uploaded').attr('src', e.target.result);
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
            let tooltipPosition = 25;
            let getHeight = $(this).offset().top;
            let positionOfModal;
            clickedFolderText = clickedFolder.text();
            getHeight >= 485 ? positionOfModal = getHeight - 117 : positionOfModal = tooltipPosition;
            $(this).append(tooltip);

            $('.tooltip').css({
                top: positionOfModal + 'px'
            });
            return false;
        }
    });

    let folder_path = '';
    $('html').delegate('#create','click', function() {
        folder_path = $(this).parent().parent().parent().parent().attr('data-id');
        $('.sidebar-item, .sidebar-item-sub').find('.tooltip').remove();
        $('.sidebar-input').remove();
        $('.sidebar-input').focus();
        clickedFolder.parent().append(addInput);
        $('.sidebar-input').focus();
    })

    $('html').delegate('#delete', 'click', function() {
        folder_path = $(this).parent().parent().parent().parent().attr('data-id');
        delete_folder(folder_path, url);
        clickedFolder.parent().remove();
    });

    $('html').delegate('#rename', 'click', function() {
        folder_path = $(this).parent().parent().parent().parent().attr('data-id');
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
                $(this).parent().append('<div class="sidebar-item" data-id="'+folder_path+'/'+inputValue+'"><i class="fa icon-folder-close sidebar-folder-icon"></i><div class="sidebar-text">'+ inputValue +'</div></div>');
                $(this).remove();
            } else {
                inputValue = 'New Folder';
                $(this).parent().append('<div class="sidebar-item" data-id="'+folder_path+'/'+inputValue+'"><i class="fa icon-folder-close sidebar-folder-icon"></i><div class="sidebar-text">'+ inputValue +'</div></div>');
                $(this).remove();
            }
            add_folder(folder_path+'/'+inputValue, url);
        }
    });

    // RENAME INPUT TEXTBOX
    $('html').on('keyup','.sidebar-input-rename', function(e) {
        folder_path = $(this).parent().parent().attr('data-id');
        if ( e.keyCode == 13 ) {
            let inputValue = '';
            let folder     = folder_path.split('/');

            if ( $(this).val().length > 1 ) {
                inputValue = $(this).val();
                $(this).parent().append(inputValue);
                if (folder.length > 1) {
                    folder[folder.length - 1] = inputValue;
                    if (folder.length == 1) {
                        folder = folder[0];                    
                    }
                    inputValue = folder.join('/');
                }
                $(this).parent().parent().attr('data-id', inputValue);
                $(this).remove(); 
            } else {
                inputValue = 'New Folder';
                $(this).parent().append(inputValue);
                $(this).val('').remove();
            }
            edit_folder(folder_path, inputValue, url);
        }
    });

    let countMainFolder = 0;
    $('.sidebar-add').click(function() {
        if ( $('#folders > .sidebar-list-main > .sidebar-item').length == 0 ) {
            countMainFolder = '';
            validateCreateMainFolder(countMainFolder, url);
            countMainFolder = 1;
        } else {
            countMainFolder = +$('#folders > .sidebar-list-main > .sidebar-item').length + 1;
            validateCreateMainFolder(countMainFolder, url);
        }
    });
    /**
    * Index get current folders 
    */
     $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url + "locations/index",
        success: function (response) {
            document.getElementById("folders").innerHTML= populateSidebarFolder(response, url);
        }
     });
});

function validateCreateMainFolder(value,url) {
    let createMainFolder = `
        <div class="sidebar-list-main">
            <div class="sidebar-item" data-id="">
                <i class="fa icon-folder-close sidebar-folder-icon"></i>
                <div class="sidebar-text">New Folder`+ value +`</div>
            </div>
        </div>
    `;
    add_folder('New Folder'+value+'' , url);
}

$(document).click(function(evt) {
    var target = evt.target.className;
    var inside = $(".sidebar-item");
    if ($.trim(target) != '') {
        if ($("." + target) != inside) {
            $('.sidebar-item').find('.tooltip').remove();
        }
    }
});

function add_folder(name, url) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url+"locations/add",
        data: {name},
        success: function(response) {
            document.getElementById("folders").innerHTML= '';
            document.getElementById("folders").innerHTML= populateSidebarFolder(response, url);
        }
    })
}

function edit_folder(before, new_name, url) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url+"locations/edit",
        data: {before, new_name},
        success: function(response) {
            document.getElementById("folders").innerHTML= '';
            document.getElementById("folders").innerHTML= populateSidebarFolder(response, url);
        }
    })
}

function delete_folder(name, url) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url+"locations/delete",
        data: {name},
        success: function(response) {
            document.getElementById("folders").innerHTML= '';
            document.getElementById("folders").innerHTML= populateSidebarFolder(response, url);
        }
    })
}

function populateSidebarFolder(data, url) {
    console.log(url);
    var htmlRetStr = "<div class='sidebar-list-main'>";
    for (var key in data) {
        if (typeof(data[key])== 'object' && data[key] != null) {
            htmlRetStr += populateSidebarFolder( data[key], url );
            htmlRetStr += '</div>';
        } else {
            htmlRetStr = `
            <div class='sidebar-item' data-id="`+ data["id"]+ `">
                <i class='fa icon-folder-close sidebar-folder-icon' href="`+url+`archives/search?location_id=`+data['location_id']+`"></i>
                <div class='sidebar-text' onclick=search("`+url+`archives/search?location_id=`+data['location_id']+`")>` + data["name"]+ `
            </div>`;
        }
    }   
    return( htmlRetStr );
    
}

function search(url) {
    window.location.href = url;
}