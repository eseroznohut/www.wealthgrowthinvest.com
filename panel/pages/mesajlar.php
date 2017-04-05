<?php
$ekle = $db->izinKontrol(8,"ekle");
$sil = $db->izinKontrol(8,"sil");
$duzenle = $db->izinKontrol(8,"duzenle");
$guncelle = $db->izinKontrol(8,"guncelle");

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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Mesajlar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Mesajlar", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="6">
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
                                        <th style="width:10px;">

                                        </th>
                                        <th width="150" class="center"><?php echo $db->Cevirmen("Tarih", $language_id, 0); ?></th>
                                        <th width="300"><?php echo $db->Cevirmen("Gönderen", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Konu", $language_id, 0); ?></th>
                                        <th class="center secenekler" width="10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mesajlar = $db->select("select *from mesaj order by tarih desc");
                                    foreach ($mesajlar as $mesaj)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">        
                                            <?php
                                            if($mesaj["gelengiden"] == 0){
                                            ?>
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $mesaj["id"]; ?>" data-eposta="<?php echo $mesaj["eposta"]; ?>" />
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class="center" style="padding:0px;">
                                            <?php
                                        if($mesaj["gelengiden"] == 1){
                                            //echo '<i class="fa fa-upload btn-info" aria-hidden="true" title="Giden Mesaj"></i>';
                                            echo '<span class="label label-info">Giden</span>';
                                        }else
                                        {
                                            //echo '<i class="fa fa-download btn-success" aria-hidden="true" title="Gelen Mesaj"></i>';
                                            echo '<span class="label label-success">Gelen</span>';
                                        }

                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $mesaj["tarih"];?>
                                        </td>
                                        <td>
                                            <?php 
                                            
                                            echo $mesaj["ad"];
                                            
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $mesaj["konu"];?>
                                        </td>
                                        <td class="center secenekler secenekler_column">                                                                                    
                                            <button type="button" data-name="<?php echo $mesaj["ad"]; ?>" data-id="<?php echo $mesaj["id"]; ?>" class="btn btn-info btn-raised btn-xs btnMesajGoster" title="<?php echo $db->Cevirmen("Mesajı Görüntüle", $language_id, 0); ?>">
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

<form id="sil-form" name="sil-form" method="post"></form>

<script>
    $(function () {
        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet mesajı silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "mesaj_sil").appendTo('#sil-form');
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