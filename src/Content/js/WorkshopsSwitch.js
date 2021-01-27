class WorkshopsSwitch {
    constructor(workshopsItem, workshopsComm) {
        this.workshopsItem = workshopsItem;
        this.workshopsComm = workshopsComm;
        this.show();
    }

    show() {
        let workshop = this.workshopsItem;
        let workshopsComm = this.workshopsComm;
        $(workshop).click(function (e) {
            e.preventDefault(); // block the default action
            if ($(workshopsComm).hasClass('hide') == true) {
                $('.workshop-comm1').addClass('hide');
                $('.workshop-comm2').addClass('hide');
                $('.workshop-comm3').addClass('hide');
                $('.workshop-comm4').addClass('hide');

                $('.workshops-item1').removeClass('main-yellow');
                $('.workshops-item2').removeClass('main-yellow');
                $('.workshops-item3').removeClass('main-yellow');
                $('.workshops-item4').removeClass('main-yellow');

                $(workshopsComm).removeClass('hide');
                $(workshop).addClass('main-yellow');
            }
        });
    }
}