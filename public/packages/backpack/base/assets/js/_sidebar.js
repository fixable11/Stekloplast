(function () {
    let navSubmenu = $('.navSubmenu');
    let chevron = navSubmenu.find('.chevron');

    if(navSubmenu.find('.open').length !== 0) {
        navSubmenu.find('ul').show();
        changeChevronClass();
    }

    navSubmenu.find('div').on('click', function () {
        navSubmenu.find('ul').slideToggle(250, function(e) {
            changeChevronClass();
        });
    });

    function changeChevronClass() {
        let chevronDownClass = 'fa-chevron-down';
        let chevronRightClass = 'fa-chevron-right';

        if (chevron.hasClass(chevronRightClass)) {
            chevron.removeClass(chevronRightClass).addClass(chevronDownClass);
        } else {
            chevron.removeClass(chevronDownClass).addClass(chevronRightClass);
        }
    }
})();



