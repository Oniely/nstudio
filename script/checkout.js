$('#showProducts').on('click', function () {
    $('#arrow').toggleClass('rotate-180');
    $('#products').toggleClass('max-h-[100vh] max-h-0');
    if ($('#products').hasClass('max-h-[100vh]')) {
        $(window).scrollTop(0);
    }
});
// FIX BUG: when scrolling the arrow this function triggers
$(window).on('resize', function () {
    if (window.innerWidth < 768) {
        $('#arrow').removeClass('hidden')
        $('#arrow').addClass('flex')
        $('#arrow').addClass('rotate-180');

        $('#products').addClass('max-h-0');
        $('#products').removeClass('max-h-[100vh]');
    }

    if (window.innerWidth >= 768) {
        $('#arrow').addClass('hidden')
        $('#products').addClass('max-h-[100vh]');
        $('#arrow').removeClass('rotate-180');

        $('#products').removeClass('max-h-0');
        $('#products').addClass('max-h-[100vh]');
    }
});