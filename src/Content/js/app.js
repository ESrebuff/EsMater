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
    
    new ShowBooked(".show-workshop-registration", ".workshop-registratio-background", ".section-workshop-registration");
    new ShowBooked(".hide-workshop", ".workshop-registratio-background", ".section-workshop-registration");
    new ShowBooked(".show-workshops-registrations", ".workshop-registratio-background", ".section-workshops-registrations");
    new ShowBooked(".hide-workshops", ".workshop-registratio-background", ".section-workshops-registrations");
    
    
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
    
    tinymce.init({
            selector: '#mytextarea'
        });
    
    
    
});