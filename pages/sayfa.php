<?php
$sayfa_adi = $_GET["sayfa"];
$modul_adi = $_GET["modul"];



$params = array();
$modul_ceo = $db->myFunctions->turkce_karakter_temizle($modul_adi);
array_push($params, $modul_ceo);
$modul = $db->select("select *from modul where seo = ?",$params);
$modul_goruntuleme_sayisi =  $modul[0]["goruntuleme"] + 1;
$modul_goruntuleme_sayisi_update = $db->ModulGoruntulemeSayisiUpdate($modul_goruntuleme_sayisi,$modul[0]["id"]);


$params = array();


if(empty($sayfa_adi)){
    array_push($params, $modul[0]["id"]);
    $sayfa = $db->select("select *from sayfa where modul_id = ?", $params);
    $sayfa_adi = $sayfa[0]["seo"];
}else
{
    array_push($params, $sayfa_adi);
    $sayfa = $db->select("select *from sayfa where seo = ?", $params);
}

$sayfa_goruntuleme_sayisi =  $sayfa[0]["goruntuleme"] + 1;
$sayfa_goruntuleme_sayisi_update = $db->SayfaGoruntulemeSayisiUpdate("sayfa",$sayfa_goruntuleme_sayisi,$sayfa[0]["id"]);



?>

<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home"><?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?></a>
        </span>
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/<?php echo $modul[0]["seo"]; ?>.html" class="post post-page">
                <?php echo $db->Cevirmen($modul[0]["ad"], $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span property="v:title"><?php
            echo $db->Cevirmen($sayfa[0]["ad"], $language_id, 1);
            $title = $db->Cevirmen($sayfa[0]["ad"], $language_id, 1); ?></span>
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

              
                                            <h1 class="page-title">
                                                <?php echo $db->Cevirmen($sayfa[0]["ad"], $language_id, 1); ?>
                                            </h1>
                                            <div class="page-content">
                                                <?php echo $db->Cevirmen($sayfa[0]["icerik"], $language_id, 1); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </main>
        <div class="col-xs-12  col-lg-3  col-lg-pull-9 sub-page-left-block">
            <div class="sidebar" role="complementary">
                <div class="widget  widget_nav_menu">
                    <div class="menu-our-service-menu-container">


                        <?php

                        if($modul[0]["seo"] == "kurumsal"){


                        if(!empty($sayfa[0]["resim_yolu"])){
                        ?>
                        <img src="/uploads/images/sayfa/<?php echo $sayfa[0]["resim_yolu"]; ?>" alt="<?php echo $sayfa[0]["ad"]; ?>" />
                        <br />
                        <br />
                        <br />
                        <?php } 
                        
                        }

                        if($modul[0]["seo"] != "kurumsal"){

                        ?>


                        <ul id="menu-our-service-menu" class="menu">

                            <?php
                            $params = array();
                            array_push($params, $modul[0]["id"]);
                 
                            $sayfalar = $db->select("SELECT *FROM sayfa WHERE modul_id = ? order by sira asc", $params);
                            foreach ($sayfalar as $sayfa)
                            {
                                $select_class="";
                                if($sayfa["seo"] == $sayfa_adi){ $select_class = "current-menu-item";}

                            ?>

                            <li id="left-nav-<?php echo $sayfa["id"]; ?>" class="sub-menu-nav-item menu-item menu-item-type-post_type menu-item-object-page <?php echo $select_class; ?>">
                                <a id="left-nav-sayfa-<?php echo $sayfa["id"]; ?>" href="/<?php echo $modul[0]["seo"]; ?>/<?php echo $sayfa["seo"]; ?>.html">
                                    <?php echo $db->Cevirmen($sayfa["ad"], $language_id, 1); ?>
                                </a>
                            </li>

                            <?php
                            }?>
                          
                        </ul>
                        <?php } ?>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
