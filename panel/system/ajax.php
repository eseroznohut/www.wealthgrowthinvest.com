<?php
include_once("Database.php");

$modul = $db->myFunctions->post("modul");
$islem = $db->myFunctions->post("islem");
$id = $db->myFunctions->post("id");

if(!isset($modul)){ $modul =  $db->myFunctions->get("modul"); }
if(!isset($islem)){ $islem = $db->myFunctions->get("islem"); }
if(!isset($id)){ $id = $db->myFunctions->get("id"); }

switch ($modul)
{
    case 'login':
        $sonuc = $db->login();
        $return = array();
        array_push($return, $sonuc);
        echo json_encode($return);
        break;

    case 'forgot':
        $params = array();
        $eposta = $db->myFunctions->post("eposta");
        array_push($params, $eposta);
        $kullanici_varmi = $db->select("select *from users where eposta = ?",$params);
        $eposta = $kullanici_varmi[0]["eposta"];
        $params = array();
        if(!empty($eposta)){
            $db->myFunctions->sifirlamaBaglantisiGonder($db, $eposta);
            array_push($params,"true");
        }else
        {
            array_push($params,"true");
        }
        echo json_encode($params);
        break;



    case 'slayt':

        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from slayt where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["yazi"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                    array_push($result, $value["aciklama"]);
                    array_push($result, $value["icerik"]);
                }

                echo json_encode($result);
                break;

            case 'active_state_change':
                $gelen = $db->myFunctions->post("durum");

                if($gelen == "true"){
                    $durum = 1;
                }else{
                    $durum = 0;
                }
                $update = $db->dbh->prepare("UPDATE slayt SET aktif = ? where id = ?");
                $update->bindParam(1, $durum);
                $update->bindParam(2, $id);
                $update->execute();
                echo json_encode("bla");
                break;
        }

        break;

    case 'sayfa':

        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from sayfa where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["modul_id"]);
                    array_push($result, $value["icerik"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                }

                echo json_encode($result);
                break;

            case 'active_state_change':
                echo $db->SayfaActiveStateChange($id);
                break;
        }
        break;

    case 'modul':
        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from modul where id = ?", $params);
                $result = array();
                foreach ($select as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["id"]);
                    array_push($result, $value["aktif"]);
                    array_push($result, $value["anasayfada_goster"]);
                }
                echo json_encode($result);
                break;

            case 'delete':
                $delete = $db->delete("modul", $id,null);
                echo json_encode($id);
                break;

            case 'active_state_change':
                echo $db->ModulActiveStateChange($id);
                break;

            case 'widget_state_change':
                echo $db->ModulWidgetStateChange($id);
                break;
        }
        break;

    case 'fotogaleri':
        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from fotogaleri where id = ?",$params);

                $result = array();
                foreach ($select as $value)
                {
                    array_push($result, $value["id"]);
                    array_push($result, $value["sira"]);
                    array_push($result, $value["yazi"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                }
                echo json_encode($result);
                break;

            case 'active_state_change':
                echo $db->FotoActiveStateChange($id);
                break;
        }
        break;



    case 'video':
        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from video where id = ?",$params);

                $result = array();
                foreach ($select as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["url"]);
                    array_push($result, $value["aktif"]);
                }
                echo json_encode($result);
                break;

            case 'active_state_change':
                echo $db->VideoActiveStateChange($id);
                break;
        }
        break;




    case 'haber':
        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from haber where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["id"]);
                    array_push($result, $value["tarih"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["icerik"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                    array_push($result, $value["kategori_id"]);
                    array_push($result, $value["etiket"]);
                }

                echo json_encode($result);
                break;

            case 'active_state_change':
                $gelen = $db->myFunctions->post("durum");

                if($gelen == "true"){
                    $durum = 1;
                }else{
                    $durum = 0;
                }
                $update = $db->dbh->prepare("UPDATE haber SET aktif = ? where id = ?");
                $update->bindParam(1, $durum);
                $update->bindParam(2, $id);
                $update->execute();
                echo json_encode("bla");
                break;
        }
        break;

    case 'mesaj':
        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from mesaj where id = ?", $params);
                $db->mesajOkunduUpdate($id);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["ad"]);
                    array_push($result, $value["eposta"]);
                    array_push($result, $value["konu"]);
                    array_push($result, $value["mesaj"]);
                    array_push($result, $value["tarih"]);
                    array_push($result, $value["ip"]);
                    array_push($result, $value["id"]);

                    $okunmayan_mesaj_sayisi = $db->mesajSayisi(0);
                    $okunan_mesaj_sayisi = $db->mesajSayisi(1);

                    array_push($result, $okunmayan_mesaj_sayisi);
                    array_push($result, $okunan_mesaj_sayisi);
                    array_push($result, $value["gelengiden"]);
                }
                echo json_encode($result);
                break;
        }
        break;
    case 'notification':
        switch ($islem)
        {
            case 'goruldu':
                echo $db->ZiyaretciTelefonGoruldu();
                echo $db->ZiyaretciEbultenGoruldu();
                break;
        }
        break;

    case 'kullanici':
        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from users where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["ad_soyad"]);
                    array_push($result, $value["username"]);
                    array_push($result, $value["eposta"]);
                    array_push($result, $value["password"]);
                    array_push($result, $value["aktif"]);
                }
                echo json_encode($result);
                break;

            case 'profil_resmi_yukle':
                $resim = $db->KullaniciProfilResmiYukle();
                $result = array();
                array_push($result, $resim);
                echo json_encode($result);
                break;
            case 'profil_resmi_sil':
                echo $db->KullaniciProfilResmiSil();
                break;
        }
        break;

    case 'ceviriler':
        switch ($islem)
        {
            case 'select':

                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from language where id = ?", $params);

                $result = array();
                foreach ($select as $value)
                {
                    array_push($result, $value["name"]);
                    array_push($result, $value["flag"]);
                    array_push($result, $value["aktif"]);
                }
                echo json_encode($result);
                break;

            case 'ceviri_select':

                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from dictionary where id = ?", $params);

                $result = array();
                foreach ($select as $value)
                {
                    array_push($result, $value["translation"]);
                }
                echo json_encode($result);
                break;

            case 'aktif_pasif':
                echo $db->DilAktifPasif($id);
                break;

            case 'get_words':

                $words_result = array();
                $words = $db->select("select *from words where site = 1");
                foreach ($words as $word)
                {
                    $language_id = $_POST["language_id"];
                    $word_id = $word["id"];
                    $word_text = $word["word"];

                    $params = array();
                    array_push($params, $language_id);
                    array_push($params, $word_id);
                    $dictionaries = $db->select("SELECT language_id, word_id FROM dictionary WHERE language_id = ? and word_id = ?", $params);

                    if(count($dictionaries) == 0){
                        echo '<option value="'.$word_id.'">'.$word_text.'</option>';
                    }
                }
                break;
        }
        break;

    case 'kullanici_grup':
        switch ($islem)
        {
            case 'select_modul':
                $moduls = array();
                $panel_moduls = $db->select("select *from panel_modul where aktif = 1 order by label asc");
                foreach ($panel_moduls as $panel_modul)
                {
                    $modul = array();
                    $modul[] = $panel_modul["id"];
                    $modul[] = $panel_modul["label"];
                    array_push($moduls, $modul);
                }
                echo json_encode($moduls);
                break;

            case 'insert_group':
                $lastId = $db->KullaniciGrupEkle();
                $group_id = array();
                array_push($group_id, $lastId);
                echo json_encode($group_id);

                break;

            case 'delete_kullanici_group':
                $params = array();
                array_push($params, $id);
                $u_module_permissions = $db->select("SELECT *FROM u_module_permission WHERE u_users_group_id = ?", $params);

                foreach ($u_module_permissions as $u_module_permission)
                {
                    $db->delete("u_module_permission",$u_module_permission["id"],"u_module_permission");
                }

                $db->delete("u_users_group",$id,"u_users_group");
                echo json_encode("ok");
                break;

            case 'insert_kullanici_group_izinler':
                $last_id = $db->izinEkle($id);
                echo json_encode($last_id);
                break;

            case 'kullanici_grup_guncelle':

                $return = $db->KullaniciGrupGuncelle();
                echo $return;
                break;

            case 'izin_guncelle':

                $db->izinGuncelle();
                echo json_encode("ok");
                break;

            case 'select_group':

                $moduls = array();
                $panel_moduls = $db->select("select *from panel_modul where aktif = 1 order by label asc");
                foreach ($panel_moduls as $panel_modul)
                {
                    $modul = array();
                    $modul[] = $panel_modul["id"];
                    $modul[] = $panel_modul["label"];

                    $params = array();
                    array_push($params, $panel_modul["id"]);
                    array_push($params, $_POST["grup_id"]);
                    $module_permissions = $db->select("select *from u_module_permission where panel_modul_id = ? and u_users_group_id = ?", $params);

                    foreach ($module_permissions as $module_permission)
                    {
                        $modul[] = $module_permission["ekle"];
                        $modul[] = $module_permission["sil"];
                        $modul[] = $module_permission["duzenle"];
                        $modul[] = $module_permission["goruntule"];
                        $modul[] = $module_permission["id"];
                        $modul[] = $module_permission["guncelle"];
                        array_push($moduls, $modul);
                    }
                }
                echo json_encode($moduls);
                break;

            case 'select_group_name':
                $grup_id = $_POST["grup_id"];
                $params = array();
                array_push($params, $grup_id);
                $select = $db->select("SELECT *FROM u_users_group WHERE id = ?", $params);
                $result =array();
                array_push($result, $select[0]["name"]);
                array_push($result, $select[0]["islem_loglarini_goster"]);
                echo json_encode($result);
                break;
        }

        break;

    case 'proje_kategori':

        switch ($islem)
        {
            case 'kategori_ekle':
                $lastId = $db->ProjeKategoriEkle();
                $result = array();
                array_push($result, $last_id);
                echo json_encode($result);

                break;
            case 'select_proje_kategori':
                $params=array();
                array_push($params, $id);
                $array = $db->select("select *from proje_kategori where id = ?",$params);

                $result = array();

                foreach ($array as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["aktif"]);
                }

                echo json_encode($result);
                break;

            case 'proje_kategori_sil':
                $delete = $db->delete("proje_kategori", $id, "proje_kategori");
                $result = array();
                array_push($result, $delete);
                echo json_encode($result);
                break;
            case 'proje_kategori_guncelle':
                $update = $db->ProjeKategoriGuncelle();
                $result = array();
                array_push($result, $update);
                echo json_encode($result);
                break;
        }

        break;

    case 'proje':

        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from proje where id = ?", $params);

                $result = array();

                foreach ($select as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["kategori_id"]);
                    array_push($result, $value["icerik"]);
                    array_push($result, $value["aktif"]);
                    array_push($result, $value["resim_yolu_thumbnail"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["baslangic_t"]);
                    array_push($result, $value["bitis_t"]);
                }

                echo json_encode($result);
                break;

            case 'active_state_change':
                $gelen = $db->myFunctions->post("durum");

                if($gelen == "true"){
                    $durum = 1;
                }else{
                    $durum = 0;
                }
                $update = $db->dbh->prepare("UPDATE proje SET aktif = ? where id = ?");
                $update->bindParam(1, $durum);
                $update->bindParam(2, $id);
                $update->execute();
                echo json_encode("bla");
                break;

        }


        break;

    case 'ekip':

        switch ($islem)
        {
            case 'select':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from ekip where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["gorev"]);
                    array_push($result, $value["facebook"]);
                    array_push($result, $value["twitter"]);
                    array_push($result, $value["instagram"]);
                    array_push($result, $value["gplus"]);
                    array_push($result, $value["telefon"]);
                    array_push($result, $value["eposta"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                    array_push($result, $value["kategori_id"]);
                }

                echo json_encode($result);
                break;

            case 'active_state_change':
                $gelen = $db->myFunctions->post("durum");

                if($gelen == "true"){
                    $durum = 1;
                }else{
                    $durum = 0;
                }
                $update = $db->dbh->prepare("UPDATE ekip SET aktif = ? where id = ?");
                $update->bindParam(1, $durum);
                $update->bindParam(2, $id);
                $update->execute();
                echo json_encode("bla");
                break;
        }

        break;


    case 'is_ortakligi':

        switch ($islem)
        {
            case 'select_segment':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from ortaklik_segment where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["icerik"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                }

                echo json_encode($result);
                break;

            case 'segment_active_state_change':
                $gelen = $db->myFunctions->post("durum");

                if($gelen == "true"){
                    $durum = 1;
                }else{
                    $durum = 0;
                }
                $update = $db->dbh->prepare("UPDATE ortaklik_segment SET aktif = ? where id = ?");
                $update->bindParam(1, $durum);
                $update->bindParam(2, $id);
                $update->execute();
                echo json_encode("bla");
                break;

            case 'select_ortak':
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from ortak where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["resim_yolu"]);
                    array_push($result, $value["aktif"]);
                }

                echo json_encode($result);
                break;

            case 'ortak_active_state_change':
                $gelen = $db->myFunctions->post("durum");

                if($gelen == "true"){
                    $durum = 1;
                }else{
                    $durum = 0;
                }
                $update = $db->dbh->prepare("UPDATE ortak SET aktif = ? where id = ?");
                $update->bindParam(1, $durum);
                $update->bindParam(2, $id);
                $update->execute();
                echo json_encode("bla");
                break;
        }

        break;


    case "haber_kategori":

        switch ($islem)
        {
            case "kategori_ekle":
                $sonuc = $db->HaberKategoriEkle();
                $return = array();
                array_push($return, $sonuc);
                echo json_encode($return);
                break;

            case "kategori_guncelle":
                $sonuc = $db->HaberKategoriGuncelle();
                $return = array();
                array_push($return, $sonuc);
                echo json_encode($return);
                break;
            case "kategori_sil":
                $sonuc = $db->delete("haber_kategori",$id,"haber_kategori");
                $return = array();
                array_push($return, $sonuc);
                echo json_encode($return);
                break;


            case "select_kategori":
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from haber_kategori where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);
                    array_push($result, $value["aktif"]);
                }

                echo json_encode($result);
                break;

        }



    case "referans":

        switch ($islem)
        {
            case "select_referans":
                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from referans where id = ?", $params);

                $result = array();

                foreach ($select as $referans)
                {
                    array_push($result, $referans["sira"]);
                    array_push($result, $referans["ad"]);
                    array_push($result, $referans["kategori_id"]);
                }

                echo json_encode($result);

                break;
            case "kategori_ekle":
                $sonuc = $db->ReferansKategoriEkle();
                $return = array();
                array_push($return, $sonuc);
                echo json_encode($return);
                break;

            case "kategori_guncelle":
                $sonuc = $db->ReferansKategoriGuncelle();
                $return = array();
                array_push($return, $sonuc);
                echo json_encode($return);
                break;
            case "kategori_sil":
                $sonuc = $db->delete("referans_kategori",$id,"referans_kategori");
                $return = array();
                array_push($return, $sonuc);
                echo json_encode($return);
                break;


            case "select_kategori":
                $params = array();
                array_push($params, $id);
                $dizi = $db->select("select *from referans_kategori where id = ?", $params);

                $result = array();
                foreach ($dizi as $value)
                {
                    array_push($result, $value["sira"]);
                    array_push($result, $value["ad"]);

                }

                echo json_encode($result);
                break;



        }


                break;


    case "sube":

        switch ($islem)
        {
            case "select_sube":
                $params = array();
                array_push($params, $id);
                $select = $db->select("select *from sube where id = ?", $params);

                $result = array();

                foreach ($select as $sube)
                {
                    array_push($result, $sube["ad"]);
                    array_push($result, $sube["adres"]);
                    array_push($result, $sube["telefon"]);
                    array_push($result, $sube["eposta"]);
                    array_push($result, $sube["resim_yolu"]);
                }

                echo json_encode($result);

                break;




        }


        break;


}
?>
