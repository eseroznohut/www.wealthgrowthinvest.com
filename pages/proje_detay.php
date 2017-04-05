<?php
$seo = $_GET["seo"];

$params = array();
array_push($params, $seo);

$proje = $db->select("SELECT *FROM proje WHERE seo = ?", $params);

$params = array();
array_push($params, $proje[0]["kategori_id"]);
$proje_kategori = $db->select("select *from proje_kategori where id = ?",$params);

?>
<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/projeler.html" class="post post-page">
                <?php echo $db->Cevirmen("projeler", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span id="current_page" property="v:title">
                <?php echo $db->Cevirmen($proje[0]["ad"], $language_id, 1);
                      $title = $db->Cevirmen($proje[0]["ad"], $language_id, 1);
                      if(empty($title)){
                          $title = $db->Cevirmen("projeler", $language_id, 1);
                      }
                ?>
            </span>
        </span>
    </div>
</div>

<style>
    .img-list {
        list-style:none;
        padding:0px;
        margin:0px;

    }
        .img-list li {
            list-style:none;
            float:left;
            margin:0px;
            padding:1px !important;
            cursor:pointer;
        }
    .image-current-view {
    padding:0px;
    margin:0px;
    }
    .ileri {
        position: absolute;
        right: 5px;
        bottom: 10px;
        z-index: 10;
        height: 60px;
        padding: 5px;
        padding-top: 15px;
        padding-bottom: 15px;
        cursor: pointer;
        background-image: url(../assets/img/pixel_beyaz_1.png);
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .geri {
        position: absolute;
        left: 5px;
        bottom: 10px;
        padding: 5px;
        padding-top: 15px;
        padding-bottom: 15px;
        z-index: 10;
        height: 60px;
        cursor: pointer;
        background-image: url(../assets/img/pixel_beyaz_1.png);
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .i {
        font-size: 30px;
        color: #ffffff;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }
    .content-area {
    margin-bottom:80px;
    }

</style>

<div id="primary" class="content-area  container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="portfolio__title">
                <?php echo $db->Cevirmen($proje[0]["ad"], $language_id, 1); ?>
            </h1>
        </div>

        <aside class="col-md-7">

            <div class="portfolio__gallery" style="position:relative;">
                <div class="image-current-view">
                    <a id="current-image-view-url" href="/uploads/images/proje/<?php echo $proje[0]["resim_yolu"]; ?>">
                        <img id="current-image-view" class="img-responsive" src="../uploads/images/proje/<?php echo $proje[0]["resim_yolu"]; ?>" alt="<?php echo $proje[0]["ad"]; ?>" />
                    </a>
                </div>
                <ul id="img_carousel" class="img-list owl-carousel owl-theme">
                    <?php
                    $i=0;
                $params = array();
                array_push($params, $proje[0]["id"]);
                $proje_fotolari = $db->select("SELECT *FROM resim WHERE modul_adi = 'proje' AND record_id = ?",$params);
                foreach ($proje_fotolari as $proje_foto)
                {
                    $i++;
                    ?>
                    <li>
                        <img id="img-<?php echo $i; ?>" class="img-responsive thumb" src="/uploads/images/proje/<?php echo $proje_foto["buyuk"]; ?>" alt="<?php echo $proje[0]["ad"]; ?>" />
                    </li>
                    <?php
                }
                    ?>
                </ul>
                <div class="geri">
                    <a class="prev">
                        <i class="fa i fa-chevron-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="ileri">
                    <a class="next">
                        <i class="fa i fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </aside>

        <script>
            $(function () {
                $(".thumb").click(function () {
                    $("#current-image-view").attr("src", $(this).attr("src"));
                    $("#current-image-view-url").attr("url", $(this).attr("src"));
                });

                var index = 1;

                var img_carousel = $("#img_carousel");
                img_carousel.owlCarousel({
                    items: 4, //10 items above 1000px browser width
                    itemsDesktop: [1000, 4], //5 items between 1000px and 901px
                    itemsDesktopSmall: [900, 2], // betweem 900px and 601px
                    itemsTablet: [600, 1], //2 items between 600 and 0
                    itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
                    loop: true,
                    lazyLoad: true,
                    autoPlay: true,
                    pagination: true,
                    afterMove: function (t) {

                        $("#current-image-view").attr("src", $("#img-" + index).attr("src"));
                        $("#current-image-view-url").attr("url", $("#img-" + index).attr("src"));
                        index++;
                        if (index > $(this).find("li").length) { index = 1; }
                    }
                });

                $(".next").click(function () {
                    img_carousel.trigger('owl.next');
                });

                $(".prev").click(function () {
                    img_carousel.trigger('owl.prev');
                });


            })
        </script>

        <main class="col-md-5" role="main" id="portfolio-navigation-anchor">
            <article id="post-510" class="post-inner post-510 portfolio type-portfolio status-publish has-post-thumbnail hentry portfolio_category-gardening">

                <div class="portfolio--left">
                    <div class="portfolio__meta">
                        <ul class="list-unstyled">
                            <li class="portfolio__meta-item">
                                <span class="portfolio__meta-icon">
                                    <i class="fa  fa-ellipsis-v"></i>
                                </span>
                                <h2 class="portfolio__meta-key">
                                    <?php echo $db->Cevirmen("kategori", $language_id, 1); ?>
                                </h2>
                                <p class="portfolio__meta-value">
                                    <?php echo $db->Cevirmen($proje_kategori[0]["ad"],$language_id, 1); ?>
                                </p>
                            </li>
                            <?php
                            if(!empty($proje[0]["baslangic_t"])){
                            ?>
                            <li class="portfolio__meta-item">
                                <span class="portfolio__meta-icon">
                                    <i class="fa  fa-clock-o"></i>
                                </span>
                                <span class="portfolio__meta-key">
                                    <?php echo $db->Cevirmen("başlangıç tarihi", $language_id, 1); ?>
                                </span>
                                <p class="portfolio__meta-value">
                                    <?php
                                $tarih = $proje[0]["baslangic_t"];
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
                                echo date("d", $timestamp);
                                echo $db->Cevirmen($tarih2, $language_id, 1);
                                    ?>
                                </p>
                            </li>
                            <?php
                            }
                            if(!empty($proje[0]["bitis_t"])){
                            ?>
                            <li class="portfolio__meta-item">
                                <span class="portfolio__meta-icon">
                                    <i class="fa  fa-clock-o"></i>
                                </span>
                                <span class="portfolio__meta-key">
                                    <?php echo $db->Cevirmen("bitiş tarihi", $language_id, 1); ?>
                                </span>
                                <p class="portfolio__meta-value">
                                    <?php
                                $tarih = $proje[0]["bitis_t"];
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
                                echo date("d", $timestamp);
                                echo $db->Cevirmen($tarih2, $language_id, 1);
                                    ?>
                                </p>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="hentry__content  portfolio__content">
                        <?php echo $db->Cevirmen($proje[0]["icerik"], $language_id, 1); ?>
                    </div>
                </div>
            </article>
        </main>


    </div>
</div>



<link href="../assets/plugins/lightgallery/css/lightgallery.min.css" rel="stylesheet" />
<link href="../assets/plugins/lightgallery/css/lg-transitions.min.css" rel="stylesheet" />
<link href="../assets/plugins/lightgallery/css/lg-fb-comment-box.min.css" rel="stylesheet" />
<script src="../assets/plugins/lightgallery/lib/jquery.mousewheel.min.js"></script>
<script src="../assets/plugins/lightgallery/js/lightgallery-all.min.js"></script>


<script>
    $(function () {
        $('.image-current-view').lightGallery({

        });
    });
</script>