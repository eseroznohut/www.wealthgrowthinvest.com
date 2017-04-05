$(function () {




    $("#languagebox").select2({
        minimumResultsForSearch: -1,
        templateResult: function (state) {
            if (!state.id) { return state.text; }
            var $state = $('<span><img alt="WGI" width="16" src="../../uploads/images/language/' + $("#" + state.element.id).attr("data-flag") + '" class="img-flag" /></span>');
            return $state;
        },
        templateSelection: function (data, container) {
            return $('<span><img alt="WGI" width="16" src="../../uploads/images/language/' + $("#languagebox option:selected").attr("data-flag") + '" class="img-flag" /></span>');
        }
    });



    $(".btnMesajGonder").click(function () {
        if ($(this).attr("data-id") == "iletisim") {
            if ($('#contact-form').parsley().validate()) {
                var ad = $("#ad").val();
                var eposta = $("#eposta").val();
                var konu = $("#konu").val();
                var telefon = $("#telefon").val();
                var mesaj = $("#mesaj").val();
                MesajGonder(ad, eposta, konu, mesaj, $("#contact-form-message"), telefon);

                $("#ad").val("");
                $("#eposta").val("");
                $("#konu").val("");
                $("#mesaj").val("");
                $("#telefon").val("");
            }

        } else {
            if ($('#footer-contact-form').parsley().validate()) {
                var ad = $("#footer-ad").val();
                var eposta = $("#footer-eposta").val();
                var telefon = $("#footer-telefon").val();
                var konu = $("#footer-konu").val();
                var mesaj = $("#footer-mesaj").val();
                MesajGonder(ad, eposta, konu, mesaj, $("#footer-contact-form-message"), telefon);

                $("#footer-ad").val("");
                $("#footer-eposta").val("");
                $("#footer-telefon").val("");
                $("#footer-konu").val("");
                $("#footer-mesaj").val("");
            }
        }

    });


  

  

    var owl = $("#owl-demo");

    owl.owlCarousel({
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        loop: true
    });

    $(".next").click(function () {
        owl.trigger('owl.next');
    });

    $(".prev").click(function () {
        owl.trigger('owl.prev');
    });


    var ortak = $("#ortak");
    ortak.owlCarousel({
        items: 3, //10 items above 1000px browser width
        itemsDesktop: [1000, 3], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        loop: true
    });

    $(".team_next").click(function () {
        ortak.trigger('owl.next');
    });

    $(".team_prev").click(function () {
        ortak.trigger('owl.prev');
    });


    var $window = $(window);
    var scrollTime = 1.2;
    var scrollDistance = 170;

    $window.on("mousewheel DOMMouseScroll", function (event) {
        event.preventDefault();
        var delta = event.originalEvent.wheelDelta / 120 || -event.originalEvent.detail / 3;
        var scrollTop = $window.scrollTop();
        var finalScroll = scrollTop - parseInt(delta * scrollDistance);

        TweenMax.to($window, scrollTime, {
            scrollTo: { y: finalScroll, autoKill: true },
            ease: Power1.easeOut,
            overwrite: 5
        });
    });




    $("#menu-top-menu li").click(function () {
        var id = $(this).attr("data-id");
        $("body").append("<form id='dil' method='post'></form>");
        $("#dil").append("<input type='hidden' name='languagebox' value='" + id + "'></input>");
        $("#dil").submit();
    });
});


function change_language(selectbox) {
    var kisa_ad = $(selectbox).find("option:selected").attr("data-kisa-ad");
    $("#lang_kisa_ad").attr("value", kisa_ad);
    lang_form.submit();
}


$(window).load(function () {
    $(".corner").animate({ "opacity": 1 }, 500);
    $(".header__logo").animate({ "opacity": 1 }, 500, function () {
      
        $(".header__navigation").animate({ "opacity": 1 }, 500, function () {
       
            $(".icon-box").animate({ "opacity": 1 }, 500, function () {
                $(".top-navigation li").each(function (i, el) {
                    setTimeout(function () {
                        $(el).animate({ "opacity": 1 }, 350, function () { });
                    }, 250 + (i * 250));
                });
            });


            $(".btn-mobil-menu").animate({ "opacity": 1 }, 500, function () { });

            anasayfaOpacity();
            breadcrumbsOpacity();
            altsayfaOpacity();



        });
    });
});


function MesajGonder(ad, eposta, konu, mesaj, msgContainer, telefon) {

    $(".btnMesajGonder").prop("disabled", true);

    $.ajax({
        method: 'post',
        dataType: 'json',
        data: { islem: 'insert', modul: 'mesaj', ad: ad, eposta: eposta, konu: konu, mesaj: mesaj, telefon:telefon },
        url: '/pages/ajax.php',
        success: function (result) {
            if (result[0] == 0) {
                $(msgContainer).html(mesaj_gonderilemedi);
                return false;
            } else {

                if (result[0] === "true") {
                    $(msgContainer).html(gunde_3_adet_eposta_gonderebilirsiniz);
                    $(".btnMesajGonder").prop("disabled", false);
                    return false;
                } else {
                    $(msgContainer).html(mesajiniz_gonderildi);
                    $(".btnMesajGonder").prop("disabled", false);
                    return true;
                }
            }
            $(".btnMesajGonder").prop("disabled", false);
        },
        error: function (a, b, c) {
            alert(a.responseText + b + c);
            $(".btnMesajGonder").prop("disabled", false);
        }
    });

}