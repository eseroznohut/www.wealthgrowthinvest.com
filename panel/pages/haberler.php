<link href="assets/plugins/mscroller/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.js"></script>

<link href="assets/plugins/bootstrap-tokenfield/css/bootstrap-tokenfield.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-tokenfield/css/tokenfield-typeahead.min.css" rel="stylesheet" />
<script src="assets/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
<script src="assets/plugins/typhead/typehead.js"></script>


<script>
    $(function () {
        var engine = new Bloodhound({
            local: [],
            datumTokenizer: function (d) {
                return Bloodhound.tokenizers.whitespace(d.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $('#etiket').tokenfield({
            typeahead: [null, { source: engine.ttAdapter() }]
        });
    });
</script>

<?php
$ekle = $db->izinKontrol(5,"ekle");
$sil = $db->izinKontrol(5,"sil");
$duzenle = $db->izinKontrol(5,"duzenle");
$guncelle = $db->izinKontrol(5,"guncelle");

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

if(!empty($_POST["islem"]))
{
    if($_POST["islem"] == "haber_ekle"){
        $db->HaberEkle();
    }
    if($_POST["islem"] == "haber_guncelle"){
        $db->HaberGuncelle();
    }
    if($_POST["islem"] == "haber_sil")
    {
        foreach ($_POST as $value)
        {
            $db->delete("haber", $value,"haber");

            $params = array();
            array_push($params, $value);
            $haber = $db->select("SELECT *FROM haber WHERE id = ?", $params);

            unlink('../uploads/images/haber/'.$haber[0]["resim_yolu"]);
            unlink('../uploads/images/haber/'.$haber[0]["resim_yolu_thumbnail"]);

            $params = array();
            array_push($params, "haber");
            array_push($params, $value);
            $deletes = $db->select("select *from resim where modul_adi = ? and record_id = ?", $params);
            foreach ($deletes as $delete)
            {
                $db->delete("resim", $delete["id"], "resim");
                unlink("../uploads/images/haber/".$delete['kucuk']);
                unlink("../uploads/images/haber/".$delete['buyuk']);
            }
        }
    }
}

$db->TamponTemizle("haber");

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Haberler", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Haberler", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="6">
                                            <button id="btnKategori" class="btn btn-info btn-sm btn-raised">
                                                <?php echo $db->Cevirmen("KATEGORİLER", $language_id, 0); ?>
                                            </button>
                                            <button id="btnYeniHaber" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ HABER", $language_id, 0); ?> </button>
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
                                        <th width="150" class="center"><?php echo $db->Cevirmen("Tarih", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Başlık", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Kategori", $language_id, 0); ?></th>
                                        <th width="150" class="center"><?php echo $db->Cevirmen("Okuma Sayısı", $language_id, 0); ?></th>
                                        <th width="150" class="center secenekler">
                                            <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                        </th>
                                        <th class="center secenekler" width="20"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $haberler = $db->select("select *from haber order by kategori_id desc");
                                    foreach ($haberler as $haber)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $haber["id"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <?php echo $haber["tarih"];?>
                                        </td>
                                        <td>
                                            <?php echo $haber["ad"];?>
                                        </td>
                                        <td>
                                            <?php
                                            $params = array();
                                            array_push($params, $haber["kategori_id"]);
                                            $kategori = $db->select("SELECT *FROM haber_kategori WHERE id = ?", $params);
                                            echo $kategori[0]["ad"];
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $haber["okuma"]; ?>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <div class="togglebutton center">
                                                <label>
                                                    <?php
                                                    if($haber["aktif"] == 1)
                                                    {
                                                        $checked = "checked";
                                                    }else{
                                                        $checked="";
                                                    }
                                                    ?>
                                                    <input class="chcAktif" data-id="<?php echo $haber["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <button type="button" data-id="<?php echo $haber["id"]; ?>" class="btn btn-info btn-raised btn-xs btnEdit btnDuzenle">
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
<!-- Haber Modal -->
<div class="modal" id="haberEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("HABER", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Tarih", $language_id, 0); ?></label>
                                <div class="input-group date" id="datepicker-pastdisabled">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <input id="tarih" name="tarih" type="text" data-type="date" class="form-control" />
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

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Kategori", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <select id="cboHaberKategori" name="cboHaberKategori" class="form-control">
                                        <?php
                                        $kategoriler = $db->select("SELECT *FROM haber_kategori ORDER BY sira ASC");
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
                                <label for="map" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Kapak Fotoğrafı", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="haber-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label">
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
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Etiketler", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="etiket" name="etiket" value="" placeholder="<?php echo $db->Cevirmen("Yeni Ekle", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="map" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Diğer Fotoğraflar", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10 dropzone_container"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("İçerik", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <textarea name="icerik" id="icerik" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="haber_id" name="haber_id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-primary btnKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-success btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Haber .modal -->








<div class="modal" id="kategoriListModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="kullanici-form" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 id="lblMesajTitle" style="text-transform:uppercase;">
                            <?php echo $db->Cevirmen("HABER KATEGORİLERİ", $language_id, 0); ?>
                        </h4>
                        <button id="btnKategoriEkle" type="button" class="btn btn-raised btn-sm btn-info btnEkle">Ekle</button>
                        <button id="btnKategoriDuzenle" type="button" class="btn btn-raised btn-sm btn-success btnDuzenle">Düzenle</button>
                        <button id="btnKategoriSil" type="button" class="btn btn-raised btn-sm btn-danger btnSil">Sil</button>
                        <div class="scroll">
                            <ul class="user_group_list">
                                <?php
                                $haber_kategorileri = $db->select("select *from haber_kategori order by ad asc");
                                foreach ($haber_kategorileri as $haber_kategori)
                                {
                                ?>
                                <li id="grp-<?php echo $haber_kategori["id"]; ?>" data-id="<?php echo $haber_kategori["id"]; ?>" class="group-li">
                                    <span style="padding-left:5px;">
                                        <?php echo $haber_kategori["ad"]; ?>
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
                                    <input type="number" id="kategori_sira" name="sira" class="form-control" placeholder="<?php echo $db->Cevirmen("Gösterim Sırası", $language_id, 0); ?>" />
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
                                <label for="ad" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Aktif", $language_id, 0); ?> / <?php echo $db->Cevirmen("Pasif", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <div class="togglebutton center">
                                        <label style="float:left;">
                                            <input id="kategori_aktif" name="kategori_aktif" type="checkbox" <?php echo $checked; ?> />
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

<form id="sil-form" name="sil-form" method="post"></form>


<script>
    $(function () {
        $(".scroll").mCustomScrollbar({ theme: 'dark' });

        $("#btnKategoriSil").prop("disabled", true);
        $("#btnKategoriDuzenle").prop("disabled", true);


        $("#btnKategori").click(function () {
            $("#kategoriListModal").modal("show");
        });

        $("#btnKategoriEkle").click(function () {
            $("#kategoriEditModal").modal("show");
        });


        $("#btnKategoriEkle").click(function () {
            $("#btnKategoriKaydet").show();
            $("#btnKategoriGuncelle").hide();
            $("#kategori_aktif").prop("checked", true);
            $("#kategori_adi").val("");
            $("#kategoriEditModal").modal("show");
            $("#kategori_sira").focus();
        });

        $("#btnKategoriKaydet").click(function () {

            var kategori_adi = $("#kategori_adi").val();
            var sira = $("#kategori_sira").val();
            var aktif = $("#kategori_aktif").is(":checked");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'haber_kategori', islem: 'kategori_ekle', adi: kategori_adi, sira: sira, aktif: aktif },
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
                data: { modul: 'haber_kategori', islem: 'select_kategori', id: kategori_id },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#kategori_sira").val(result[0]);
                    $("#kategori_adi").val(result[1]);
                    aktif = result[2] == 1 ? true : false;
                    $("#kategori_aktif").prop("checked", aktif);
                    $("#btnKategoriKaydet").hide();
                    $("#btnKategoriGuncelle").show();
                    $("#kategoriEditModal").modal("show");
                    $("#kategori_sira").focus();
                },
                error: function (a, b, c) { alert(a.responseText, b.responseText, c.responseText); }
            });
        });

        $("#btnKategoriGuncelle").click(function () {

            if (kategori_id == null) return;
            var kategori_adi = $("#kategori_adi").val();
            var sira = $("#kategori_sira").val();
            var aktif = $("#kategori_aktif").is(":checked");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'haber_kategori', islem: 'kategori_guncelle', sira: sira, adi: kategori_adi, aktif: aktif, kategori_id: kategori_id },
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
                    data: { modul: 'haber_kategori', islem: 'kategori_sil', id: id },
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











    });
</script>





<script>
    var sessionId = '<?php echo session_id();  ?>';

    $(function () {

        $(".chcAktif").change(function (e) {

            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'active_state_change', modul: 'haber', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });


        $('#haberEditModal').on('shown.bs.modal', function () {
            //$("#tarih").focus();
        });

        $("#btnYeniHaber").click(function () {

            $("input[data-type='date']").val("<?php echo date("d-m-Y");?>");
            $("#ad").val("");
            $("#icerik").code("");
            $(".haber-file").html("<image />");
            $(".islem").val("haber_ekle");
            $("#chcGorunurluk").prop("checked", true);
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
            dropzone("haber", sessionId);

            $("#haberEditModal").modal("show");
        });

        $(".btnEdit").click(function () {
            var id = $(this).attr("data-id");
            dropzone("haber", id);
            $("#haberEditModal").modal("show");
            $("#haber_id").val(id);
            $(".islem").val("haber_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();


            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'haber' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#haber_id").val(result[0]);
                    $("#tarih").val(result[1]);
                    $("#ad").val(result[2]);
                    $('.summernote').code(result[3]);

                    $(".haber-file").html("<image />");
                    $(".haber-file img").prop("src", "../uploads/images/haber/" + result[4]);

                    var aktif = result[5] == 1 ? true : false;
                    $('#chcGorunurluk').prop("checked", aktif);

                    $("#cboHaberKategori").find("option[value='" + result[6] + "']").prop("selected", true);

                    $('#etiket').tokenfield('setTokens', result[7]);

                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });

        $('.summernote').summernote({
            lang: 'tr-TR',
            height: 200,
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']]
            ]
        });

        $('#datepicker-pastdisabled').datepicker({
            todayHighlight: true,
            startDate: "-3d",
            endDate: "+3d",
            format: 'dd-mm-yyyy',
        });





        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet haberi silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "haber_sil").appendTo('#sil-form');
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "id" + id).attr('value', id).appendTo('#sil-form');
                    }
                });
                $("#sil-form").submit();
            }
        });


    });

    var exportButtons = false;
</script>