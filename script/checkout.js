$('#showProducts').on('click', function () {
    $('#arrow').toggleClass('rotate-180');
    $('#products').toggleClass('max-h-[100vh] max-h-0');
    if ($('#products').hasClass('max-h-[100vh]')) {
        $(window).scrollTop(0);
    }
});
// FIX BUG: when scrolling the arrow this function triggers