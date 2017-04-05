<?php
$p = 1;
include_once('system/Database.php');

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title><?php echo $db->Cevirmen("YÖNETİM PANELİ", $language_id, 0); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <link type='text/css' href='http://cdn.datatables.net/plug-ins/1.10.12/integration/font-awesome/dataTables.fontAwesome.css' rel='stylesheet'>
    <link type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500' rel='stylesheet'>
    <link type='text/css' href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="assets/css/styles.css" type="text/css" rel="stylesheet">
    <link href="assets/plugins/codeprettifier/prettify.css" type="text/css" rel="stylesheet">
    <link href="assets/plugins/dropdown.js/jquery.dropdown.css" type="text/css" rel="stylesheet">
    <link href="assets/plugins/progress-skylo/skylo.css" type="text/css" rel="stylesheet">
    <!--[if lt IE 10]>
        <script src="assets/js/media.match.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <script src="assets/js/placeholder.min.js"></script>
    <![endif]-->
    <link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet">
    <link href="assets/plugins/fullcalendar/fullcalendar.css" type="text/css" rel="stylesheet">
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" type="text/css" rel="stylesheet">
    <link href="assets/less/card.less" type="text/css" rel="stylesheet">
    <link href="assets/plugins/chartist/dist/chartist.min.css" type="text/css" rel="stylesheet">
    <link href="assets/plugins/summernote/dist/summernote.css" type="text/css" rel="stylesheet"> 
    <link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" />    
    <link href="assets/plugins/pines-notify/pnotify.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/snackbar/snackbar.min.css" type="text/css" rel="stylesheet" /> 
    <link href="assets/plugins/form-parsley/parsley.css" rel="stylesheet" />
    <link href="assets/plugins/datatables/export/datatables.bootstrap.css" rel="stylesheet" />
    <link href="assets/plugins/form-select2/select2.css" rel="stylesheet" />

    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jqueryui-1.10.3.min.js"></script>
</head>
<body class="animated-content infobar-overlay">
    <?php
    if(!empty($_POST["islem"]))
    {
        if($_POST["islem"] == "mesaj_gonder")
        {
            $sendMail = $_POST["alici_eposta"];
            $subject = $_POST["alici_konu"];
            $message = $_POST["alici_mesaj"]; 
            $mail_sonuc = $db->MesajGonder(1, $sendMail,$subject,$message);
    ?>
    <script>
        $(function () {
            new PNotify({
                title: "<?php echo $mail_sonuc; ?>",
                type: 'info',
                delay: 10000,
                icon: 'fa fa-info-circle'
            });
        });
    </script>
    <?php       
        }
        if($_POST["islem"] == "mesaj_sil"){
            foreach ($_POST as $value)
            {
                $db->delete("mesaj", $value,"mesaj");
            }
        }
    ?>
    <?php    
        if(empty($settings[0]["url"]) || 
         empty($settings[0]["smtp_host"]) || 
         empty($settings[0]["smtp_username"]) || 
         empty($settings[0]["smtp_password"]) || 
         empty($settings[0]["smtp_secure"]) || 
         empty($settings[0]["smtp_authentication"]) || 
         empty($settings[0]["smtp_port"])){
    ?>
    <script>
        $(function () {
            $("#btnEpostaGonder").remove();
        });
    </script>
    <?php
        }
    }
    ?>
<!-- Mesaj Goster Modal -->
<div class="modal" id="mesajGosterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 id="lblMesajTitle" style="text-transform:uppercase;"><?php echo $db->Cevirmen("MESAJ", $language_id, 0); ?></h4>
                        <button type="button" data-id="" data-name="" class="btn btn-success btn-sm btn-raised btnMesajCevapla pull-right">
                            <?php echo $db->Cevirmen("Cevapla", $language_id, 0); ?>
                        </button>
                        <br />
                        <div class="table-responsive">
                            <div class="form-group">
                                <label class="col-sm-3 control-label lblGonderen">
                                    <?php echo $db->Cevirmen("Gönderen", $language_id, 0); ?>
                                </label>
                                <label class="col-sm-3 control-label lblAlici">
                                    <?php echo $db->Cevirmen("Alıcı", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-6" id="eposta" style="margin-top:13px;"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $db->Cevirmen("Konu", $language_id, 0); ?></label>
                                <div class="col-sm-6" id="konu" style="margin-top:13px;"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $db->Cevirmen("Mesaj", $language_id, 0); ?></label>
                                <div class="col-sm-9" id="mesaj"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Mesaj Goster Modal -->
<!-- Mesaj Gönder Modal -->
<div class="modal" id="epostaGonderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("EPOSTA", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Alıcı Eposta", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" multiple id="alici_eposta" name="alici_eposta" data-parsley-trigger="change" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Konu", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alici_konu" name="alici_konu" placeholder="Konu" data-parsley-trigger="change" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("İçerik", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <textarea name="alici_mesaj" id="alici_mesaj" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" value="mesaj_gonder" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-raised btn-primary"><?php echo $db->Cevirmen("Gönder", $language_id, 0); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Mesaj Gönder Modal -->
<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div id="page-progress-loader" class="hide"></div> 
        <div class="logo-area">
            <a class="navbar-brand navbar-brand-primary" href="?view=panel">
                <img class="show-on-collapse img-logo-white" alt="Paper" src="assets/img/logo-icon-white.png">
                <img class="show-on-collapse img-logo-dark" alt="Paper" src="assets/img/logo-icon-dark.png">
                <img class="img-white" alt="Paper" src="assets/img/logo-white.png">
                <img class="img-dark" alt="Paper" src="assets/img/logo-dark.png">
            </a>
            <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg stay-on-search">
                <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                    <span class="icon-bg">
                        <i class="material-icons">menu</i>
                    </span>
                </a>
            </span>
        </div>
        <ul class="nav navbar-nav toolbar pull-right">      
            <li class="dropdown toolbar-icon-bg notify">
                <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="material-icons">notifications</i></span><span class="badge badge-info new_notification_count_top"></span></a>
                <div class="dropdown-menu animated notifications">
                    <div class="topnav-dropdown-header">
                        <span class="new_notification_count_box"></span>
                    </div>
                    <div class="scroll-pane">
                        <ul class="media-list scroll-content">
                            <?php  
                            $languages = $db->select("select *from language where aktif = 1");
                            foreach ($languages as $language)
                            {
                            	$cevrilecek_kelime_sayisi = $db->CevirilecekKelimeSayisi($language["id"]);
                                $new_notification_count++;                                
                            ?>                           
                            <li class="media notification-warning">
                                <a href="#">
                                    <div class="media-left">
                                        <span class="notification-icon"><i class="material-icons">translate</i></span>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="notification-heading"><?php echo $db->Cevirmen($language["name"], $language_id, 0); ?> <?php echo $db->Cevirmen("diline çevirilmeyi bekleyen", $language_id, 0); ?> <?php echo $cevrilecek_kelime_sayisi; ?> <?php echo $db->Cevirmen("adet kelime var", $language_id, 0); ?>.</h4>
                                        <span class="notification-time"><?php echo $db->Cevirmen("Şimdi Çevir", $language_id, 0); ?></span>
                                    </div>
                                </a>
                            </li>  
                            <?php
                            }
                            ?>

                            <?php
                            $array = $db->select("select *from ziyaretci_telefon where goruldu = 0 limit 10");
                            foreach ($array as $value)
                            {
                                $new_notification_count++;
                            ?>
                                                        
                            <li class="media notification-success">
                                <a href="#">
                                    <div class="media-left">
                                        <span class="notification-icon"><i class="material-icons">phone</i></span>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="notification-heading"><?php echo $value["ad_soyad"]; ?> <?php echo $db->Cevirmen("isimli ziyaretçi telefon numarasını bıraktı", $language_id, 0); ?>.</h4>
                                        <span class="notification-time"><?php echo $value["tarih"]; ?></span>
                                    </div>
                                </a>
                            </li>                          
                            
                            <?php
                            }
                            ?>
                            
                            <?php
                            $array = $db->select("select *from ebulten where goruldu = 0 limit 10");
                            foreach ($array as $value)
                            {
                                $new_notification_count++;
                            ?>
                                                        
                            <li class="media notification-info">
                                <a href="#">
                                    <div class="media-left">
                                        <span class="notification-icon"><i class="material-icons">email</i></span>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="notification-heading">
                                        <?php echo $db->Cevirmen("bir ziyaretçi", $language_id, 0); ?> <?php echo $value["eposta"]; ?> <?php echo $db->Cevirmen("eposta adresi ile ebültene abone oldu", $language_id, 0); ?>.</h4>
                                        <span class="notification-time"><?php echo $value["tarih"]; ?></span>
                                    </div>
                                </a>
                            </li>                          
                            
                            <?php
                             }
                            ?>        
                        </ul>
                    </div>
                </div>
            </li>
            <li class="dropdown toolbar-icon-bg hidden-xs">
                <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'>
                    <span class="icon-bg"><i class="material-icons">mail</i></span><span id="newmsg-count" class="badge badge-info"></span>
                </a>
                <div class="dropdown-menu animated notifications">
                    <div class="topnav-dropdown-header">
                        <span id="newmsg-box"></span>
                    </div>
                    <div class="scroll-pane">
                        <ul class="media-list scroll-content">
                            <?php                            
                            $mesajlar = $db->select("select *from mesaj where gelengiden = 0 order by tarih asc limit 10");
                            $okunmamis_mesaj_sayisi = 0;
                            foreach ($mesajlar as $mesaj)
                            {
                                if($mesaj["okundu"] == 0){
                                    $okunmamis_mesaj_sayisi = $okunmamis_mesaj_sayisi+1;
                                    $class = "okunmadi";
                                }                                
                            ?>
                            <li class="media notification-message <?php echo $class; ?>">
                                <a href="#" class="btnMesajGoster" data-id="<?php echo $mesaj["id"]; ?>" data-name="<?php echo $mesaj["ad"]; ?>">
                                    <div class="media-body">
                                        <h4 class="notification-heading"><strong><?php echo $mesaj["ad"]; ?></strong> <span class="text-gray">‒ <?php echo $mesaj["konu"]; ?></span></h4>
                                        <span class="notification-time"><?php echo $mesaj["tarih"]; ?></span>
                                    </div>
                                </a>
                            </li> 
                            <?php
                            }?>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="?view=mesajlar"><?php echo $db->Cevirmen("Tüm mesajlar", $language_id, 0); ?></a>
                    </div>
                </div>
            </li>
            <li class="dropdown toolbar-icon-bg">
                <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="material-icons">more_vert</i></span></a>
                <div class="dropdown-menu">
                    <ul class="profile-list">  
                        <li class="">
                            <a href="?view=profil"><?php echo $db->Cevirmen("Profil", $language_id, 0); ?></a>
                        </li> 
                        <li class="">
                            <a href="?logout"><?php echo $db->Cevirmen("Çıkış", $language_id, 0); ?></a>
                        </li>   
                    </ul>
                </div>
            </li>
        </ul>


    <?php
    
    if($new_notification_count>0){

    ?>

<script>
    $(function () {

        $(".new_notification_count_box").html("<?php echo $new_notification_count;?> <?php echo $db->Cevirmen("yeni bildirim", $language_id, 0); ?>.");
        $(".new_notification_count_top").html("<?php echo $new_notification_count;?>");
    });
</script>

    <?php
    }
    ?>

        <script>
        exportButtons = false;
        $(function () {
            var notification_count = <?php echo $new_notification_count; ?>;
            if( notification_count == 0){
                $(".notify").remove();
            }

            $("#newmsg-count").html("<?php if($okunmamis_mesaj_sayisi > 0){ echo $okunmamis_mesaj_sayisi; } ?>");
            $('#newmsg-box').html("<?php echo $okunmamis_mesaj_sayisi; ?>" + " <?php echo $db->Cevirmen("yeni mesaj", $language_id, 0); ?>");

            $(".btnMesajGoster").click(function () {
                $(".lblGonderen").show();
                $(".lblAlici").show();
                var id = $(this).attr("data-id");
                var name = $(this).attr("data-name");
                $("#mesajGosterModal").modal("show");
                $("#mesaj_id").val(id);
                $("#gonderen_ad").val(name);
                $("#mesaj_id").val(id);
                $(this).parent().removeClass("okunmadi");
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { id: id, islem: 'select', modul: 'mesaj' },
                    url: 'system/ajax.php',
                    success: function (result) {
                        $("#ad").html(result[0]);
                        $("#eposta").html(result[1]);
                        $("#konu").html(result[2]);
                        $('#mesaj').html(result[3]);
                        

                        $("#lblMesajTitle").html(""+result[0] + "<span class='pull-right'><?php echo $db->Cevirmen("TARİH", $language_id, 0); ?> : " + result[4] + "</span>");
                        
                        
                        $(".btnMesajCevapla").show();
                        $(".btnMesajCevapla").attr("data-id", id);
                        $(".btnMesajCevapla").attr("data-name", name);
                        if (result[7] == 0) {
                            $('#newmsg-count').html("");
                            $('#newmsg-box').html("<?php echo $db->Cevirmen("Yeni mesaj yok", $language_id, 0); ?>");
                        } else {
                            $('#newmsg-count').html(result[7]);
                            $('#newmsg-box').html(result[7] + "<?php echo $db->Cevirmen("yeni mesaj", $language_id, 0); ?>");
                        }

                        if(result[9] == 1){
                            $(".btnMesajCevapla").hide();
                            $(".lblGonderen").hide();
                            $(".lblAlici").show();
                        }else{
                            $(".btnMesajCevapla").show();
                            $(".lblGonderen").show();
                            $(".lblAlici").hide();
                        }

                    },
                    error: function (a, b, c) {
                        alert(a.responseText, b.responseText, c.responseText);
                    }
                });
            });

            $(".btnMesajCevapla").click(function () {
                var id = $(this).attr("data-id");
                var name = $(this).attr("data-name");
                $("#epostaGonderModal").modal("show");
                $("#mesaj_id").val(id);
                $("#gonderen_ad").val(name);

                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { id: id, islem: 'select', modul: 'mesaj' },
                    url: 'system/ajax.php',
                    success: function (result) {
                        $("#ad").val(result[0]);
                        //$("#alici_eposta").val(result[1]);
                        var arr = [];
                        arr.push(result[1]);

                        $("#alici_eposta").select2({ width: "100%", tags: arr }).val(arr).trigger("change");
                        $("#alici_konu").val("RE :" + result[2]);
                        //$('.summernote').code(result[3]);
                        $("#lblMesajTitle").html("<?php echo $db->Cevirmen("YENİ MESAJ", $language_id, 0); ?> : " + result[0]);
                    },
                    error: function (a, b, c) {
                        alert(a.responseText, b.responseText, c.responseText);
                    }
                });
            });

            $("#btnEpostaGonder").click(function () {
                alici_eposta = [];
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var eposta = $(this).attr("data-eposta");
                        if (alici_eposta.indexOf(eposta) === -1) {
                            alici_eposta.push(eposta);
                        }
                    }
                });
                $("#alici_eposta").select2({ width: "100%", tags: alici_eposta }).val([alici_eposta]).trigger("change");
                $("#epostaGonderModal").modal("show");
            });



            $(".hasnotifications").click(function () {
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { islem: 'goruldu', modul: 'notification' },
                    url: 'system/ajax.php',
                    success: function () {
                        $(".new_notification_count_top").remove();
                    },
                    error: function (a, b, e) { alert(a.responseText); }
                });
            });

        });
        </script>
    </header>