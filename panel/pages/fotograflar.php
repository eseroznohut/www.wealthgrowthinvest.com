<?php
$ekle = $db->izinKontrol(4,"ekle");
$sil = $db->izinKontrol(4,"sil");
$duzenle = $db->izinKontrol(4,"duzenle");
$guncelle = $db->izinKontrol(4,"guncelle");

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
if($_POST["islem"] == "foto_ekle"){
    $db->FotoEkle();
}
if($_POST["islem"] == "foto_guncelle"){
    $db->FotoGuncelle();
}
if($_POST["islem"] == "foto_sil"){

    foreach ($_POST as $value)
    {
        $db->delete("fotogaleri", $value,"fotogaleri");

        $params = array();
        array_push($params, $value);
        $haber = $db->select("SELECT *FROM fotogaleri WHERE id = ?", $params);

        unlink('../uploads/images/fotogaleri/'.$haber[0]["resim_yolu"]);
        unlink('../uploads/images/fotogaleri/'.$haber[0]["resim_yolu_thumbnail"]);

        $params = array();
        array_push($params, "fotograf");
        array_push($params, $value);
        $deletes = $db->select("select *from resim where modul_adi = ? and record_id = ?", $params);
        foreach ($deletes as $delete)
        {
            $db->delete("resim", $delete["id"], "resim");
            unlink("../uploads/images/fotogaleri/".$delete['kucuk']);
            unlink("../uploads/images/fotogaleri/".$delete['buyuk']);
        }
    }
}

$db->TamponTemizle("fotogaleri");

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Fotoğraf Galerisi", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="table_container" class="row" style="margin-top:15px;">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="basliklar"><?php echo $db->Cevirmen("Albümler", $language_id, 0); ?></h2>
                                <br />
                                <button id="btnYeniFoto" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ ALBÜM EKLE", $language_id, 0); ?> </button>
                                <button id="btnCheckAll" class="btn btn-success btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Tümünü Seç", $language_id, 0); ?></button>
                                <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
                            </div>
                            <div class="panel-body">
                                <ul id="lightgallery" class="list-unstyled row">
                                    <?php
                                    $fotograflar = $db->select("select *from fotogaleri");
                                    foreach ($fotograflar as $value)
                                    {
                                    ?>
                                    <li class="col-xs-6 col-sm-4 col-md-3 margin" data-responsive="/uploads/images/fotogaleri/<?php echo $value["resim_yolu"]; ?> 800" data-src="/uploads/images/fotogaleri/<?php echo $value["resim_yolu"]; ?>" data-sub-html="<?php echo $value["yazi"];?>">
                                        <a href="#">
                                            <image class="img-responsive" src="/uploads/images/fotogaleri/<?php echo $value["resim_yolu"]; ?>" title="<?php echo $value["yazi"]; ?>"></image>
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
</div>

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4>
                            <?php echo $db->Cevirmen("Fotoğraf Albümü", $language_id, 0); ?>
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
                                    <?php echo $db->Cevirmen("Albüm Adı", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="yazi" name="yazi" placeholder="<?php echo $db->Cevirmen("Albüm Adı", $language_id, 0); ?>" />
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
                                <label for="map" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Kapak Fotoğrafı", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="foto-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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
                                <label for="map" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Fotoğraflar", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10 dropzone_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <form method="post">
                        <input type="hidden" id="islem" name="islem" />
                        <input type="hidden" id="foto_id" name="foto_id" />
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
<style>
    .btnRemove {
        visibility: hidden;
    }

    #lightgallery li:hover > .btnRemove {
        visibility: visible;
    }

    .margin {
        /*margin-top: 70px;*/
    }
</style>
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
                data: { id: id, islem: 'active_state_change', modul: 'fotogaleri', durum: durum },
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

        $("#btnYeniFoto").click(function () {
            $("#sira").val("");
            $("#yazi").val("");
            $(".foto-file").html("<image />");           
            $("#islem").val("foto_ekle");
            $("#chcGorunurluk").prop("checked", true);
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
            dropzone("fotogaleri", sessionId);
            $("#myModal").modal("show");
        });

        $(".btnDuzenle").click(function () {
            var id = $(this).attr("data-id");
           
            $("#foto_id").val(id);
            $("#islem").val("foto_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'fotogaleri' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#sira").val(result[1]);
                    $("#yazi").val(result[2]);
                    $(".foto-file").html("<image />");
                    $(".foto-file img").prop("src", "../uploads/images/fotogaleri/" + result[3]);
                    var gorunurluk = false;
                    if (result[4] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk").prop("checked", gorunurluk);
                    dropzone("fotogaleri", id);
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
            var cf = confirm(count + '<?php echo $db->Cevirmen(" adet fotoğrafı silmek istediğinizden eminmisiniz?", $language_id, 0); ?>');
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "foto_sil").appendTo('#sil-form');
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
            var text = ($('input[data-type="select"]:checkbox:checked').length > 0) ? "<?php echo $db->Cevirmen("Seçimi Kaldır", $language_id, 0); ?>" : "<?php echo $db->Cevirmen("Tümünü Seç", $language_id, 0); ?>";

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