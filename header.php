<?php
$p = 0;
include_once('panel/system/Database.php');


if(!empty($_SESSION["site_language"]))
{
    $language_id = $_SESSION["lang_id"];
    $varsayilan_dil_kisa = $_SESSION["lang_kisa_ad"];
}


$db->ZiyaretciKontrol();


?>
