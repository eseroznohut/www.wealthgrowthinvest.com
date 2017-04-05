$(function () {
    ShineLogo();
    $("footer").animate({ "opacity": 1 }, 500, function () {
    });
   
});

function anasayfaOpacity() {
    return $(".jumbotron").animate({ "opacity": 1 }, 500, function () {
        $(".parallax").animate({ "opacity": 1 }, 500, function () {

        });
    });
}

function altsayfaOpacity() {
    return $("#primary").animate({ opacity: 1 }, 600);
}

function breadcrumbsOpacity() {
    return $(".breadcrumbs").animate({ opacity: 1 }, 600);
}

function ShineLogo() {

    var items = $(".header__logo");
    var shiners = [];
    var idx = 0;
    var max = items.length;
    var active = 0;

    function getShiner() {
        var jthis = $(this);
        jthis.attr("id", idx++);
        shiners.push(jthis.find(".peShiner").peShiner({ api: true, paused: true, reverse: true, repeat: 1 }));
    }

    items.each(getShiner);
    idx = active = parseInt(items.attr("id"), 10);
    return shiners[idx].resume();

}


//destroy: function() {
//    this._destroy(); //or this.delete; depends on jQuery version
//    this.element.unbind( this.eventNamespace )
//    this.bindings.unbind( this.eventNamespace );
//    //this.hoverable.removeClass( "hover state" );
//    //this.focusable.removeClass( "focus state" );
//}


//$(window).scroll(function () {
//    var windscroll = $(window).scrollTop();
//    if (windscroll >= 1) {
//        $('header').addClass('fixed-header');
//        $(".top").css({ "display": "none" });
//        $(".header__logo, .peShiner, .header__logo > canvas, .header__logo > img").css({ "width": "140px", "height": "97px" });

//    } else {

//        $('nav').removeClass('fixed-header');
//        $(".top").css({ "display": "block" });
//    }

//}).scroll();