
<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span id="current_page" property="v:title">
                <?php echo $db->Cevirmen("haberler", $language_id, 1); ?>
            </span>
        </span>
    </div>
</div>



<div id="primary" class="content-area  container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-box__title">
                <?php echo $db->Cevirmen("haberler", $language_id, 1);
                      $title = $db->Cevirmen("haberler", $language_id, 1);
                ?>
            </h1>
        </div>

        <div class="col-xs-12  col-lg-4">
            <div class="sidebar" role="complementary">
                <div class="widget  widget_search">

                    <form role="search" method="post" class="search-form">
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
                    <div style="display:block;margin-top:15px;padding-left:10px;">
                        <?php
                        if($_POST){
                            $keyword = $_POST["q"];
                            $params = array();
                            array_push($params,$kategori[0]["id"]);
                            $sayfada = 5;
                            $sorgu = $db->select("SELECT COUNT(*) AS toplam FROM haber WHERE icerik like '%".$keyword."%'");
                            $toplam_icerik = $sorgu[0]['toplam'];
                            $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                            $sayfa = isset($_GET['a_p']) ? (int) $_GET['a_p'] : 1;
                            if($sayfa < 1) $sayfa = 1;
                            if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                            $limit = ($sayfa - 1) * $sayfada;
                            $haberler = $db->select("SELECT * FROM haber WHERE icerik like '%".$keyword."%' order by tarih desc limit ".$limit.",".$sayfada);
                        ?>
                        <p style="font-size:12px;float:left;">
                            <span>
                                <?php echo $db->Cevirmen("aranan kelime ", $language_id, 1).": ".$keyword; ?>
                            </span>
                            <br />
                            <span>
                                <?php echo $db->Cevirmen("bulunan kayıt sayısı ", $language_id, 1).": ".$toplam_icerik; ?>
                            </span>
                        </p>
                        <?php }?>
                    </div>

                </div>

                <div class="widget  widget-latest-news" style="margin-top:65px;">
                    <div class="sidebar" role="complementary">
                        <div class="widget  widget_nav_menu">
                            <div class="menu-our-service-menu-container">
                                <ul id="menu-our-service-menu" class="menu">
                                    <?php
                                    $kategori_seo = $_GET["seo"];
                                    if(!$_POST){
                                        $params = array();
                                        if(!empty($kategori_seo)){
                                            array_push($params,$kategori_seo);
                                            $kategori = $db->select("SELECT *FROM haber_kategori WHERE seo = ?", $params);
                                        }
                                    }

                                    $haber_kategorileri = $db->select("SELECT *FROM haber_kategori ORDER BY sira ASC");
                                    foreach ($haber_kategorileri as $haber_kategori)
                                    {
                                        $select_class="";
                                        if($haber_kategori["seo"] == $kategori[0]["seo"]){ $select_class = "current-menu-item";}
                                    ?>

                                    <li id="left-nav-<?php echo $haber_kategori["id"]; ?>" class="sub-menu-nav-item menu-item menu-item-type-post_type menu-item-object-page <?php echo $select_class; ?>">
                                        <a id="nav-kategori-<?php echo $haber_kategori["id"]; ?>" href="/haber-kategori/<?php echo $haber_kategori["seo"]; ?>.html">
                                            <?php echo $db->Cevirmen($haber_kategori["ad"], $language_id, 1); ?>
                                        </a>
                                    </li>

                                    <?php }?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main id="main" class="site-main  col-xs-10  col-lg-8" role="main">
            <?php
            if(!$_POST){

                $params = array();
                array_push($params,$kategori[0]["id"]);

                $sayfada = 5;
                if(!empty($kategori_seo)){

                    $sorgu = $db->select('SELECT COUNT(*) AS toplam FROM haber WHERE kategori_id = ?', $params);
                }else
                {
                    $sorgu = $db->select('SELECT COUNT(*) AS toplam FROM haber');
                }

                $toplam_icerik = $sorgu[0]['toplam'];
                $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                $sayfa = isset($_GET['a_p']) ? (int) $_GET['a_p'] : 1;
                if($sayfa < 1) $sayfa = 1;
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                $limit = ($sayfa - 1) * $sayfada;

                if(!empty($kategori_seo)){
                    $haberler = $db->select('SELECT * FROM haber WHERE kategori_id = ? ORDER BY tarih DESC LIMIT '.$limit.', '.$sayfada, $params);
                }else
                {
                    $haberler = $db->select('SELECT * FROM haber ORDER BY tarih DESC LIMIT '.$limit.', '.$sayfada);

                }
            }

            if(count($haberler) == 0){
            ?>
            <br />
            <br />
            <br />
            <div style="text-align:center;">
                <?php echo $db->Cevirmen("bu alana henüz içerik eklenmedi.", $language_id, 1); ?>
                
            </div>
            <?php
            }

            foreach ($haberler as $haber)
            {
            ?>

            <article id="post-339" class="clearfix post-339 post type-post status-publish format-standard has-post-thumbnail sticky hentry category-interior-design category-real-estate category-renovation">
                <a href="/haberler/<?php echo $haber["seo"]; ?>.html">
                    <img src="/uploads/images/haber/<?php echo $haber["resim_yolu"]; ?>" width="100%" class="img-fluid  hentry__featured-image wp-post-image" alt="<?php echo $db->Cevirmen($haber["ad"], $language_id, 1); ?>" />
                </a>
                <div class="hentry__container">
                    <header class="hentry__header">
                        <time class="hentry__date" datetime="<?php echo $haber["tarih"]; ?>">
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
                        <h2 class="hentry__title">
                            <a href="/haberler/<?php echo $haber["seo"]; ?>.html" rel="bookmark">
                                <?php echo $db->Cevirmen($haber["ad"], $language_id, 1); ?>
                            </a>
                        </h2>
                    </header>
                    <div class="hentry__content  entry-content">
                        <div>
                            <?php
                $text = strip_tags($haber["icerik"]);
                $text = $db->Cevirmen($text, $language_id, 1);
                echo $db->myFunctions->textOverflow($text, 300);
                            ?>
                        </div>
                    </div>
                    <footer class="hentry__footer">
                        <div class="hentry__meta">
                            <div class="meta">

                                <?php
                                if(!empty($kategori[0]["ad"])){
                                ?>
                                <span class="meta__item  meta__item--categories">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <a href="/haber-kategori/<?php echo $kategori[0]["seo"]; ?>.html">
                                        <?php echo $db->Cevirmen($kategori[0]["ad"], $language_id, 1); ?>
                                    </a>
                                </span>
                                <?php } ?>


                                <span style="padding-left:10px;">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <?php echo $haber["okuma"]; ?> <?php echo $db->Cevirmen("görüntüleme", $language_id, 1); ?>
                                </span>


                                <a href="/haberler/<?php echo $haber["seo"]; ?>.html" class="btn btn-primary pull-right" style="color:#fff !important;">
                                    <?php echo $db->Cevirmen("devamını oku", $language_id, 1); ?>
                                </a>
                            </div>
                        </div>
                    </footer>
                </div>
            </article>

            <?php
            }
            ?>

            <nav class="navigation pagination" role="navigation">

                <div class="nav-links">
                    <?php
                    for($s = 1; $s <= $toplam_sayfa; $s++) {
                        if($sayfa == $s) {
                            echo '<span class="page-numbers current">'.$s.'</span>';
                        } else {
                            echo ' <a class="page-numbers" href="?a_p=' . $s . '">' . $s . '</a> ';
                        }
                    }
                    ?>
                </div>
            </nav>
        </main>
    </div>
</div>