<?php
$ekle = $db->izinKontrol(9,"ekle");
$sil = $db->izinKontrol(9,"sil");
$duzenle = $db->izinKontrol(9,"duzenle");
$guncelle = $db->izinKontrol(9,"guncelle");

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
if($_POST["islem"] == "telefon_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("ziyaretci_telefon", $value,"ziyaretci_telefon");
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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Telefon Numaraları", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Telefon Numaraları", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="4">
                                            <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("SİL", $language_id, 0); ?></button>
                                            <button id="btnSmsGonder" class="btn btn-info btn-sm btn-raised"><?php echo $db->Cevirmen("SMS GÖNDER", $language_id, 0); ?></button>
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
                                        <th><?php echo $db->Cevirmen("Gönderen Kişi", $language_id, 0); ?></th>
                                        <th width="200"><?php echo $db->Cevirmen("Telefon Numarası", $language_id, 0); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $telefonlar = $db->select("select *from ziyaretci_telefon order by tarih desc");
                                    foreach ($telefonlar as $telefon)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $telefon["id"]; ?>" />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <?php echo $telefon["tarih"];?>
                                        </td>
                                        <td>
                                            <?php echo $telefon["ad_soyad"];?>
                                        </td>
                                        <td>
                                            <?php echo $telefon["telefon_no"];?>
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

<form id="sil-form" name="sil-form" method="post"></form>

<script>
    $(function () {
        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet telefon numarasını silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "telefon_sil").appendTo('#sil-form');
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
</script>



