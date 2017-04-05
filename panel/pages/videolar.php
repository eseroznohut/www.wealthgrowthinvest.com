<?php
$ekle = $db->izinKontrol(18,"ekle");
$sil = $db->izinKontrol(18,"sil");
$duzenle = $db->izinKontrol(18,"duzenle");
$guncelle = $db->izinKontrol(18,"guncelle");

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
if($_POST["islem"] == "video_ekle"){
    $db->VideoEkle();
}
if($_POST["islem"] == "video_guncelle"){
    $db->VideoGuncelle();
}
if($_POST["islem"] == "video_sil"){

    foreach ($_POST as $value)
    {
        $db->delete("video", $value,"video");

        $params = array();
        array_push($params, $value);
        $haber = $db->select("SELECT *FROM video WHERE id = ?", $params);

        unlink('../uploads/images/video/'.$haber[0]["resim_yolu"]);
        unlink('../uploads/images/video/'.$haber[0]["resim_yolu_thumbnail"]);


    }
}

$db->TamponTemizle("video");

?>

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Videolar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="table_container" class="row" style="margin-top:15px;">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="basliklar"><?php echo $db->Cevirmen("Videolar", $language_id, 0); ?></h2>
                                <br />
                                <button id="btnYeniVideo" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ VİDEO EKLE", $language_id, 0); ?> </button>
                                <button id="btnCheckAll" class="btn btn-success btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Tümünü Seç", $language_id, 0); ?></button>
                                <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
                            </div>
                            <div class="panel-body">


                                <?php
                                $videolar = $db->select("select *from video");
                                foreach ($videolar as $value)
                                {
                                ?>
                                <div class="col-xs-6 col-sm-4 col-md-3 margin">
                                    <a href="#">
                                        <image class="img-responsive" src="http://img.youtube.com/vi/<?php echo $value["url"]; ?>/0.jpg"></image>
                                    </a>
                                    <div class="preevent" style="display:block;width:100%;height:60px;">
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:33.33333%;">
                                                    <div class="checkbox checkbox-info">
                                                        <label>
                                                            <input type="checkbox" data-type="select" data-id="<?php echo $value["id"]; ?>" />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="width:33.33333%;text-align:center;">
                                                    <div class="togglebutton" title="<?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>">
                                                        <label>
                                                            <?php
                                    $checked = "";
                                    if($value["aktif"] == 1){ $checked = "checked";}
                                                            ?>
                                                            <input data-id="<?php echo $value["id"]; ?>" name="chcAktif" type="checkbox" <?php echo $checked;?> />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="text-align:right;width:33.33333%;">
                                                    <button type="button" data-id="<?php echo $value["id"]; ?>" title="<?php echo $db->Cevirmen("Düzenle", $language_id, 0); ?>" class="btn btn-raised btn-sm btn-info btnDuzenle">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <?php } ?>
         
                           
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4>
                            <?php echo $db->Cevirmen("Video", $language_id, 0); ?>
                        </h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sira" name="sira" placeholder="<?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="yazi" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Başlık", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ad" name="ad" placeholder="<?php echo $db->Cevirmen("Başlık", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="chcGorunurluk1" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <div class="togglebutton">
                                        <label>
                                            <input id="chcGorunurluk" name="chcGorunurluk" type="checkbox" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="yazi" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Video Url", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" data-charakter="normal" class="form-control" id="url" name="url" placeholder="<?php echo $db->Cevirmen("Video Url", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <form method="post">
                        <input type="hidden" id="islem" name="islem" />
                        <input type="hidden" id="video_id" name="video_id" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <?php echo $db->Cevirmen("Kapat", $language_id, 0); ?>
                        </button>
                        <button type="submit" class="btn btn-raised btn-primary btnKaydet">
                            <?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?>
                        </button>
                        <button type="submit" class="btn btn-raised btn-success btnGuncelle">
                            <?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?>
                        </button>
                    </form>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<form id="sil-form" method="post"></form>
<script>
    var secilimi = false;
    var sessionId = '<?php echo session_id(); ?>';
    $(function () {
        $(".preevent").click(function (event) {
            event.stopPropagation();
        });

        $("input[name=chcGorunurluk1]").change(function (e) {

            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'active_state_change', modul: 'video', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });

        $('#myModal').on('shown.bs.modal', function () {
            $("#sira").focus();
        });

        $("#btnYeniVideo").click(function () {
            $("#sira").val("");
            $("#ad").val("");     
            $("#url").val("");
            $("#islem").val("video_ekle");
            $("#chcGorunurluk").prop("checked", true);
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
            $("#myModal").modal("show");
        });

        $(".btnDuzenle").click(function () {
            var id = $(this).attr("data-id");
           
            $("#video_id").val(id);
            $("#islem").val("video_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'video' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#sira").val(result[0]);
                    $("#ad").val(result[1]);
                    $("#url").val(result[2]);
                    var gorunurluk = false;
                    if (result[3] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk").prop("checked", gorunurluk);
                    $("#myModal").modal("show");

                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });

        $("#btnCheckAll").click(function () {
            $("input[data-type='select']").prop("checked", !secilimi);
            secilimi = !secilimi;
            var text = secilimi == true ? "Seçimi Kaldır" : "Tümünü Seç";
            $(this).html(text);
            $("#btnSil").prop("disabled", !secilimi);
        });

        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + '<?php echo $db->Cevirmen(" adet videoyu silmek istediğinizden eminmisiniz?", $language_id, 0); ?>');
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "video_sil").appendTo('#sil-form');
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "d-" + id).attr('value', id).appendTo('#sil-form');
                    }
                });
                $("#sil-form").submit();
            }
        });

        $("#btnCheckAll").prop("disabled", !($('input[data-type="select"]').length > 0));

        $('input[type="checkbox"]').on('change', function () {
            var text = ($('input[data-type="select"]:checkbox:checked').length > 0) ? "Seçimi Kaldır" : "Tümünü Seç";

            $('#btnCheckAll').html(text);
            $('#btnSil').prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0));
        });

                
    });
</script>