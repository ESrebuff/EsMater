$(function () {
    // Delete comment
    let deleteComments = $(".delete-comment");
    for (let i = 0; i < deleteComments.length; i++) {
        let deleteComment = deleteComments[i];
        deleteComment.addEventListener('click', function (e) {
            e.preventDefault(); // block the default action
            url = deleteComment.getAttribute('href');
            deleteComment.innerHTML = "Chargement...";
            $.ajax({
                url: url,
                type: 'GET',
                success: function (datas) {
                    let response = datas;
                    $(".msgId" + response).remove();
                },

                error: function (jqXHR) {
                    alert(jqXHR.responseText);
                }
            });
        })
    }

    // Scrolling Effect
    $(window).on("scroll", function (e) {
        if ($(window).scrollTop()) {
            $('.main-nav').addClass('black');
            $('.main-nav ul li a').addClass('white');
        } else {
            $('.main-nav').removeClass('black');
            $('.main-nav ul li a').removeClass('white');
        }
    });

    // Open responsive menu when is cliked
    $(document).ready(function () {
        $(".menu-icon").on("click", function () {
            $(".main-nav ul").toggleClass("showing");
        });
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".nav-link").click(function () {
        $(".main-nav ul").toggleClass("showing");
    });

    // Delete FlashMessage
    $(".close-message").click(function (e) {
        e.preventDefault(); // block the default action
        $(".flash-message").fadeOut(150);
    });
    
    
    $(".workshops-item1").click(function (e) {
        e.preventDefault(); // block the default action
        $('.workshop-comm1').removeClass('hide');
        $('.workshop-comm2').addClass('hide');
        $('.workshop-comm3').addClass('hide');
        $('.workshop-comm4').addClass('hide');
        
        $('.workshops-item1').addClass('main-yellow');
        $('.workshops-item2').removeClass('main-yellow');
        $('.workshops-item3').removeClass('main-yellow');
        $('.workshops-item4').removeClass('main-yellow');
    });
    
    $(".workshops-item2").click(function (e) {
        e.preventDefault(); // block the default action
        $('.workshop-comm1').addClass('hide');
        $('.workshop-comm2').removeClass('hide');
        $('.workshop-comm3').addClass('hide');
        $('.workshop-comm4').addClass('hide');
        
        $('.workshops-item1').removeClass('main-yellow');
        $('.workshops-item2').addClass('main-yellow');
        $('.workshops-item3').removeClass('main-yellow');
        $('.workshops-item4').removeClass('main-yellow');
    });
    
    $(".workshops-item3").click(function (e) {
        e.preventDefault(); // block the default action
        $('.workshop-comm1').addClass('hide');
        $('.workshop-comm2').addClass('hide');
        $('.workshop-comm3').removeClass('hide');
        $('.workshop-comm4').addClass('hide');
        
        $('.workshops-item1').removeClass('main-yellow');
        $('.workshops-item2').removeClass('main-yellow');
        $('.workshops-item3').addClass('main-yellow');
        $('.workshops-item4').removeClass('main-yellow');
    });
    
    $(".workshops-item4").click(function (e) {
        e.preventDefault(); // block the default action
        $('.workshop-comm1').addClass('hide');
        $('.workshop-comm2').addClass('hide');
        $('.workshop-comm3').addClass('hide');
        $('.workshop-comm4').removeClass('hide');
        
        $('.workshops-item1').removeClass('main-yellow');
        $('.workshops-item2').removeClass('main-yellow');
        $('.workshops-item3').removeClass('main-yellow');
        $('.workshops-item4').addClass('main-yellow');
    });
    
    $(".avatar-edit").click(function (e) {
        e.preventDefault(); // block the default action
        if ($('.avatar-edit-form').hasClass('hide') == true) {
            $('.first-dropdown-account').animate({height: '250px'}, 200);
            $('.avatar-edit-form').removeClass('hide');
        } else {
            $('.first-dropdown-account').animate({height: '90px'});
            $('.avatar-edit-form').addClass('hide');
        }

    });

    $(".password-edit").click(function (e) {
        e.preventDefault(); // block the default action
        if ($('.password-edit-form').hasClass('hide') == true) {
            $('.second-dropdown-account').animate({height: '250px'}, 250);
            $('.password-edit-form').removeClass('hide');
        } else {
            $('.second-dropdown-account').animate({height: '90px'});
            $('.password-edit-form').addClass('hide');
        }

    });
    
});










