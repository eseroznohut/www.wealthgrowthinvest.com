<?php
if($_POST){
    $aktif_tab = $_POST["aktif_tab"];
    $islem = $_POST["islem"];
    if(empty($islem)){
        $db->SiteAyarGuncelle();        
        $settings = $db->select("select *from ayarlar limit 1");
    }else
    {
        switch ($islem)
        {
            case "sube_ekle":
                $db->SubeEkle();
            break;
            case "sube_guncelle":
                $db->SubeGuncelle();
                break;
            case "sube_sil":
                foreach ($_POST as $value)
                {
                    $db->delete("sube", $value,"sube");

                    $params = array();
                    array_push($params, $value);
                    $proje = $db->select("SELECT *FROM sube WHERE id = ?", $params);

                    unlink('../uploads/images/sube/'.$proje[0]["resim_yolu"]);
                    unlink('../uploads/images/sube/'.$proje[0]["resim_yolu_thumbnail"]);

                }
                break;
        }
        
    }
    
}

$guncelle = $db->izinKontrol(12,"guncelle");

if($guncelle == false){
 ?>
<script>
    $(function(){
        $(".btnGuncelle").remove();
        $("input,button,textarea,select").prop("disabled",true);
     
    });
</script>


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
                                <h4 class="media-heading"><?php echo $db->Cevirmen("Genel Ayarlar", $language_id, 0); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pl-n pr-n">
                <ul class="nav nav-tabs material-nav-tabs mb-lg">
                    <li id="3" class="active"><a href="#tab-3" data-toggle="tab"><?php echo $db->Cevirmen("Site Ayarları", $language_id, 0); ?> </a></li>
                    <li id="1"><a href="#tab-1" data-toggle="tab"><?php echo $db->Cevirmen("Firma Bilgileri", $language_id, 0); ?>  </a></li>
                    <li id="2"><a href="#tab-2" data-toggle="tab"><?php echo $db->Cevirmen("Sosyal Medya", $language_id, 0); ?>  </a></li>
                    <li id="7"><a href="#tab-7" data-toggle="tab"><?php echo $db->Cevirmen("Şubeler", $language_id, 0); ?>  </a></li>
                    <li id="4"><a href="#tab-4" data-toggle="tab"><?php echo $db->Cevirmen("Smtp Ayarları", $language_id, 0); ?> </a></li>
                    <li id="5"><a href="#tab-5" data-toggle="tab"><?php echo $db->Cevirmen("Google Analytics Ayarları", $language_id, 0); ?> </a></li>
                    <li id="6"><a href="#tab-6" data-toggle="tab"><?php echo $db->Cevirmen("Bildirim Ayarları", $language_id, 0); ?> </a></li>
                </ul>
            </div>
            <div class="col-md-12">
                <form name="settings" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div class="panel-profile">
                            <div class="tab-content">
                                <div class="tab-pane active p-md" id="tab-3">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("SİTE AYARLARI", $language_id, 0); ?></h4>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_password" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Site Başlığı", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" data-charakter="normal" name="title" id="title" value="<?php echo $settings[0]["title"]; ?>" placeholder="<?php echo $db->Cevirmen("Site Başlığı", $language_id, 0); ?>">
                                                    <span id="title-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="description" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Site Açıklaması", $language_id, 0); ?> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $settings[0]["description"]; ?>" placeholder="<?php echo $db->Cevirmen("Site Açıklaması (Maximum 155 Karakter)", $language_id, 0); ?>">
                                                    <span id="description-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="keywords" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Anahtar Kelimeler", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo $settings[0]["keywords"]; ?>" placeholder="<?php echo $db->Cevirmen("Anahtar Kelimeler", $language_id, 0); ?>">
                                                    <span id="keywords-text"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="keywords" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Çoklu Dil Desteği", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <div class="togglebutton" title="<?php echo $db->Cevirmen("Aktif/Pasif", $language_id, 0); ?>">
                                                        <label>
                                                            <?php
                                                            if($settings[0]["coklu_dil_destegi_aktif"] == 1){
                                                                $coklu_dil_destegi_aktif = "checked";
                                                                }
                                                            ?>
                                                            <input id="coklu_dil_destegi_aktif" name="coklu_dil_destegi_aktif" type="checkbox" <?php echo $coklu_dil_destegi_aktif;?> />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="div_goruntulenecek_diller" class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="keywords" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Görüntülenecek Site Dilleri", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <?php
                                                    $diller = array();
                                                    $secili_diller = array();
                                                    $languages = $db->select("select *from language order by anadil desc");
                                                    foreach ($languages as $language)
                                                    {
                                                        if($language["aktif"] == 1){
                                                            array_push($secili_diller, $language["name"]);
                                                        }
                                                        if($language["anadil"] == 1){
                                                            $anadil = $language["name"];
                                                        }
                                                        array_push($diller, $language["name"]);
                                                    }
                                                    ?>
                                                    <input type="text" multiple id="site_dilleri" name="site_dilleri" />
                                                    <script>
                                                        $(function () {
                                                            $("#site_dilleri").select2({ width: "100%", tags: <?php echo json_encode($diller); ?> }).val(<?php echo  json_encode($secili_diller); ?>).trigger("change");
                                                            $("#site_dilleri").on("change", function(e){
                                                                $("select option").remove();
                                                                var item = this.value.split(",");
                                                                for (var i = 0; i < item.length; i++) {
                                                                    var name = item[i];
                                                                    $("#varsayilan_dil_adi").append('<option value="'+ name +'">'+ name +'</option>');
                                                                }
                                                            });
                                                            $(".select2-search-choice div:contains('<?php echo $anadil; ?>')").parent().find("a").remove();
                                                        });
                                                    </script>
                                                    <span id="keywords-text"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="div_varsayilan_dil" class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="varsayilan_dil_id" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Varsayılan Site Dili", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="varsayilan_dil_adi" name="varsayilan_dil_adi">
                                                        <?php
                                                        $languages = $db->select("select *from language WHERE aktif = 1 order by name asc");
                                                        foreach ($languages as $language)
                                                        {
                                                            $selected = "";
                                                            if($language["name"] == $settings[0]["varsayilan_dil"]){
                                                                $selected = "selected";
                                                            }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $language["name"]; ?>"><?php echo $language["name"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span id="keywords-text"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Slayt Geçiş Süresi", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text"   class="form-control" name="slayt_gecis_suresi" value="<?php echo $settings[0]["slayt_gecis_suresi"]; ?>" placeholder="<?php echo $db->Cevirmen("Slayt Geçiş Süresi", $language_id, 0); ?> ">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Harita Url", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" data-charakter="normal" class="form-control" name="map" value="<?php echo $settings[0]["map"]; ?>" placeholder="<?php echo $db->Cevirmen("Harita Url", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Üst bilgi logo ", $language_id)." ".Database::$logo_foto_x."x".Database::$logo_foto_y;  ?></label>
                                                <div class="col-sm-9">
                                                    <div class="fileinput fileinput-new" style="width: 270px;" data-provides="fileinput">
                                                        <div class="logo-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: <?php echo Database::$logo_foto_x; ?>px; height: <?php echo Database::$logo_foto_y; ?>px; padding:0px;"></div>
                                                        <div class="btnGuncelle">
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></a>
                                                            <span class="btn btn-default btn-file"><span class="fileinput-new"><?php echo $db->Cevirmen("Resim Seç", $language_id, 0); ?></span><span class="fileinput-exists"><?php echo $db->Cevirmen("Değiştir", $language_id, 0); ?></span><input type="file" accept="image/*" value="<?php echo $settings[0]["logo_yolu"]; ?>" name="logo_yolu"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Alt bilgi logo ", $language_id)." ".Database::$footer_logo_foto_x."x".Database::$footer_logo_foto_y; ?></label>
                                                <div class="col-sm-9">
                                                    <div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
                                                        <div class="altlogo-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: <?php echo Database::$footer_logo_foto_x; ?>px; height: <?php echo Database::$footer_logo_foto_y; ?>px; padding:0px;"></div>
                                                        <div class="btnGuncelle">
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></a>
                                                            <span class="btn btn-default btn-file "><span class="fileinput-new"><?php echo $db->Cevirmen("Resim Seç", $language_id, 0); ?></span><span class="fileinput-exists"><?php echo $db->Cevirmen("Değiştir", $language_id, 0); ?></span><input type="file" accept="image/*" value="<?php echo $settings[0]["footer_logo"]; ?>" name="footer_logo"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="map" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Alt Bilgi Arkaplan Resmi", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
                                                        <div class="arkaplan-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="max-width: 600px; max-height: 600px; overflow:hidden;"></div>
                                                        <div class="btnGuncelle">
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></a>
                                                            <span class="btn btn-default btn-file"><span class="fileinput-new"><?php echo $db->Cevirmen("Resim Seç", $language_id, 0); ?></span><span class="fileinput-exists"><?php echo $db->Cevirmen("Değiştir", $language_id, 0); ?></span><input type="file" accept="image/*" value="<?php echo $settings[0]["arkaplan_yolu"]; ?>" name="arkaplan_yolu"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="tab-pane p-md" id="tab-1">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("FİRMA BİLGİLERİ", $language_id, 0); ?></h4>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="firma_adi" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" data-charakter="normal" name="firma_adi" value="<?php echo $settings[0]["firma_adi"]; ?>" placeholder="<?php echo $db->Cevirmen("Firma Adı", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="hakkinda_kisa" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Firma Hakkında (Kısa)", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <textarea rows="5" class="form-control" data-charakter="normal" name="hakkinda_kisa" placeholder="<?php echo $db->Cevirmen("Firma Hakkında (Kısa)", $language_id, 0); ?>"><?php echo $settings[0]["hakkinda_kisa"]; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="mesai" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Çalışma Zamanı", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="mesai" value="<?php echo $settings[0]["mesai"]; ?>" placeholder="<?php echo $db->Cevirmen("Çalışma Zamanı", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="adres" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Adres", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"  data-charakter="normal" name="adres" value="<?php echo $settings[0]["adres"]; ?>" placeholder="<?php echo $db->Cevirmen("Adres", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="telefon1" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Telefon Numarası 1", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="telefon1" value="<?php echo $settings[0]["telefon1"]; ?>" placeholder="<?php echo $db->Cevirmen("Telefon Numarası", $language_id, 0); ?> 1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="telefon2" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Telefon Numarası", $language_id, 0); ?> 2</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="telefon2" value="<?php echo $settings[0]["telefon2"]; ?>" placeholder="<?php echo $db->Cevirmen("Telefon Numarası", $language_id, 0); ?> 2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="fax" class="col-sm-3 control-label" <?php echo $db->Cevirmen("Fax Numarası", $language_id, 0); ?>></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="fax" value="<?php echo $settings[0]["fax"]; ?>" placeholder="<?php echo $db->Cevirmen("Fax Numarası", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="eposta" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="eposta" value="<?php echo $settings[0]["eposta"]; ?>" placeholder="<?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="url" class="col-sm-3 control-label"><?php echo $db->Cevirmen("İnternet Adresi", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="url" value="<?php echo $settings[0]["url"]; ?>" placeholder="<?php echo $db->Cevirmen("İnternet Adresi", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-md" id="tab-2">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("SOSYAL MEDYA", $language_id, 0); ?></h4>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="facebook" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Facebook", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="facebook" value="<?php echo $settings[0]["facebook"]; ?>" placeholder="<?php echo $db->Cevirmen("Facebook", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="twitter" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Twitter", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="twitter" value="<?php echo $settings[0]["twitter"]; ?>" placeholder="<?php echo $db->Cevirmen("Twitter", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="instagram" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Instagram", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="instagram" value="<?php echo $settings[0]["instagram"]; ?>" placeholder="<?php echo $db->Cevirmen("Instagram", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="gplus" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Google Plus", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gplus" value="<?php echo $settings[0]["gplus"]; ?>" placeholder="<?php echo $db->Cevirmen("Google Plus", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="gplus" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Youtube", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="youtube" value="<?php echo $settings[0]["youtube"]; ?>" placeholder="<?php echo $db->Cevirmen("Youtube", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-md" id="tab-4">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("SMTP AYARLARI", $language_id, 0); ?></h4>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_host" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Smtp Sunucusu", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="smtp_host" value="<?php echo $settings[0]["smtp_host"]; ?>" placeholder="<?php echo $db->Cevirmen("Smtp Sunucusu", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_username" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="smtp_username" value="<?php echo $settings[0]["smtp_username"]; ?>" placeholder="<?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_password" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Parola", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="smtp_password" value="<?php echo $settings[0]["smtp_password"]; ?>" placeholder="<?php echo $db->Cevirmen("Parola", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_port" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Port", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="smtp_port" value="<?php echo $settings[0]["smtp_port"]; ?>" placeholder="<?php echo $db->Cevirmen("Port", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_secure" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Güvenli Kimlik Doğrulaması", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <?php
                                                    if($settings[0]["smtp_authentication"] == 1){
                                                        $checked = "checked";
                                                    }
                                                    ?>
                                                    <div class="checkbox block"><label><input type="checkbox" name="smtp_authentication" <?php echo $checked; ?>></label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_secure" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Bağlantı", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="cboGuvenliBaglanti" class="form-control" name="smtp_secure">
                                                        <option value="tls"><?php echo $db->Cevirmen("TLS", $language_id, 0); ?></option>
                                                        <option value="ssl"><?php echo $db->Cevirmen("SSL (Güvenli Bağlantı)", $language_id, 0); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-md" id="tab-5">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("GOOGLE ANALYTICS AYARLARI", $language_id, 0); ?></h4>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_secure" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Analytics Aktif", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <div class="togglebutton" title="<?php echo $db->Cevirmen("Görünürlük", $language_id, 0); ?>">
                                                        <label>
                                                            <?php
                                                                if($settings[0]["google_analystic_aktif"] == 1){
                                                                    $google_analystic_aktif = "checked";
                                                                }
                                                            ?>
                                                            <input id="google_analystic_aktif" name="google_analystic_aktif" type="checkbox" <?php echo $google_analystic_aktif;?> />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_host" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="ga_email" value="<?php echo $settings[0]["ga_email"]; ?>" placeholder="<?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_host" class="col-sm-3 control-label"><?php echo $db->Cevirmen("Profil ID Numarası", $language_id, 0); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="ga_profile_id" value="<?php echo $settings[0]["ga_profile_id"]; ?>" placeholder="<?php echo $db->Cevirmen("Profil ID Numarası", $language_id, 0); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="smtp_host" class="col-sm-3 control-label"><?php echo $db->Cevirmen("P12 Anahtar Dosyası", $language_id, 0); ?></label>
                                                <input type="file" name="ga_p12_key_yolu" accept=".p12">
                                                <div class="col-sm-8 input-group" style="padding-left:16px;">
                                                    <input type="text" readonly="" class="form-control" placeholder="<?php echo $db->Cevirmen("P12 Anahtar Dosyası", $language_id, 0); ?>" value="<?php echo $settings[0]["ga_p12_key_yolu"]; ?>">
                                                    <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-md" id="tab-6">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("BİLDİRİM AYARLARI", $language_id, 0); ?></h4>

                                        <style>
                                            .toggle {
                                                float: left !important;
                                            }
                                        </style>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="url" class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    <div class="togglebutton center">
                                                        <label style="float:left;">
                                                            <?php
                                                            if($settings[0]["ziyaretci_mesajlari_epostama_gelsin"] == 1)
                                                            {
                                                                $checked = "checked";
                                                            }else{
                                                                $checked="";
                                                            }
                                                            ?>
                                                            <p><?php echo $db->Cevirmen("Ziyaretçiler Tarafından Gönderilen Mesajlar Bildirim Eposta Adresime Gelsin", $language_id, 0); ?></p>
                                                            <input class="ziyaretci_mesajlari_epostama_gelsin" name="ziyaretci_mesajlari_epostama_gelsin" data-id="<?php echo $settings[0]["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="form-group is-empty">
                                                <label for="url" class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    <div class="togglebutton center">
                                                        <label style="float:left;">
                                                            <?php
                                                            if($settings[0]["ziyaretci_telefonlari_epostama_gelsin"] == 1)
                                                            {
                                                                $checked = "checked";
                                                            }else{
                                                                $checked="";
                                                            }
                                                            ?>
                                                            <p><?php echo $db->Cevirmen("Ağımıza Katılmak İçin Gönderilen Form Bilgileri Bildirim Eposta Adresime Gelsin", $language_id, 0); ?></p>
                                                            <input class="ziyaretci_telefonlari_epostama_gelsin" name="ziyaretci_telefonlari_epostama_gelsin" data-id="<?php echo $settings[0]["id"];?>" type="checkbox" <?php echo $checked; ?> />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane p-md table-responsive" id="tab-7">
                                    <div class="about-area">
                                        <h4><?php echo $db->Cevirmen("ŞUBELER", $language_id, 0); ?></h4>
                                        
                                        <table class="checkbox_tables table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="mycontrol-box" colspan="6">
                                                    <button id="btnYeniSube" type="button" class="btn btn-info btn-sm btn-raised btnEkle"><?php echo $db->Cevirmen("YENİ ŞUBE", $language_id, 0); ?> </button>
                                                    <button id="btnSil" type="button" class="btn btn-danger btn-sm btn-raised btnSil"><?php echo $db->Cevirmen("Sil", $language_id, 0); ?></button>
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
                                                <th><?php echo $db->Cevirmen("Şube Adı", $language_id, 0); ?></th>
                                                <th><?php echo $db->Cevirmen("Eposta", $language_id, 0); ?></th>
                                                <th><?php echo $db->Cevirmen("Telefon", $language_id, 0); ?></th>
                                                <th><?php echo $db->Cevirmen("Adres", $language_id, 0); ?></th>
         
                                                <th class="center secenekler" width="20"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ofisler = $db->select("select *from sube order by id desc");
                                            foreach ($ofisler as $ofis)
                                            {
                                            ?>
                                            <tr>
                                                <td class="center">
                                                    <div class="checkbox checkbox-info">
                                                        <label>
                                                            <input type="checkbox" data-type="select" data-id="<?php echo $ofis["id"]; ?>" />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $ofis["ad"];?>
                                                </td>
                                                <td>
                                                    <?php echo $ofis["eposta"];?>
                                                </td>
                                                <td>
                                                    <?php echo $ofis["telefon"];?>
                                                </td>
                                                <td>
                                                    <?php echo $ofis["adres"];?>
                                                </td>

                                                <td class="center secenekler secenekler_column">
                                                    <button type="button" data-id="<?php echo $ofis["id"]; ?>" class="btn btn-info btn-raised btn-xs btnEdit btnDuzenle">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-panel-footer">
                        <div class="col-sm-9 col-sm-offset-2">
                            <button class="btn-raised btn-primary btn pull-right btnGuncelle"><?php echo $db->Cevirmen("Değişiklikleri Kaydet", $language_id, 0); ?><div class="ripple-container"></div></button>
                        </div>
                    </div>
                    <input type="hidden" id="aktif_tab" name="aktif_tab" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Haber Modal -->
<div class="modal" id="subeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="about-area">
                        <h4><?php echo $db->Cevirmen("ŞUBE", $language_id, 0); ?></h4>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Şube Adı", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" data-charakter="normal" class="form-control" id="ad" name="ad" placeholder="<?php echo $db->Cevirmen("Şube Adı", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Adres", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" data-charakter="normal" class="form-control" id="adres" name="adres" placeholder="<?php echo $db->Cevirmen("Adres", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Telefon", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" data-charakter="normal" class="form-control" id="telefon" name="telefon" placeholder="<?php echo $db->Cevirmen("Telefon", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="ad" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Eposta", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" data-charakter="normal" class="form-control" id="ofis_eposta" name="eposta" placeholder="<?php echo $db->Cevirmen("Eposta", $language_id, 0); ?>" />
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <div class="form-group is-empty">
                                <label for="map" class="col-sm-2 control-label"><?php echo $db->Cevirmen("Fotoğraf", $language_id, 0); ?></label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new col-sm-9" data-provides="fileinput">
                                        <div class="sube-file fileinput-preview thumbnail mb20" data-trigger="fileinput" style="background-color:transparent; border:0;"></div>
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
                        <!--<div class="table-responsive">
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
                        </div>-->
                    </div>
                </div>
                <div class="modal-footer" style="padding-right:20px;padding-bottom:20px;">
                    <input type="hidden" class="islem" name="islem" />
                    <input type="hidden" id="sube_id" name="sube_id" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $db->Cevirmen("Kapat", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-primary btnKaydet"><?php echo $db->Cevirmen("Kaydet", $language_id, 0); ?></button>
                    <button type="submit" class="btn btn-raised btn-success btnGuncelle"><?php echo $db->Cevirmen("Güncelle", $language_id, 0); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Haber .modal -->
<form id="sil" method="post"></form>
<script>
    $(document).ready(function () {

        $('form').submit(function(e) {
            e.preventDefault();
            $(this).append($("#aktif_tab"));
            this.submit();
        });
        
        $("#btnSil").click(function () {
            var count = $('input[data-type="select"]:checkbox:checked').length;
            var cf = confirm(count + " <?php echo $db->Cevirmen("adet şubeyi silmek istediğinizden eminmisiniz?", $language_id, 0); ?>");
            if (cf) {
                $('<input />').attr('type', 'hidden').attr('name', "islem").attr('value', "sube_sil").appendTo('#sil');
                $("input[data-type='select']").each(function () {
                    if (this.checked) {
                        var id = $(this).attr("data-id");
                        $('<input />').attr('type', 'hidden').attr('name', "id" + id).attr('value', id).appendTo('#sil');
                    }
                });
                $("#sil").submit();
            }
        });

        $('#subeEditModal').on('shown.bs.modal', function () {
            //$("#tarih").focus();
        });

        $("#btnYeniSube").click(function(){
            $("#subeEditModal").modal("show");
            $(".islem").val("sube_ekle");
            $(".btnGuncelle").hide();
            $(".btnKaydet").show();

            $("#ad").val("");
            $("#adres").val("");
            $("#telefon").val("");
            $("#eposta").val("");
        });

        $(".btnEdit").click(function () {
            var id = $(this).attr("data-id");
            $("#subeEditModal").modal("show");
            $("#sube_id").val(id);
            $(".islem").val("sube_guncelle");
            $(".btnGuncelle").show();
            $(".btnKaydet").hide();

            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { id: id,  modul: 'sube', islem: 'select_sube' },
                url: 'system/ajax.php',
                success: function (result) {

                    $("#ad").val(result[0]);
                    $("#adres").val(result[1]);
                    $("#telefon").val(result[2]);
                    $("#ofis_eposta").val(result[3]);               

                    $(".sube-file").html("<image />");
                    $(".sube-file img").prop("src", "../../uploads/images/sube/" + result[4]);
                },
                error: function (a, b, c) {
                    alert(a.responseText, b.responseText, c.responseText);
                }
            });
        });


        $('#cboGuvenliBaglanti option[value="<?php echo $settings[0]["smtp_secure"]; ?>"]').prop("selected", true);
        $('.logo-file').append("<image/>");
        $('.logo-file img').prop('src', '../uploads/images/logo/<?php echo $settings[0]["logo_yolu"]; ?>');

        $('.altlogo-file').append("<image/>");
        $('.altlogo-file img').prop('src', '../uploads/images/logo/<?php echo $settings[0]["footer_logo"]; ?>');

        $('.arkaplan-file').append("<image/>");
        $('.arkaplan-file img').prop('src', '../uploads/images/background/<?php echo $settings[0]["arkaplan_yolu"]; ?>');


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

        if($("#coklu_dil_destegi_aktif").prop("checked")){
            $("#div_goruntulenecek_diller").fadeIn();
            $("#div_varsayilan_dil").fadeIn();
        }else{
            $("#div_goruntulenecek_diller").fadeOut();
            $("#div_varsayilan_dil").fadeOut();
        }

        $("#coklu_dil_destegi_aktif").change(function(){
            if($(this).prop("checked")){
                $("#div_goruntulenecek_diller").fadeIn();
                $("#div_varsayilan_dil").fadeIn();
            }else{
                $("#div_goruntulenecek_diller").fadeOut();
                $("#div_varsayilan_dil").fadeOut();
            }
        });



        KalanKarakterHesapla($("#description"), $("#description-text"), 155);
        $("#description").keyup(function () {
            KalanKarakterHesapla(this, $("#description-text"), 155);
        });

        KalanKarakterHesapla($("#keywords"), $("#keywords-text"), 160);
        $("#keywords").keyup(function () {
            KalanKarakterHesapla(this, $("#keywords-text"), 160);
        });

        KalanKarakterHesapla($("#title"), $("#title-text"), 70);
        $("#title").keyup(function () {
            KalanKarakterHesapla(this, $("#title-text"), 70);
        });
    });

    function KalanKarakterHesapla(kontrol, kontrol_text, max_karakter) {
        var text = $(kontrol).val();
        if (text.length > max_karakter) {
            $(kontrol).val(text.substring(0, max_karakter));
            $(kontrol_text).css({ "color": "red" });
        } else {
            var simdiki = $(kontrol).val().length;
            var kalan = max_karakter - simdiki;
            $(kontrol_text).html(simdiki+" <?php echo $db->Cevirmen("Karakter girdiniz.", $language_id, 0); ?> " + kalan + " <?php echo $db->Cevirmen("Karakter kaldı.", $language_id, 0); ?>");
            $(kontrol_text).css({ "color": "green" });
        }
    }
 </script>
