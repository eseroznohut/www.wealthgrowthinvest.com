<?php
$referans_adi = $_GET["seo"];
?>
<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home"><?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?></a>
        </span>
        <span typeof="v:Breadcrumb">
            <span property="v:title"><?php echo $db->Cevirmen("referanslar", $language_id, 1); ?></span>
        </span>
    </div>
</div>

<div id="primary" class="content-area  container">
    <div class="row">
        <main id="main" class="site-main  col-xs-12  col-lg-9  col-lg-push-3" role="main">
            <article id="post-477" class="clearfix post-477 page type-page status-publish has-post-thumbnail hentry">
                <div class="hentry__content  entry-content">
                    <div id="pl-477">
                        <div class="panel-grid" id="pg-477-0">
                            <div class="panel-grid-cell" id="pgc-477-0-0">
                                <div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-477-0-0-0" data-index="0">
                                    <div class="so-widget-sow-editor so-widget-sow-editor-base">
                                        <div class="siteorigin-widget-tinymce textwidget">

                                            <style>
                                                .referans-list {
                                                    list-style:none;
                                                }
                                                .referans-list li {
                                                    width:100%;
                                                    height:auto;
                                                    overflow:hidden;
                                                    background-color:#f2f2f2;
                                                    margin-top:5px;
                                                    border-radius:5px;
                                                    padding:8px;
                                                    padding-left:15px;
                                                    cursor:pointer;
                                                    text-transform:capitalize;
                                                }
                                                    .referans-list li:nth-child(n+2):hover {
                                                        background-color: #ccc;
                                                        color: #fff;
                                                    }
                                            </style>


                                            <ul class="referans-list">
                                                <li><?php echo $db->Cevirmen("referans adı", $language_id, 1); ?></li>
                                                <?php
                                                if(!empty($referans_adi)){
                                                    $params = array();
                                                    array_push($params, $referans_adi);
                                                    $referans_kategori = $db->select("SELECT *FROM referans_kategori WHERE seo = ?", $params);

                                                    $params = array();
                                                    array_push($params, $referans_kategori[0]["id"]);

                                                    $referanslar = $db->select("SELECT *FROM referans WHERE kategori_id = ?", $params);
                                                }else{
                                                 	 $referanslar = $db->select("SELECT *FROM referans");
                                                }

                                                foreach ($referanslar as $referans)
                                                {
                                                ?>

                                                <li class="transition">
                                                    <?php echo $referans["ad"]; ?>
                                                </li>

                                                <?php } ?>

                                            </ul>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </main>
        <div class="col-xs-12  col-lg-3  col-lg-pull-9">
            <div class="sidebar" role="complementary">
                <div class="widget  widget_nav_menu">
                    <div class="menu-our-service-menu-container">
                        <ul id="menu-our-service-menu" class="menu">

                            <?php

                            $referans_kategorileri = $db->select("SELECT *FROM referans_kategori");
                            foreach ($referans_kategorileri as $referans_kategori)
                            {
                                $select_class="";
                                if($referans_kategori["seo"] == $referans_adi){ $select_class = "current-menu-item";}
                            ?>

                            <li id="left-nav-<?php echo $referans_kategori["id"]; ?>" class="sub-menu-nav-item menu-item menu-item-type-post_type menu-item-object-page <?php echo $select_class; ?>">
                                <a id="left-nav-sayfa-<?php echo $referans_kategori["id"]; ?>" href="/referans-kategori/<?php echo $referans_kategori["seo"]; ?>.html">
                                    <?php echo $db->Cevirmen($referans_kategori["ad"], $language_id, 1); ?>
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

<style>
    body {
        background-image: url(../assets/img/bg-3.jpg);
    }

</style>