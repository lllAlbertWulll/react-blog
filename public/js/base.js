$(document).ready(function () {
    $('img').lazyload();
    $('.opensearch').on('click', function (e) {
        if ($('.search-form').hasClass('is-active')) {
            $(".search-form").removeClass('is-active');
        } else {
            $('.search-form').addClass('is-active');
        }
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 1000);
        return false;
    });
});