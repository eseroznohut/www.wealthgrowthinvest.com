<?php
$ekle = $db->izinKontrol(16,"ekle");
$sil = $db->izinKontrol(16,"sil");
$duzenle = $db->izinKontrol(16,"duzenle");
$guncelle = $db->izinKontrol(16,"guncelle");

if($ekle == true){
?>
<?php
}else{
?>
<script>$(function () { $(".btnEkle").remove(); })</script>
<?php
}

if($sil == true){
?>
<?php
}else{
?>
<script>$(function () { $(".btnSil").remove(); })</script>
<?php
}

if($duzenle == true){
?>
<?php
}else{
?>
<script>$(function () { $(".btnDuzenle").remove(); })</script>
<?php
}

if($guncelle == true){
?>
<?php
}else{
?>
<script>$(function () { $(".btnGuncelle").remove(); })</script>
<?php
}
?>


<?php
if($_POST){
    $aktif_tab = $_POST["aktif_tab"];
}

if($_POST["islem"] == "segment_ekle"){
    $db->OrtakSegmentEkle();
}
if($_POST["islem"] == "segment_guncelle"){
    $db->OrtakSegmentGuncelle();
}
if($_POST["islem"] == "segment_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("ortaklik_segment", $value,"ortaklik_segment");
    }
}

if($_POST["islem"] == "ortak_ekle"){
    $db->OrtakEkle();
}

if($_POST["islem"] == "ortak_guncelle"){
    $db->OrtakGuncelle();
}
if($_POST["islem"] == "ortak_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("ortak", $value,"ortak");
    }
}
?>



<form id="sil-form" name="sil-form" enctype="multipart/form-data" method="post"></form>
<div class="static-content">
    <div class="page-content">
        <div class="container-fluid">
            <div data-widget-group="group1">
                <div class="row">
                    <div class="col-md-12 profile-area">
                        <div class="media col-md-6 col-sm-6 col-xs-6">
                            <div class="media-body pl-xl">
                                <span class="icon">
                                    <i class="material-icons">
                                        <?php echo $_GET["icon"]; ?>
                                    </i>
                                </span>
                                <h4 class="media-heading">
                                    <?php echo $db->Cevirmen("İş Ortaklığı", $language_id, 0); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pl-n pr-n">
                <ul class="nav nav-tabs material-nav-tabs mb-lg">
                    <li id="1" class="active">
                        <a href="#tab-1" data-toggle="tab">
                            <?php echo $db->Cevirmen("İş Ortakları", $language_id, 0); ?>
                        </a>
                    </li>
                    <li id="2">
                        <a href="#tab-2" data-toggle="tab">
                            <?php echo $db->Cevirmen("Kayan Metinler", $language_id, 0); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <form name="settings" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div class="panel-profile">
                            <div class="tab-content">

                                <div class="tab-pane active p-md" id="tab-1">
                                    <div class="about-area">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h2 class="basliklar">
                                                    <?php echo $db->Cevirmen("İş Ortakları", $language_id, 0); ?>
                                                </h2>
                                            </div>
                                            <div class="panel-body no-padding">
                                                <table id="table-2" class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="mycontrol-box" colspan="6">
                                                                <button type="button" id="btnYeniOrtak" class="btn btn-sm btn-info btn-raised btnEkle">
                                                                    <?php echo $db->Cevirmen("YENİ ORTAK", $language_id, 0); ?>
                                                                </button>
                                                                <button type="button" id="btnOrtakSil" class="btn btn-danger btn-sm btn-raised btnSil">
                                                                    <?php echo $db->Cevirmen("SİL", $language_id, 0); ?>
                                                                </button>
                                                                <div id="ct2" class="panel-ctrls col-md-3" style="float:right;"></div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center" style="width:10px;">
                                                                <div class="checkbox checkbox-info">
                                                                    <label>
                                                                        <input type="checkbox" id="btnTümünüSeç" />
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th width="100" class="center">
                                                                <?php echo $db->Cevirmen("Sıra", $language_id, 0); ?>
                                                            </th>
                                                            <th>Ortak Adı</th>
                                                            <th>Logo</th>
                                                            <th class="center secenekler" width="100">
                                                                <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                                            </th>
                                                            <th class="center secenekler" width="20"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ortaklar = $db->select("select *from ortak order by sira asc");
                                                        foreach ($ortaklar as $ortak)
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td class="center">
                                                                <div class="checkbox checkbox-info">
                                                                    <label>
                                                                        <input type="checkbox" data-type="select" data-id="<?php echo $ortak["id"]; ?>" />
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo $ortak["sira"];?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ortak["ad"];?>
                                                            </td>
                                                            <td>
                                                                logo
                                                            </td>
                                                            <td class="center secenekler secenekler_column">
                                                                <div class="togglebutton center">
                                                                    <label>
                                                                        <?php
                                                            if($ortak["aktif"] == 1)
                                                            {
                                                                $checked = "checked";
                                                            }else{
                                                                $checked="";
                                                            }
                                                                        ?>
                                                                        <input class="chc_ortak_aktif" data-id="<?php echo $ortak["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="center secenekler secenekler_column center">
                                                                <button type="button" data-id="<?php echo $ortak["id"]; ?>" class="btn btn-info btn-raised btn-xs btnOrtakEdit btnDuzenle">
                                                                    <i class="fa fa-pencil"></i>
                                                                    <div class="ripple-container"></div>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-footer"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-md" id="tab-2">
                                    <div class="about-area">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h2 class="basliklar">
                                                    <?php echo $db->Cevirmen("Kayan Metinler", $language_id, 0); ?>
                                                </h2>
                                            </div>
                                            <div class="panel-body no-padding">
                                                <table id="table-1" class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="mycontrol-box" colspan="5">
                                                                <button type="button" id="btnYeniSegment" class="btn btn-sm btn-info btn-raised btnEkle">
                                                                    <?php echo $db->Cevirmen("YENİ METİN", $language_id, 0); ?>
                                                                </button>
                                                                <button type="button" id="btnSegmentSil" class="btn btn-danger btn-sm btn-raised btnSil">
                                                                    <?php echo $db->Cevirmen("SİL", $language_id, 0); ?>
                                                                </button>
                                                                <div id="ct1" class="panel-ctrls col-md-3" style="float:right;"></div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center" style="width:10px;">
                                                                <div class="checkbox checkbox-info">
                                                                    <label>
                                                                        <input type="checkbox" id="btnTümünüSeç" />
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th width="100" class="center">
                                                                <?php echo $db->Cevirmen("Sıra", $language_id, 0); ?>
                                                            </th>
                                                            <th>Başlık</th>
                                                            <th class="center secenekler" width="100">
                                                                <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                                            </th>
                                                            <th class="center secenekler" width="20"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ortaklar = $db->select("select *from ortaklik_segment order by sira asc");
                                                        foreach ($ortaklar as $ortak)
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td class="center">
                                                                <div class="checkbox checkbox-info">
                                                                    <label>
                                                                        <input type="checkbox" data-type="select" data-id="<?php echo $ortak["id"]; ?>" />
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo $ortak["sira"];?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ortak["ad"];?>
                                                            </td>
                                                            <td class="center secenekler secenekler_column">
                                                                <div class="togglebutton center">
                                                                    <label>
                                                                        <?php
                                                            if($ortak["aktif"] == 1)
                                                            {
                                                                $checked = "checked";
                                                            }else{
                                                                $checked="";
                                                            }
                                                                        ?>
                                                                        <input class="chcAktif" data-id="<?php echo $ortak["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="center secenekler secenekler_column center">
                                                                <button type="button" data-id="<?php echo $ortak["id"]; ?>" class="btn btn-info btn-raised btn-xs btnSegmentEdit btnDuzenle">
                                                                    <i class="fa fa-pencil"></i>
                                                                    <div class="ripple-container"></div>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="aaa" class="panel-footer"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="aktif_tab" name="aktif_tab" />
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Ortak Segment Edit Modal -->
<div class="modal" id="segmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("KAYAN METİN", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="segment_sira" name="sira" placeholder="<?php echo $db->Cevirmen("Sıra", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Başlık", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ad" name="ad" placeholder="<?php echo $db->Cevirmen("Başlık", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <!--<div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="map" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Fotoğraf", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="segment-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
                                        <div>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></a>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new"><?php echo $db->Cevirmen("Resim Seç", $language_id, 0); ?></span>
                                                <span class="fileinput-exists"><?php echo $db->Cevirmen("Değiştir", $language_id, 0); ?></span>
                                                <input type="file" name="resim_yolu" accept="image/*" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                <div class="togglebutton">
                                     <label>
                                        <input id="chcGorunurluk" name="chcGorunurluk" type="checkbox"/>
                                   </label>
                                 </div>
                                </div>
                            </div>
                        </div>

                       <!--<div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("İçerik", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                     <textarea name="icerik" id="segment_icerik" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="segment_id" name="segment_id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-primary btnSegmentKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-success btnSegmentGuncelle btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Ortak Segment Edit Modal -->
<!-- Ortak Edit Modal -->
<div class="modal" id="ortakModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="about-area">
                        <h4>
                            <?php echo $db->Cevirmen("ORTAK", $language_id, 0); ?>
                        </h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="ortak_sira" name="sira" placeholder="<?php echo $db->Cevirmen("Sıra", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ortak_ad" name="ad" placeholder="<?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="map" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Logo", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="ortak-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
                                        <div>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                <?php echo $db->Cevirmen("Sil", $language_id, 0); ?>
                                            </a>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">
                                                    <?php echo $db->Cevirmen("Resim Seç", $language_id, 0); ?>
                                                </span>
                                                <span class="fileinput-exists">
                                                    <?php echo $db->Cevirmen("Değiştir", $language_id, 0); ?>
                                                </span>
                                                <input type="file" name="resim_yolu" accept="image/*" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <div class="togglebutton">
                                        <label>
                                            <input id="chc_ortak_gorunurluk" name="chcGorunurluk" type="checkbox" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="ortak_id" name="ortak_id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <?php echo $db->Cevirmen("Kapat", $language_id, 0); ?>
                    </button>
                    <button type="submit" class="btn btn-raised btn-primary btnOrtakKaydet">
                        <?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?>
                    </button>
                    <button type="submit" class="btn btn-raised btn-success btnOrtakGuncelle btnGuncelle">
                        <?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?>
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Ortak Edit Modal -->

<script>
    $(function () {
        $(".chc_ortak_aktif").change(function (e) {

            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, modul: 'is_ortakligi', islem: 'ortak_active_state_change', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });
        $("#btnYeniOrtak").click(function () {
            $("#ortak_sira").val("");
            $("#ortak_ad").val("");
            $(".ortak-file").html("<image />");
            $(".islem").val("ortak_ekle");
            $("#chc_ortak_gorunurluk").prop("checked", true);
            $("#ortakModal").modal("show");
            $("#ortak_sira").focus();
            $(".btnOrtakKaydet").show();
            $(".btnOrtakGuncelle").hide();
        });
        $(".btnOrtakEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#ortakModal").modal("show");
            $("#ortak_id").val(id);
            $(".islem").val("ortak_guncelle");
            $(".btnOrtakGuncelle").show();
            $(".btnOrtakKaydet").hide();
            $("#ortak_sira").focus();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select_ortak', modul: 'is_ortakligi' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#ortak_sira").val(result[0]);
                    $("#ortak_ad").val(result[1]);

                    $(".ortak-file").html("<image />");
                    $(".ortak-file img").prop("src", "../uploads/images/ortak/" + result[2]);

                    var gorunurluk = false;
                    if (result[3] == 1) { gorunurluk = true; }
                    $("#chc_ortak_gorunurluk").prop("checked", gorunurluk);
                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });
    });
</script>

<script>
    $(function () {

        $(".chcAktif").change(function (e) {

            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, modul: 'is_ortakligi', islem: 'segment_active_state_change', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });

        $('#segmentModal').on('shown.bs.modal', function () {
            $("#sira").focus();
        });
        $("#btnYeniSegment").click(function () {
            $("#segment_sira").val("");
            $("#ad").val("");
            $("#segment_icerik").code("");
            $(".segment-file").html("<image />");
            $(".islem").val("segment_ekle");
            $("#chcGorunurluk").prop("checked", true);
            $("#segmentModal").modal("show");
            $("#segment_sira").focus();
            $(".btnSegmentKaydet").show();
            $(".btnSegmentGuncelle").hide();
        });

        $(".btnSegmentEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#segmentModal").modal("show");
            $("#segment_sira").focus();
            $("#segment_id").val(id);
            $(".islem").val("segment_guncelle");
            $(".btnSegmentGuncelle").show();
            $(".btnSegmentKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select_segment', modul: 'is_ortakligi' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#segment_sira").val(result[0]);
                    $("#ad").val(result[1]);
                    $('.summernote').code(result[2]);

                    $(".segment-file").html("<image />");
                    $(".segment-file img").prop("src", "../uploads/images/ortaklik_segment/" + result[3]);

                    var gorunurluk = false;
                    if (result[4] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk").prop("checked", gorunurluk);

                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });


        $("#btnSegmentSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet segmenti silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "segment_sil").appendTo('#sil-form');
                $("#table-1 input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "d-" + id).attr('value', id).appendTo('#sil-form');
                    }
                });
                $("#sil-form").submit();
            }
        });

          $("#btnOrtakSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet ortağı silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "ortak_sil").appendTo('#sil-form');
                $("#table-2 input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "d-" + id).attr('value', id).appendTo('#sil-form');
                    }
                });
                $("#sil-form").submit();
            }
        });


    });

    var exportButtons = false;
</script>

<script>
    $(function () {

        $(".material-nav-tabs li a").click(function () {
            var tab = $(this).attr("href").replace("#", "");
            $("#aktif_tab").val(tab);
        });

        $("#aktif_tab").val("<?php echo $aktif_tab; ?>");
        var aktif_t = $("#aktif_tab").val().replace("#", "");
        aktif_t = aktif_t.replace("tab-", "");

        $(".material-nav-tabs li").removeClass("active");
        $(".tab-pane").removeClass("active");

        $("#" + aktif_t).addClass("active");
        $("#tab-" + aktif_t).addClass("active");
        if (!$("#aktif_tab").val()) {
            $(".tab-pane").first().addClass("active");
            $(".material-nav-tabs li").first().addClass("active");
        }
    });


</script>