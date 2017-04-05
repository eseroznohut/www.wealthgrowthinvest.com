<?php
$ekle = $db->izinKontrol(15,"ekle");
$sil = $db->izinKontrol(15,"sil");
$duzenle = $db->izinKontrol(15,"duzenle");
$guncelle = $db->izinKontrol(15,"guncelle");

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
if($_POST["islem"] == "ekip_ekle"){
    $db->EkipEkle();
}
if($_POST["islem"] == "ekip_guncelle"){
    $db->EkipGuncelle();
}
if($_POST["islem"] == "ekip_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("ekip", $value,"ekip");
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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Ekip", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar">
                                <?php echo $db->Cevirmen("EKİP", $language_id, 0); ?>
                            </h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="7">
                                            <button id="btnYeniPersonel" class="btn btn-sm btn-info btn-raised btnEkle">
                                                <?php echo $db->Cevirmen("YENİ PERSONEL", $language_id, 0); ?>
                                            </button>
                                            <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil">
                                                <?php echo $db->Cevirmen("SİL", $language_id, 0); ?>
                                            </button>
                                            <div class="panel-ctrls col-md-3" style="float:right;"></div>
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
                                        <th>Ad, Soyad</th>
                                        <th>Görev</th>
                                        <th>Kategori</th>
                                        <th class="center secenekler" width="100">
                                            <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                        </th>
                                        <th class="center secenekler" width="20"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $personeller = $db->select("select *from ekip order by ad asc");
                                    foreach ($personeller as $personel)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $personel["id"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <?php echo $personel["sira"];?>
                                        </td>
                                        <td>
                                            <?php echo $personel["ad"];?>
                                        </td>
                                        <td>
                                            <?php echo $personel["gorev"];?>
                                        </td>
                                                                                    <td>
                                                <?php
                                        $kategori_id = $personel["kategori_id"];
                                        $params = array();
                                        array_push($params, $kategori_id);
                                        $modul = $db->select("select *from ekip_kategori where id = ?", $params);
                                        echo $modul[0]["ad"];
                                                ?>
                                            </td>
                                        <td class="center secenekler secenekler_column">
                                            <div class="togglebutton center">
                                                <label>
                                                    <?php
                                        if($personel["aktif"] == 1)
                                        {
                                            $checked = "checked";
                                        }else{
                                            $checked="";
                                        }
                                                    ?>
                                                    <input class="chcAktif" data-id="<?php echo $personel["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center secenekler secenekler_column center">
                                            <button type="button" data-id="<?php echo $personel["id"]; ?>" class="btn btn-info btn-raised btn-xs btnPersonelEdit btnDuzenle">
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
                        <h4><?php echo $db->Cevirmen("PERSONEL", $language_id, 0); ?></h4>
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
                                <label for="ad" class="col-sm-3 control-label">
                             <?php echo $db->Cevirmen("Ad", $language_id);
                                    ?>,<?php echo $db->Cevirmen("Soyad", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ad" name="ad" placeholder="<?php echo $db->Cevirmen("Ad", $language_id, 0); ?>,<?php echo $db->Cevirmen("Soyad", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="gorev" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Kategori", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <select id="cboKategori" name="cboKategori" class="form-control">

                                        <?php 
                                        $kategoriler = $db->select("select *from ekip_kategori");
                                        foreach ($kategoriler as $kategori)
                                        {                                        
                                        ?>
                                        <option value="<?php echo $kategori["id"]; ?>"><?php echo $kategori["ad"]; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="gorev" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Görev", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="gorev" name="gorev" placeholder="<?php echo $db->Cevirmen("Görev", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="facebook" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Facebook", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="<?php echo $db->Cevirmen("Facebook", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="twitter" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Twitter", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="<?php echo $db->Cevirmen("Twitter", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="instagram" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Instagram", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="<?php echo $db->Cevirmen("Instagram", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="gplus" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Google Plus", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="gplus" name="gplus" placeholder="<?php echo $db->Cevirmen("Google Plus", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="telefon" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Telefon", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="telefon" name="telefon" placeholder="<?php echo $db->Cevirmen("Telefon", $language_id, 0); ?>"  />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="eposta" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Eposta", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="eposta_ekip" name="eposta" placeholder="<?php echo $db->Cevirmen("Eposta", $language_id, 0); ?>" />
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
                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Personel Fotoğrafı", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="personel-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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
                    <input type="hidden" id="ekip_id" name="ekip_id" />
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
                data: { id: id, islem: 'active_state_change', modul: 'ekip', durum: durum },
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

        $("#btnYeniPersonel").click(function () {
            $("#sira").val("");
            $("#ad").val("");
            $("#gorev").val("");
            $("#facebook").val("");
            $("#twitter").val("");
            $("#instagram").val("");
            $("#gplus").val("");
            $("#telefon").val("");
            $("#eposta_ekip").val("");

            $("#chcGorunurluk").prop("checked", true);
            $(".personel-file").html("<image />");
            $("#myModal").modal("show");
            $("#islem").val("ekip_ekle");
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
        });

        $(".btnDuzenle").click(function () {
            var id = $(this).attr("data-id");
            $("#myModal").modal("show");
            $("#ekip_id").val(id);
            $("#islem").val("ekip_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'ekip' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#sira").val(result[0]);
                    $("#ad").val(result[1]);
                    $("#gorev").val(result[2]);
                    $("#facebook").val(result[3]);
                    $("#twitter").val(result[4]);
                    $("#instagram").val(result[5]);
                    $("#gplus").val(result[6]);
                    $("#telefon").val(result[7]);
                    $("#eposta_ekip").val(result[8]);

                    $(".personel-file").html("<image />");
                    $(".personel-file img").prop("src", "../uploads/images/ekip/" + result[9]);
                    var gorunurluk = false;
                    if (result[10] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk").prop("checked", gorunurluk);


                    $("#cboKategori option[value='" + result[11] + "']").attr("selected", "selected");

                    

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
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet personeli silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "ekip_sil").appendTo('#sil-form');
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