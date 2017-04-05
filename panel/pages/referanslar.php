<link href="assets/plugins/mscroller/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.js"></script>

<?php
$ekle = $db->izinKontrol(17,"ekle");
$sil = $db->izinKontrol(17,"sil");
$duzenle = $db->izinKontrol(17,"duzenle");
$guncelle = $db->izinKontrol(17,"guncelle");

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
    if($_POST["islem"] == "referans_ekle"){
        $db->ReferansEkle();
    }
    if($_POST["islem"] == "referans_guncelle"){
        $db->ReferansGuncelle();
    }
    if($_POST["islem"] == "referans_sil")
    {
        foreach ($_POST as $value)
        {
            $db->delete("referans", $value,"referans");
        }
    }
}

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Referanslar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Referanslar", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="4">
                                            <button id="btnKategori" class="btn btn-info btn-sm btn-raised">
                                                <?php echo $db->Cevirmen("KATEGORİLER", $language_id, 0); ?>
                                            </button>
                                            <button id="btnYeniHaber" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ REFERANS", $language_id, 0); ?> </button>
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
                                        <th><?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Kategori", $language_id, 0); ?></th>
                                        <th class="center secenekler" width="20"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $referanslar = $db->select("select *from referans order by kategori_id desc");
                                    foreach ($referanslar as $referans)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $referans["id"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $referans["ad"];?>
                                        </td>
                                        <td>
                                            <?php
                                            $params = array();
                                            array_push($params, $referans["kategori_id"]);
                                            $kategori = $db->select("SELECT *FROM referans_kategori WHERE id = ?", $params);
                                            echo $kategori[0]["ad"];
                                            ?>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <button type="button" data-id="<?php echo $referans["id"]; ?>" class="btn btn-info btn-raised btn-xs btnEdit btnDuzenle">
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
<div class="modal" id="referansEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("REFERANS", $language_id, 0); ?></h4>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ad" name="ad" placeholder="<?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label">
                                    <?php echo $db->Cevirmen("Kategori", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-10">
                                    <select id="cboReferansKategori" name="cboReferansKategori" class="form-control">
                                        <?php
                                        $kategoriler = $db->select("SELECT *FROM referans_kategori ORDER BY sira ASC");
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
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="referans_id" name="referans_id" />
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
                            <?php echo $db->Cevirmen("REFERANS KATEGORİLERİ", $language_id, 0); ?>
                        </h4>
                        <button id="btnKategoriEkle" type="button" class="btn btn-raised btn-sm btn-info btnEkle">Ekle</button>
                        <button id="btnKategoriDuzenle" type="button" class="btn btn-raised btn-sm btn-success btnDuzenle">Düzenle</button>
                        <button id="btnKategoriSil" type="button" class="btn btn-raised btn-sm btn-danger btnSil">Sil</button>
                        <div class="scroll">
                            <ul class="user_group_list">
                                <?php
                                $referans_kategorileri = $db->select("select *from referans_kategori order by ad asc");
                                foreach ($referans_kategorileri as $referans_kategori)
                                {
                                ?>
                                <li id="grp-<?php echo $referans_kategori["id"]; ?>" data-id="<?php echo $referans_kategori["id"]; ?>" class="group-li">
                                    <span style="padding-left:5px;">
                                        <?php echo $referans_kategori["ad"]; ?>
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

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'referans', islem: 'kategori_ekle', adi: kategori_adi, sira: sira },
                url: 'system/ajax.php',
                success: function (result) {
                    var kategori_id = result[0];
                    $("#cboReferansKategori").append("<option value='" + kategori_id + "'>" + kategori_adi + "</option>");
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
                data: { modul: 'referans', islem: 'select_kategori', id: kategori_id },
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
                data: { modul: 'referans', islem: 'kategori_guncelle', sira: sira, adi: kategori_adi, aktif: aktif, kategori_id: kategori_id },
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
                    data: { modul: 'referans', islem: 'kategori_sil', id: id },
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
        $('#referansEditModal').on('shown.bs.modal', function () {
            //$("#tarih").focus();
        });

        $("#btnYeniHaber").click(function () {

            $("input[data-type='date']").val("<?php echo date("d-m-Y");?>");
            $("#ad").val("");
            $("#icerik").code("");
            $(".haber-file").html("<image />");
            $(".islem").val("referans_ekle");
            $("#chcGorunurluk").prop("checked", true);
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
            dropzone("haber", sessionId);

            $("#referansEditModal").modal("show");
        });

        $(".btnEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#referansEditModal").modal("show");
            $("#referans_id").val(id);
            $(".islem").val("referans_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select_referans', modul: 'referans' },
                url: 'system/ajax.php',
                success: function (result) {

                    $("#ad").val(result[1]);
                    $("#cboReferansKategori").find("option[value='" + result[2] + "']").prop("selected", true);
                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });

        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet referans silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "referans_sil").appendTo('#sil-form');
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