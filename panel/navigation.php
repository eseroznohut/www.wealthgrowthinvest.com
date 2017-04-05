
<div class="static-sidebar-wrapper sidebar-blue">
    <div class="static-sidebar">
        <div class="sidebar">
            <div class="widget" id="widget-profileinfo">
                <div class="widget-body">                   
                    <div class="userinfo ">
                        <a href="/?view=profil">
                            <div class="avatar pull-left">                               
                                <img src="<?php echo $profil_resmi;  ?>" class="img-responsive img-circle" width="50" height="50" />
                            </div>
                            <div class="info">
                                <span class="username">
                                    <?php echo $_SESSION["ad_soyad"]; ?>
                                </span>
                                <span class="useremail">
                                    <?php echo $_SESSION["eposta"]; ?>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="widget stay-on-collapse" id="widget-sidebar">
                <nav role="navigation" class="widget-body">
                    <ul class="acc-menu">
                        <li class="nav-separator"><span><?php echo $db->Cevirmen("Navigasyon", $language_id, 0); ?></span></li>
                        <li>
                            <a class="withripple" href="?view=panel">
                                <span class="icon">
                                    <i class="material-icons">home</i>
                                </span><span><?php echo $db->Cevirmen("Gösterge Paneli", $language_id, 0); ?></span>
                            </a>
                        </li>    

                        <?php
                        $panel_moduls = $db->select("select *from panel_modul where aktif = 1 order by sira asc");
                        foreach ($panel_moduls as $value)
                        {
                            if($db->izinKontrol($value["id"],"goruntule"))
                            {
                        ?>
                        <li>
                            <a class="withripple" href="?view=<?php echo $value["href"]; ?>&icon=<?php echo $value["icon"]; ?>">
                                <span class="icon">
                                    <i class="material-icons">
                                        <?php echo $value["icon"]; ?>
                                    </i>
                                </span>
                                <span>
                                    <?php echo $db->Cevirmen($value["label"], $language_id, 0); ?>
                                </span>
                            </a>
                        </li>
                        <?php
                            }
                        }?>  
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>