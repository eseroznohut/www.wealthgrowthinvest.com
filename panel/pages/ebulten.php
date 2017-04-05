<?php
$ekle = $db->izinKontrol(10,"ekle");
$sil = $db->izinKontrol(10,"sil");
$duzenle = $db->izinKontrol(10,"duzenle");
$guncelle = $db->izinKontrol(10,"guncelle");

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

if($_POST["islem"] == "eposta_gonder"){
    $db->myFunctions->mailGonder($db,$_POST["alici_eposta"],$_POST["konu"],$_POST["mesaj"],$settings[0]["firma_adi"]);
}
if($_POST["islem"] == "ebulten_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("ebulten", $value,"ebulten");
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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("E-bülten", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("E-bülten", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="4">
                                            <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
                                            <button id="btnEpostaGonder" class="btn btn-info btn-sm btn-raised"><?php echo $db->Cevirmen("Eposta Gönder", $language_id, 0); ?></button>
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
                                        <th><?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ebulten_listesi = $db->select("select *from ebulten order by tarih asc");
                                    foreach ($ebulten_listesi as $ebulten)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $ebulten["id"]; ?>" data-eposta="<?php echo $ebulten["eposta"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <?php echo $ebulten["tarih"];?>
                                        </td>
                                        <td>
                                            <?php echo $ebulten["eposta"];?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="sil-form" name="sil-form" method="post"></form>

<script>

    var alici_eposta = [];

    $(function () {

        $('#epostaGonderModal').on('shown.bs.modal', function () {
            $("#konu").focus();
        });

        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet eposta adresini ebülten listesinden silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "ebulten_sil").appendTo('#sil-form');
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "d-" + id).attr('value', id).appendTo('#sil-form');
                    }
                });
                $("#sil-form").submit();
            }
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


    });
    exportButtons = true;
</script>


<link href="assets/plugins/form-select2/select2.css" rel="stylesheet" />
<script src="assets/plugins/form-select2/select2.min.js"></script>