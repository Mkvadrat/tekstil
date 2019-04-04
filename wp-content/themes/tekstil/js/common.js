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
        items:2,
        stagePadding: 300,
        margin: 7,
        navText: ["<img src='/wp-content/themes/tekstil/images/prev.png'>","<img src='/wp-content/themes/tekstil/images/next.png'>"],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                stagePadding: 0,
                margin: 0
            },
            600:{
                items:2,
                stagePadding: 0,
                margin: 7
            },
            1400:{
                items:2,
                stagePadding: 300,
                margin: 7
            }
        }
    });
});

        

