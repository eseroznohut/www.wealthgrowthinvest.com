<div id="wrapper">
    <div id="layout-static">
        <?php include_once("navigation.php");  ?>
        <div class="static-content-wrapper">
            <?php
            $page = $_GET["view"];
            switch ($page)
            {
                case "ortaklik":
                    include_once("pages/ortaklik.php");
                    break;
                case "ekip":
                    include_once("pages/ekip.php");
                    break;
                case "referanslar":
                    include_once("pages/referanslar.php");
                    break;
                case "ceviriler":
                    include_once("pages/ceviriler.php");
                    break;
                case "ebulten":
                    include_once("pages/ebulten.php");
                    break;
                case "telefon_numaralari":
                    include_once("pages/telefon_numaralari.php");
                    break;
                case "panel":
                    include_once("pages/dashboard.php");
                    break;
                case "kullanicilar":
                    include_once("pages/kullanicilar.php");
                    break;
                case "sayfalar":
                    include_once("pages/sayfalar.php");
                    break;
                case "moduller":
                    include_once("pages/moduller.php");
                    break;
                case "mesajlar":
                    include_once("pages/mesajlar.php");
                    break;
                case "haberler":
                    include_once("pages/haberler.php");
                    break;
                case "fotograflar":
                    include_once("pages/fotograflar.php");
                    break;
                case "videolar":
                    include_once("pages/videolar.php");
                    break;
                case "slaytlar":
                    include_once("pages/slaytlar.php");
                    break;
                case "genel_ayarlar":
                    include_once("pages/genel_ayarlar.php");
                    break;
                case "profil":
                    include_once("pages/profil.php");
                    break;
                case "projeler":
                    include_once("pages/projeler.php");
                    break;
                default:
                    include_once("pages/dashboard.php");
                    break;
            }
            ?>
        </div>
    </div>
</div>