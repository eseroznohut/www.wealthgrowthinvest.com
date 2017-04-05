<div class="breadcrumbs">
    <div class="container">
        <span typeof="v:Breadcrumb">
            <a rel="v:url" property="v:title" href="/anasayfa.html" class="home">
                <?php echo $db->Cevirmen("anasayfa", $language_id, 1); ?>
            </a>
        </span>
        <span typeof="v:Breadcrumb">
            <span property="v:title">
                <?php echo $db->Cevirmen("iletişim", $language_id, 1);
                      $title = $db->Cevirmen("iletişim", $language_id, 1);
                ?>
            </span>
        </span>
    </div>
</div>


<div id="primary" class="content-area  container">
    <div class="row">
        <main id="main" class="site-main  col-xs-12" role="main">
            <article id="post-38" class="clearfix post-38 page type-page status-publish hentry">
                <div class="hentry__content  entry-content">
                    <div id="pl-38">
                        <div class="panel-grid" id="pg-38-0">
                            <div class="siteorigin-panels-stretch panel-row-style" style="margin-top: -60px; margin-left: -221.5px; margin-right: -221.5px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px;" data-stretch-type="full-stretched">
                                <div class="panel-grid-cell" id="pgc-38-0-0" style="padding-left: 0px; padding-right: 0px;">
                                    <div class="so-panel widget widget_sow-google-map panel-first-child panel-last-child" id="panel-38-0-0-0" data-index="0">
                                        <div id="map" class="so-widget-sow-google-map so-widget-sow-google-map-base">
                                            <iframe class="map" src="<?php echo $settings[0]["map"]; ?>" style="width:100%; height:300px;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-grid" id="pg-38-1">
                            <div class="panel-grid-cell" id="pgc-38-1-0">
                                <div class="so-panel widget widget_pw_contact_profile widget-contact-profile panel-first-child panel-last-child" id="panel-38-1-0-0" data-index="1">
                                    <div class="card  contact-profile">
                                        <h3>
                                            <?php echo $db->Cevirmen("iletişim bilgileri", $language_id, 1); ?>
                                        </h3>

                                        <div class="card-block contact-profile__container">
                                            <div class="contact-profile__social-icons">
                                                <?php if(!empty($settings[0]["facebook"])) { ?>
                                                <a class="contact-profile__social-icon" href="<?php echo $settings[0]["facebook"]; ?>" target="_blank">
                                                    <i class="fa  fa-facebook-square"></i>
                                                </a>
                                                <?php } ?>

                                                <?php if(!empty($settings[0]["twitter"])) { ?>
                                                <a class="contact-profile__social-icon" href="<?php echo $settings[0]["twitter"]; ?>" target="_blank">
                                                    <i class="fa  fa-twitter-square"></i>
                                                </a>
                                                <?php } ?>
                                                <?php if(!empty($settings[0]["instagram"])) { ?>
                                                <a class="contact-profile__social-icon" href="<?php echo $settings[0]["instagram"]; ?>" target="_blank">
                                                    <i class="fa  fa-instagram"></i>
                                                </a>
                                                <?php } ?>
                                                <?php if(!empty($settings[0]["gplus"])) { ?>
                                                <a class="contact-profile__social-icon" href="<?php echo $settings[0]["gplus"]; ?>" target="_blank">
                                                    <i class="fa  fa-google-plus-square"></i>
                                                </a>
                                                <?php } ?>
                                                <?php if(!empty($settings[0]["youtube"])) { ?>
                                                <a class="contact-profile__social-icon" href="<?php echo $settings[0]["youtube"]; ?>" target="_blank">
                                                    <i class="fa fa-youtube-square"></i>
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <div class="contact-profile__items">

                                                <?php if(!empty($settings[0]["adres"])) { ?>
                                                <div class="contact-profile__item">
                                                    <div class="contact-profile__icon">
                                                        <i class="fa  fa-map-marker"></i>
                                                    </div>
                                                    <p class="contact-profile__text text-capitalize">
                                                        <?php echo $settings[0]["adres"]; ?>
                                                    </p>
                                                </div>
                                                <?php } ?>

                                                <?php if(!empty($settings[0]["telefon1"])) { ?>
                                                <div class="contact-profile__item">
                                                    <div class="contact-profile__icon">
                                                        <i class="fa  fa-phone"></i>
                                                    </div>
                                                    <p class="contact-profile__text">
                                                        <?php echo $settings[0]["telefon1"]; ?>
                                                    </p>
                                                </div>
                                                <?php } ?>
                                                <?php if(!empty($settings[0]["telefon2"])) { ?>
                                                <div class="contact-profile__item">
                                                    <div class="contact-profile__icon">
                                                        <i class="fa  fa-phone"></i>
                                                    </div>
                                                    <p class="contact-profile__text">
                                                        <?php echo $settings[0]["telefon2"]; ?>
                                                    </p>
                                                </div>
                                                <?php } ?>

                                                <?php if(!empty($settings[0]["fax"])) { ?>
                                                <div class="contact-profile__item">
                                                    <div class="contact-profile__icon">
                                                        <i class="fa fa-fax"></i>
                                                    </div>
                                                    <p class="contact-profile__text">
                                                        <?php echo $settings[0]["fax"]; ?>
                                                    </p>
                                                </div>
                                                <?php } ?>

                                                <?php if(!empty($settings[0]["eposta"])) { ?>
                                                <div class="contact-profile__item">
                                                    <div class="contact-profile__icon">
                                                        <i class="fa  fa-envelope"></i>
                                                    </div>
                                                    <p class="contact-profile__text no-uppercase">
                                                        <?php echo $settings[0]["eposta"]; ?>
                                                    </p>
                                                </div>
                                                <?php } ?>

                                                <?php if(!empty($settings[0]["url"])) { ?>
                                                <div class="contact-profile__item">
                                                    <div class="contact-profile__icon">
                                                        <i class="fa  fa-compass"></i>
                                                    </div>
                                                    <p class="contact-profile__text">
                                                        <?php echo $settings[0]["url"]; ?>
                                                    </p>
                                                </div>
                                                <?php } ?>

                                            </div>
                                            <div class="contact-profile__content"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-grid-cell" id="pgc-38-1-1">
                                <div class="so-panel widget widget_text panel-first-child panel-last-child" id="panel-38-1-1-0" data-index="2">
                                    <div class="textwidget">
                                        <div role="form" class="wpcf7">
                                            <h3>
                                                <?php echo $db->Cevirmen("bize mesaj bırakın", $language_id, 1); ?>
                                            </h3>
                                            <div class="contact-profile__container"></div>
                                            <form id="contact-form" method="post">
                                                <div class="row">
                                                    <div class="col-xs-12  col-md-12">
                                                        <span class="wpcf7-form-control-wrap name">
                                                            <input type="text" id="ad" name="ad" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false"
                                                                placeholder="<?php echo $db->Cevirmen("adınız", $language_id, 1); ?>, <?php echo $db->Cevirmen("soyadınız", $language_id, 1); ?> *"
                                                                data-parsley-trigger="change"
                                                                required="" />
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-12  col-md-6">
                                                        <span class="wpcf7-form-control-wrap email">
                                                            <input type="email" id="eposta" name="eposta" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" placeholder="<?php echo $db->Cevirmen("eposta adresiniz", $language_id, 1); ?> *"
                                                                data-parsley-trigger="change"
                                                                required="" />
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-12  col-md-6">
                                                        <span class="wpcf7-form-control-wrap telefon">
                                                            <input type="tel" id="telefon" name="telefon" placeholder="<?php echo $db->Cevirmen("telefon numarası",$language_id, 1); ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                                                                data-parsley-trigger="change"
                                                                required="" />
                                                        </span>
                                                    </div>
                                                </div>                                             
                                           
                                                <div class="row">
                                                    <div class="col-xs-12  col-md-12">
                                                        <span class="wpcf7-form-control-wrap">
                                                            <input type="text" id="konu" name="konu" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" placeholder="<?php echo $db->Cevirmen("konu", $language_id, 1); ?> *"
                                                                data-parsley-trigger="change"
                                                                required="" />
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">

                                                            <textarea name="mesaj" style="height:150px;" id="mesaj" class="form-control" aria-invalid="false" placeholder="<?php echo $db->Cevirmen("mesajınız", $language_id, 1); ?> *"
                                                                data-parsley-trigger="change"
                                                                required=""></textarea>
                                                        </div>
                                                        <p>
                                                            <div id="contact-form-message"></div>
                                                        </p>
                                                        <p>
                                                            <button type="button" class="wpcf7-form-control wpcf7-submit btn btn-primary btnMesajGonder" data-id="iletisim">
                                                                <?php echo $db->Cevirmen("gönder", $language_id, 1); ?>
                                                            </button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div>

                               <h3>
                                   <?php echo $db->Cevirmen("Şubelerimiz", $language_id, 1); ?>
                               </h3>
                               <div class="screen-reader-response contact-profile__container"></div>
                               <br />
                               <br />

                               <?php
                               $subeler = $db->select("select *from sube order by id asc");
                               foreach ($subeler as $sube)
                               {
                               ?>


                               <div class="panel-grid-cell" id="pgc-38-2-0" style="width:33.33333333%;">
                                   <div class="so-panel widget widget_pw_contact_profile widget-contact-profile panel-first-child panel-last-child" id="panel-38-2-0-0" data-index="3">
                                       <div class="card  contact-profile">

                                           <img width="100%" class="contact-profile__image wp-post-image" src="/uploads/images/sube/<?php echo $sube["resim_yolu"]; ?>" alt="<?php echo $db->Cevirmen($sube["ad"], $language_id, 1); ?>" />
                                           
                                           <div class="card-block  contact-profile__container">
                                               <div class="contact-profile__items">
                                                   <div class="contact-profile__item">
                                                       <div class="contact-profile__icon">
                                                           <i class="fa  fa-map-marker"></i>
                                                       </div>
                                                       <p class="contact-profile__text capitalize">
                                                           <?php echo $sube["adres"]; ?>
                                                       </p>
                                                   </div>
                                                   <div class="contact-profile__item">
                                                       <div class="contact-profile__icon">
                                                           <i class="fa  fa-phone"></i>
                                                       </div>
                                                       <p class="contact-profile__text">
                                                           <?php echo $sube["telefon"]; ?>
                                                       </p>
                                                   </div>
                                                   <div class="contact-profile__item">
                                                       <div class="contact-profile__icon">
                                                           <i class="fa  fa-envelope"></i>
                                                       </div>
                                                       <p class="contact-profile__text no-uppercase">
                                                           <?php echo $sube["eposta"]; ?>
                                                       </p>
                                                   </div>
                                               </div>
                                               <div class="contact-profile__content">
                                                   <span class="contact-profile__name capitalize">
                                                       <?php echo $db->Cevirmen($sube["ad"], $language_id, 1); ?>
                                                   </span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                               <?php } ?>

                           </div>
                        </div>
                    </div>
                </div>
            </article>
        </main>
    </div>
</div>






