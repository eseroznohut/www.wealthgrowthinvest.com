<?php
$ekle = $db->izinKontrol(3,"ekle");
$sil = $db->izinKontrol(3,"sil");
$duzenle = $db->izinKontrol(3,"duzenle");
$guncelle = $db->izinKontrol(3,"guncelle");

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
if($_POST["islem"] == "slayt_ekle"){
    $db->SlaytEkle();
}
if($_POST["islem"] == "slayt_guncelle"){
    $db->SlaytGuncelle();
}
if($_POST["islem"] == "slayt_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("slayt", $value,"slayt");
    }
}

?>
<link href="/panel/assets/plugins/lightgallery/css/lightgallery.min.css" rel="stylesheet" />
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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Slaytlar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Slaytlar", $language_id, 0); ?></h2>
                            <br />
                            <button id="btnYeniSlayt" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("Yeni Slayt", $language_id, 0); ?> </button>
                            <button id="btnCheckAll" class="btn btn-success btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Tümünü Seç", $language_id, 0); ?></button>
                            <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
                        </div>
                        <div class="panel-body">
                            <ul id="lightgallery" class="list-unstyled row">
                                <?php
                                $slaytlar = $db->select("select *from slayt order by sira asc");
                                foreach ($slaytlar as $slayt)
                                {
                                ?>
                                <li class="col-xs-6 col-sm-4 col-md-3 margin" data-responsive="/uploads/images/slayt/<?php echo $slayt["resim_yolu"];?> 800" data-src="/uploads/images/slayt/<?php echo $slayt["resim_yolu"]; ?>" data-sub-html="<?php echo $slayt["yazi"];?>">
                                    <a href="#">
                                        <image class="img-responsive" src="/uploads/images/slayt/<?php echo $slayt["resim_yolu"];?>" title="<?php echo $slayt["yazi"]; ?>"></image>
                                    </a>
                                    <div class="preevent" style="display:block;width:100%;height:60px;">
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:33.33333%;">
                                                    <div class="checkbox checkbox-success">
                                                        <label>
                                                            <input type="checkbox" data-type="select" data-id="<?php echo $slayt["id"]; ?>" />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="width:33.33333%;text-align:center;">
                                                    <div class="togglebutton" title="<?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>">
                                                        <label>
                                                            <?php
                                                            $checked = "";
                                                            if($slayt["aktif"] == 1){ $checked = "checked";}
                                                            ?>
                                                            <input data-id="<?php echo $slayt["id"]; ?>" name="chcAktif" type="checkbox" <?php echo $checked;?> />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="text-align:right;width:33.33333%;">
                                                    <button type="button" data-id="<?php echo $slayt["id"]; ?>" title="Düzenle" class="btn btn-raised btn-sm btn-info btnDuzenle">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>

                                <?php } ?>
                            </ul>
                        </div>
                        <div class="panel-footer"></div>
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
                        <h4><?php echo $db->Cevirmen("SLAYT", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="sira" name="sira" placeholder="<?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="yazi" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Başlık", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="yazi" name="yazi" placeholder="<?php echo $db->Cevirmen("Başlık", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="yazi" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Kısa Açıklama", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="aciklama" name="aciklama" placeholder="<?php echo $db->Cevirmen("Kısa Açıklama", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="yazi" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("İçerik", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <textarea class="form-control summernote" rows="5" id="icerik" name="icerik" placeholder="<?php echo $db->Cevirmen("İçerik", $language_id, 0); ?>"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?></label>
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
                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Slayt Resmi", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="slayt-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" id="islem" name="islem" />
                    <input type="hidden" id="slayt_id" name="slayt_id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-primary btnKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-success btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<form id="sil-form" method="post"></form>

<script>
    var secilimi = false;
    $(function () {
        $(".preevent").click(function (event) {
            event.stopPropagation();
        });

        $(".chcAktif").change(function (e) {
            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'active_state_change', modul: 'slayt', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });

        $('#myModal').on('shown.bs.modal', function () {
            $("#sira").focus();
        });

        $("#btnYeniSlayt").click(function () {
            $("#sira").val("");
            $("#yazi").val("");
            $("#icerik").code("");
            $("#aciklama").val("");
            $("#chcGorunurluk").prop("checked", true);
            $(".slayt-file").html("<image />");
            $("#myModal").modal("show");
            $("#islem").val("slayt_ekle");
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
        });

        $(".btnDuzenle").click(function () {
            var id = $(this).attr("data-id");
            $("#myModal").modal("show");
            $("#slayt_id").val(id);
            $("#islem").val("slayt_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'slayt' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#sira").val(result[0]);
                    $("#yazi").val(result[1]);
                    $(".slayt-file").html("<image />");
                    $(".slayt-file img").prop("src", "../uploads/images/slayt/" + result[2]);
                    var gorunurluk = false;
                    if (result[3] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk").prop("checked", gorunurluk);

                    $("#aciklama").val(result[4]);
                    $("#icerik").code(result[5]);
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
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet slaytı silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "slayt_sil").appendTo('#sil-form');
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

        $('#lightgallery').on('change', 'input[data-type="select"]', function () {
            var text =  ($('input[data-type="select"]:checkbox:checked').length > 0)? "Seçimi Kaldır" : "Tümünü Seç";

            $('#btnCheckAll').html(text);
            $('#btnSil').prop("disabled", !($('input[data-type="select"]:checkbox:checked').length > 0));
        });


    });
</script>


<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lightgallery.min.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lg-fullscreen.min.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lg-thumbnail.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lg-autoplay.min.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lg-zoom.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lg-hash.min.js"></script>
<script src="/panel/assets/plugins/lightgallery/js/lg-pager.js"></script>
<script src="/panel/assets/plugins/lightgallery/lib/jquery.mousewheel.min.js"></script>


<script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
</script>

<style>
    .checkbox .checkbox-material {
        top: 0px;
        z-index: 555;
    }

    .btnRemove {
        visibility: hidden;
    }

    #lightgallery li:hover > .btnRemove {
        visibility: visible;
    }
</style>