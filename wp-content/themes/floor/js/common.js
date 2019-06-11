$(document).ready(function () {
    $('.smeta-link').bind("click", function (e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 1000);
        e.preventDefault();
    });
        
    $('.anchor').bind("click", function (e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 1000);
        e.preventDefault();
    });
   
    $(".owl-carousel").owlCarousel({
        nav: true,
        loop: true,
        dots: false,
        items: 2,
        stagePadding: 300,
        margin: 7,
        navText: ["<img src='/wp-content/themes/tekstil/images/prev.png'>","<img src='/wp-content/themes/tekstil/images/next.png'>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                stagePadding: 0,
                margin: 0
            },
            600: {
                items: 2,
                stagePadding: 0,
                margin: 7
            },
            1400: {
                items: 2,
                stagePadding: 300,
                margin: 7
            }
        }
    });
    
    $('.wpcf7-submit').attr('disabled', 'disabled');
    
    $('#confirmation-1').on('change', function () {
        if ($(this).is(':checked')) {
            $('.agree-1').removeAttr('disabled');
        } else {
            $('.agree-1').attr('disabled', 'disabled');
        }
    });
    
    $('#confirmation-2').on('change', function () {
        if ($(this).is(':checked')) {
            $('.agree-2').removeAttr('disabled');
        } else {
            $('.agree-2').attr('disabled', 'disabled');
        }
    });
    
    $('#confirmation-3').on('change', function () {
        if ($(this).is(':checked')) {
            $('.agree-3').removeAttr('disabled');
        } else {
            $('.agree-3').attr('disabled', 'disabled');
        }
    });
});