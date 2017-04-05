<?php

$modul_adi = $_GET["modul"];

$params = array();
$modul_ceo = $db->myFunctions->turkce_karakter_temizle($modul_adi);
array_push($params, "agimiza-katilin");
$modul = $db->select("select *from modul where seo = ?",$params);
$modul_goruntuleme_sayisi =  $modul[0]["goruntuleme"] + 1;
$modul_goruntuleme_sayisi_update = $db->ModulGoruntulemeSayisiUpdate($modul_goruntuleme_sayisi,$modul[0]["id"]);

if($_POST){

    $db->JoinNetwork();
}

?>


<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home"><?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?></a>
        </span>
        <span typeof="v:Breadcrumb">
            <span property="v:title">
                <?php echo $db->Cevirmen($modul[0]["ad"], $language_id, 1); ?>
            </span>
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
                                        <div class="siteorigin-widget-tinymce textwidget join-network">
                                            <h1 class="page-title">
                                                <?php echo $db->Cevirmen("KÜRESEL AĞIMIZA KATILIN", $language_id, 1); ?>
                                            </h1>
                                            <p class="page-content">
                                                <?php echo $db->Cevirmen('<p class="MsoNormal" style="text-align:justify">WGI, alıcılar, satıcılar ve
gayrimenkul yatırımcılara satış ve danışmanlık hizmetleri sunan Dünya çapında
sürekli genişleyen uluslararası ofis ağını işletmektedir. Entegre, stratejik ve
uygun maliyetli satış ve pazarlama hizmetlerini yerine getirdiğimiz piyasaları
sürekli inceliyoruz.<o:p></o:p></p>

<p class="MsoNormal" style="text-align:justify">Yılların birikimi olan WGI
emlakçı ağımızın temsilcileri, dostça ve profesyonel yaklaşımları ile değer
biçme, ikamet amaçlı projeler ve ilgili tüm hukuki ve mali hizmetler konuları
dahil adanmış uzmanlık sunmaya heveslidir. WGI, benzer hedefleri olan ortakları
ve acenteleri memnuniyetle karşılıyor ve katılmaları için davet ediyor.
Ortaklarımız ve acentelerimizin attıkları her adımda kazanmalarını
sağlıyoruz.<o:p></o:p></p>', $language_id, 1); ?>
                                            </p>
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
                        <p><?php echo $db->Cevirmen("ağımıza katılın", $language_id, 1); ?></p>
                 
                       <form method="post">
                           <div class="form-group">
                               <input type="text" class="form-control" name="ad" placeholder="<?php echo $db->Cevirmen("Firma Adı", $language_id, 1); ?>"                                       
                                      data-parsley-trigger="change"                                   
                                      required="" />
                           </div>
                           <div class="form-group">
                               <input type="text" class="form-control" name="sektor" placeholder="<?php echo $db->Cevirmen("Sektör", $language_id, 1); ?>" 
                                      data-parsley-trigger="change"                                   
                                      required="" />
                           </div>
                           <div class="form-group">
                               <input type="text" class="form-control" name="yetkili" placeholder="<?php echo $db->Cevirmen("Yetkili Kişi", $language_id, 1); ?>" 
                                      data-parsley-trigger="change"                                   
                                      required="" />
                           </div>
                           <div class="form-group">
                               <input type="text" class="form-control" name="telefon" placeholder="<?php echo $db->Cevirmen("Yetkili Telefon", $language_id, 1); ?>" 
                                      data-parsley-trigger="change"                                   
                                      required="" />
                           </div>
                           <div class="form-group">
                               <input type="email" class="form-control" name="eposta" placeholder="<?php echo $db->Cevirmen("Eposta", $language_id, 1); ?>"
                                   data-parsley-trigger="change"
                                   required="" />
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-default" style="width:100% !important;font-size:18px;color:#ffffff;"><?php echo $db->Cevirmen("Gönder", $language_id, 1); ?></button>
                           </div>
                       </form>
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

    ::-webkit-input-placeholder {
        text-transform: capitalize;
        color: #cccccc;
        font-size:14px;
    }

    ::-moz-placeholder {
        text-transform: capitalize;
        color: #cccccc;
        font-size: 14px;
    }
    /* firefox 19+ */
    :-ms-input-placeholder {
        text-transform: capitalize;
        color: #cccccc;
        font-size: 14px;
    }
    /* ie */
    input:-moz-placeholder {
        text-transform: capitalize;
        color: #cccccc;
        font-size: 14px;
    }

    .menu-our-service-menu-container p {
        color:#999999;
        font-size:20px;
        padding:5px;
        padding-left:20px;
        text-transform:uppercase;

    }
</style>

<?php $title = $db->Cevirmen("KÜRESEL AĞIMIZA KATILIN", $language_id, 1); ?>