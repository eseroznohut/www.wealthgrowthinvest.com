<?php
if($_POST){
    $db->KullaniciGuncelle();
}
?>


<style>

    .btn-pic-ekle, .btn-pic-sil, btn-pic-degistir {
        width:22px;
        height:22px;
        padding:0px;
        float:right;
        cursor:pointer;
    }

    .pic-buttonlar {
        text-align:center;
        position:absolute;
        bottom: 5px;
        right: 8px;
        z-index:55;
        color:#808080 !important;
        cursor:pointer;
    }

    .fileinput-new {
    width:auto;
    height:auto;
    overflow:hidden;
    z-index:56;

    }
    .profil-pic img {
        width:80px !important;
        height:80px !important;

    }
        .profil-pic  {
        width:88px !important;
        height:90px !important;

    }
</style>
<script>
    $(function () {
        $(".fileinput").on("change.bs.fileinput", function () {

            var formData = new FormData($("#profil-foto-form")[0]);
            $.ajax({
                method:'post',
                dataType:'json',
                data: formData,
                async:false,
                url:'system/ajax.php',
                success: function (result) {
                    $(".avatar img").prop("src", "uploads/images/profile/" + result[0]);
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () { }
            });

        });


         $(".profil-pic").html("<image />");
         $(".profil-pic img").prop("src", "<?php echo $profil_resmi; ?>");

        $(".btn-pic-sil").click(function () {
            var id = '<?php echo $_SESSION["id"]; ?>'
            $.ajax({
                method:'post',
                dataType:'json',
                data: {modul:'kullanici', islem:'profil_resmi_sil', id:id},
                url:'system/ajax.php',
                success: function () {
                 $(".profil-pic").html("<image />");
                 $(".profil-pic img").prop("src", "assets/img/user_avatar.jpg");
                },
                error: function () { }
            });
        });
    });
</script>
<div class="static-content">
    <div class="page-content">
        <div class="container-fluid">

            <div data-widget-group="group1">
                <div class="row">
                    <div class="col-md-12 profile-area">
                        <div class="media col-md-6 col-sm-6 col-xs-6">
                            <div class="media-left pr-n">


                                <form id="profil-foto-form">
                                    <input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>" />
                                    <input type="hidden" name="modul" value="kullanici" />
                                    <input type="hidden" name="islem" value="profil_resmi_yukle" />

                                    <div class="fileinput fileinput-new" data-provides="fileinput" style="position:relative;width:88px;">
                                        <div class="profil-pic fileinput-preview thumbnail " data-trigger="fileinput" style="background-color:white; border:0;"></div>
                                        <div class="pic-buttonlar">
                                            <a href="#" class="btn btn-pic-sil fileinput-exists" data-dismiss="fileinput">
                                                <i class="material-icons">delete_forever</i>
                                            </a>
                                            <span class="btn btn-file btn-pic-ekle">
                                                <span class="fileinput-new">
                                                    <i class="material-icons">add_box</i>
                                                </span>
                                                <span class="btn fileinput-exists btn-pic-degistir">
                                                    <i class="material-icons">cached</i>
                                                </span>
                                                <input type="file" id="resim_yolu" name="resim_yolu" accept="image/*" />
                                            </span>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="media-body pl-xl">
                                <h4 class="media-heading">
                                    <?php echo $profile[0]["ad_soyad"]; ?>
                                </h4>
                                <p style="padding-left:5px;">
                                    <?php echo $profile[0]["eposta"]; ?>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 pl-n pr-n">
                        <ul class="nav nav-tabs material-nav-tabs mb-lg">
                            <li id="1" class="active">
                                <a href="#tab-1" data-toggle="tab">Bilgilerim </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-12">
                        <div class="tab-content">
                            <form method="post" id="kullanici-form" data-parsley-validate="">

                                <div class="panel-profile">
                                    <div class="tab-content">
                                        <div class="tab-pane active p-md" id="tab-1">
                                            <div class="about-area">
                                                                               
                                                <div class="table-responsive">
                                                    <div class="form-group is-empty">
                                                        <label for="ad" class="col-sm-3 control-label">
                                                            <?php echo $db->Cevirmen("Ad", $language_id, 0); ?>, <?php echo $db->Cevirmen("Soyad", $language_id, 0); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" value="<?php echo $profile[0]["ad_soyad"]; ?>" name="ad_soyad" class="form-control" placeholder="<?php echo $db->Cevirmen("Ad", $language_id, 0); ?>, <?php echo $db->Cevirmen("Soyad", $language_id, 0); ?>" data-parsley-trigger="change" required="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group is-empty">
                                                        <label for="ad" class="col-sm-3 control-label">
                                                            <?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  value="<?php echo $profile[0]["username"]; ?>" name="kullanici_adi" class="form-control" placeholder="<?php echo $db->Cevirmen("Kullanıcı Adı", $language_id, 0); ?>" data-parsley-trigger="change" required="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group is-empty">
                                                        <label for="ad" class="col-sm-3 control-label">
                                                            <?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  value="<?php echo $profile[0]["eposta"]; ?>" name="eposta" class="form-control" placeholder="<?php echo $db->Cevirmen("Eposta Adresi", $language_id, 0); ?>"
                                                                data-parsley-trigger="change"
                                                                required="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group is-empty eposta">
                                                        <label for="ad" class="col-sm-3 control-label">
                                                            <?php echo $db->Cevirmen("Parola (Minimum 6 Karakter)", $language_id, 0); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" 
                                                                   id="parola"
                                                                   value="<?php echo $profile[0]["password"]; ?>"
                                                                   name="parola"                                                                
                                                                   class="form-control"                                                                
                                                                   placeholder="Parola"                                                                
                                                                   data-parsley-trigger="change"                                                                
                                                                   required="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group is-empty eposta">
                                                        <label for="ad" class="col-sm-3 control-label">
                                                            <?php echo $db->Cevirmen("Parola Tekrar", $language_id, 0); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="password"
                                                                   value="<?php echo $profile[0]["password"]; ?>"                                                                
                                                                   data-parsley-trigger="keyup"                                                                
                                                                   data-parsley-minlength="6"                                                                
                                                                   data-parsley-minlength-message="<?php echo $db->Cevirmen("Parolanız minimum 6 karakter olmalıdır.", $language_id, 0); ?>"
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
                                                                                                
                                                <div class="table-responsive">
                                                    <div class="form-group is-empty">
                                                        <label for="password" class="col-sm-3 control-label">
                                                            <?php echo $db->Cevirmen("Panel Dili", $language_id, 0); ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="panel_dili">
                                                                <?php
                                                                
                                                                $diller = $db->select("select *from language where aktif = 1 order by name asc");
                                                                foreach ($diller as $dil)
                                                                {
                             
                                                                    $selected ="";
                                                                    if($_SESSION['panel_dil_id'] == 0){
                                                                        $selected ="selected";
                                                                    }else
                                                                    {
                                                                        if($_SESSION['panel_dil_id'] == $dil["id"]){
                                                                            $selected ="selected";
                                                                        } 
                                                                    }
                                                                    
                                                                ?>
                                                                <option value="<?php echo $dil["id"]; ?>" <?php echo $selected; ?>><?php echo $dil["name"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-panel-footer">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class="btn-raised btn-primary btn pull-right btnGuncelle">
                                                <?php echo $db->Cevirmen("Değişiklikleri Kaydet", $language_id, 0); ?>
                                                <div class="ripple-container"></div>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="aktif" value="on" />
                                    <input type="hidden" name="id" value="<?php echo $profile[0]["id"]; ?>" />
                                    <input type="hidden" id="aktif_tab" name="aktif_tab" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>