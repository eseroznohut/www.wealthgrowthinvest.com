var menuDurum;
$(function () {

    //setTimeout(function () {
    //    //$(".header__logo img").css({"width":"125px"});
    //}, 300);
    mobilKontrol();


    menuDurum = false;
    $(".btn-mobil-menu").click(function () {
        if (menuDurum) {
            $("nav").css({ "display": "none" });
            menuDurum = false;
        } else {
           
            $("nav").css({ "display": "block" });
            menuDurum = true;
        }
    });

});

$(window).resize(function () {
    mobilKontrol();
});


function mobilKontrol() {

    $(".slogan").appendTo(".header__logo");
    $("#menu-top-menu").appendTo(".header__navigation");


    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (width <= 1200) {      
        $(".ceo_img").prependTo(".ceo_content");
        $(".slogan").appendTo(".top"); 
    }

    if (width < 992) {
        $("#menu-top-menu").appendTo(".top-iletisim");
        $(".slogan").appendTo(".header > .container");
    }

    if (width < 615) {
        $(".slogan").appendTo(".top");
    } 

    if (width < 376) {
        
    }



    console.clear();
    console.log(window.innerWidth + " " + screen.width);
}




