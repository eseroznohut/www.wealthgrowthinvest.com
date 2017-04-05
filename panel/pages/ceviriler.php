<?php
$ekle = $db->izinKontrol(13,"ekle");
if($ekle == true){
?>
<!-- Dil Edit Modal -->
<div class="modal" id="dilEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="dil">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("Dil", $language_id, 0); ?></h4>
                        <div class="form-group is-empty">
                            <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Dil Adı", $language_id, 0); ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="adi" name="adi" placeholder="<?php echo $db->Cevirmen("Dil Adı", $language_id, 0); ?>" />
                            </div>
                        </div>
                        <div class="form-group is-empty">
                            <label for="map" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Bayrak", $language_id, 0); ?></label>
                            <div class="col-sm-10">
                                <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                    <div class="flag-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0; width:48px;height:48px;"></div>
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

                        <div class="form-group is-empty">
                            <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Aktif", $language_id, 0); ?> / <?php echo $db->Cevirmen("Pasif", $language_id, 0); ?></label>
                            <div class="col-sm-10">
                                <div class="togglebutton">
                                    <label>
                                        <input id="aktif_pasif" name="aktif" type="checkbox" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" id="btnDilKaydet" class="btn btn-info btn-raised"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" id="btnDilGuncelle" class="btn btn-success btn-raised"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                    <input type="hidden" id="dil_model_islem" name="islem" value="dil_ekle" />
                    <input type="hidden" id="dil_model_id" name="id" />
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Dil Edit .modal -->
<!-- Translated Edit Modal -->
<div class="modal" id="ceviriEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" name="ceviri">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("Çeviri", $language_id, 0); ?></h4>
                        <div class="form-group is-empty">
                            <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Çevirilen Kelime", $language_id, 0); ?></label>
                            <div class="col-sm-10">
                                <textarea class="form-control summernote" id="cevirilen_kelime" name="cevirilen_kelime"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-success btn-raised"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                    <input type="hidden" id="ceviri_modal_islem" name="islem" value="ceviri_guncelle" />
                    <input type="hidden" id="ceviri_modal_id" name="id" />
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Translated Edit .modal -->
<script>
    $(function () {

        $("#btnDilEkle").click(function () {
            $("#adi").val("");
            $("#aktif_pasif").prop("checked", true);
            $('.flag-file img').remove("");

            $("#btnDilKaydet").show();
            $("#btnDilGuncelle").hide();
            $("#dilEditModal").modal("show");
        });

        $(".btnKelimeEkle").click(function () {
            if ($("#cboLanguage").val() && $("#cboWords").val()) {
                $("#ceviri_ekle_form").append("<input type='hidden' name='islem' value='add_word' />");
                $("#ceviri_ekle_form").submit();

            } else { alert("Boş alanları doldurun"); return false; }
        });
    });


</script>

<?php
}else
{
?>
<script> $(function () { $(".btnEkle").remove(); }); </script>
<?php
}
$sil = $db->izinKontrol(13,"sil");
if($sil == true){
?>

<script>
    $(function () {
        $(".btnDilSil").click(function () {
            var cf = confirm('<?php echo $db->Cevirmen("Bu dili silmek istediğinizden eminmisiniz?", $language_id, 0); ?>');
            if (cf) {
                var id = $(this).attr("data-id");
                $("#dil_table_form").append("<input type='hidden' name='islem' value='dil_sil' />");
                $("#dil_table_form").append("<input type='hidden' name='dil_id' value='" + id + "' />");
                $("#dil_table_form").append("<input type='hidden' name='aktif_tab' value='tab-2' />");
                $("#dil_table_form").submit();
            }
        });

        $(".btnCeviriSil").click(function () {
            var id = $(this).attr("data-id");
            $("body").append("<form id='ceviri_sil_form' method='post'/>");
            $("#ceviri_sil_form").append("<input type='hidden' name='islem' value='ceviri_sil'/>");
            $("#ceviri_sil_form").append("<input type='hidden' name='ceviri_id' value='" + id + "'/>");
            $("#ceviri_sil_form").submit();
        });
    });
</script>

<?php
}else
{
?>
<script> $(function () { $(".btnSil").remove();  }); </script>
<?php
}
$duzenle = $db->izinKontrol(13,"duzenle");
if($duzenle == true){
?>
<script>
    $(function () {
        $(".btnDilDuzenle").click(function () {
            var id = $(this).attr("data-id");
            $('.flag-file img').remove();
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'ceviriler', islem: 'select', id: id },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#adi").val(result[0]);


                    $('.flag-file').append("<image/>");
                    $('.flag-file img').prop('src', '../../uploads/images/language/' + result[1]);

                    $("#aktif_pasif").prop("checked", (result[2] == 1));

                    $("#btnDilKaydet").hide();
                    $("#btnDilGuncelle").show();
                    $("#dilEditModal").modal("show");
                    $("#dil_model_islem").val("dil_guncelle");
                    $("#dil_model_id").val(id);
                },
                error: function (a) { alert(a); }
            });

        });

        $(".btnCeviriDuzenle").click(function () {
            var id = $(this).attr("data-id");
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'ceviriler', islem: 'ceviri_select', id: id },
                url: 'system/ajax.php',
                success: function (result) {
                    $("#cevirilen_kelime").code(result[0]);
                    $("#ceviri_modal_id").val(id);
                    $("#ceviriEditModal").modal("show");
                },
                error: function () { alert(); }
            });
        });
    });
</script>
<?php
}else
{
?>
<script> $(function () { $(".btnDuzenle").remove(); }); </script>
<?php
}
?>

<?php
$aktif_tab = $_POST["aktif_tab"];
$id = $_POST["id"];

if($_POST){

    $islem= $_POST["islem"];

    switch ($islem)
    {
        case 'dil_ekle':
            $db->DilEkle();
            $aktif_tab = "tab-2";
            break;
        case 'dil_sil':
            $id = $_POST["dil_id"];
            $db->delete("language",$id,"language");
            $aktif_tab = "tab-2";
            break;
        case 'dil_guncelle':
            $db->DilGuncelle();
            $aktif_tab = "tab-2";
            break;
        case 'add_word':
            $db->CeviriEkle();
            break;
        case 'ceviri_sil':
            $id = $_POST["ceviri_id"];
            echo $db->delete("dictionary",$id,"dictionary");
            break;
        case 'ceviri_guncelle':
            $db->CeviriGuncelle();
            break;
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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Çeviriler", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pl-n pr-n">
                <ul class="nav nav-tabs material-nav-tabs mb-lg">
                    <li id="1" class="active">
                        <a href="#tab-1" data-toggle="tab"><?php echo $db->Cevirmen("Çeviriler", $language_id, 0); ?> </a>
                    </li>
                    <li id="2">
                        <a href="#tab-2" data-toggle="tab"><?php echo $db->Cevirmen("Diller", $language_id, 0); ?> </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="panel-profile">
                    <div class="tab-content">
                            <div class="tab-pane p-md active" id="tab-1">
                                <div class="about-area">
                                    <h4><?php echo $db->Cevirmen("Çeviriler", $language_id, 0); ?></h4>
                                    <div class="col-md-12 btnEkle">
                                        <form id="ceviri_ekle_form" name="ceviri_ekle_form" method="post" enctype="multipart/form-data">
                                            <div class="table-responsive">
                                                <div class="form-group is-empty">
                                                    <label for="sira" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Çevrilecek Dil", $language_id, 0); ?></label>
                                                    <div class="col-sm-10">
                                                        <select id="cboLanguage" name="language" class="form-control">
                                                                <?php
                                                                $languages = $db->select("select *from language where aktif = 1 order by name asc");
                                                                foreach ($languages as $value)
                                                                {
                                                                    $selected ="";
                                                                    if(!empty($_POST["language"])){
                                                                        if($_POST["language"] == $value["id"]){
                                                                            $selected ="selected";
                                                                        }
                                                                    }                                                            _
                                                                ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value["id"]; ?>"><?php echo $db->Cevirmen($value["name"], $language_id, 0); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="form-group is-empty">
                                                    <label for="sira" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Çevrilecek Kelime", $language_id, 0); ?></label>
                                                    <div class="col-sm-10">
                                                        <select id="cboWords" name="words" style="width:100% !important" class="populate"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="form-group is-empty">
                                                    <label for="sira" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Çevrilmiş Kelime", $language_id, 0); ?></label>
                                                    <div class="col-sm-9">
                                                        <textarea rows="3" id="kelime" name="value" class="form-control summernote" placeholder="<?php echo $db->Cevirmen("Çevrilmiş Kelime", $language_id, 0); ?>"></textarea>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-sm btn-info btn-raised pull-right btnKelimeEkle btnEkle" style="height:83px; width:100%;"><?php echo $db->Cevirmen("Ekle", $language_id, 0); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                            </div>
                                        </form>
                                    </div>
                                    <table class="datatable_ table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td colspan="5"><div class="panel-ctrls col-md-3" style="float:right;"></div></td>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $db->Cevirmen("Kelime", $language_id, 0); ?></th>
                                                <th><?php echo $db->Cevirmen("Çevrilmiş Kelime", $language_id, 0); ?></th>
                                                <th style="width:100px;min-width:100px;max-width:100px;"><?php echo $db->Cevirmen("Çevrilen Dil", $language_id, 0); ?></th>
                                                <th class="secenekler center" style="width:150px;min-width:150px;max-width:150px;"><?php echo $db->Cevirmen("Seçenekler", $language_id, 0); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $dictionary = $db->select("select *from dictionary order by id desc");
                                            foreach ($dictionary as $value)
                                            {
                                                $i++;
                                            ?>
                                            <tr>
                                                <td class="center">
                                                    <?php echo $i;?>
                                                </td>
                                                <td style="padding-left:5px;">
                                                    <?php
                                                $word_id = $value["word_id"];
                                                $params = array();
                                                array_push($params, $word_id);
                                                $word = $db->select("SELECT *FROM words WHERE id = ?", $params);
                                                echo $word[0]["word"];
                                                    ?>
                                                </td>
                                                <td style="padding-left:5px;">
                                                    <?php echo $value["translation"];?>
                                                </td>
                                                <td style="padding-left:5px;">
                                                    <?php
                                                $params = array();
                                                array_push($params, $value["language_id"]);
                                                $languages = $db->select("select *from language where id = ?", $params);
                                                echo $languages[0]["name"];
                                                    ?>
                                                </td>
                                                <td class="secenekler secenekler_column center">
                                                    <button type="button" class="btn btn-xs btn-raised btn-info btnCeviriDuzenle btnDuzenle" data-id="<?php echo $value["id"];?>">Düzenle</button>
                                                    <button type="submit" onclick="return confirm('Bu çeviriyi silmek istediğinizden eminmisiniz?');" data-id="<?php echo $value["id"];?>" class="btn btn-xs btn-raised btn-danger btnCeviriSil btnSil">Sil</button>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane p-md" id="tab-2">
                                <form id="dil_table_form" name="dil_table_form" method="post" enctype="multipart/form-data">
                                <div class="about-area">
                                    <h4><?php echo $db->Cevirmen("Diller", $language_id, 0); ?></h4>
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="mycontrol-box" colspan="4">
                                                    <button id="btnDilEkle" type="button" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("Yeni Dil Ekle", $language_id, 0); ?></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><?php echo $db->Cevirmen("Dil", $language_id, 0); ?></th>
                                                <th width="50"><?php echo $db->Cevirmen("Bayrak", $language_id, 0); ?></th>
                                                <th class="center secenekler" style="width:100px;min-width:100px;max-width:100px;"><?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?></th>
                                                <th class="secenekler center" style="width:150px;min-width:150px;max-width:150px;"><?php echo $db->Cevirmen("Seçenekler", $language_id, 0); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $languages = $db->select("select *from language order by name asc");
                                            foreach ($languages as $value)
                                            {
                                            ?>
                                            <tr>
                                                <td style="padding-left:5px;">
                                                    <?php echo $value["name"];?>
                                                </td>
                                                <td class="center">
                                                    <img src="/uploads/images/language/<?php echo $value["flag"];?>" width="24"  alt="<?php echo $value["ad"]; ?>"  />
                                                </td>
                                                <td class="center secenekler">
                                                    <div class="togglebutton" title="<?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>">
                                                        <label>
                                                            <?php
                                                            if($value["aktif"] == 1){
                                                                $language_aktif = "checked";
                                                            }
                                                            ?>
                                                            <input class="chcAktif" id="aktif_<?php echo $value["id"];?>" type="checkbox" <?php echo $language_aktif;?> />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="secenekler secenekler_column center">
                                                    <button type="button" class="btn btn-xs btn-info btn-raised btnDilDuzenle btnDuzenle" data-id="<?php echo $value["id"];?>"><?php echo $db->Cevirmen("Düzenle", $language_id, 0); ?></button>

                                                    <?php if($value["anadil"] == 0){ ?>
                                                    <button type="button" class="btn btn-xs btn-danger btn-raised btnDilSil btnSil" data-id="<?php echo $value["id"];?>"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="aktif_tab" name="aktif_tab" />
<script>
    $(function () {

        $('#dilEditModal').on('shown.bs.modal', function () { });

        $(".chcAktif").click(function () {
            var id = $(this).attr("id");
            id = id.replace("aktif_", "");
            var value = $(this).is(':checked');

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { modul: 'ceviriler', islem: 'aktif_pasif', id: id, value: value },
                url: 'system/ajax.php',
                success: function (result) {

                },
                error: function (a, b, c) {

                }
            });
        });

        $("#cboWords").select2({ width: '100%' });

        KelimeDoldur($("#cboLanguage").val());
        $("#cboLanguage").change(function () {
            var language_id = $(this).val();
            KelimeDoldur(language_id);
        });

        $(".material-nav-tabs li a").click(function () {
            var tab = $(this).attr("href").replace("#", "");
            $("#aktif_tab").val(tab);
        });

        $("#aktif_tab").val("<?php echo $aktif_tab; ?>");
        var aktif_t = $("#aktif_tab").val().replace("#", "");
        aktif_t = aktif_t.replace("tab-", "");

        $(".material-nav-tabs li").removeClass("active");
        $(".tab-pane").removeClass("active");

        $("#" + aktif_t).addClass("active");
        $("#tab-" + aktif_t).addClass("active");
        if (!$("#aktif_tab").val()) {
            $(".tab-pane").first().addClass("active");
            $(".material-nav-tabs li").first().addClass("active");
        }

        $("#cevirilen_kelime, #kelime").keypress(function (e) {
            if (e.keyCode != 13) return;
            var msg = $(this).val().replace(/\n/g, "");
            if (!util.isBlank(msg)) {
                send(msg);
                $(this).val("");
            }
            return false;
        });
    });

    function KelimeDoldur(language_id) {
        $("#cboWords").html("");
        $.ajax({
            method: 'post',
            data: { modul: 'ceviriler', islem: 'get_words', language_id: language_id },
            url: 'system/ajax.php',
            success: function (result) {
                $("#cboWords").append(result);
                //alert(result);
            },
            error: function () { }
        });
    }
</script>
<script src="assets/plugins/form-select2/select2.min.js"></script>