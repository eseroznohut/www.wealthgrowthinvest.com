<?php
$ekle = $db->izinKontrol(2,"ekle");
$sil = $db->izinKontrol(2,"sil");
$duzenle = $db->izinKontrol(2,"duzenle");
$guncelle = $db->izinKontrol(2,"guncelle");

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
if($_POST["islem"] == "sayfa_ekle"){
    $db->SayfaEkle();
}
if($_POST["islem"] == "sayfa_guncelle"){
    $db->SayfaGuncelle();
}
if($_POST["islem"] == "sayfa_sil"){
    foreach ($_POST as $value)
    {
        $db->delete("sayfa", $value,"sayfa");
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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Sayfalar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_container" class="row" style="margin-top:15px;">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="basliklar"><?php echo $db->Cevirmen("Sayfalar", $language_id, 0); ?></h2>
                            </div>
                            <div class="panel-body no-padding">
                                <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="mycontrol-box" colspan="7">
                                                <button id="btnYeniSayfa" class="btn btn-sm btn-info btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ SAYFA", $language_id, 0); ?> </button>
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
                                            <th width="100" class="center"><?php echo $db->Cevirmen("Sıra", $language_id, 0); ?></th>
                                            <th>Başlık</th>
                                            <th>Modül</th>
                                            <th class="center secenekler" width="100"><?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?></th>
                                            <th width="120" class="center"><?php echo $db->Cevirmen("Gösterim", $language_id, 0); ?></th>
                                            <th class="center secenekler" width="20"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sayfalar = $db->select("select *from sayfa order by modul_id asc");
                                        foreach ($sayfalar as $sayfa)
                                        {
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <div class="checkbox checkbox-info">
                                                    <label>
                                                        <input type="checkbox" data-type="select" data-id="<?php echo $sayfa["id"]; ?>" />
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="center">
                                                <?php echo $sayfa["sira"];?>
                                            </td>
                                            <td>
                                                <?php echo $sayfa["ad"];?>
                                            </td>
                                            <td>
                                                <?php
                                            $modul_id = $sayfa["modul_id"];
                                            $params = array();
                                            array_push($params, $modul_id);
                                            $modul = $db->select("select *from modul where id = ?", $params);
                                            echo $modul[0]["ad"];
                                                ?>
                                            </td>
                                            <td class="center secenekler secenekler_column">
                                                <div class="togglebutton center">
                                                    <label>
                                                        <?php
                                            if($sayfa["aktif"] == 1)
                                            {
                                                $checked = "checked";
                                            }else{
                                                $checked="";
                                            }
                                                        ?>
                                                        <input class="chcAktif" data-id="<?php echo $sayfa["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                    </label>
                                                </div>
                                            </td>
                                             <td class="center">
                                                <?php echo $sayfa["goruntuleme"];?>
                                            </td>
                                            <td class="center secenekler secenekler_column center">
                                                <button type="button" data-id="<?php echo $sayfa["id"]; ?>" class="btn btn-info btn-raised btn-xs btnSayfaEdit btnDuzenle">
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
<!-- Sayfa Edit Modal -->
<div class="modal" id="sayfaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="slayt">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("SAYFA", $language_id, 0); ?></h4>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="sira" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Görüntüleme Sırası", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sayfa_sira" name="sira" placeholder="<?php echo $db->Cevirmen("Sıra", $language_id, 0); ?>" />
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
                                <label for="modul" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Modül", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                   <select name="modul_id" id="modul_id" class="form-control">

                                        <?php
                                        $moduller = $db->select("select *from modul where gizli = 0");
                                        foreach ($moduller as $modul)
                                        {
                                        ?>
                                        <option value="<?php echo $modul["id"]; ?>"><?php echo $modul["ad"]; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="map" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Sayfa Resmi", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="sayfa-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                <div class="togglebutton">
                                     <label>
                                        <input id="chcGorunurluk" name="chcGorunurluk" type="checkbox"/>
                                   </label>
                                 </div>
                                </div>
                            </div>
                        </div>

                       <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("İçerik", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                     <textarea name="icerik" id="sayfa_icerik" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="sayfa_id" name="sayfa_id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-primary btnSayfaKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-success btnSayfaGuncelle btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Sayfa Edit Modal -->
<script>
    $(function () {

        $(".chcAktif").change(function (e) {

            var durum = $(this).is(':checked');
            var id = $(this).attr("data-id");

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'active_state_change', modul: 'sayfa', durum: durum },
                url: 'system/ajax.php',
                success: function (result) {
                    //alert(result[0]);
                },
                error: function (a, b, c) {
                    alert("hata");
                }
            });
        });

        $('#sayfaModal').on('shown.bs.modal', function () {
            $("#sira").focus();
        });
        $("#btnYeniSayfa").click(function () {
            $("#sayfa_sira").val("");
            $("#ad").val("");
            $("#sayfa_icerik").code("");
            $(".sayfa-file").html("<image />");
            $(".islem").val("sayfa_ekle");
            $("#chcGorunurluk").prop("checked", true);
            $("#sayfaModal").modal("show");

            $(".btnSayfaKaydet").show();
            $(".btnSayfaGuncelle").hide();
        });

        $(".btnSayfaEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#sayfaModal").modal("show");
            $("#sayfa_id").val(id);
            $(".islem").val("sayfa_guncelle");
            $(".btnSayfaGuncelle").show();
            $(".btnSayfaKaydet").hide();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id, islem: 'select', modul: 'sayfa' },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#sayfa_sira").val(result[0]);
                    $("#ad").val(result[1]);

                    $("#modul_id option[value='" + result[2] + "']").attr("selected", "selected");
                    $('.summernote').code(result[3]);

                    $(".sayfa-file").html("<image />");
                    $(".sayfa-file img").prop("src", "../uploads/images/sayfa/" + result[4]);

                    var gorunurluk = false;
                    if (result[5] == 1) { gorunurluk = true; }
                    $("#chcGorunurluk").prop("checked", gorunurluk);

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
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "sayfa_sil").appendTo('#sil-form');
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "d-" + id).attr('value', id).appendTo('#sil-form');
                    }
                });
                $("#sil-form").submit();
            }
        });


    });

    var exportButtons = false;
</script>

<form id="sil-form" name="sil-form" enctype="multipart/form-data" method="post"></form>