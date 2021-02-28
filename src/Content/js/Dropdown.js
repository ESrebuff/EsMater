class Dropdown {
    constructor(section, formTarget, dropDown, time) {
        this.section = section;
        this.formTarget = formTarget;
        this.dropDown = dropDown;
        this.time = time;
        this.show();
    }

    show() {
        let section = this.section;
        let formTarget = this.formTarget;
        let dropDown = this.dropDown;
        let time = this.time;
        $(section).click(function (e) {
            e.preventDefault(); // block the default action
            if ($(formTarget).hasClass('hide') == true) {
                $(dropDown).animate({
                    height: '350px'
                }, time);
                $(formTarget).removeClass('hide');
            } else {
                $(dropDown).animate({
                    height: '90px'
                });
                $(formTarget).addClass('hide');
            }

        });
    }
}