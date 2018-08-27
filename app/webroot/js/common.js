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
});

