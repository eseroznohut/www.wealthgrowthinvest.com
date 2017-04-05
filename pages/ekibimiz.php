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
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/<?php echo $modul[0]["seo"]; ?>.html" class="post post-page">
                <?php echo $db->Cevirmen($modul[0]["ad"], $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span property="v:title">
                <?php
                if($sayfa_adi =="yonetim" ){
                    echo $db->Cevirmen("yönetim kurulu", $language_id, 1);
                }else{
                    echo $db->Cevirmen($sayfa[0]["ad"], $language_id, 1);
                }
                ?>
            </span>
        </span>
    </div>
</div>

<div id="primary" class="content-area  container">
    <div class="row">
        <main id="main" class="site-main  col-xs-12  col-lg-9 col-lg-push-3" role="main" style="padding:0px;">
            <article id="post-477" class="clearfix post-477 page type-page status-publish has-post-thumbnail hentry">
                <div class="hentry__content  entry-content">
                    <div id="pl-477">
                        <div class="panel-grid" id="pg-477-0">
                            <div class="panel-grid-cell" id="pgc-477-0-0">
                                <div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-477-0-0-0" data-index="0">
                                    <div class="so-widget-sow-editor so-widget-sow-editor-base">
                                        <div class="siteorigin-widget-tinymce textwidget">
                                            <?php
                                            if(empty($sayfa[0]["seo"])){
                                            ?>
                                            <h1 class="page-title">
                                                <?php
                                                echo $db->Cevirmen("yönetim kurulu", $language_id, 1);
                                                $title =  $db->Cevirmen("yönetim kurulu", $language_id, 1);
                                                ?>
                                            </h1>
                                            <hr />
                                            <div style="margin-top:5px;padding-top:5px;">

                                                <style type="text/css">
                                                    .ad {
                                                        text-transform: capitalize;
                                                        padding-left: 10px;
                                                    }

                                                    .unvan {
                                                        text-transform: capitalize;
                                                        padding-left: 10px;
                                                    }

                                                    .personel-list {
                                                        list-style: none;
                                                        padding: 0px;
                                                        margin: 0px;
                                                    }

                                                        .personel-list li {
                                                            list-style: none;
                                                            margin-left: 0px;
                                                        }

                                                            .personel-list li:first-child {
                                                                margin-left: 0px;
                                                            }

                                                    .bg1 {
                                                        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#eeeeee+0,cccccc+100;Gren+3D */
                                                        background: rgb(238,238,238); /* Old browsers */
                                                        background: -moz-linear-gradient(top, rgba(238,238,238,1) 0%, rgba(204,204,204,1) 100%); /* FF3.6-15 */
                                                        background: -webkit-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Chrome10-25,Safari5.1-6 */
                                                        background: linear-gradient(to bottom, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                                                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
                                                    }
                                                </style>

                                                <?php
                                                $personeller = $db->select("SELECT *FROM ekip WHERE kategori_id = 2 and aktif = 1 ORDER BY sira ASC");
                                                foreach ($personeller as $personel)
                                                {
                                                ?>


                                                <div class="panel-grid-cell col-md-4 personel" id="pgc-36-1-0" style="margin-top:20px;">
                                                    <div class="so-panel widget widget_pw_person_profile widget-person-profile panel-first-child panel-last-child" id="panel-36-1-0-0" data-index="6">
                                                        <div class="card  person-profile">
                                                            <img class="person-profile__image wp-post-image"
                                                                src="/uploads/images/ekip/<?php echo $personel["resim_yolu"]; ?>"
                                                                alt="<?php echo $personel["ad"]; ?>"
                                                                width="100%" />

                                                            <div class="card-block  person-profile__container">
                                                                <!--<div class="person-profile__social-icons">-->
                                                                    <!--<span style="opacity:0;">xx</span>-->
                                                                    <!--<a class="person-profile__social-icon" href="https://www.facebook.com/ProteusThemes/" target="_blank">
                                                                        <i class="fa  fa-facebook-square"></i>
                                                                    </a>

                                                                    <a class="person-profile__social-icon" href="https://twitter.com/ProteusThemes" target="_blank">
                                                                        <i class="fa  fa-twitter-square"></i>
                                                                    </a>

                                                                    <a class="person-profile__social-icon" href="https://www.youtube.com/user/ProteusNetCompany" target="_blank">
                                                                        <i class="fa  fa-youtube-square"></i>
                                                                    </a>

                                                                    <a class="person-profile__social-icon" href="https://github.com/ProteusThemes" target="_blank">
                                                                        <i class="fa  fa-github-square"></i>
                                                                    </a>-->

                                                                <!--</div>-->
                                                                <div class="person-profile__content">
                                                                    <span class="person-profile__tag">
                                                                        <?php echo $personel["ad"]; ?>                                                                       
                                                                    </span>
                                                                    <h4 class="card-title  person-profile__name">
                                                                        <?php echo $db->Cevirmen($personel["gorev"], $language_id, 1); ?>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>





                                                <?php } ?>



                                            </div>


                                            <?php
                                            }else
                                            {


                                                if($sayfa[0]["seo"] == "ceo-nun-mesaji"){
                                            ?>


                                            <?php
                                                    if(!empty($sayfa[0]["resim_yolu"])){
                                            ?>
                                            <img src="/uploads/images/sayfa/<?php echo $sayfa[0]["resim_yolu"]; ?>" alt="<?php echo $sayfa["ad"]; ?>" />
                                            <br />
                                            <br />
                                            <br />
                                            <?php } ?>

                                            <div class="page-content" style="margin-top:0px;padding-top:0px;">
                                                <div class="col-md-7 ceo_content">

                                                    <h1 class="page-title">
                                                        <?php echo $db->Cevirmen($sayfa[0]["ad"], $language_id, 1);
                                                              $title =  $db->Cevirmen($sayfa[0]["ad"], $language_id, 1);?>

                                                        <br />
                                                    </h1>
                                                    <div class="page-content">
                                                        <?php echo $db->Cevirmen($sayfa[0]["icerik"], $language_id, 1); ?>
                                                    </div>
                                                </div>
                                                <div class="ceo_img col-md-5">
                                                    <img src="/assets/img/ceo_bw.jpg" alt="<?php echo $sayfa[0]["ad"]; ?>" />
                                                </div>
                                            </div>
                                            <?php
                                                }else
                                                {

                                            if(!empty($sayfa[0]["resim_yolu"])){
                                            ?>
                                            <img src="/uploads/images/sayfa/<?php echo $sayfa[0]["resim_yolu"]; ?>" alt="<?php echo $sayfa["ad"]; ?>" />
                                            <br />
                                            <br />
                                            <br />
                                            <?php } ?>
                                            <h1 class="page-title">
                                                <?php echo $db->Cevirmen($sayfa[0]["ad"], $language_id, 1); ?>
                                            </h1>
                                            <p class="page-content icerik">
                                                <?php echo $db->Cevirmen($sayfa[0]["icerik"], $language_id, 1); ?>
                                            </p>

                                            <?php
                                                }
                                            }
                                            ?>
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
                            $params = array();
                            array_push($params, $modul[0]["id"]);
                            $sayfalar = $db->select("SELECT *FROM sayfa WHERE modul_id = ?", $params);
                            foreach ($sayfalar as $sayfa)
                            {
                                $select_class="";
                                if($sayfa["seo"] == $sayfa_adi){ $select_class = "current-menu-item";}
                            ?>
                            <li id="left-nav-<?php echo $sayfa["id"]; ?>" class="sub-menu-nav-item menu-item menu-item-type-post_type menu-item-object-page <?php echo $select_class; ?>">
                                <a id="left-nav-sayfa-<?php echo $sayfa["id"]; ?>" href="/<?php echo strtolower($db->myFunctions->turkce_karakter_temizle($modul[0]["ad"])); ?>/<?php echo strtolower($db->myFunctions->turkce_karakter_temizle($sayfa["ad"])); ?>.html">
                                    <?php echo $db->Cevirmen($sayfa["ad"], $language_id, 1); ?>
                                </a>
                            </li>
                            <?php
                            }
                            $select_class="";
                            if($sayfa_adi == "yonetim"){ $select_class="current-menu-item"; }
                            ?>
                            <li id="left-nav-98567" class="sub-menu-nav-item menu-item menu-item-type-post_type menu-item-object-page <?php echo $select_class; ?>">
                                <a id="left-nav-sayfa-98567" href="/ekibimiz/yonetim.html">
                                    <?php echo $db->Cevirmen("yönetim kurulu", $language_id, 1); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>