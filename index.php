<?php
include_once("header.php");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang_kisa_ad"]; ?>">
<head>
    <meta charset="utf-8" />
    <title>
       WGI
    </title>
    <meta name="content-language" content="tr" />
    <meta name="rating" content="All" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="reply-to" content="<?php echo $settings[0]['eposta']; ?>" />
    <meta name="description" content="<?php echo $db->Cevirmen($settings[0]['description'], $language_id, 1); ?>" />
    <meta name="keywords" content="<?php echo $db->Cevirmen($settings[0]['keywords'], $language_id, 1); ?>" />
    <meta name="author" content="<?php echo $db->Cevirmen($settings[0]['firma_adi'], $language_id, 1); ?>" />
    <meta name="copyright" content="<?php echo $db->Cevirmen($settings[0]['firma_adi'], $language_id, 1); ?>" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image" content="<?php echo $db->Cevirmen($settings[0]['logo_yolu'], $language_id, 1); ?>" />
    <meta property="og:url" content="<?php echo $db->Cevirmen($settings[0]['url'], $language_id, 1); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $db->Cevirmen($settings[0]['title'], $language_id, 1); ?>" />
    <meta property="og:description" content="<?php echo $db->Cevirmen($settings[0]['description'], $language_id, 1); ?>" />
    <meta name="google-site-verification" content="o-GdJA_UxTpa6jaN6_6u62ZCmkL3k0RPnbnNVagc9VA" />
    <meta name="msvalidate.01" content="5F522008CC9B98DAD02B88701EA9DAE1" />
    <link rel='stylesheet' type="text/css" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css' />
    <link rel='stylesheet' type="text/css" href='/assets/plugins/siteorigin-panels/css/front367a.css?ver=2.4.10' media='all' />
    <link rel='stylesheet' type="text/css" href='/assets/themes/stylecbe8.css?ver=1.7.1-1-g1c6871a' media='all' />
    <link rel='stylesheet' type="text/css" href='http://fonts.googleapis.com/css?family=Roboto%3A700%7COpen+Sans%3A400%2C700&amp;subset=latin' media='all' />
    <link rel='stylesheet' type="text/css" href="/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/plugins/form-select2/4.0.3/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/plugins/form-parsley/parsley.css" />
    <link rel="stylesheet" type="text/css" href="/assets/plugins/owl-carousel/owl.transitions.css" />
    <link rel="stylesheet" type="text/css" href="/assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/animate/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/mobile.css" media="all"/>
    <?php
    $languages = $db->select("select *from language where aktif = 1 order by anadil desc");

    foreach ($languages as $language)
    {
    ?>
    <link rel="alternate" href="http://www.wealthgrowthinvest.com/?language=<?php echo $language["kisa_ad"]; ?>" hreflang="<?php echo $language["kisa_ad"]; ?>" />
    <?php
    }
    ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script type='text/javascript' src='/assets/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
    <script type='text/javascript' src='/assets/themes/assets/js/modernizr.custom.20160712.js'></script>
    <script type="text/javascript" src="/assets/plugins/form-select2/4.0.3/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/form-parsley/parsley.js"></script>
    <script type="text/javascript" src="/assets/plugins/form-parsley/i18n/tr.js"></script>
    <script type="text/javascript" src="/assets/plugins/shinner/pe.shiner/jquery.pixelentity.shiner.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/shinner/jpreLoader.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/assets/js/script.js"></script>
    <script type="text/javascript" src="/assets/themes/assets/js/mobil_menu.js"></script>
    <script type="text/javascript" src="/assets/js/index.js"></script>
    <script type="text/javascript" src="/assets/js/mobile.js"></script>

    <script>
        var mesaj_gonderilemedi = '<?php echo $db->Cevirmen("Mesajınız Gönderilemedi!", $language_id, 1); ?>';
        var gunde_3_adet_eposta_gonderebilirsiniz = '<?php echo $db->Cevirmen("Günde sadece 3 adet mesaj gönderebilirsiniz.", $language_id, 1); ?>';
        var mesajiniz_gonderildi = '<?php echo $db->Cevirmen("Mesajınız Gönderildi.", $language_id, 1); ?>';
    </script>
</head>
<body class="home page page-id-11 page-template page-template-template-front-page-slider page-template-template-front-page-slider-php siteorigin-panels siteorigin-panels-home wp-featherlight-captions">
    <div class="boxed-container">
        <header class="site-header">
            <div class="top">
                <div class="container  top__container">
                    <div class="corner"></div>
                    <div class="top__tagline"></div>
                    <nav class="top__menu" aria-label="Top Menu"></nav>
                </div>
            </div>
            <div class="header">
                <div class="container">

                    <div class="header__logo">
                        <div class="peShiner">
                            <a href="/anasayfa.html">
                                <img src="/uploads/images/logo/<?php echo $settings[0]["logo_yolu"];?>" alt="<?php echo $settings[0]["firma_adi"];?>" class="img-fluid header_logo_img" style="max-width:none;" />
                            </a>
                        </div>
                        <div class="slogan">Have fun & make money</div>
                    </div>

                    <div class="top-right">
                        <div class="top-iletisim">
                            <div class="icon-box">
                                <i class="fa  fa-phone"></i>
                                <div class="icon-box__text">
                                    <h1 class="icon-box__title">
                                        <?php echo $db->Cevirmen("bizi arayın", $language_id, 1); ?>
                                    </h1>
                                    <span class="icon-box__subtitle">
                                        <?php echo $settings[0]["telefon1"]; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


             
                        <button type="button" class="btn btn-mobil-menu">
                            <i class="fa fa-bars"></i>
                        </button>

               

                        <nav class="header__navigation  collapse  navbar-toggleable-md  js-sticky-offset" aria-label="Main Menu">
                            <a class="home-icon" href="/anasayfa.html">
                                <i class="fa fa-home"></i>
                            </a>
                            <ul id="menu-main-menu" class="main-navigation js-main-nav js-dropdown" role="menubar">
                                <?php
                        $moduller = $db->select("select *from modul where aktif = 1 order by sira asc");
                        foreach ($moduller as $modul)
                        {
                            $modul_id = $modul["id"];
                                ?>
                                <li id="drop-<?php echo $modul_id;?>" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu menu1">
                                    <a id="nav-<?php echo strtolower($modul["seo"]); ?>" href="/<?php echo strtolower($modul["seo"]); ?>.html">
                                        <?php echo $db->Cevirmen($modul["ad"], $language_id, 1); ?>
                                    </a>
                                    <div class="main_nav_speator"></div>
                                    <ul class="sub-menu">
                                        <?php
                            $i = 0;

                            if($modul["seo"] == "projeler"){
                                $proje_sayisi = 0;
                                $proje_kategorleri = $db->select("select *from proje_kategori where aktif = 1 order by sira asc");
                                foreach ($proje_kategorleri as $proje_kategorl)
                                {
                                    $i++;
                                    $params = array();
                                    array_push($params, $proje_kategorl["id"]);
                                    $proje_varmi = $db->select("select *from proje where kategori_id = ? and aktif = 1 ", $params);

                                    $proje_sayisi = $proje_sayisi + count($proje_varmi);
                                    //if(count($proje_varmi) > 0 ){

                                        ?>

                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a id="nav-proje-kategori-detay-<?php echo $proje_kategorl["id"]; ?>" href="/proje-kategori-detay/<?php echo $proje_kategorl["seo"] ?>.html">
                                                <?php echo $db->Cevirmen($proje_kategorl["ad"], $language_id, 1); ?>
                                            </a>
                                        </li>

                                        <?php
                                    //}
                                }

                                //if($proje_sayisi == 0){
                                        
                                        
                                        ?>

                                        <script>
                                            $(function () {
                                                //$("#drop-<?php echo $modul_id; ?>").removeClass("menu-item-has-children");
                                            });
                                        </script>


                               <?php
                            //}
                            }
                            $modul_sayfalar = $db->select("select *from sayfa where aktif = 1 and modul_id = '$modul_id'  order by sira asc");
                            foreach ($modul_sayfalar as $modul_sayfa)
                            {
                                $i++;
                                        ?>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a id="nav-sayfa-<?php echo $modul_sayfa["id"]; ?>" href="/<?php echo $modul["seo"]; ?>/<?php echo $modul_sayfa["seo"]; ?>.html">
                                                <?php echo $db->Cevirmen($modul_sayfa["ad"], $language_id, 1); ?>
                                            </a>
                                        </li>
                                        <?php
 }
                            if($modul["seo"] == "ekibimiz"){
                                        ?>

                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a id="nav-sayfa-ekip" href="/ekibimiz/yonetim.html">
                                                <?php echo $db->Cevirmen("yönetim kurulu", $language_id, 1); ?>
                                            </a>
                                        </li>

                                        <?php
                            }
                                        ?>


                                    </ul>
                                    <?php
                            if($i == 0){
                                    ?>
                                    <script>
                            $(function () {
                                $("#drop-<?php echo $modul_id;?>").removeClass("menu-item-has-children");
                            });
                                    </script>
                                    <?php
                            }else
                            {
                                    ?>
                                    <script>
                            $(function () {
                                ////$("#nav-<?php echo strtolower($modul["seo"]);?>").attr("href", "");
                                ////$("#nav-sayfa-<?php echo strtolower($modul["seo"]);;?>").attr("href", "");
                            })
                                    </script>
                                    <?php
                            }
                                    ?>
                                </li>
                                <?php
  }
                                ?>
                                <?php
                        $sayfalar = $db->select("select *from sayfa where aktif = 1 and modul_id = 0  order by sira asc");
                        foreach ($sayfalar as $sayfa)
                        {
                                ?>
                                <li>
                                    <a href="/<?php echo strtolower($sayfa["seo"]); ?>.html">
                                        <?php echo $db->Cevirmen($sayfa["ad"], $language_id, 1); ?>
                                    </a>
                                </li>
                                <?php
                        }
                                ?>
                            </ul>
                            <ul id="menu-top-menu" class="top-navigation js-dropdown">
                                <?php
                      
                        foreach ($languages as $language)
                        {
                            $selected = "selected_language_image";
                            if($language_id == $language["id"]){ $selected = ""; }
                                ?>
                                <li data-id="<?php echo $language["id"]; ?>">
                                    <img class="<?php echo $selected;?>" src="/uploads/images/language/<?php echo $language["flag"]; ?>" alt="<?php echo $db->Cevirmen("site dilini değiştir", $language_id, 1);?>" width="20" />
                                </li>
                                <?php
                    }
                                ?>
                            </ul>

                        </nav>



                    </div>
            </div>
        </header>

        <div class="content">

            <?php

            $sayfa = $_GET["p"];
            switch ($sayfa)
            {
                case "anasayfa":
                    include_once("pages/anasayfa.php");
                    break;
                case "sayfa":
                    include_once("pages/sayfa.php");
                    break;
                case "agimiza-katilin":
                    include_once("pages/agimiza-katilin.php");
                    break;
                case "proje":
                    include_once("pages/proje.php");
                    break;
                case "proje-detay":
                    include_once("pages/proje_detay.php");
                    break;
                case "proje-kategori-detay":
                    include_once("pages/proje_kategori_detay.php");
                    break;
                case "referanslar":
                    include_once("pages/referanslar.php");
                    break;
                case "ekibimiz":
                    include_once("pages/ekibimiz.php");
                    break;
                case "haberler":
                    include_once("pages/haberler.php");
                    break;
                case "haber-detay":
                    include_once("pages/haber_detay.php");
                    break;
                case "videolar":
                    include_once("pages/videolar.php");
                    break;
                case "iletisim":
                    include_once("pages/iletisim.php");
                    break;
    	        default:
                    include_once("pages/anasayfa.php");
                    break;
            }

            ?>

        </div>




        <footer class="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12  col-md-4">
                            <div class="widget  widget_nav_menu">
                                <h1 class="footer-top__headings">
                                    <?php echo $db->Cevirmen("menu", $language_id, 1); ?>
                                </h1>
                                <div class="footer-menu-container">
                                    <ul>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu">
                                            <a href="/<?php echo strtolower("anasayfa"); ?>.html">
                                                <?php echo $db->Cevirmen("Anasayfa", $language_id, 1); ?>
                                            </a>
                                            <div class="footer_nav_speator"></div>
                                        </li>
                                        <?php
                                        $moduller = $db->select("select *from modul where aktif = 1 order by sira asc");
                                        foreach ($moduller as $modul)
                                        {
                                            $modul_id = $modul["id"];
                                        ?>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu cmn-t-underline">
                                            <a href="/<?php echo strtolower($modul["seo"]); ?>.html">
                                                <?php echo $db->Cevirmen($modul["ad"], $language_id, 1); ?>
                                            </a>
                                            <div class="footer_nav_speator"></div>
                                        </li>
                                        <?php  }  ?>
                                        <?php
                                        $sayfalar = $db->select("select *from sayfa where aktif = 1 and modul_id = 0  order by sira asc");
                                        foreach ($sayfalar as $sayfa)
                                        {
                                        ?>
                                        <li>
                                            <a href="/<?php echo strtolower($sayfa["seo"]); ?>.html">
                                                <?php echo $db->Cevirmen($sayfa["ad"], $language_id, 1); ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <br />
                                    <p>
                                        <?php if(!empty($settings[0]["facebook"])){ ?>
                                        <a class="icon-container" href="<?php echo $settings[0]["facebook"]; ?>" target="_self">
                                            <i class="fa  fa-facebook-square"></i>
                                        </a>
                                        <?php }?>
                                        <?php if(!empty($settings[0]["twitter"])){ ?>
                                        <a class="icon-container" href="<?php echo $settings[0]["twitter"]; ?>" target="_self">
                                            <i class="fa  fa-twitter-square"></i>
                                        </a>
                                        <?php }?>
                                        <?php if(!empty($settings[0]["gplus"])){ ?>
                                        <a class="icon-container" href="<?php echo $settings[0]["gplus"]; ?>" target="_self">
                                            <i class="fa fa-google-plus-square"></i>
                                        </a><?php }?>

                                        <?php if(!empty($settings[0]["instagram"])){ ?>
                                        <a class="icon-container" href="<?php echo $settings[0]["instagram"]; ?>" target="_self">
                                            <i class="fa  fa-instagram"></i>
                                        </a>
                                        <?php }?>
                                        <?php if(!empty($settings[0]["youtube"])){ ?>
                                        <a class="icon-container" href="<?php echo $settings[0]["youtube"]; ?>" target="_self">
                                            <i class="fa fa-youtube-square"></i>
                                        </a>
                                        <?php }?>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12  col-md-4">
                            <div class="widget  widget_text">
                                <h1 class="footer-top__headings">
                                    <?php echo $db->Cevirmen("bize mesaj bırakın",$language_id, 1); ?>
                                </h1>
                                <div class="textwidget index-footer-message-form">
                                    <form method="post" id="footer-contact-form">
                                        <div class="form-group cmn-t-underline">
                                            <input type="text" id="footer-ad" name="footer-ad" placeholder="<?php echo $db->Cevirmen("adınız",$language_id, 1); ?>, <?php echo $db->Cevirmen("soyadınız",$language_id, 1); ?>" class="form-control input-sm"
                                                aria-required="true"
                                                aria-invalid="false"
                                                data-parsley-trigger="change"
                                                required="" />
                                        </div>
                                        <div class="form-group cmn-t-underline">
                                            <input type="email" id="footer-eposta" name="footer-eposta" placeholder="<?php echo $db->Cevirmen("eposta adresiniz",$language_id, 1); ?>" class="form-control input-sm"
                                                aria-required="true"
                                                aria-invalid="false"
                                                data-parsley-trigger="change"
                                                required="" />
                                        </div>
                                        <div class="form-group cmn-t-underline">
                                            <input type="tel" id="footer-telefon" name="footer-telefon" placeholder="<?php echo $db->Cevirmen("telefon numarası",$language_id, 1); ?>" class="form-control input-sm"
                                                aria-required="true"
                                                aria-invalid="false"
                                                data-parsley-trigger="change"
                                                required="" />
                                        </div>
                                        <div class="form-group cmn-t-underline">
                                            <input type="text" id="footer-konu" name="footer-konu" placeholder="<?php echo $db->Cevirmen("konu",$language_id, 1); ?>" class="form-control input-sm"
                                                aria-required="true"
                                                aria-invalid="false"
                                                data-parsley-trigger="change"
                                                required="" />
                                        </div>
                                        <div class="form-group cmn-t-underline">
                                            <textarea class="form-control input-sm"
                                                id="footer-mesaj"
                                                name="footer-mesaj" placeholder="<?php echo $db->Cevirmen("mesajınız",$language_id, 1); ?>"
                                                aria-required="true"
                                                aria-invalid="false"
                                                data-parsley-trigger="change"
                                                required=""></textarea>
                                        </div>
                                        <div>
                                            <div id="footer-contact-form-message"></div>
                                            <button type="button" class="btnMesajGonder btn-fsm pull-right cmn-t-underline" style="width:100%;">
                                                <?php echo $db->Cevirmen("Gönder", $language_id, 1); ?>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>



                        <div class="col-xs-12  col-md-4">

                            <div class="widget  widget_text">
                                <h1 class="footer-top__headings">
                                    <?php echo $db->Cevirmen("iletişim bilgileri",$language_id, 1); ?>
                                </h1>
                                <div class="textwidget">
                                    <p>
                                        <span class="icon-container">
                                            <span class="fa  fa-map-marker"></span>
                                        </span>
                                        <span style="text-transform: capitalize;">
                                            <?php echo $settings[0]["adres"]; ?>
                                        </span>

                                        <br />
                                        <span class="icon-container">
                                            <span class="fa  fa-phone"></span>
                                        </span><?php echo $settings[0]["telefon1"]; ?>
                                        <br />
                                        <!--<span class="icon-container">
                                            <span class="fa  fa-phone"></span>
                                        </span><?php echo $settings[0]["telefon2"]; ?>
                                        <br />-->
                                        <span class="icon-container">
                                            <span class="fa  fa-envelope"></span>
                                        </span>
                                        <span>
                                            <?php echo $settings[0]["eposta"]; ?>
                                        </span>
                                        <br />
                                    </p>

                                </div>
                            </div>
                            <h1 class="footer-top__headings">
                                <?php echo $db->Cevirmen("lokasyonumuz",$language_id, 1); ?>
                            </h1>
                            <iframe class="map" src="<?php echo $settings[0]["map"]; ?>" frameborder="0" style="width:100%; height:170px; overflow:hidden;"></iframe>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="container" style="text-align:left;font-size:12px; padding-left:10px;">
                    &copy; <?php echo date("Y")." ". $settings[0]["firma_adi"]; ?>. <span style="text-transform:capitalize;"><?php echo $db->Cevirmen("tüm hakları saklıdır",$language_id, 1); ?></span>.
                </div>
            </div>



        </footer>
    </div>

    <script type='text/javascript' src='/assets/js/underscore.min4511.js'></script>
    <script type='text/javascript' src='/assets/plugins/woocommerce/assets/js/frontend/cart-fragments.min72e6.js'></script>
    <script type='text/javascript' src='/assets/themes/assets/js/main.mincbe8.js?ver=1.7.1-1-g1c6871a'></script>
    <script type='text/javascript' src="/assets/plugins/PageScroll/TweenMax.min.js"></script>
    <script type='text/javascript' src="/assets/plugins/PageScroll/ScrollToPlugin.js"></script>

    <script>
        $(function () {
            document.title = 'WGI - <?php echo $db->myFunctions->strtoupperTR($title); ?>';
        });
    </script>
    
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-82945203-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>
