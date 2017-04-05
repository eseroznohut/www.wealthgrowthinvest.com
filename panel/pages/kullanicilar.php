<link href="assets/plugins/mscroller/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/mscroller/jquery.mCustomScrollbar.js"></script>

<?php
$ekle = $db->izinKontrol(11,"ekle");
$sil = $db->izinKontrol(11,"sil");
$duzenle = $db->izinKontrol(11,"duzenle");
$guncelle = $db->izinKontrol(11,"guncelle");
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
if($_POST["islem"] == "mesaj_gonder"){
    $sendMail = $_POST["alici_eposta"];
    $subject = $_POST["alici_konu"];
    $message = $_POST["alici_mesaj"];
    $gonderen_ad = $settings[0]["firma_adi"];
    $db->myFunctions->mailGonder($db, $sendMail, $subject, $message,"", $gonderen_ad);
?>
<script>
    $(function () {
        new PNotify({
            title: "<?php echo $sonuc; ?>",
            type: 'info',
            delay: 10000,
            icon: 'fa fa-info-circle'
        });
    });
</script>
<?php
}
if($_POST["islem"] == "kullanici_guncelle"){
    $db->KullaniciGuncelle();
}
if($_POST["islem"] == "kullanici_ekle"){
    $db->KullaniciEkle();
}
if($_POST["islem"] == "kullanici_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("users", $value,"users");
    }
}
?>

<style>
    .scroll {
        height: 150px;
    }

    .user_group_list {
        padding: 0px;
        margin: 0px;
        width: 100%;
        height: auto;
        overflow: hidden;
    }

        .user_group_list li {
            width: 100%;
            height: auto;
            overflow: hidden;
            border-bottom: solid 1px #efefef;
            padding: 10px;
            -webkit-transition: background-color 0.1s linear;
            -moz-transition: background-color 0.1s linear;
            -o-transition: background-color 0.1s linear;
            -ms-transition: background-color 0.1s linear;
            transition: background-color 0.1s linear;
            cursor: pointer;
        }

            .user_group_list li:before {
                content: "\f105";
                font-family: 'FontAwesome';
            }

            .user_group_list li:hover {
                background-color: #ededed;
            }

    .group-select {
        background-color: #73d0ff;
    }
</style>

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Kullanıcılar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="btnGruplar" type="button" class="btn btn-info btn-sm btn-raised">
                <?php echo $db->Cevirmen("Kullanıcı Grupları ve İzinleri", $language_id, 0); ?>
            </button>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Kullanıcılar", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="5">
                                            <button id="btnYeniKullanici" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("Yeni Kullanıcı", $language_id, 0); ?></button>
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
                                        <th width="200"><?php echo $db->Cevirmen("Ad", $language_id, 0); ?>, <?php echo $db->Cevirmen("Soyad", $language_id, 0); ?></th>
                                        <th width="200"><?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Kullanıcı Grubu", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Eposta", $language_id, 0); ?></th>
                                        <th class="center secenekler" width="10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $kullanicilar = $db->select("select *from users order by ad_soyad asc");
                                    foreach ($kullanicilar as $kullanici)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $kullanici["id"]; ?>" data-eposta="<?php echo $kullanici["eposta"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $kullanici["ad_soyad"];?>
                                        </td>
                                        <td>
                                            <?php echo $kullanici["username"];?>
                                        </td>
                                        <td>
                                            <?php
                                        $params = array();
                                        array_push($params, $kullanici["u_users_group_id"]);
                                        $kullanici_gruplari = $db->select("SELECT *FROM u_users_group WHERE id = ?", $params);
                                        echo $kullanici_gruplari[0]["name"];
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $kullanici["eposta"];?>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <button type="button" data-id="<?php echo $kullanici["id"]; ?>" class="btn btn-info btn-raised btn-xs btnEdit btnDuzenle" title="Kullanıcıyı Görüntüle">
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

<div class="modal" id="grupListModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="kullanici-form" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 id="lblMesajTitle" style="text-transform:uppercase;">
                            <?php echo $db->Cevirmen("GRUPLAR", $language_id, 0); ?>
                        </h4>
                        <button id="btnGrpEkle" type="button" class="btn btn-raised btn-sm btn-info btnEkle">Ekle</button>
                        <button id="btnGrpDuzenle" type="button" class="btn btn-raised btn-sm btn-success btnDuzenle">Düzenle</button>
                        <button id="btnGrpSil" type="button" class="btn btn-raised btn-sm btn-danger btnSil">Sil</button>
                        <div class="scroll">
                            <ul class="user_group_list">
                                <?php
                            $groups = $db->select("select *from u_users_group order by name asc");
                            foreach ($groups as $group)
                            {
                                ?>
                                <li id="grp-<?php echo $group["id"]; ?>" data-id="<?php echo $group["id"]; ?>" class="group-li">
                                    <span style="padding-left:5px;">
                                        <?php echo $group["name"]; ?>
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

<div class="modal" id="grupEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="kullanici-form" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 style="text-transform:uppercase;"></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Grup Adı", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="grup_name" name="grup_name" class="form-control" placeholder="<?php echo $db->Cevirmen("Grup Adı", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <table id="tbl_modul" width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>Modül Adı</th>
                                            <th>Modüle Erişim</th>
                                            <th>Kayıt Ekleme</th>
                                            <th>Kayıt Görüntüleme</th>
                                            <th>Kayıt Güncelleme</th>
                                            <th>Kayıt Silme</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <?php echo $db->Cevirmen("Kapat", $language_id, 0); ?>
                    </button>
                    <button id="btnGrupKaydet" type="button" class="btn btn-raised btn-info">
                        <?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?>
                    </button>
                    <button id="btnGrupGuncelle" type="button" class="btn btn-raised btn-success btnGuncelle">
                        <?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="kullaniciEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="kullanici-form" data-parsley-validate="">
                <div class="modal-body">
                    <div class="about-area">
                        <h4 id="lblMesajTitle" style="text-transform:uppercase;"><?php echo $db->Cevirmen("KULLANICI", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Ad", $language_id, 0); ?>, <?php echo $db->Cevirmen("Soyad", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="ad_soyad" name="ad_soyad" class="form-control" placeholder="<?php echo $db->Cevirmen("Ad", $language_id, 0); ?>, <?php echo $db->Cevirmen("Soyad", $language_id, 0); ?>" data-parsley-trigger="change" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="kullanici_adi" name="kullanici_adi" class="form-control" placeholder="<?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?>" data-parsley-trigger="change" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label">
                                    <?php echo $db->Cevirmen("Kullanıcı Grubu", $language_id, 0); ?>
                                </label>
                                <div class="col-sm-9">
                                    <select id="cboKullaniciGrubu" name="cboKullaniciGrubu" class="form-control">
                                        <?php
                                        $kullanici_gruplari = $db->select("SELECT *FROM u_users_group ORDER BY name ASC");
                                        foreach ($kullanici_gruplari as $kullanici_grup)
                                        {
                                        ?>
                                        <option value="<?php echo $kullanici_grup["id"]; ?>"><?php echo $kullanici_grup["name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="email" id="eposta_adresi" name="eposta" class="form-control" placeholder="<?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?>"
                                           data-parsley-trigger="change"
                                           required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty eposta">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Parola (Minimum 6 Karakter)", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" id="parola" name="parola"
                                           class="form-control"
                                           placeholder="Parola"
                                           data-parsley-trigger="change"
                                           required="" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty eposta">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Parola Tekrar", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" id="parola2"
                                           data-parsley-trigger="keyup"
                                           data-parsley-minlength="6"
                                           data-parsley-minlength-message="<?php echo $db->Cevirmen("Minimum 6 Maximum 8 Karakter", $language_id, 0); ?>"
                                           data-parsley-validation-threshold="10"
                                           data-parsley-equalto="#parola"
                                           data-equalto-message="<?php echo $db->Cevirmen("Parola tekrarı gerekiyor", $language_id, 0); ?>"
                                           required=""
                                           class="form-control eposta"
                                           placeholder="<?php echo $db->Cevirmen("Parola Tekrar", $language_id, 0); ?>"
                                           name="parola2" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="overflow:hidden;">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Aktif", $language_id, 0); ?> / <?php echo $db->Cevirmen("Pasif", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="togglebutton center">
                                        <label style="float:left;">
                                            <input id="aktif" name="aktif" type="checkbox" <?php echo $checked; ?> />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" id="islem" name="islem" />
                    <input type="hidden" id="id" name="id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" onclick="return form_kontrol();" class="btn btn-info btn-raised btnKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" onclick="return form_kontrol();" class="btn btn-success btn-raised btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="sil" name="sil" method="post"></form>

<!-- KULLANICILAR -->
<script>
    $(function () {

        $(".scroll").mCustomScrollbar({ theme: 'dark' });

        $("#btnYeniKullanici").click(function () {
            $("#kullaniciEditModal").modal("show");
            $(".btnKaydet").show();
            $(".btnGuncelle").hide();
            $("#islem").val("kullanici_ekle");
            $("#ad_soyad").val("");
            $("#kullanici_adi").val("");
            $("#eposta_adresi").val("");
            $("#parola").val("");
            $("#parola2").val("");
            $("#aktif").prop("checked", true);
        });

        $(".btnEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#islem").val("kullanici_guncelle");
            $("#id").val(id);
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'kullanici' },
                url: 'system/ajax.php',
                success: function (result) {

                    $("#ad_soyad").val(result[0]);
                    $("#kullanici_adi").val(result[1]);
                    $("#eposta_adresi").val(result[2]);

                    $("#parola").val(result[3]);
                    $("#parola2").val(result[3]);

                    var checked = result[4] == 1 ? true : false;
                    $("#aktif").prop("checked", checked);

                    $(".btnKaydet").hide();
                    $(".btnGuncelle").show();
                    $("#kullaniciEditModal").modal("show");
                },
                error: function (a, b, c) { alert("hata"); }
            });
        });

        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet kullanıcıyı silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "kullanici_sil").appendTo('#sil');
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
<!-- KULLANICILAR -->
<!-- GRUPLAR -->
<script>
    var seciliGrupId;

    $(function () {

        //  GRUPLAR BAŞLANGIÇ
        $("#btnGrpSil").prop("disabled", true);
        $("#btnGrpDuzenle").prop("disabled", true);

        $("#btnGruplar").click(function () {
            $("#grupListModal").modal("show");
        });

        $("#btnGrpEkle").click(function () {
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'kullanici_grup', islem: 'select_modul' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#tbl_modul tbody").html("");

                    for (var i = 0; i < result.length; i++) {
                        var row_template = '<tr id="ROW-' + i + '"><td> X_LABEL </td><td><div class="togglebutton toggle-warning"><label><input type="checkbox" data-id="X_ERISIM_ID" data-option="goruntule" checked="" /></label></div></td><td><div class="togglebutton toggle-info"><label><input type="checkbox" data-id="X_EKLEME_ID" data-option="ekle" checked="" /></label></div></td><td><div class="togglebutton toggle-success"><label><input type="checkbox" data-id="X_DUZENLEME_ID" data-option="duzenle" checked="" /></label></div></td><td>   <div class="togglebutton toggle-danger"><label><input type="checkbox" data-id="X_GUNCELLE_ID" data-option="guncelle" checked="" /></label></div>    </td><td><div class="togglebutton toggle-danger"><label><input type="checkbox" data-id="X_SILME_ID" data-option="sil" checked="" /></label></div></td></tr>';
                        row_template = row_template.replace("X_LABEL", result[i][1]);
                        row_template = row_template.replace("X_ERISIM_ID", result[i][0]);
                        row_template = row_template.replace("X_EKLEME_ID", result[i][0]);
                        row_template = row_template.replace("X_DUZENLEME_ID", result[i][0]);
                        row_template = row_template.replace("X_GUNCELLE_ID", result[i][0]);
                        row_template = row_template.replace("X_SILME_ID", result[i][0]);

                        $("#tbl_modul tbody").append(row_template);

                        if (result[i][0] === "12") {
                            $("#ROW-" + i).find("input[data-option='ekle']").hide();
                            $("#ROW-" + i).find("input[data-option='sil']").hide();
                            $("#ROW-" + i).find("input[data-option='duzenle']").hide();
                        }

                        if (result[i][0] === "10") {
                            $("#ROW-" + i).find("input[data-option='ekle']").hide();
                            $("#ROW-" + i).find("input[data-option='duzenle']").hide();
                            $("#ROW-" + i).find("input[data-option='guncelle']").hide();
                        }

                        if (result[i][0] === "9") {
                            $("#ROW-" + i).find("input[data-option='ekle']").hide();
                            $("#ROW-" + i).find("input[data-option='duzenle']").hide();
                            $("#ROW-" + i).find("input[data-option='guncelle']").hide();
                        }

                        if (result[i][0] === "8") {
                            $("#ROW-" + i).find("input[data-option='ekle']").hide();
                            $("#ROW-" + i).find("input[data-option='duzenle']").hide();
                            $("#ROW-" + i).find("input[data-option='guncelle']").hide();
                        }
                    }
                    var islem_log_row = '<tr id="00"><td>İşlem Kayıtları (Log)</td><td><div class="togglebutton toggle-warning"><label><input type="checkbox" data-id="islem-log" data-option="goruntule" checked="" /></label></div></td><td></td><td></td><td></td><td></td></tr>';
                    $("#tbl_modul tbody").append(islem_log_row);
                    $("#tbl_modul tbody").find(".togglebutton input[type='checkbox']").after("<span class='toggle'></span>");
                    $("#btnGrupKaydet").show();
                    $("#btnGrupGuncelle").hide();
                    $("#grup_name").val("");
                    $("#grupEditModal").modal("show");
                },
                error: function (a, b, c) { alert(a.responseText, b.responseText, c.responseText); }
            });
        });

        $("#btnGrupKaydet").click(function () {
            var columns;
            var grup_name = $("#grup_name").val();

            var islem_loglarini_goruntule = $("input[data-id='islem-log']").is(":checked");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'kullanici_grup', islem: 'insert_group', grup_name: grup_name, islem_loglarini_goruntule: islem_loglarini_goruntule },
                url: 'system/ajax.php',
                success: function (result) {
                    if (result[0].length > 0) {
                        var grup_id = result[0];

                        $("#cboKullaniciGrubu").append("<option value='" + grup_id + "'>" + grup_name + "</option>");
                        var i = 0;
                        $("#tbl_modul tbody tr td input[type='checkbox']").each(function () {
                            i++;

                            var id = $(this).attr("data-id");
                            var field = $(this).attr("data-option");
                            var value = $(this).is(':checked');

                            var column;
                            if (i == 1) {
                                columns = [];
                                column = [];
                            }

                            column = [id, field, value];
                            columns.push(column);

                            if (i == 5) {
                                i = 0;
                                $.ajax({
                                    method: 'post',
                                    dataType: 'json',
                                    data: { modul: 'kullanici_grup', islem: 'insert_kullanici_group_izinler', grup_id: grup_id, columns: columns, id: id },
                                    url: 'system/ajax.php',
                                    success: function (result) {

                                    },
                                    error: function (a, b, c) { alert(c.responseText); }
                                });
                            }
                        });

                        $("#grupEditModal").modal("hide");
                        $(".user_group_list").append('<li id="grp-' + result[0] + '" data-id="' + result[0] + '" class="group-li"><span style="padding-left:5px;">' + grup_name + '</span></li>');
                    }
                },
                error: function (a, b, c) { alert(a.responseText); }
            });
        });

        $("#btnGrpDuzenle").click(function () {
            if (seciliGrupId == null) return;
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'kullanici_grup', islem: 'select_group', grup_id: seciliGrupId },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#tbl_modul tbody").html("");
                    for (var i = 0; i < result.length; i++) {
                        var row_template = '<tr id="X_ROW_ID" data-grup-id="' + seciliGrupId + '" data-permission-id="' + result[i][6] + '"><td> X_LABEL </td><td><div class="togglebutton toggle-warning"><label><input type="checkbox" name="erisim" data-id="X_ERISIM_ID" data-option="goruntule" checked="" /></label></div></td><td><div class="togglebutton toggle-info"><label><input type="checkbox" name="ekle" data-id="X_EKLEME_ID" data-option="ekle" checked="" /></label></div></td><td><div class="togglebutton toggle-success"><label><input type="checkbox" name="duzenle" data-id="X_DUZENLEME_ID" data-option="duzenle" checked="" /></label></div></td> <td><div class="togglebutton toggle-danger"><label><input type="checkbox" name="guncelle" data-id="X_GUNCELLE_ID" data-option="guncelle" checked="" /></label></div></td> <td><div class="togglebutton toggle-danger"><label><input type="checkbox" name="sil" data-id="X_SILME_ID" data-option="sil" checked="" /></label></div></td></tr>';
                        row_template = row_template.replace("X_ROW_ID", "ROW-" + result[i][0]);
                        row_template = row_template.replace("X_LABEL", result[i][1]);
                        row_template = row_template.replace("X_ERISIM_ID", result[i][0]);
                        row_template = row_template.replace("X_EKLEME_ID", result[i][0]);
                        row_template = row_template.replace("X_DUZENLEME_ID", result[i][0]);
                        row_template = row_template.replace("X_GUNCELLE_ID", result[i][0]);
                        row_template = row_template.replace("X_SILME_ID", result[i][0]);
                        $("#tbl_modul tbody").append(row_template);

                        if (result[i][0] === "12") { //EĞER GENEL AYARLAR İSE
                            $("#ROW-" + result[i][0]).find("input[data-option='ekle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='sil']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='duzenle']").remove();
                        }

                        if (result[i][0] === "10") {
                            $("#ROW-" + result[i][0]).find("input[data-option='ekle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='duzenle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='guncelle']").remove();
                        }

                        if (result[i][0] === "9") {
                            $("#ROW-" + result[i][0]).find("input[data-option='ekle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='duzenle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='guncelle']").remove();
                        }

                        if (result[i][0] === "8") {
                            $("#ROW-" + result[i][0]).find("input[data-option='ekle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='duzenle']").remove();
                            $("#ROW-" + result[i][0]).find("input[data-option='guncelle']").remove();
                        }

                        var ekle = result[i][2] == 1 ? true : false;
                        $("input[type='checkbox'][data-id='" + result[i][0] + "'][data-option='ekle']").prop("checked", ekle);

                        var sil = result[i][3] == 1 ? true : false;
                        $("input[type='checkbox'][data-id='" + result[i][0] + "'][data-option='sil']").prop("checked", sil);

                        var duzenle = result[i][4] == 1 ? true : false;
                        $("input[type='checkbox'][data-id='" + result[i][0] + "'][data-option='duzenle']").prop("checked", duzenle);

                        var goruntule = result[i][5] == 1 ? true : false;
                        $("input[type='checkbox'][data-id='" + result[i][0] + "'][data-option='goruntule']").prop("checked", goruntule);

                        var guncelle = result[i][7] == 1 ? true : false;
                        $("input[type='checkbox'][data-id='" + result[i][0] + "'][data-option='guncelle']").prop("checked", guncelle);
                    }

                    $.ajax({
                        method: 'post',
                        dataType: 'json',
                        data: { modul: 'kullanici_grup', islem: 'select_group_name', grup_id: seciliGrupId },
                        url: 'system/ajax.php',
                        success: function (result) {
                            $("#grup_name").val(result[0]);
                            var islem_log_row = '<tr><td>İşlem Kayıtları (Log)</td><td><div class="togglebutton toggle-warning"><label><input type="checkbox" name="islem_loglarini_goster" data-id="grp-row-' + seciliGrupId + '" data-option="islem_loglarini_goster" checked="" /></label></div></td><td></td><td></td><td></td><td></td></tr>';
                            $("#tbl_modul tbody").append(islem_log_row);
                            var islem_log_goruntule = result[1] == 1 ? true : false;
                            $("input[type='checkbox'][data-id='grp-row-" + seciliGrupId + "'][data-option='islem_loglarini_goster']").prop("checked", islem_log_goruntule);
                            $("input[type='checkbox'][data-id='grp-row-" + seciliGrupId + "'][data-option='islem_loglarini_goster']").after("<span class='toggle'></span>");
                        },
                        error: function () { }
                    });

                    $("#tbl_modul tbody").find(".togglebutton input[type='checkbox']").after("<span class='toggle'></span>");
                    $("#btnGrupKaydet").hide();
                    $("#btnGrupGuncelle").show();
                    $("#grupEditModal").modal("show");
                },
                error: function (a, b, c) { alert(a.responseText, b.responseText, c.responseText); }
            });
        });

        $("#btnGrupGuncelle").click(function () {

            if (seciliGrupId == null) return;
            var grup_id = $(".group-select").attr("data-id");
            var grup_name = $("#grup_name").val();
            var islem_loglarini_goruntule = $("input[data-option='islem_loglarini_goster']").is(":checked");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'kullanici_grup', islem: 'kullanici_grup_guncelle', grup_id: grup_id, grup_name: grup_name, islem_loglarini_goruntule: islem_loglarini_goruntule },
                url: 'system/ajax.php',
                success: function (result) {

                    $("#tbl_modul tbody tr").each(function () {
                        var permission_id = $(this).attr("data-permission-id");
                        var ekle = $(this).find("input[name='ekle']").is(":checked");
                        var sil = $(this).find("input[name='sil']").is(":checked");
                        var duzenle = $(this).find("input[name='duzenle']").is(":checked");
                        var goruntule = $(this).find("input[name='erisim']").is(":checked");
                        var guncelle = $(this).find("input[name='guncelle']").is(":checked");

                        $.ajax({
                            method: 'post',
                            dataType: 'json',
                            data: { modul: 'kullanici_grup', islem: 'izin_guncelle', grup_id: grup_id, permission_id: permission_id, ekle: ekle, sil: sil, duzenle: duzenle, guncelle: guncelle, goruntule: goruntule },
                            url: 'system/ajax.php',
                            success: function (result) { },
                            error: function (a, b, c) { alert(a.responseText, ' ', b.responseText, ' ', c.responseText); }
                        });
                    });

                    $("#grp-" + grup_id).html(" " + grup_name);
                    $("#grupEditModal").modal("hide");
                },
                error: function (a, b, c) { alert(a.responseText, ' ', b.responseText, ' ', c.responseText); }
            });
        });

        $("#btnGrpSil").click(function () {

            var id = $(".group-select").attr("data-id");
            var ad = $(".group-select span").html().replace(/\s/g, '');

            var conf = confirm(ad + " isimli grubu silmek istediğinizden eminmisiniz?");
            if (conf) {
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { modul: 'kullanici_grup', islem: 'delete_kullanici_group', id: id },
                    url: 'system/ajax.php',
                    success: function (result) {
                        $("#grp-" + id).remove();
                        $("#btnGrpSil").prop("disabled", true);
                        $("#btnGrpDuzenle").prop("disabled", true);
                    },
                    error: function () { alert("hata"); }
                });
            }
        });

        $(".group-li").click(function () {
            $(".group-li").removeClass("group-select");
            $(this).addClass("group-select");
            seciliGrupId = $(this).attr("data-id");
            $("#btnGrpSil").prop("disabled", false);
            $("#btnGrpDuzenle").prop("disabled", false);
        });


    });
</script>
<!-- GRUPLAR -->