
<div class="static-content">
    <div class="page-content">
        <ol class="breadcrumb">
            <li></li>
        </ol>
        <div class="container-fluid">
            <div data-widget-group="group1">
                <div class="row" style="display:none;">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-success">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Bugünkü Ziyaretçiler", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body ">
                                    <span>
                                        <?php
                                        $sayi = $db->GunlukZiyaretciSayisi();
                                        echo $sayi;
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <div id="dashboard-sparkline-success"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-primary clearfix">
                            <div class="info">
                                <div class="tile-heading">
                                    <span>
                                        <?php echo $db->Cevirmen("Dünkü Ziyaretçiler", $language_id, 0); ?>
                                    </span>
                                </div>
                                <div class="tile-body ">
                                    <span>
                                    <?php
                                        $sayi = $db->DunkuZiyaretciSayisi();
                                        echo $sayi;
                                    ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <div id="dashboard-sparkline-primary"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-indigo">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Toplam Tekil Ziyaretçi", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        $sayi = $db->tekilZiyaretciSayisi();
                                        echo $sayi;
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <div id="dashboard-sparkline-indigo"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-danger">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Toplam Sayfa Görüntüleme", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body ">
                                    <span>
                                        <?php
                                        $sayi = $db->sayfaGoruntulemeSayisi();
                                        echo $sayi;
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <div id="dashboard-sparkline-gray"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="display:none;">

                    <?php
                    $goruntulenen_sayfalar_class = "col-md-6";
                    $islem_gecmisi_class ="col-md-6";
                    $ziyaretci_girisleri_class = "col-md-6";

                    if($settings[0]["google_analystic_aktif"] == 1){
                        $goruntulenen_sayfalar_class = "col-md-4";
                        $islem_gecmisi_class ="col-md-8";
                        $ziyaretci_girisleri_class = "col-md-4";
                    ?>

                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel-white" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="panel-heading">
                                <h2 class="basliklar">
                                    <?php echo $db->Cevirmen("Bölgelere göre ziyaretçi dağılımı", $language_id, 0); ?> 
                                </h2>
                            </div>
                            <div class="panel-body">
                                <div id="mapBox">
                                    <div id="up" class="highcharts-button"></div>
                                    <div class="selector">
                                        <select id="mapDropdown"></select>
                                    </div>
                                    <div id="container"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    <div class="<?php echo $goruntulenen_sayfalar_class; ?>">
                        <div class="panel panel-default">
                            <div class="p-md">
                                <h4 class="mb-n" style="color: #9e9e9e;">
                                    <?php echo $db->Cevirmen("GÖRÜNTÜLENEN SAYFALAR", $language_id, 0); ?>
                                </h4>
                            </div>
                            <div class="panel-body no-padding table-responsive scroll" style="max-height:558px !important; height: 558px !important;">
                                <div class="list-group my-list-group">
                                    <div>
                                        <?php
                                    $sayfalar = $db->select("select *from sayfa order by goruntuleme desc, modul_id desc");
                                    foreach ($sayfalar as $sayfa)
                                    {
                                        ?>
                                        <div data-id="<?php echo $sayfa["goruntuleme"]; ?>" class="list-group-item my-list-group-item withripple">
                                            <div class="row-action-primary">
                                                <div class="progress-pie-chart" data-percent="<?php echo $sayfa["goruntuleme"]; ?>"></div>
                                            </div>
                                            <div class="row-content">
                                                <h4 class="list-group-item-heading my-list-group-item-heading">
                                                    <?php echo $db->Cevirmen($sayfa["ad"], $language_id, 0); ?>
                                                    <small>
                                                        <?php echo $sayfa["goruntuleme"]; ?><?php echo $db->Cevirmen("Görüntüleme", $language_id, 0); ?>
                                                    </small>
                                                </h4>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    $moduller = $db->select("select *from modul where gizli = 1 order by goruntuleme desc");
                                    foreach ($moduller as $modul)
                                    {
                                        if($modul["seo"] != "projeler"){
                                        ?>
                                        <div data-id="<?php echo $modul["goruntuleme"]; ?>" class="list-group-item my-list-group-item withripple">
                                            <div class="row-action-primary">
                                                <div class="progress-pie-chart" data-percent="<?php echo $modul["goruntuleme"]; ?>"></div>
                                            </div>
                                            <div class="row-content">
                                                <h4 class="list-group-item-heading my-list-group-item-heading">
                                                    <?php echo $db->Cevirmen($modul["ad"], $language_id, 0); ?>
                                                    <small>
                                                        <?php echo $modul["goruntuleme"]; ?><?php echo $db->Cevirmen("Görüntüleme", $language_id, 0); ?>
                                                    </small>
                                                </h4>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                     
                    <!--<div class="<?php echo $islem_gecmisi_class; ?>">
                        <div class="panel panel-default" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="panel-body no-padding table-responsive">
                                <div class="p-md">
                                    <h4 class="mb-n">
                                        <?php echo $db->Cevirmen("İŞLEM GEÇMİŞİ", $language_id, 0); ?>
                                    </h4>
                                </div>
                                <div class="panel-content scroll" style="height:233px;">
                                    <div id="islem-gecmisi-data-yok" style="margin:0 auto;width:170px;">Görüntülenecek işlem yok.</div>
                                    <?php
                                    $kullanici_id = $_SESSION["id"];


                                    if($db->izinKontrol(0,"islem_log") == 0){
                                        $params = array();
                                        array_push($params, $kullanici_id);
                                        $audits = $db->select("SELECT *FROM audit WHERE kullanici_id = ? order by id desc LIMIT 100",$params);
                                    }else
                                    {
                                        $audits = $db->select("SELECT *FROM audit order by id desc LIMIT 100");
                                    }


                                    foreach ($audits as $audit)
                                    {
                                        $params = array();
                                        array_push($params, $audit["modul_id"]);
                                        $modul = $db->select("select *from panel_modul where id = ?",$params);
                                    ?>
                                    <script>$(function () { $("#islem-gecmisi-data-yok").remove(); })</script>
                                    <div id="audit-<?php echo $audit["id"]; ?>" class="list-group-item withripple">
                                        <div class="row-content">
                                            <h4 class="list-group-item-heading">
                                                <a href="?view=<?php echo $modul[0]["href"]; ?>&id=<?php echo $audit["kayit_id"]; ?>">
                                                    <span>
                                                        <i class="material-icons">history</i>
                                                    </span>
                                                    <span style="font-size:15px;">
                                                        <?php echo $audit["tarih"]." ".$audit["saat"]; ?>
                                                    </span>
                                                </a>
                                            </h4>
                                            <small style="padding-left:25px;font-size:13px;">
                                                <?php
                                                if($_SESSION["id"] != $audit["kullanici_id"]){
                                                    $params = array();
                                                    array_push($params, $audit["kullanici_id"]);
                                                    $kullanici = $db->select("select id,username from users where id = ?",$params);
                                                    $kullanici_adi = $kullanici[0]["username"]." ".$db->Cevirmen("kullanıcısı", $language_id);
                                                }

                                                switch ($audit["islem"])
                                                {
                                                    case 'Insert':

                                                        if($_SESSION["id"] != $audit["kullanici_id"]){
                                                            echo $kullanici_adi."".$db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("ekledi", $language_id);
                                                        }else{
                                                            echo $db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("eklediniz", $language_id);
                                                        }

                                                        break;
                                                    case 'Update':

                                                        if($_SESSION["id"] != $audit["kullanici_id"]){
                                                            echo $kullanici_adi." ".$db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("güncelledi.", $language_id);
                                                        }else{
                                                            echo $db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("güncellediniz.", $language_id);
                                                        }

                                                        break;
                                                    case 'Delete':

                                                        if($_SESSION["id"] != $audit["kullanici_id"]){
                                                            echo $kullanici_adi." ".$db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("sildi.", $language_id);
                                                        }else{
                                                            echo $db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("sildiniz.", $language_id);
                                                        }

                                                        break;
                                                    case 'Login':

                                                        if($_SESSION["id"] != $audit["kullanici_id"]){
                                                            echo $db->Cevirmen($audit["aciklama"], $language_id);
                                                        }else{
                                                            echo $db->Cevirmen("panele giriş yaptınız.", $language_id);
                                                        }

                                                        break;

                                                    case 'Logout':

                                                        if($_SESSION["id"] != $audit["kullanici_id"]){
                                                            echo $db->Cevirmen($audit["aciklama"], $language_id);
                                                        }else{
                                                            echo $db->Cevirmen("panelden çıktınız.", $language_id);
                                                        }

                                                        break;

                                                    case 'Eposta':
                                                        if($_SESSION["id"] != $audit["kullanici_id"]){
                                                            echo $kullanici_adi." ".$db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("gönderdi.", $language_id);
                                                        }else{
                                                            echo $db->Cevirmen($audit["aciklama"], $language_id)." ".$db->Cevirmen("gönderdiniz.", $language_id);
                                                        }
                                                        break;
                                                }

                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="list-group-separator"></div>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>-->




                    <!--<div class="<?php echo $ziyaretci_girisleri_class; ?>">
                        <div class="panel panel-default" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="panel-body no-padding table-responsive">
                                <div class="p-md">
                                    <h4 class="mb-n">
                                        <?php echo $db->Cevirmen("ZİYARETÇİ GİRİŞLERİ", $language_id, 0); ?>
                                    </h4>
                                </div>
                                <div class="panel-content scroll" style="height:233px;">
                                    <?php
                                    $visitors = $db->select("SELECT *FROM visitors order by date desc LIMIT 100");
                                    foreach ($visitors as $visitor)
                                    {
                                    ?>
                                    <div class="list-group-item withripple">
                                        <div class="row-content">
                                            <h4 class="list-group-item-heading">
                                                <?php echo $db->Cevirmen("IP ADRESİ", $language_id, 0); ?> : <?php echo $visitor["ip"]; ?>
                                            </h4>
                                            <p class="list-group-item-text">
                                                <?php echo $db->Cevirmen("TARİH", $language_id, 0); ?> :<?php echo $visitor["date"]; ?> | <?php echo $db->Cevirmen("GİRİŞ SAYISI", $language_id, 0); ?> : <?php echo $visitor["giris_sayisi"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="list-group-separator"></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-danger" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Modüller", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->ModulSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">view_module</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-indigo" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Sayfalar", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->SayfaSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">pages</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-lime" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Slaytlar", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->SlaytSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">star_border</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-purple" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Fotoğraflar", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->FotografSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">add_a_photo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-teal" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Haberler", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->HaberSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">comment</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-orange" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Mesajlar", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        $okunan = $db->mesajSayisi(1);
                                        $okunmayan = $db->mesajSayisi(2);
                                        $toplam = $okunan + $okunmayan;
                                        echo $toplam." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">mail</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-info" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("Telefon Numaraları", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->TelefonNumaralariSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">contact_phone</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-gray" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span><?php echo $db->Cevirmen("E-Bülten", $language_id, 0); ?></span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->EbultenSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">perm_contact_calendar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-brown" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span>
                                        <?php echo $db->Cevirmen("Yöneticiler", $language_id, 0); ?>
                                    </span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->YoneticiSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">accessibility</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-tile info-tile-alt tile-blue" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                            <div class="info">
                                <div class="tile-heading">
                                    <span>
                                        <?php echo $db->Cevirmen("Diller", $language_id, 0); ?>
                                    </span>
                                </div>
                                <div class="tile-body">
                                    <span>
                                        <?php
                                        echo $db->DilSayisi()." ".$db->Cevirmen("Adet", $language_id);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="stats">
                                <div class="tile-content">
                                    <span class="material-icons tile-icon">translate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="display:none;">
              
                </div>
            </div>
        </div>
    </div>
</div>

<div class="itemss"></div>

<link href="assets/plugins/mscroller/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.js"></script>

<script>
    $(document).ready(function () {

        $(".row").css({ "display":"block" });

        $(".scroll").mCustomScrollbar({
            theme: "dark"
        });

        var arr = [];
        $(".my-list-group-item").each(function () {
            arr.push($(this).attr("data-id"));

        });

        arr.sort(function (a, b) { return a - b; });

        for (var i = 0; i < arr.length; i++) {
            $(".my-list-group-item[data-id='" + arr[i] + "']").prependTo(".itemss");
        }

        $(".my-list-group-item").each(function () {
            $(this).appendTo(".my-list-group").append('<div class="list-group-separator"></div>');

        });


        $(".my-list-group-item-heading").each(function () {
            $(this).html(BasHarfBuyuk($(this).html()));
        });
    });
</script>