<link href="assets/plugins/mscroller/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.js"></script>
<?php
$ekle = $db->izinKontrol(14, "ekle");
$sil = $db->izinKontrol(14, "sil");
$duzenle = $db->izinKontrol(14, "duzenle");
$guncelle = $db->izinKontrol(14, "guncelle");

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

if($_POST["islem"] == "proje_ekle"){
    $db->ProjeEkle();
}

if($_POST["islem"] == "proje_guncelle"){
    $db->ProjeGuncelle();
}

if($_POST["islem"] == "proje_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("proje", $value,"proje");

        $params = array();
        array_push($params, $value);
        $proje = $db->select("SELECT *FROM proje WHERE id = ?", $params);

        unlink('../uploads/images/proje/'.$proje[0]["resim_yolu"]);
        unlink('../uploads/images/proje/'.$proje[0]["resim_yolu_thumbnail"]);

        $params = array();
        array_push($params, "proje");
        array_push($params, $value);
        $deletes = $db->select("select *from resim where modul_adi = ? and record_id = ?", $params);
        foreach ($deletes as $delete)
        {
            $db->delete("resim", $delete["id"], "resim");
            unlink("../uploads/images/proje/".$delete['kucuk']);
            unlink("../uploads/images/proje/".$delete['buyuk']);
        }
    }
}

$db->TamponTemizle("proje");

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Projeler", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="btnKategoriler" type="button" class="btn btn-info btn-sm btn-raised">
                <?php echo $db->Cevirmen("Proje Kategorileri", $language_id, 0); ?>
            </button>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Projeler", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="4">
                                            <button id="btnYeniProje" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("Yeni Proje", $language_id, 0); ?></button>
                                            <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
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
                                        <th width="200"><?php echo $db->Cevirmen("Proje Adı", $language_id, 0); ?></th>
                                        <th width="200"><?php echo $db->Cevirmen("Kategorisi", $language_id, 0); ?></th>
                                        <th class="center secenekler" width="100">
                                            <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                        </th>
                                        <th class="center secenekler" width="10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $projeler = $db->select("select *from proje order by kategori_id asc");
                                    foreach ($projeler as $proje)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $proje["id"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $proje["ad"];?>
                                        </td>
                                        <td>
                                            <?php
                                        $params = array();
                                        array_push($params, $proje["kategori_id"]);
                                        $proje_kategorileri = $db->select("SELECT *FROM proje_kategori WHERE id = ?", $params);
                                        echo $proje_kategorileri[0]["ad"];
                                            ?>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <div class="togglebutton center">
                                                <label>
                                                    <?php
                                                    if($proje["aktif"] == 1)
                                                    {
                                                        $checked = "checked";
                                                    }else{
                                                        $checked="";
                                                    }
                                                    ?>
                                                    <input class="chcAktif" data-id="<?php echo $proje["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <button type="button" data-id="<?php echo $proje["id"]; ?>" class="btn btn-info btn-raised btn-xs btnEdit btnDuzenle" title="Görüntüle">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
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

<div class="modal" id="projeEditModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" id="kullanici-form" enctype="multipart/form-data" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 id="lblMesajTitle" style="text-transform:uppercase;"><?php echo $db->Cevirmen("PROJE", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="number" id="proje_sira" name="sira" class="form-control" placeholder="<?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?>" data-parsley-trigger="change" required="" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Başlangıç Tarihi", $language_id, 0); ?></label>
                                <div class="input-group date" id="datepicker-pastdisabled">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <input id="baslangic_t" name="baslangic_t" type="text" data-type="date" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Bitiş Tarihi", $language_id, 0); ?></label>
                                <div class="input-group date" id="datepicker-pastdisabled">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <input id="bitis_t" name="bitis_t" type="text" data-type="date" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Proje Adı", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="proje_adi" name="proje_adi" class="form-control" placeholder="<?php echo $db->Cevirmen("Proje Adı", $language_id, 0); ?>" data-parsley-trigger="change" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="cboProjeKategori" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Kategori", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <select id="cboProjeKategori" name="kategori_id" class="form-control">
                                        <?php
                                        $proje_kategorileri = $db->select("SELECT *FROM proje_kategori ORDER BY ad ASC");
                                        foreach ($proje_kategorileri as $proje_kategori)
                                        {
                                        ?>
                                        <option value="<?php echo $proje_kategori["id"]; ?>"><?php echo $proje_kategori["ad"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="overflow:hidden;">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Aktif", $language_id, 0); ?> / <?php echo $db->Cevirmen("Pasif", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="togglebutton center">
                                        <label style="float:left;">
                                            <input id="projeAktif" name="aktif" type="checkbox" <?php echo $checked; ?> />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Kapak Fotoğrafı", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="proje-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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

                        <div class="table-responsive" style="overflow:hidden;">
                            <div class="form-group is-empty">
                                <label class="col-sm-3 control-label"><?php echo $db->Cevirmen("Diğer Fotoğraflar", $language_id, 0); ?></label>
                                <div class="col-sm-9 dropzone_container">

                                </div>
                            </div>
                        </div>


                        <div class="table-responsive" style="overflow:hidden;">
                            <div class="form-group is-empty">
                                <label for="icerik" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Açıklama", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <textarea name="icerik" id="sayfa_icerik" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" id="islem" name="islem" />
                    <input type="hidden" id="id" name="id" />
                    <button type="button" class="btn btn-danger btnProjeVazgec" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" onclick="return form_kontrol();" class="btn btn-info btn-raised btnKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" onclick="return form_kontrol();" class="btn btn-success btn-raised btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="kategoriListModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="kullanici-form" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 id="lblMesajTitle" style="text-transform:uppercase;">
                            <?php echo $db->Cevirmen("PROJE KATEGORİLERİ", $language_id, 0); ?>
                        </h4>
                        <button id="btnKategoriEkle" type="button" class="btn btn-raised btn-sm btn-info btnEkle">Ekle</button>
                        <button id="btnKategoriDuzenle" type="button" class="btn btn-raised btn-sm btn-success btnDuzenle">Düzenle</button>
                        <button id="btnKategoriSil" type="button" class="btn btn-raised btn-sm btn-danger btnSil">Sil</button>
                        <div class="scroll">
                            <ul class="user_group_list">
                                <?php
                                $proje_kategorileri = $db->select("select *from proje_kategori order by ad asc");
                                foreach ($proje_kategorileri as $proje_kategori)
                                {
                                ?>
                                <li id="grp-<?php echo $proje_kategori["id"]; ?>" data-id="<?php echo $proje_kategori["id"]; ?>" class="group-li">
                                    <span style="padding-left:5px;">
                                        <?php echo $proje_kategori["ad"]; ?>
                                    </span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <?php echo $db->Cevirmen("Kapat", $language_id, 0); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="kategoriEditModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="kullanici-form" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 style="text-transform:uppercase;"></h4>


                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Gösterim Sırası", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="number" id="sira" name="sira" class="form-control" placeholder="<?php echo $db->Cevirmen("Gösterim Sırası", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Kategori Adı", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="kategori_adi" name="kategori_adi" class="form-control" placeholder="<?php echo $db->Cevirmen("Kategori Adı", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="overflow:hidden;">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Aktif", $language_id, 0); ?> / <?php echo $db->Cevirmen("Pasif", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="togglebutton center">
                                        <label style="float:left;">
                                            <input id="proje_aktif" name="proje_aktif" type="checkbox" <?php echo $checked; ?> />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <?php echo $db->Cevirmen("Kapat", $language_id, 0); ?>
                    </button>
                    <button id="btnKategoriKaydet" type="button" class="btn btn-raised btn-info">
                        <?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?>
                    </button>
                    <button id="btnKategoriGuncelle" type="button" class="btn btn-raised btn-success btnGuncelle">
                        <?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- PROJE -->
<script>
    var sessionId = '<?php echo session_id();  ?>';

    $(function () {

        $(".scroll").mCustomScrollbar({ theme:'dark'});

        $("#btnYeniProje").click(function () {
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
            $("#islem").val("proje_ekle");
            $("#proje_adi").val("");
            $("#proje_sira").val("");
            $("#projeAktif").prop("checked", true);
            $("#sayfa_icerik").code("");
            dropzone("proje", sessionId);
            $(".btnEdit").attr("data-id", "");

            $(".proje-file").html("<image />");
            $(".proje-file img").prop("src", "");

            $("#baslangic_t").val("");
            $("#bitis_t").val("");

            $("#projeEditModal").modal("show");
            $("#proje_sira").focus();
        });

        $(".btnEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#islem").val("proje_guncelle");
            $("#id").val(id);

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'proje' },
                url: 'system/ajax.php',
                success: function (result) {

                     $("#proje_sira").val(result[0]);
                     $("#proje_adi").val(result[1]);
                     $("#cboProjeKategori").val(result[2]);
                     $("#sayfa_icerik").code(result[3]);

                     var checked = result[4] == 1 ? true : false;

                     $("#projeAktif").prop("checked", checked);

                     $(".proje-file").html("<image />");
                     $(".proje-file img").prop("src", "../uploads/images/proje/" + result[5]);

                     $("#id").val(id);
                     $("#islem").val("proje_guncelle");

                    $(".btnKaydet").hide();
                    $(".btnGuncelle").show();

                    $("#baslangic_t").val(result[7]);
                    $("#bitis_t").val(result[8]);

                    dropzone("proje", id);

                    $("#projeEditModal").modal("show");
                },
                error: function (a, b, c) { alert("hata"); }
            });
        });

        $(".btnProjeVazgec").click(function () {
            var id = $(".btnEdit").attr("data-id");
            $.ajax({
                method: 'post',
                dataType:'text',
                data:{ dosya:'proje', islem:'tamponu_temizle', id:id },
                url: 'system/dropzone.php',
                success: function () { console.log("Tampon Temizlendi."); },
                error: function (xhr, status, error) {
                    console.log("Hata :" + xhr.responseText);
                }
            });
        });

        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet projeyi silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "proje_sil").appendTo('#sil');
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "id" + id).attr('value', id).appendTo('#sil');
                    }
                });
                $("#sil").submit();
            }
        });
    });
    var exportButtons = false;
</script>

<!-- KATEGORİ -->
<script>

    var kategori_id;

    $(function () {

        $("#btnKategoriSil").prop("disabled", true);
        $("#btnKategoriDuzenle").prop("disabled", true);

        $("#btnKategoriler").click(function () {
            $("#kategoriListModal").modal("show");
        });

        $("#btnKategoriEkle").click(function () {
            $("#btnKategoriKaydet").show();
            $("#btnKategoriGuncelle").hide();
            $("#proje_aktif").prop("checked", true);
            $("#kategori_adi").val("");
            $("#kategoriEditModal").modal("show");
            $("#sira").focus();
        });

        $("#btnKategoriKaydet").click(function () {

            var kategori_adi = $("#kategori_adi").val();
            var sira = $("#sira").val();
            var aktif = $("#proje_aktif").is(":checked");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'proje_kategori', islem: 'kategori_ekle', adi: kategori_adi, sira: sira, aktif: aktif },
                url: 'system/ajax.php',
                success: function (result) {

                    var kategori_id = result[0];

                    $("#cboProjeKategori").append("<option value='" + kategori_id + "'>" + kategori_adi + "</option>");
                    $("#kategoriEditModal").modal("hide");
                    $(".user_group_list").append('<li id="grp-' + result[0] + '" data-id="' + result[0] + '" class="group-li"><span style="padding-left:5px;">' + kategori_adi + '</span></li>');
                    $("#kategoriEditModal").modal("hide");

                },
                error: function (a, b, c) { alert(a.responseText); }
            });
        });

        $("#btnKategoriDuzenle").click(function () {
            if (kategori_id == null) return;
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'proje_kategori', islem: 'select_proje_kategori', id: kategori_id },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#sira").val(result[0]);
                    $("#kategori_adi").val(result[1]);
                    aktif = result[2] == 1 ? true : false;
                    $("#proje_aktif").prop("checked", aktif);
                    $("#btnKategoriKaydet").hide();
                    $("#btnKategoriGuncelle").show();
                    $("#kategoriEditModal").modal("show");
                    $("#sira").focus();
                },
                error: function (a, b, c) { alert(a.responseText, b.responseText, c.responseText); }
            });
        });

        $("#btnKategoriGuncelle").click(function () {

            if (kategori_id == null) return;
            var kategori_adi = $("#kategori_adi").val();
            var sira = $("#sira").val();
            var aktif = $("#proje_aktif").is(":checked");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'proje_kategori', islem: 'proje_kategori_guncelle', sira: sira, adi: kategori_adi, aktif: aktif, kategori_id: kategori_id },
                url: 'system/ajax.php',
                success: function (result) {

                    $("#grp-" + kategori_id).html(" " + kategori_adi);
                    $("#kategoriEditModal").modal("hide");
                },
                error: function () { alert("hata"); }
            });
        });

        $("#btnKategoriSil").click(function () {

            var id = $(".group-select").attr("data-id");
            var ad = $(".group-select span").html().replace(/\s/g, '');

            var conf = confirm(ad + " isimli kategoriyi silmek istediğinizden eminmisiniz?");
            if (conf) {
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { modul: 'proje_kategori', islem: 'proje_kategori_sil', id: id },
                    url: 'system/ajax.php',
                    success: function (result) {
                        $("#grp-" + id).remove();
                        $("#btnKategoriSil").prop("disabled", true);
                        $("#btnKategoriDuzenle").prop("disabled", true);
                    },
                    error: function () { alert("hata"); }
                });
            }
        });

        $(".group-li").click(function () {
            $(".group-li").removeClass("group-select");
            $(this).addClass("group-select");
            kategori_id = $(this).attr("data-id");
            $("#btnKategoriSil").prop("disabled", false);
            $("#btnKategoriDuzenle").prop("disabled", false);
        });

        $(".chcAktif").change(function (e) {
            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'active_state_change', modul: 'proje', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });
    });



</script>

<script>
    $(function () {
        $('.date').datepicker({
            todayHighlight: true,
            startDate: "-3d",
            endDate: "+3d",
            format: 'dd-mm-yyyy',
        });
    });
</script>

<form id="sil" method="post"></form>