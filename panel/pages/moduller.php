<?php
$ekle = $db->izinKontrol(1,"ekle");
$sil = $db->izinKontrol(1,"sil");
$duzenle = $db->izinKontrol(1,"duzenle");
$guncelle = $db->izinKontrol(1,"guncelle");

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
if($_POST["islem"] == "modul_ekle"){
    $db->ModulEkle();
}
if($_POST["islem"] == "modul_guncelle"){
    $db->ModulGuncelle();
}
if($_POST["islem"] == "modul_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("modul", $value,"modul");
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
                                <h4 class="media-heading" style="float:left;"><?php echo $db->Cevirmen("Navigasyon", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="basliklar"><?php echo $db->Cevirmen("Modüller", $language_id, 0); ?></h2>
                        </div>
                        <div class="panel-body no-padding">
                            <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="mycontrol-box" colspan="7">
                                            <button id="btnYeniModul" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ MODÜL", $language_id, 0); ?> </button>
                                            <button id="btnSil" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("SİL", $language_id, 0); ?></button>
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
                                        <th width="50" class="center"><?php echo $db->Cevirmen("Sıra", $language_id, 0); ?></th>
                                        <th><?php echo $db->Cevirmen("Modül Adı", $language_id, 0); ?></th>
                                        <th width="100" class="center secenekler">
                                            <?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>
                                        </th>
                                        <th width="100" class="center secenekler secenekler_column">
                                            <?php echo $db->Cevirmen("Widget", $language_id, 0); ?>
                                        </th>
                                        <th width="100" class="center"><?php echo $db->Cevirmen("Gösterim", $language_id, 0); ?></th>
                                        <th class="center secenekler" width="10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $moduller = $db->select("select *from modul order by sira asc");
                                    foreach ($moduller as $modul)
                                    {
                                    ?>
                                    <tr>
                                        <td class="center">
                                            <?php
                                        if($modul["gizli"] == 0){
                                            ?>
                                            <div class="checkbox checkbox-info">
                                                <label>
                                                    <input type="checkbox" data-type="select" data-id="<?php echo $modul["id"]; ?>" />
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $modul["sira"];?>
                                        </td>
                                        <td>
                                            <?php echo $modul["ad"];?>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <div class="togglebutton center">
                                                <label>
                                                    <?php
                                        if($modul["aktif"] == 1)
                                        {
                                            $checked = "checked";
                                        }else{
                                            $checked="";
                                        }
                                                    ?>
                                                    <input class="chcAktif" data-id="<?php echo $modul["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <div class="togglebutton toggle-success center">
                                                <label>
                                                    <?php
                                        if($modul["anasayfada_goster"] == 1)
                                        {
                                            $checked = "checked";
                                        }else{
                                            $checked="";
                                        }
                                                    ?>
                                                    <input class="chcWidget" data-id="<?php echo $modul["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                </label>
                                            </div>

                                        </td>
                                        <td class="center">
                                            <?php echo $modul["goruntuleme"];?>
                                        </td>
                                        <td class="center secenekler secenekler_column">
                                            <?php
                                        if($modul["gizli"] == 0){
                                            ?>

                                            <button type="button" data-id="<?php echo $modul["id"]; ?>" class="btn btn-info btn-raised btn-xs btnModulEdit btnDuzenle">
                                                <i class="fa fa-pencil"></i>
                                                <div class="ripple-container"></div>
                                            </button>

                                            <?php
                                        }else
                                        {
                                            echo "<span class='label label-success' style='padding-left:5px;padding-right:5px;padding-top:2px;padding*bottom:2px;'>".$db->Cevirmen("SABİT MODÜL", $language_id)."</span>";
                                        }
                                            ?>
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

<!-- modul Edit Modal -->
<div id="modulEditModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("MODÜL", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="number" id="sira" name="sira" class="form-control" placeholder="<?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Modül Adı", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="ad" name="ad" class="form-control" placeholder="<?php echo $db->Cevirmen("Modül Adı", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="chcGorunurluk1" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="togglebutton">
                                        <label>
                                            <input id="chcGorunurluk1" name="chcGorunurluk1" type="checkbox" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="chcWidget1" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Widget", $language_id, 0); ?></label>
                                <div class="col-sm-9">
                                    <div class="togglebutton toggle-success">
                                        <label>
                                            <input id="chcWidget1" name="chcWidget1" type="checkbox" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="modul_id" name="modul_id" />
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-sm btn-raised btn-primary btnModulKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-sm btn-raised btn-success btnModulGuncelle btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- /modul Edit Modal -->

<form id="sil-form" name="sil-form" enctype="multipart/form-data" method="post"></form>

<script>
    $(function () {


        $(".chcWidget").change(function (e) {
            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'widget_state_change', modul: 'modul', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });

        $(".chcAktif").change(function (e) {

            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'active_state_change', modul: 'modul', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });

        $('#modulEditModal').on('shown.bs.modal', function () {
            $("#sira").focus();
        });

        $("#btnYeniModul").click(function () {
            $("#modulEditModal").modal("show");
            $("#sira").val("");
            $("#ad").val("");
            $(".btnModulKaydet").show();
            $(".btnModulGuncelle").hide();
            $(".islem").val("modul_ekle");
            $("#chcGorunurluk1").prop("checked", true);
            $("#chcWidget1").prop("checked", false);
        });

        $(".btnModulEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#modulEditModal").modal("show");
            $("#modul_id").val(id);
            $(".islem").val("modul_guncelle");
            $(".btnModulGuncelle").show();
            $(".btnModulKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'modul' },
                url: 'system/ajax.php',
                success: function (result) {


                    $("#sira").val(result[0]);
                    $("#ad").val(result[1]);

                    $("#modul_id option[value='" + result[2] + "']").attr("selected", "selected");

                    var gorunurluk = false;
                    if (result[3] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk1").prop("checked", gorunurluk);

                    var widget = false;
                    if (result[4] == 1) { widget = true; }
                    $("#chcWidget1").prop("checked", widget);

                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });

        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet modülü silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "modul_sil").appendTo('#sil-form');
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



