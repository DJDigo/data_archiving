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
});

