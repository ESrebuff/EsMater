class ShowBooked {
    constructor(booked, backgroundn, section) {
        this.booked = booked;
        this.backgroundn = backgroundn;
        this.section = section;
        this.show();
    }

    show() {
        let booked = this.booked;
        let backgroundn = this.backgroundn;
        let section = this.section;
        $(booked).click(function (e) {
            e.preventDefault(); // block the default action
            if ($(backgroundn).hasClass('hide') == true) {
                $(backgroundn).removeClass('hide');
                $(section).removeClass('hide');
            } else {
                $(backgroundn).addClass('hide');
                $(section).addClass('hide');
            }
        });
    }
}