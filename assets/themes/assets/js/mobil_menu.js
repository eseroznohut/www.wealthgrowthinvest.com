$(function () {
    var open = false;
    $(".header__navbar-toggler").click(function () {
        if (open == false) {
            $(".header__navigation").css({ "display": "block" });
            open = true;
        } else {
            $(".header__navigation").css({ "display": "none" });
            open = false;
        }

    });


    //$(".menu1").hover(function () {
    //    $(this).find(".sub-menu").css({ "display":"block" });
    //}, function () {
    //    $(this).find(".sub-menu").css({ "display": "none" });
    //});
});