<?php

$haber_seo = $_GET["seo"];

$params = array();
array_push($params, $haber_seo);
$haber = $db->select("SELECT *FROM haber WHERE seo = ?", $params);
$okuma = $haber[0]["okuma"] + 1;
$db->HaberOkumaSayisiUpdate($okuma,$haber[0]["id"]);

$params = array();
array_push($params, $haber[0]["kategori_id"]);
$kategori = $db->select("SELECT *FROM haber_kategori WHERE id = ?", $params);


?>



<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/haberler.html" class="home">
                <?php echo $db->Cevirmen("haberler", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/haber-kategori/<?php echo $kategori[0]["seo"]?>.html" class="home">
            <?php echo $db->Cevirmen($kategori[0]["ad"], $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span id="current_page" property="v:title">
                <?php echo $db->Cevirmen($haber[0]["ad"], $language_id, 1); ?>
            </span>
        </span>
    </div>
</div>


<div id="primary" class="content-area  container">
    <div class="row">
        <main id="main" class="site-main  col-xs-12  col-lg-9" role="main">
            <article id="post-339" class="clearfix post-339 post type-post status-publish format-standard has-post-thumbnail hentry category-interior-design category-real-estate category-renovation">
                <img width="100%" src="/uploads/images/haber/<?php echo $haber[0]["resim_yolu"]; ?>" class="img-responsive" alt="<?php echo $haber[0]["ad"]; ?>" />
                <br />
                <br />
                <header class="hentry__header">
                    <time class="hentry__date" datetime="<?php echo $haber[0]["tarih"]; ?>">
                        <?php
                        $tarih = $haber[0]["tarih"];
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
                    <h1 class="hentry__title">
                        <?php
                        echo $db->Cevirmen($haber[0]["ad"], $language_id, 1);
                        $title = $db->Cevirmen($haber[0]["ad"], $language_id, 1);
                        ?>
                    </h1>
                </header>
                <div class="hentry__content  entry-content">
                    <div style="text-indent:20px;line-height:1.8;">
                        <?php
                        $text = strip_tags($haber[0]["icerik"]);
                        $text = $db->Cevirmen($text, $language_id, 1);
                        echo $text;
                        ?>
                    </div>

                </div>
                <footer class="hentry__footer">
                    <div class="hentry__meta">
                        <div class="meta">
                            <span class="meta__item  meta__item--categories">
                                <?php
                                if(!empty($haber[0]["etiket"])){
                                $array = explode(",", $haber[0]["etiket"]);
                                foreach ($array as $value)
                                {
                                ?>
                                <span class="etiket">
                                    <i class="fa fa-tag" aria-hidden="true"></i>
                                    <?php echo $db->Cevirmen($value, $language_id, 1);
                                    ?>
                                </span>
                                <?php } }?>
                            </span>
                        </div>
                    </div>
                </footer>
            </article>

        </main>
        <div class="col-xs-12  col-lg-3">
            <div class="sidebar" role="complementary">
                <div class="widget  widget_search">

                    <form role="search" method="post" class="search-form" action="/haberler.html">
                        <div class="form-group" style="display:block;">
                            <label style="margin-bottom:0px !important; height:60px !important;">
                                <span class="screen-reader-text">Search for:</span>
                                <input type="search" class="form-control  search-field" placeholder="<?php echo $db->Cevirmen("arama", $language_id, 1); ?>" value="" name="q" />
                            </label>
                            <button type="submit" class="btn  btn-primary  search-submit" style="padding: 1.0625rem 0 !important; margin-top:0px !important;">
                                <i class="fa  fa-lg  fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>




                <div class="widget  widget-latest-news">
                    <div class="latest-news__container">

                        <?php
                        $haberler = $db->select("SELECT *FROM haber ORDER BY id DESC LIMIT 2");
                        foreach ($haberler as $haber)
                        {
                        ?>

                        <a href="/haberler/<?php echo $haber["seo"]; ?>.html" class="card  latest-news  latest-news--inline">
                            <div class="card-block  latest-news__content">
                                <h2 class="card-title  latest-news__title">
                                    <?php echo $db->Cevirmen($haber["ad"],$language_id, 1); ?>
                                </h2>
                                <time class="latest-news__date" datetime="<?php echo $haber[0]["tarih"]; ?>">
                                    <?php
                            $tarih = $haber[0]["tarih"];
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
                            echo $db->Cevirmen($tarih2, $language_id, 1)." ";
                            echo date("Y");
                                    ?>
                                </time>
                            </div>
                        </a>

                        <?php
                        }
                        ?>

                        <a href="/haberler.html" class="card-block  latest-news  latest-news--more-news">
                            <?php echo $db->Cevirmen("tüm haberler", $language_id, 1); ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>