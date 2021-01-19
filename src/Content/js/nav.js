    // Scrolling Effect
    $(window).on("scroll", function (e) {
            let scrollTop = $(this).scrollTop() + ($(window).height() / 2);
            if (scrollTop > $('#contact').offset().top) {
                $('.to-contact-section').addClass('main-yellow');
            } else {
                $('.to-contact-section').removeClass('main-yellow');
            }
    });