<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span id="current_page" property="v:title">
                <?php echo $db->Cevirmen("projeler", $language_id, 1);
                      $title = $db->Cevirmen("projeler", $language_id, 1);
                ?>
            </span>
        </span>
    </div>
</div>


<script>
    $(function () {
        $(".portfolio-grid__nav-item").click(function () {
            $("#current_page").html($(this).find("a").html());
        });
    });
</script>

<div id="primary" class="content-area  container">
    <div class="row">
        <main id="main" class="site-main  col-xs-12" role="main">
            <article id="post-269" class="clearfix post-269 page type-page status-publish hentry">
                <div class="hentry__content  entry-content">
                    <div id="pl-269">
                        <div class="panel-grid" id="pg-269-0">
                            <div class="panel-grid-cell" id="pgc-11-1-0">
                                <div class="so-panel widget widget_pw_portfolio_grid widget-portfolio-grid panel-first-child panel-last-child" id="panel-11-1-0-0" data-index="6">
                                    <div class="portfolio-grid  portfolio-grid--grid" data-type="grid">

                                        <?php

                                        $proje_kategorileri = $db->select("SELECT *FROM proje_kategori WHERE aktif = 1 ORDER BY sira asc");
                                        $projeler = $db->select("select id from proje");
                                        if(count($proje_kategorileri)> 0 && count($projeler) > 0){
                                        ?>
                                        
                                        <nav class="portfolio-grid__header">
                                            <a href="#" class="portfolio-grid__mobile-filter  js-filter  btn  btn-primary  btn-sm  hidden-lg-up">
                                                <span class="fa  fa-filter"></span>&nbsp;<?php echo $db->Cevirmen("filtre", $language_id, 1); ?>
                                            </a>
                                            <ul class="portfolio-grid__nav  js-wpg-nav-holder">
                                                <li class="portfolio-grid__nav-item  is-active">
                                                    <a href="" data-category="*" class="portfolio-grid__nav-link js-wpg-nav">
                                                        <?php echo $db->Cevirmen("tüm projeler", $language_id, 1); ?>
                                                    </a>
                                                </li>
                                                <?php
                                                
                                                foreach ($proje_kategorileri as $proje_kategori)
                                                {
                                                ?>
                                                <li class="portfolio-grid__nav-item">
                                                    <a href="" data-category="c<?php echo $proje_kategori["id"]; ?>" class="portfolio-grid__nav-link  js-wpg-nav">
                                                        <?php echo $db->Cevirmen($proje_kategori["ad"], $language_id, 1); ?>
                                                    </a>
                                                </li>
                                                <?php }?>
                                            </ul>
                                        </nav>
                                        <div class="js-wpg-items">
                                            <?php
                                            $i = 0;
                                            foreach ($proje_kategorileri as $proje_kategori)
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

