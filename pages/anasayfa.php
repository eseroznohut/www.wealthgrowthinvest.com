

<div class="jumbotron  jumbotron--with-captions">
    <div class="carousel slide carousel-fade" id="headerCarousel" data-ride="carousel" data-interval="<?php echo $settings[0]["slayt_gecis_suresi"]*1000; ?>">
        <div class="carousel-inner">
            <?php
            $i = 0;
            $slaytlar = $db->select("select *from slayt where aktif = 1 order by sira asc");
            foreach ($slaytlar as $slayt)
            {
                $i ++;
                if($i == 1 ){ $aktif ="active"; }else{ $aktif = "";}
            ?>
            <div class="carousel-item <?php echo $aktif; ?>">
                <img src="/uploads/images/slayt/<?php echo $slayt["resim_yolu"]; ?>" alt="WGI REAL ESTATE" />
                <div class="container">
                    <?php
                if(!empty($slayt["yazi"])){
                    ?>
                    <div class="jumbotron-content">
                        <h1 class="jumbotron-content__title">
                            <?php echo $slayt["yazi"]; ?>
                        </h1>
                        <div class="jumbotron-content__description">
                            <p>
                                <?php echo $db->Cevirmen($slayt["aciklama"], $language_id, 1); ?>
                            </p>
                            <p>
                                <a class="btn  btn-primary" href="/<?php echo $slayt["seo"]; ?>.html" target="_self">
                                    <?php echo $db->Cevirmen("DEVAMI", $language_id, 1); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="jumbotron__extras">
            <div class="container">

                <a class="left  jumbotron__control" href="#headerCarousel" role="button" data-slide="prev">
                    <i class="fa  fa-caret-left"></i>
                </a>
                <a class="right  jumbotron__control" href="#headerCarousel" role="button" data-slide="next">
                    <i class="fa  fa-caret-right"></i>
                </a>

                <div class="jumbotron__widgets  hidden-md-down">
                    <div class="widget  widget-icon-box" style="margin:0 auto !important;">
                        <div class="icon-box">
                            <i class="fa  fa-phone"></i>
                            <div class="icon-box__text">
                                <h4 class="icon-box__title white">
                                    <?php echo $db->Cevirmen("bizi arayın", $language_id, 1); ?> <?php echo $settings[0]["telefon1"]; ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="orta_telefon">
    <h1 class="icon-box__title">
        <?php echo $db->Cevirmen("call us", $language_id, 1); ?>
    </h1>
    <span class="icon-box__subtitle">
        <?php echo $settings[0]["telefon1"]; ?>
    </span>
</div>

<script>
    $(function () {
        var toplam_Eleman = $(".kayan_metin_container div").length-1;
        var simdikiIndex = 0;
        $(".kayan_metin_container div").first().show();
        setInterval(function () {
            $(".kayan_metin_container div").hide();
            $(".kayan_metin_container div:eq('" + simdikiIndex + "')").show();
            simdikiIndex = simdikiIndex + 1;
            if (simdikiIndex == toplam_Eleman) { simdikiIndex = 0; }
        }, 3000);

    });
</script>

<div class="row parallax">
    <h1 class="parallax-header">
        <a href="/agimiza-katilin.html">
            <?php echo $db->Cevirmen("dünya'daki ağımıza katılın", $language_id, 1); ?>
        </a>
    </h1>
    <div class="container kayan_metin_container">
            <?php
            $ortaklik_segmentleri = $db->select("SELECT *FROM ortaklik_segment ORDER BY sira ASC");
            foreach ($ortaklik_segmentleri as $segment)
            {
            ?>
            <div class="kayan_metin">
                <h1>
                    <?php
                        $text = strip_tags($segment["ad"]);
                        $text = $db->Cevirmen($text, $language_id, 1);
                        echo $db->myFunctions->textOverflow($text, 50);
                    ?>
                </h1>
            </div>
            <?php
            }
            ?>
    </div>
</div>

<?php
    $moduller = $db->select("select *from modul where anasayfada_goster = 1 and aktif = 1 and ad = 'projeler' order by sira asc");
    $proje_kategorileri = $db->select("SELECT *FROM proje_kategori WHERE aktif = 1 ORDER BY sira asc");
    $projeler = $db->select("select id from proje");
    
    if(count($proje_kategorileri) > 0 && count($projeler) > 0){

        foreach ($moduller as $modul)
        {
?>

<div class="row projects">
    <div class="container">
        <h1 class="widget-title">
            <span class="widget-title__inline">
                <?php echo $db->Cevirmen("projelerimiz", $language_id, 1); ?>
            </span>
        </h1>
        <div class="panel-grid" id="pg-11-1">
            <div class="siteorigin-panels-stretch panel-row-style" style="padding: 30px;" data-stretch-type="full">
                <div class="panel-grid-cell" id="pgc-11-1-0">
                    <div class="so-panel widget widget_pw_portfolio_grid widget-portfolio-grid panel-first-child panel-last-child" id="panel-11-1-0-0" data-index="6">
                        <div class="portfolio-grid  portfolio-grid--slider" data-type="slider">
                            <nav class="portfolio-grid__header">
                                <div class="portfolio-grid__arrows  js-wpg-arrows">
                                    <a class="portfolio-grid__arrow  portfolio-grid__arrow--left" href="#portfolio-grid-widget-1-0-0" role="button" data-slide="prev">
                                        <span class="fa fa-caret-left" aria-hidden="true"></span>
                                        <span class="sr-only">
                                            <?php echo $db->Cevirmen("önceki", $language_id, 1); ?>
                                        </span>
                                    </a>
                                    <a class="portfolio-grid__arrow  portfolio-grid__arrow--right" href="#portfolio-grid-widget-1-0-0" role="button" data-slide="next">
                                        <span class="fa fa-caret-right" aria-hidden="true"></span>
                                        <span class="sr-only">
                                            <?php echo $db->Cevirmen("sonraki", $language_id, 1); ?>
                                        </span>
                                    </a>
                                </div>
                                <a href="#" class="portfolio-grid__mobile-filter  js-filter  btn  btn-primary  btn-sm  hidden-lg-up">
                                    <span class="fa  fa-filter"></span>&nbsp;
                                    <?php echo $db->Cevirmen("filtre", $language_id, 1); ?>
                                </a>
                                <ul class="portfolio-grid__nav  js-wpg-nav-holder">
                                    <li class="portfolio-grid__nav-item  is-active">
                                        <a href="#widget-1-0-0-all" data-category="*" class="portfolio-grid__nav-link  js-wpg-nav">
                                            <?php echo $db->Cevirmen("tüm projeler", $language_id, 1); ?>
                                        </a>
                                    </li>
                                    <?php
            //$proje_kategori_proje_sayi = 0;
            foreach ($proje_kategorileri as $proje_kategori)
            {
                //$params = array();
                //array_push($params, $proje_kategori["id"]);
                //$proje_varmi = $db->select("select *from proje where kategori_id = ? and aktif = 1", $params);
                //$proje_kategori_proje_sayi = $proje_kategori_proje_sayi + count($proje_varmi);

                //if(count($proje_varmi) > 0){
                                    ?>
                                    <li class="portfolio-grid__nav-item">
                                        <a href="#kategori-<?php echo $proje_kategori["id"]; ?>" data-category="c<?php echo $proje_kategori["id"]; ?>" class="portfolio-grid__nav-link  js-wpg-nav">
                                            <?php echo $db->Cevirmen($proje_kategori["ad"], $language_id, 1); ?>
                                        </a>
                                    </li>
                                    <?php
            //}
            }?>
                                </ul>
                            </nav>
                            <div id="portfolio-grid-widget-1-0-0" class="so-panel widget widget_pw_portfolio_grid widget-portfolio-grid panel-first-child panel-last-child" data-index="0">
                                <div class="js-wpg-items" data-type="grid">
                                    <?php
            $i = 0;
            foreach ($proje_kategorileri as $proje_kategori)
            {
                $i++;
                if($i == 1){ $aktif = "active"; }else{ $aktif = ""; }
                                    ?>

                                    <div class="carousel-item <?php echo $aktif; ?>">
                                        <div class="row">
                                            <?php
                    $params = array();
                    array_push($params, $proje_kategori["id"]);
                    $projeler = $db->select("SELECT *FROM proje WHERE kategori_id = ? and aktif = 1", $params);
                    foreach ($projeler as $proje)
                    {
                                            ?>
                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 js-wpg-item" data-categories="c<?php echo $proje["kategori_id"]; ?>">
                                                <a class="card  portfolio-grid__card  js-wpg-card" href="/proje-detay/<?php echo $proje["seo"]; ?>.html">
                                                    <img width="360" height="240" src="/uploads/images/proje/<?php echo $proje["resim_yolu"]; ?>" class="card-img-top  portfolio-grid__card-img wp-post-image" alt="<?php echo $db->Cevirmen($proje["ad"], $language_id, 1); ?>" />
                                                    <div class="card-block  portfolio-grid__card-block">
                                                        <h2 class="card-title  portfolio-grid__card-title">
                                                            <?php echo $db->Cevirmen($proje["ad"], $language_id, 1); ?>
                                                        </h2>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }
    }

    if($i == 0){
?>

<script>
    $(function () {
        //$(".projects").remove();
    })
</script>

<?php
    }

?>



<?php
$moduller = $db->select("select *from modul where anasayfada_goster = 1 and aktif = 1 and seo = 'bizim-takim' order by sira asc");
foreach ($moduller as $modul)
{
?>

<div class="row " style="padding-bottom:50px;">
    <div class="container">
        <h1 class="widget-title">
            <span class="widget-title__inline">
                <?php echo $db->Cevirmen("ekibimizle tanışın", $language_id, 1); ?>
            </span>
        </h1>
        <div id="owl-demo" class="owl-carousel owl-theme">
            <?php
            $personeller = $db->select("SELECT *FROM ekip WHERE aktif = 1 ORDER BY sira ASC");
            foreach ($personeller as $personel)
            {
            ?>
            <div class="panel-grid-cell shadow" id="pgc-36-1-<?php echo $personel["id"]; ?>" style="margin:10px;">
                <div class="so-panel widget widget_pw_person_profile widget-person-profile panel-first-child panel-last-child" data-index="<?php echo $personel["id"]; ?>">
                    <div class="card  person-profile">
                        <img class="person-profile__image transition wp-post-image" src="uploads/images/ekip/<?php echo $personel["resim_yolu"]; ?>" alt="<?php echo $personel["ad"]; ?>" />
                        <div class="card-block  person-profile__container">
                            <div class="person-profile__social-icons">
                                <?php if(!empty($personel["facebook"])) { ?>
                                <a class="person-profile__social-icon" href="<?php echo $personel["facebook"]; ?>" target="_blank">
                                    <i class="fa  fa-facebook-square"></i>
                                </a>
                                <?php } ?>

                                <?php if(!empty($personel["twitter"])) { ?>
                                <a class="person-profile__social-icon" href="<?php echo $personel["twitter"]; ?>" target="_blank">
                                    <i class="fa  fa-twitter-square"></i>
                                </a>
                                <?php } ?>
                                <?php if(!empty($personel["instagram"])) { ?>
                                <a class="person-profile__social-icon" href="<?php echo $personel["instagram"]; ?>" target="_blank">
                                    <i class="fa  fa-instagram"></i>
                                </a>
                                <?php } ?>
                                <?php if(!empty($personel["gplus"])) { ?>
                                <a class="person-profile__social-icon" href="<?php echo $personel["gplus"]; ?>" target="_blank">
                                    <i class="fa  fa-google-plus-square"></i>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="person-profile__content">
                                <span class="person-profile__tag">
                                    <?php echo $personel["gorev"]; ?>
                                </span>
                                <h2 class="card-title  person-profile__name">
                                    <?php echo $personel["ad"]; ?>
                                </h2>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>


<?php
    $moduller = $db->select("select *from modul where anasayfada_goster = 1 and aktif = 1 and ad = 'haberler' order by sira asc");
    foreach ($moduller as $modul)
    {
?>

<div class="row" style="background-color:#f2f2f2;">
    <div class="container">
        <h1 class="widget-title">
            <span class="widget-title__inline">
                <?php echo $db->Cevirmen("haberler", $language_id, 1); ?>
            </span>
        </h1>
        <div class="panel-grid" id="pg-11-2">

            <?php
            $i=0;
            $haberler = $db->select("SELECT *FROM haber WHERE aktif = 1 ORDER BY tarih desc LIMIT 2");
            foreach ($haberler as $haber)
            {
                $params=array();
                array_push($params, $haber["kategori_id"]);
                $kategori = $db->select("SELECT *FROM haber_kategori WHERE id = ?", $params);
                $i++;
            ?>

            <div class="panel-grid-cell" id="pgc-11-2-<?php echo $i;?>">
                <div class="so-panel widget widget_pw_latest_news widget-latest-news panel-first-child panel-last-child" id="panel-11-2-1-0" data-index="<?php echo $i; ?>">
                    <div class="card  latest-news  latest-news--block">
                        <a href="/haberler/<?php echo $kategori[0]["ad"]; ?>/<?php echo $haber["seo"]; ?>.html" class="latest-news__image">
                            <img src="uploads/images/haber/<?php echo $haber["resim_yolu"]; ?>" width="360" height="204" class="card-img-top  wp-post-image" alt="<?php echo $db->Cevirmen($haber["ad"], $language_id, 1); ?>" />
                        </a>
                        <div class="card-block  latest-news__content" style="padding-bottom:60px;">
                            <time class="latest-news__date" datetime="<?php echo $haber["tarih"]; ?>">
                                <?php
                                $tarih = $haber["tarih"];
                                $tarih2 = $db->myFunctions->turkceTarih($tarih, $db, $language_id);
                                $timestamp = strtotime($tarih);
                                $tarih2 = str_replace("1","",$tarih2);
                                $tarih2 = str_replace("2","",$tarih2);
                                $tarih2 = str_replace("3","",$tarih2);
                                $tarih2 = str_replace("4","",$tarih2);
                                $tarih2 = str_replace("5","",$tarih2);
                                $tarih2 = str_replace("6","",$tarih2);
                                $tarih2 = str_replace("7","",$tarih2);
                                $tarih2 = str_replace("8","",$tarih2);
                                $tarih2 = str_replace("9","",$tarih2);
                                $tarih2 = str_replace("0","",$tarih2);
                                $tarih2 = str_replace(",","",$tarih2);
                                $tarih2 = str_replace(".","",$tarih2);
                                $tarih2 = str_replace("/","",$tarih2);
                                $tarih2 = str_replace("-","",$tarih2);
                                echo date("d", $timestamp)." ";
                                echo $db->Cevirmen($tarih2, $language_id, 1);
                                ?>
                            </time>
                            <h2 class="card-title  latest-news__title">
                                <a href="">
                                    <?php
                                    $text = strip_tags($haber["ad"]);
                                    $text = $db->Cevirmen($text, $language_id, 1);
                                    echo $db->myFunctions->textOverflow($text, 50);
                                    ?>
                                </a>
                            </h2>
                            <div class="card-text  latest-news__text">
                                <?php
                                $text = strip_tags($haber["icerik"]);
                                $text = $db->Cevirmen($text, $language_id, 1);
                                echo $db->myFunctions->textOverflow($text, 200);
                                ?>
                            </div>
                            <br />
                            <span style="padding-left:10px; padding-top:20px;padding-bottom:20px; font-size:12px;float:left;">

                                <?php echo $haber["okuma"]; ?> <?php echo $db->Cevirmen("görüntüleme", $language_id, 1); ?>
                            </span>
                            <a href="/haberler/<?php echo $kategori[0]["ad"]; ?>/<?php echo $haber["seo"]; ?>.html" class="btn btn-primary pull-right" style="color:#fff !important; float:right;">
                                <?php echo $db->Cevirmen("devamını oku", $language_id, 1); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>

            <div class="panel-grid-cell" id="pgc-11-2-2">
                <div class="so-panel widget widget_pw_latest_news widget-latest-news panel-first-child panel-last-child" id="panel-11-2-2-0" data-index="9">
                    <div class="latest-news__container">
                        <?php
                        $i=0;
                        $haberler = $db->select("SELECT *FROM haber WHERE aktif = 1 ORDER BY tarih desc LIMIT 2, 4");
                        foreach ($haberler as $haber)
                        {
                            $i++;
                        ?>

                        <a href="/haberler/<?php echo $kategori[0]["ad"]; ?>/<?php echo $haber["seo"]; ?>.html" class="card  latest-news  latest-news--inline">
                            <div class="card-block  latest-news__content">
                                <h2 class="card-title  latest-news__title">
                                    <?php
                            $text = strip_tags($haber["ad"]);
                            $text = $db->Cevirmen($text, $language_id, 1);
                            echo $db->myFunctions->textOverflow($text, 50);
                                    ?>
                                </h2>
                                <time class="latest-news__date" datetime="<?php echo $haber["tarih"]; ?>">
                                    <?php
                            $tarih = $haber["tarih"];
                            $tarih2 = $db->myFunctions->turkceTarih($tarih, $db, $language_id);
                            $timestamp = strtotime($tarih);
                            $tarih2 = str_replace("1","",$tarih2);
                            $tarih2 = str_replace("2","",$tarih2);
                            $tarih2 = str_replace("3","",$tarih2);
                            $tarih2 = str_replace("4","",$tarih2);
                            $tarih2 = str_replace("5","",$tarih2);
                            $tarih2 = str_replace("6","",$tarih2);
                            $tarih2 = str_replace("7","",$tarih2);
                            $tarih2 = str_replace("8","",$tarih2);
                            $tarih2 = str_replace("9","",$tarih2);
                            $tarih2 = str_replace("0","",$tarih2);
                            $tarih2 = str_replace(",","",$tarih2);
                            $tarih2 = str_replace(".","",$tarih2);
                            $tarih2 = str_replace("/","",$tarih2);
                            $tarih2 = str_replace("-","",$tarih2);
                            echo date("d", $timestamp)." ";
                            echo $db->Cevirmen($tarih2, $language_id, 1);
                                    ?>
                                </time>
                            </div>
                        </a>
                        <?php } ?>

                        <a href="haberler.html" class="card-block  latest-news  latest-news--more-news">
                            <?php echo $db->Cevirmen("diğer haberler", $language_id, 1);?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php
    $moduller = $db->select("select *from modul where anasayfada_goster = 1 and aktif = 1 and ad = 'ortaklık' order by sira asc");
    foreach ($moduller as $modul)
    {
?>

<div id="primary" class="content-area container" role="main">
    <div class="entry-content">
        <div id="pl-11">
            <div class="panel-grid" id="pg-11-6">
                <div class="panel-grid-cell" id="pgc-11-6-0">
                    <div class="so-panel widget widget_text panel-first-child panel-last-child" id="panel-11-6-0-0" data-index="13">
                        <h1 class="widget-title">
                            <span class="widget-title__inline">
                                <?php echo $db->Cevirmen("iş ortaklarımız", $language_id, 1); ?>
                            </span>
                        </h1>
                        <div class="textwidget">
                            <div class="logo-panel">
                                <div class="row">
                                    <?php
                                    $partners = $db->select("SELECT *FROM ortak order by sira asc");
                                    foreach ($partners as $partner)
                                    {
                                    ?>
                                    <div class="col-xs-12  col-sm-4  col-lg-2">
                                        <img src="uploads/images/ortak/<?php echo $partner["resim_yolu"]; ?>" alt="<?php echo $partner["ad"]; ?>" />
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-grid" id="pg-11-7">
                <div class="panel-grid-cell" id="pgc-11-7-0">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

<?php } ?>


<?php $title = $settings[0]["title"]; ?>