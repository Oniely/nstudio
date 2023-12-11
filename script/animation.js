let preloader = document.querySelector('.preloader');

window.addEventListener('load', () => {
    $('.preloader').fadeOut();
    $('.fadeIn').addClass('animate__fadeIn');
    $('.fadeUp').addClass('animate__fadeInUp');
});