<?php
include_once ('Database.php');

if($_SESSION["on"] == "on")
{

    $islem = $_POST["islem"];
    $dosya = $_POST["dosya"];
    $id = $_POST["id"];

    if(!isset($islem)){$islem=$_GET["islem"];}
    if(!isset($dosya)){$dosya=$_GET["dosya"];}
    if(!isset($id)){$id=$_GET["id"];}


    if(isset($islem) && isset($dosya) && isset($id)){


        switch ($islem)
        {
            case 'yukle':

                switch ($dosya)
                {
                    case 'proje':
                        $buyuk = $db->myFunctions->ResimYukle(Database::$proje_foto_input_name,Database::$proje_foto_x,Database::$proje_foto_y,Database::$proje_foto_tablename,Database::$proje_foto_resize,Database::$proje_foto_ratio_crop,2);
                        $kucuk = $db->myFunctions->ResimYukle(Database::$proje_foto_input_name,Database::$proje_foto_thumbnail_x,Database::$proje_foto_thumbnail_y,Database::$proje_foto_tablename,Database::$proje_foto_resize,Database::$proje_foto_ratio_crop,2);
                        break;
                    case 'haber':
                        $buyuk = $db->myFunctions->ResimYukle(Database::$haber_foto_input_name,Database::$haber_foto_x,Database::$haber_foto_y,Database::$haber_foto_tablename,Database::$haber_foto_resize,Database::$haber_foto_ratio_crop,2);
                        $kucuk = $db->myFunctions->ResimYukle(Database::$haber_foto_input_name,Database::$haber_foto_thumbnail_x,Database::$haber_foto_thumbnail_y,Database::$haber_foto_tablename,Database::$haber_foto_resize,Database::$haber_foto_ratio_crop,2);
                        break;
                    case 'fotogaleri':
                        $buyuk = $db->myFunctions->ResimYukle(Database::$fotogaleri_foto_input_name,Database::$fotogaleri_foto_x,Database::$fotogaleri_foto_y,Database::$fotogaleri_foto_tablename,Database::$fotogaleri_foto_resize,Database::$fotogaleri_foto_ratio_crop,2);
                        $kucuk = $db->myFunctions->ResimYukle(Database::$fotogaleri_foto_input_name,Database::$fotogaleri_foto_thumbnail_x,Database::$fotogaleri_foto_thumbnail_y,Database::$fotogaleri_foto_tablename,Database::$fotogaleri_foto_resize,Database::$fotogaleri_foto_ratio_crop,2);
                        break;
                }

                return $db->ResimEkle($dosya, session_id(), $buyuk, $kucuk);
                break;

            case 'sil':
                $file = $_POST["kucuk_resim_adi"];

                $update = $db->dbh->prepare("UPDATE resim SET secili = 1 WHERE modul_adi = ? and record_id = ? and kucuk = ?");
                $update->bindParam(1, $dosya);
                $update->bindParam(2, $id);
                $update->bindParam(3, $file);
                $xx = $update->execute();
                echo $xx;
                break;

            case 'getir':
                $params = array();
                array_push($params, $dosya);
                array_push($params, $id);

                $sonuc = $db->select("select *from resim where modul_adi = ? and record_id = ?", $params);

                $result  = array();
                foreach ($sonuc as $key => $value) {
                    $resim = $value['kucuk'];
                    $buyuk = $value['buyuk'];
                    $fil = "../../uploads/images/$dosya/$buyuk";
                    $obj['name'] = $value['kucuk'];
                    $obj['size'] = filesize($fil);
                    $result[] = $obj;
                }
                header('Content-type: text/json');
                header('Content-type: application/json');
                echo json_encode($result);
                break;

            case 'tamponu_temizle':
                echo $db->TamponTemizle($dosya);
                break;

        }
    }
}
else
{
    echo "OTURUM KAPALI";
}

?>

