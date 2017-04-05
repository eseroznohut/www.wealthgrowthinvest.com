<?php
include_once("../panel/system/Database.php");

$modul = $db->myFunctions->post("modul");
$islem = $db->myFunctions->post("islem");
$id = $db->myFunctions->post("id");

if(!isset($modul)){ $modul =  $db->myFunctions->get("modul"); }
if(!isset($islem)){ $islem = $db->myFunctions->get("islem"); }
if(!isset($id)){ $id = $db->myFunctions->get("id"); }

switch ($modul)
{
    case 'mesaj':
        switch ($islem)
        {
            case 'insert':

                $sonuc = $db->MesajGonder(0);
                $result = array();
                array_push($result, $sonuc);
                echo json_encode($result);
                break;
        }
        break;

    case 'ebulten':
        switch ($islem)
        {
            case 'insert':

                $sonuc = $db->EbultenEpostaEkle();
                $result = array();
                array_push($result, $sonuc);

                echo json_encode($result);

                break;
        }
        break;

    case 'telefon_kayit':
        switch ($islem)
        {
            case 'insert':

                $sonuc = $db->ZiyaretciTelefonEkle();
                $result = array();
                array_push($result, $sonuc);

                echo json_encode($result);

                break;
        }
        break;

    case 'ziyaretci':
        switch ($islem)
        {
            case 'cikis':

                $sonuc = $db->ZiyaretciCikis();
                $result = array();
                array_push($result, $sonuc);

                echo json_encode($result);

                break;
        }
        break;

}
?>