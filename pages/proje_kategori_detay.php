<?php
$kategori_adi_seo = $_GET["seo"];

$params = array();
array_push($params, $kategori_adi_seo);
$secilen_kategori = $db->select("select *from proje_kategori where aktif = 1 and seo = ?", $params)[0];

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
            <span property="v:title">
                <?php echo $db->Cevirmen($secilen_kategori["ad"], $language_id, 1);
                      $title = strtoupper($db->Cevirmen($secilen_kategori["ad"], $language_id, 1)); ?>
            </span>
        </span>
    </div>
</div>



<div id="primary" class="content-area  container">
    <div class="row">
        <main id="main" class="site-main  col-xs-12" role="main">
            <article id="post-269" class="clearfix post-269 page type-page status-publish hentry">
                <div class="hentry__content  entry-content">
                    <div id="pl-269">
                        <div class="panel-grid" id="pg-269-0">
                            <div class="panel-grid-cell" id="pgc-11-1-0">
                                <div class="so-panel widget widget_pw_portfolio_grid widget-portfolio-grid panel-first-child panel-last-child" id="panel-11-1-0-0" data-index="6">

                                    <?php

                                    $params = array();
                                    array_push($params, $secilen_kategori["id"]);
                                    $projeler = $db->select("select id from proje where kategori_id = ?", $params);


                                    if(count($projeler) > 0){
                                    ?>
                                    <h1 class="page-title" style="padding-bottom:5px;">
                                        <?php echo $db->Cevirmen($secilen_kategori["ad"], $language_id, 1); ?>
                                    </h1>
                                    <hr />
                                    <div class="portfolio-grid  portfolio-grid--grid" data-type="grid" style="margin-top:10px;margin-bottom:10px;">



                                        <div class="js-wpg-items">
                                            <?php
                                            $i = 0;
                                            foreach ($secilen_kategori as $proje_kategori)
                                            {
                                                $i++;
                                                if($i == 1){ $aktif = "active"; }else{ $aktif = ""; }
                                            ?>
                                            <div class="carousel-item <?php echo $aktif;?>">
                                                <?php
                                                $params = array();
                                                array_push($params, $proje_kategori["id"]);
                                                $projeler = $db->select("SELECT *FROM proje WHERE kategori_id = ? and aktif = 1", $params);
                                                foreach ($projeler as $proje)
                                                {
                                                ?>
                                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 js-wpg-item" data-categories="c<?php echo $proje["kategori_id"]; ?>">
                                                    <a class="card portfolio-grid__card js-wpg-card" href="/proje-detay/<?php echo $proje["seo"]; ?>.html">
                                                        <img width="360" height="240" src="/uploads/images/proje/<?php echo $proje["resim_yolu"]; ?>" class="card-img-top  portfolio-grid__card-img wp-post-image" alt="<?php echo $db->Cevirmen($proje["ad"], $language_id, 1); ?>" />
                                                        <div class="card-block  portfolio-grid__card-block">
                                                            <h5 class="card-title  portfolio-grid__card-title">
                                                                <?php echo $db->Cevirmen($proje["ad"], $language_id, 1); ?>
                                                            </h5>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php }?>


                                        </div>

                                        <?php }else
                                              {
                                                  echo "<br/>"; echo "<br/>"; echo "<br/>";
                                            echo $db->Cevirmen("bu alana henüz içerik eklenmedi.", $language_id, 1);

                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </main>
    </div>
</div>

