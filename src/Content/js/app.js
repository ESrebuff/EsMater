$(function () {
    new DeleteAjax(".delete-comment", ".msgId");
    new DeleteAjax(".delete-post", ".postId");
    new DeleteAjax(".workshop-unsubscribe", ".subscribeId");


    new WorkshopsSwitch(".workshops-item1", ".workshop-comm1");
    new WorkshopsSwitch(".workshops-item2", ".workshop-comm2");
    new WorkshopsSwitch(".workshops-item3", ".workshop-comm3");
    new WorkshopsSwitch(".workshops-item4", ".workshop-comm4");

    new Dropdown(".avatar-edit", ".avatar-edit-form", ".first-dropdown-account", 200);
    new Dropdown(".password-edit", ".password-edit-form", ".second-dropdown-account", 250);

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
    $(window).click(function (e) {
        $(".flash-message").fadeOut(150);
    });


    $("#password-register").on("input", function () {
        //Si la valeur n'est pas vide
        if ($(this).val() != "") {
            let size = $("#size-mdp");
            size.children().remove();
            let maj = $("#maj-mdp");
            maj.children().remove();
            let number = $("#number-mdp");
            number.children().remove();
            //Vérifie qu'il y a au moins 8 caractères
            if (/^(.{8,})/.test($(this).val())) {
                size.addClass('alert-success');
                size.removeClass('alert-danger');
            } else {
                size.addClass('alert-danger');
                size.removeClass('alert-success');
            }
            //Vérification de la majuscule
            if (/^(?=.*[A-Z])/.test($(this).val())) {
                maj.addClass('alert-success');
                maj.removeClass('alert-danger');
            } else {
                maj.addClass('alert-danger');
                maj.removeClass('alert-success');
            }
            //Vérification du chiffre
            if (/^(?=.*\d)/.test($(this).val())) {
                number.addClass('alert-success');
                number.removeClass('alert-danger');
            } else {
                number.addClass('alert-danger');
                number.removeClass('alert-success');
            }
        }
    });

    let date = new Date().getFullYear();
    $(".date-copyright").html(date);
    
    tinymce.init({
        selector: '#mytextarea'
    });   
});
