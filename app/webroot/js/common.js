$(function() {
    document.getElementById("folders").innerHTML= populateSidebarFolder(folders);

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
        $('.sidebar-item').find('.tooltip').remove();
        $('.sidebar-input').remove();
        $('.sidebar-input').focus();
        clickedFolder.parent().append(addInput);
        $('.sidebar-input').focus();
    })

    $('html').delegate('#delete', 'click', function() {
        clickedFolder.parent().remove();
    });

    $('html').delegate('#rename', 'click', function() {
        $('.sidebar-item').find('.tooltip').remove();
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
    var inside = $(".sidebar-item");
    if ($.trim(target) != '') {
        if ($("." + target) != inside) {
            $('.sidebar-item').find('.tooltip').remove();
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


const folders = {
  id: '1',
  name: 'Main Folder',
  children: [
    {
      id: '2',
      name: 'child1'
    },
    {
      id: '3',
      name: 'child2',
      children: [
        {
          id: '4',
          name: 'child1'
        },
        {
          id: '5',
          name: 'child2'
        },
        {
          id: '6',
          name: 'child3'
        },
        {
          id: '7',
          name: 'child4',
          children: [
            {
              id: '8',
              name: 'child1'
            },
            {
              id: '9',
              name: 'child2'
            }
          ]
        }
      ]
    },
    {
      id: '10',
      name: 'child4',
      children: [
        {
          id: '11',
          name: 'child1'
        },
        {
          id: '12',
          name: 'child2'
        }
      ]
    }
  ]
};

function populateSidebarFolder( data ) {
    var htmlRetStr = "<div class='sidebar-list-main'>";
    for (var key in data) {
        if (typeof(data[key])== 'object' && data[key] != null) {
            htmlRetStr += populateSidebarFolder( data[key] );
            htmlRetStr += '</div>';
        } else {
            htmlRetStr = `
            <div class='sidebar-item'>
                <i class='fa icon-folder-close sidebar-folder-icon'></i>
                <div class='sidebar-text'>` + data["name"]+ `
            </div>`;
        }
    }   
    return( htmlRetStr );
}
