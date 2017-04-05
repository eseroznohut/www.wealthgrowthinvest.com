<?php
error_reporting(0);

include_once('classes/class.upload.php');
include_once("classes/class.phpmailer.php");

$db = new Database();
$db->sessionStart();
$settings = $db->select("select *from ayarlar limit 1");

$varsayilan_dil = $settings[0]["varsayilan_dil"];

$params = array();
array_push($params, $varsayilan_dil);
$diller = $db->select("SELECT *FROM language where name = ?", $params);
$varsayilan_dil_kisa = $diller[0]["kisa_ad"];
$language_id = $diller[0]["id"];
//$_SESSION["site_language"] = $diller[0]["name"];
//$_SESSION["lang_kisa_ad"] = $diller[0]["kisa_ad"];
//$_SESSION["lang_id"] = $diller[0]["id"];

if(!empty($_GET["language"])){
    $params = array();
    array_push($params, $_GET["language"]);
    $diller = $db->select("SELECT *FROM language where kisa_ad = ?", $params);

    $_SESSION["site_language"] = $diller[0]["name"];
    $_SESSION["lang_kisa_ad"] = $diller[0]["kisa_ad"];
    $_SESSION["lang_id"] = $diller[0]["id"];


    $varsayilan_dil_kisa = $_SESSION["lang_kisa_ad"];
    $varsayilan_dil =  $_SESSION["site_language"];
    $language_id = $_SESSION["lang_id"];
}


if(!empty($_POST["languagebox"])){

    $params = array();
    array_push($params, $_POST["languagebox"]);
    $diller = $db->select("SELECT *FROM language where id = ?", $params);

    $_SESSION["site_language"] = $diller[0]["name"];
    $_SESSION["lang_kisa_ad"] = $diller[0]["kisa_ad"];
    $_SESSION["lang_id"] = $diller[0]["id"];


    $varsayilan_dil_kisa = $_SESSION["lang_kisa_ad"];
    $varsayilan_dil =  $_SESSION["site_language"];
    $language_id = $_SESSION["lang_id"];

}



$params = array();
array_push($params, $_SESSION["id"]);
$profile = $db->select("select *from users where id = ?", $params);

if(empty($profile[0]["resim_yolu"])){
    $profil_resmi="assets/img/user_avatar.jpg";
}else{
    $profil_resmi = "uploads/images/profile/".$profile[0]["resim_yolu"];
}

//if($_SESSION['panel_dil_id'] == 0 || empty($_SESSION['panel_dil_id'])){
//    $params = array();
//    array_push($params, $varsayilan_dil);
//    $diller = $db->select("SELECT *FROM language where name = ?", $params);
//    $language_id = $diller[0]["id"];
//}else
//{

//    $language_id = $_SESSION['panel_dil_id'];
//}

if($p == 1){
    if(isset($_GET["logout"])){
        $db->sessionflush();
    }else
    {
        $on = $_SESSION['on'];
        $s = $db->session($on);

        if($_GET["view"] == "panel" || empty($_GET["view"])){

            if($settings[0]["google_analystic_aktif"] == 1){
                //$dosya_varmi = file_exists("/2120dfde507c.p12");

                //if($dosya_varmi){
                    require 'classes/gapi.class.php';
                    $gaEmail    = $settings[0]["ga_email"];
                    $p12Pass    = "../2120dfde507c.p12";
                    $profileId  = $settings[0]["ga_profile_id"];
                    $baslangic  = '2015-06-03';
                    $bitis 	    = '2015-07-03';
                    $dimensions = array('date');
                    $metrics    = array('visits','pageviews');
                    $sortMetric	= null;
                    $filter		= null;

                    $ga = new gapi($gaEmail,$p12Pass);

                    $ulkeler = $ga->requestReportData($profileId,array('CountryISOCode'),array('pageviews','visits'));
                    $sehirler = $ga->requestReportData($profileId,array('City'),array('pageviews','visits'));
                    $ga->requestReportData($profileId,$dimensions,$metrics,$sortMetric,$filter,$baslangic,$bitis);

                //}else
                //{
                //    $ayar_update = $db->dbh->prepare("UPDATE ayarlar SET google_analystic_aktif = 0 limit 1");
                //    $ayar_update->execute();
                //}

            }
        }
    }
}

class Database extends PDO
{
	public $dbh;
    public $myFunctions;

    public static $MaxUploadFileSize = 4096;

    public static $fotogaleri_foto_x = 1070;
    public static $fotogaleri_foto_y = 720;
    public static $fotogaleri_foto_thumbnail_x = 290;
    public static $fotogaleri_foto_thumbnail_y = 180;
    public static $fotogaleri_foto_resize = true;
    public static $fotogaleri_foto_ratio_crop = true;
    public static $fotogaleri_foto_tablename = 'fotogaleri';
    public static $fotogaleri_foto_input_name = 'resim_yolu';

    public static $ekip_foto_x = 370;
    public static $ekip_foto_y = 503;
    public static $ekip_foto_thumbnail_x = 370;
    public static $ekip_foto_thumbnail_y = 503;
    public static $ekip_foto_resize = true;
    public static $ekip_foto_ratio_crop = true;
    public static $ekip_foto_tablename = 'ekip';
    public static $ekip_foto_input_name = 'resim_yolu';

    public static $haber_foto_x = 928;
    public static $haber_foto_y = 619;
    public static $haber_foto_thumbnail_x = 350;
    public static $haber_foto_thumbnail_y = 200;
    public static $haber_kapak_foto_x = 635;
    public static $haber_kapak_foto_y = 315;
    public static $haber_kapak_foto_thumbnail_x = 350;
    public static $haber_kapak_foto_thumbnail_y = 200;

    public static $haber_foto_resize = true;
    public static $haber_foto_ratio_crop = true;
    public static $haber_foto_tablename = 'haber';
    public static $haber_foto_input_name = 'resim_yolu';

    public static $sayfa_foto_x = 400;
    public static $sayfa_foto_y = 803;
    public static $sayfa_foto_thumbnail_x = 0;
    public static $sayfa_foto_thumbnail_y = 0;
    public static $sayfa_foto_resize = false;
    public static $sayfa_foto_ratio_crop = false;
    public static $sayfa_foto_tablename = 'sayfa';
    public static $sayfa_foto_input_name = 'resim_yolu';

    public static $slayt_foto_x = 1920;
    public static $slayt_foto_y = 660;
    public static $slayt_foto_thumbnail_x = 290;
    public static $slayt_foto_thumbnail_y = 180;
    public static $slayt_foto_resize = true;
    public static $slayt_foto_ratio_crop = true;
    public static $slayt_foto_tablename = 'slayt';
    public static $slayt_foto_input_name = 'resim_yolu';

    public static $proje_foto_x = 840;
    public static $proje_foto_y = 420;
    public static $proje_foto_thumbnail_x = 255;
    public static $proje_foto_thumbnail_y = 170;
    public static $proje_foto_resize = true;
    public static $proje_foto_ratio_crop = true;
    public static $proje_foto_tablename = 'proje';
    public static $proje_foto_input_name = 'resim_yolu';

    public static $logo_foto_x = 190;
    public static $logo_foto_y = 130;
    public static $logo_foto_resize = true;
    public static $logo_foto_ratio_crop = true;
    public static $logo_foto_tablename = 'ayarlar';
    public static $logo_foto_input_name = 'logo_yolu';

    public static $footer_logo_foto_x = 190;
    public static $footer_logo_foto_y = 130;
    public static $footer_logo_foto_resize = true;
    public static $footer_logo_foto_ratio_crop = true;
    public static $footer_logo_foto_tablename = 'ayarlar';
    public static $footer_logo_foto_input_name = 'footer_logo';

    public static $background_image_x = 1920;
    public static $background_image_y = 1080;
    public static $background_image_resize = true;
    public static $background_image_ratio_crop = true;
    public static $background_image_tablename = 'ayarlar';
    public static $background_image_input_name = 'arkaplan_yolu';


    public static $ortak_segment_foto_x = 289;
    public static $ortak_segment_foto_y = 289;
    public static $ortak_segment_foto_thumbnail_x = 289;
    public static $ortak_segment_foto_thumbnail_y = 289;
    public static $ortak_segment_foto_resize = true;
    public static $ortak_segment_foto_ratio_crop = true;
    public static $ortak_segment_foto_tablename = 'ortaklik_segment';
    public static $ortak_segment_foto_input_name = 'resim_yolu';

    public static $ortak_foto_x = 210;
    public static $ortak_foto_y = 100;
    public static $ortak_foto_thumbnail_x = 210;
    public static $ortak_foto_thumbnail_y = 100;
    public static $ortak_foto_resize = true;
    public static $ortak_foto_ratio_crop = true;
    public static $ortak_foto_tablename = 'ortak';
    public static $ortak_foto_input_name = 'resim_yolu';


	function __construct()
	{
        //$dsn = 'mysql:host=94.73.146.252;dbname=itw_monkey';
        //$user = 'itw_monkey';
        //$password = 'OApu57H6';

        //$dsn = 'mysql:dbname=monkeyfist;localhost';
        //$user = 'root';
        //$password = '';

        $dsn = 'mysql:dbname=wg_db;localhost';
        $user = 'root';
        $password = '';

		try {
		    $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->query("SET NAMES 'utf8'");
            $this->dbh->query("SET CHARACTER SET 'utf8'");
            $this->myFunctions = new myFunctions();

            //$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
        catch (PDOException $e) {

            $dsn = 'mysql:dbname=wealthgr_db;localhost';
            $user = 'wealthgr_user';
            $password = 'emre102030';

            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->query("SET NAMES 'utf8'");
            $this->dbh->query("SET CHARACTER SET 'utf8'");
            $this->myFunctions = new myFunctions();

            //echo 'Veritabanı Bağlantısı Sağlanamadı: ' . $e->getMessage();
		}
	}

	public function login()
	{
        $this->sessionStart();
        $remember = $_POST["beni_hatirla"];

        if(isset($_COOKIE["panel2016_remember"]) && isset($_COOKIE["panel2016_username"]) && isset($_COOKIE["panel2016_password"])){
            $username = $_COOKIE["panel2016_username"];
            $password = $_COOKIE["panel2016_password"];
            return $this->oturum($username, $password, $remember);
        }else{
            $username = $_POST["kullanici_adi"];
            $password = $_POST["parola"];
            return $this->oturum($username, $password, $remember);
        }
    }
    public function oturum($username, $password, $remember){

        if(isset($_COOKIE["panel2016_remember"]) && isset($_COOKIE["panel2016_username"]) && isset($_COOKIE["panel2016_password"])){
            $password2 = $password;
        }else
        {
            $password2 = md5(md5($password));
        }

        $login = $this->dbh->prepare("SELECT * FROM users WHERE username = ? AND password = ? ");
        $login->bindParam(1,$username);
        $login->bindParam(2,$password2);
        $login->execute();

        if ($login->rowCount() == 0) {
            return "Hatalı kullanıcı adı veya parola girdiniz.";
        }else{
            $login = $login->fetch();

            if($login["aktif"] == 0){
                return "Bu kullanıcı aktif değil. Lütfen yöneticinize danışın.";
            }

            $params = array();
            array_push($params, $login['u_users_group_id']);
            $kullanici_gruplari = $this->select("SELECT *FROM u_users_group WHERE id = ?", $params);

            if(count($kullanici_gruplari) == 0){
                return "Bu kullanıcının grubu atanmamış. Lütfen yöneticinize danışın.";
            }else{
                $_SESSION['user_group_id'] = $login['u_users_group_id'];
                $_SESSION['id'] = $login['id'];
                $_SESSION['username'] = $login['username'];
                $_SESSION['ad_soyad'] = $login['ad_soyad'];
                $_SESSION['eposta'] = $login['eposta'];
                $_SESSION['panel_dil_id'] = $login['panel_dil_id'];

                $_SESSION['on'] = "on";
                $last_enter = date("d-m-Y h:m:s");
                $last_ip = $this->myFunctions->get_client_ip();
                $update = $this->dbh->prepare("update users set last_enter = ?, last_ip = ? WHERE id = ?");
                $update->bindParam(1, $last_enter);
                $update->bindParam(2, $last_ip);
                $update->bindParam(3, $login['id']);
                $update->execute();

                $this->Audit("Login", 11, $login['id'], $login['ad_soyad']." isimli kullanıcı panele giriş yaptı.");

                if ($remember == "true") {
                    setcookie('panel2016_username', $username, time()+60*60*24*365, '/panel');
                    setcookie('panel2016_password', $password2, time()+60*60*24*365, '/panel');
                    setcookie('panel2016_remember', $remember, time()+60*60*24*365, '/panel');
                }else
                {
                    setcookie('panel2016_remember', null, time()-1, '/panel');
                    setcookie('panel2016_username', null, time()-1, '/panel');
                    setcookie('panel2016_password', null, time()-1, '/panel');
                }
                return "true";
            }
        }
    }
    public function izinKontrol($panel_modul_id, $kriter){

        $grup_id = $_SESSION['user_group_id'];

        $params = array();
        array_push($params, $grup_id);
        array_push($params, $panel_modul_id);
        $modul_izinleri = $this->select("SELECT *FROM u_module_permission WHERE u_users_group_id = ? and panel_modul_id = ?", $params);

        switch ($kriter)
        {
            case 'goruntule':
                if($modul_izinleri[0]["goruntule"] == 1){
                    return true;
                }
                break;
            case 'ekle':
                if($modul_izinleri[0]["ekle"] == 1){
                    return true;
                }
                break;
            case 'sil':
                if($modul_izinleri[0]["sil"] == 1){
                    return true;
                }
                break;
            case 'duzenle':
                if($modul_izinleri[0]["duzenle"] == 1){
                    return true;
                }
                break;
            case 'guncelle':
                if($modul_izinleri[0]["guncelle"] == 1){
                    return true;
                }
                break;
            case 'islem_log':
                $params = array();
                array_push($params, $grup_id);
                $kullanici_grup = $this->select("SELECT *FROM u_users_group WHERE id = ?", $params);
                if(count($kullanici_grup) > 0) {
                    return $kullanici_grup[0]["islem_loglarini_goster"];
                }
                break;
        }

        return false;
    }
    public function delete($table,$id,$dosya_yolu)
	{
        if(!empty($dosya_yolu)){
            $select = $this->dbh->query("SELECT *FROM $table WHERE id = '$id' ");
            foreach ($select as $value)
            {
            	unlink("../uploads/images/$dosya_yolu/".$value["resim_yolu"]);
                unlink("../uploads/images/$dosya_yolu/".$value["resim_yolu_thumbnail"]);
            }
        }

        $delete = $this->dbh->query("DELETE FROM $table WHERE id = '$id' ");
		if ($delete) {
            $this->Audit("Delete",0,$id,$table." tablosundan bir kayıt");
            return true;
		}else{
			return false;
		}
	}
	public function session($on = false)
	{
		if ($on) {

		}else {

            if(isset($_COOKIE["panel2016_remember"]) && isset($_COOKIE["panel2016_username"]) && isset($_COOKIE["panel2016_password"])){
                $this->login();
            }else
            {
                header("location:login.php");
                return "false";
            }
		}
	}
	public function sessionStart(){
		session_start();
		ob_start();
	}
	public function sessionflush()
	{
        session_start();

        unset($_COOKIE['panel2016_username']);
        unset($_COOKIE['panel2016_password']);
        unset($_COOKIE['panel2016_remember']);

        setcookie('panel2016_username', null, time()-1, '/panel');
        setcookie('panel2016_password', null, time()-1, '/panel');
        setcookie('panel2016_remember', null, time()-1, '/panel');

        $this->Audit("Logout",11,0,"panelden çıktı.");

        session_destroy();
        ob_end_flush();
        header("location:index.php");
    }
    public function getRowCount($tablo){
        $sorgu = $this->dbh->prepare("SELECT id FROM ".$tablo);
        $sonuc = $sorgu->rowCount();
        return $sonuc;
    }
    public function userInfo($id)
	{
		$info = $this->dbh->prepare("SELECT * FROM users WHERE id = ?");
		$info->bindParam(1,$id);
		$info->execute();
		if ($info->rowCount() == 1) {
			foreach ($info as $veri) {
				$ad = $veri['adsoyad'];
				$id = $veri['id'];
				echo $ad;
			}
		}
	}
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
        $sth = $this->dbh->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue($key + 1, $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }
    public function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
            return $uuid;
        }
    }
    public function mesajSayisi($okunan)
    {
        $sonuc = $this->dbh->prepare("SELECT id FROM mesaj WHERE okundu = ".$okunan);
        $sonuc->execute();
        $dd = $sonuc->rowCount();
        return $dd;
    }
    public function mesajOkunduUpdate($mesaj_id)
    {
        $update_okundu = $this->dbh->prepare("UPDATE mesaj SET okundu = 1 WHERE id = ?");
        $update_okundu->bindParam(1, $mesaj_id);
        $update_okundu->execute();
        return $update_okundu->rowCount();
    }
    public function mesajGorulduUpdate()
    {
        $update_goruldu = $this->dbh->prepare("UPDATE mesaj SET goruldu = 1 WHERE goruldu = 0");
        $update_goruldu->execute();
        return $update_goruldu->rowCount();
    }
    public function ZiyaretciKontrol()
    {
        $ip =  $this->myFunctions->get_client_ip();

        $params = array();
        array_push($params, $ip);
        array_push($params, date("d-m-Y"));
        $visitors = $this->select("SELECT *FROM visitors WHERE ip = ? and date = ?", $params);

        if(count($visitors) == 0){
            $insert = $this->dbh->prepare("INSERT INTO visitors SET ip = ?, date = ?, time = ?");
            $insert->bindParam(1, $ip);
            $insert->bindParam(2, date("d-m-Y"));
            $insert->bindParam(3, date("H:i:s"));
            $insert->execute();
        }else
        {
            $sayi = $visitors[0]["giris_sayisi"] +1;
            $update = $this->dbh->prepare("UPDATE visitors SET giris_sayisi = ? where id = ?");
            $update->bindParam(1, $sayi);
            $update->bindParam(2, $visitors[0]["id"]);
            $update->execute();
        }

        return $ip;
    }
    public function sayfaGoruntulemeSayisi()
    {
        $return = 0;
        $sonuclar = $this->select("select goruntuleme from sayfa");
        foreach ($sonuclar as $value)
        {
            $return = $return + $value["goruntuleme"];
        }

        $sonuclar = $this->select("select goruntuleme from modul where gizli = 1");
        foreach ($sonuclar as $value)
        {
            $return = $return + $value["goruntuleme"];
        }

        return $return;
    }
    public function tekilZiyaretciSayisi( )
    {
        $visitors = $this->select("SELECT DISTINCT *FROM visitors");
        return count($visitors);
    }
    public function GunlukZiyaretciSayisi( )
    {
        $params = array();
        array_push($params, date("d-m-Y"));
        $visitors = $this->select("SELECT DISTINCT *FROM visitors WHERE date = ?", $params);
        return count($visitors);
    }
    public function DunkuZiyaretciSayisi( )
    {
        $params = array();
        array_push($params, date('d-m-Y',strtotime("-1 day")));
        $visitors = $this->select("SELECT DISTINCT *FROM visitors WHERE date = ?", $params);
        return count($visitors);
    }
    public function SayfaSayisi(){
        $sayfa = $this->select("select *from sayfa");
        $return = count($sayfa);
        return $return;
    }
    public function ModulSayisi(){
        $modul = $this->select("select *from modul");
        $return = count($modul);
        return $return;
    }
    public function SlaytSayisi(){
        $slayt = $this->select("select *from slayt");
        $return = count($slayt);
        return $return;
    }
    public function FotografSayisi(){
        $fotogaleri = $this->select("select *from fotogaleri");
        $return = count($fotogaleri);
        return $return;
    }
    public function HaberSayisi(){
        $haber = $this->select("select *from haber");
        $return = count($haber);
        return $return;
    }
    public function TelefonNumaralariSayisi(){
        $telefon = $this->select("select *from ziyaretci_telefon");
        $return = count($telefon);
        return $return;
    }
    public function EbultenSayisi(){
        $ebulten = $this->select("select *from ebulten");
        $return = count($ebulten);
        return $return;
    }
    public function YoneticiSayisi(){
        $yonetici = $this->select("select *from users");
        $return = count($yonetici);
        return $return;
    }
    public function DilSayisi(){
        $dil = $this->select("select *from language");
        $return = count($dil);
        return $return;
    }
    public function ZiyaretciCikis(){

        $return = array();
        array_push($return,"true");
        return json_encode($return);
    }
    public function SiteAyarGuncelle() {

        $settings = $this->select("select *from ayarlar limit 1");

        $adres = $_POST["adres"];
        $telefon1 = $_POST["telefon1"];
        $telefon2 = $_POST["telefon2"];
        $eposta = $_POST["eposta"];
        $facebook = $_POST["facebook"];
        $twitter = $_POST["twitter"];
        $instagram = $_POST["instagram"];
        $gplus = $_POST["gplus"];
        $youtube = $_POST["youtube"];
        $firma_adi = $_POST["firma_adi"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $keywords = $_POST["keywords"];
        $map = $_POST["map"];
        $smtp_host = $_POST["smtp_host"];
        $smtp_authentication = $_POST["smtp_authentication"];
        $smtp_password = $_POST["smtp_password"];
        $smtp_port = $_POST["smtp_port"];
        $smtp_secure = $_POST["smtp_secure"];
        $smtp_username = $_POST["smtp_username"];
        $hakkinda_kisa = $_POST["hakkinda_kisa"];
        $varsayilan_dil_adi = $_POST["varsayilan_dil_adi"];
        $slayt_gecis_suresi = $_POST["slayt_gecis_suresi"];


        $update_dil = $this->dbh->prepare("UPDATE language SET aktif = 0 where anadil = 0");
        $update_dil->execute();


        $site_dilleri = explode(',',$_POST["site_dilleri"]);

        foreach ($site_dilleri as $site_dili)
        {
            $update_dil = $this->dbh->prepare("UPDATE language SET aktif = 1 WHERE name = ?");
            $update_dil->bindParam(1, $site_dili);
            $update_dil->execute();
        }


        $update_varsayilan_dil = $this->dbh->prepare("UPDATE language SET anadil = 1 WHERE name = ?");
        $update_varsayilan_dil->bindParam(1, $varsayilan_dil_adi);
        $update_varsayilan_dil->execute();




        $ga_email = $_POST["ga_email"];
        $ga_profile_id = $_POST["ga_profile_id"];

        $ziyaretci_mesajlari_epostama_gelsin = $_POST["ziyaretci_mesajlari_epostama_gelsin"]?1:0;
        $ziyaretci_telefonlari_epostama_gelsin = $_POST["ziyaretci_telefonlari_epostama_gelsin"]?1:0;


        if($_FILES[self::$logo_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/logo/'.$settings[0]["logo_yolu"]);
            $logo = $this->myFunctions->ResimYukle(self::$logo_foto_input_name,self::$logo_foto_x,self::$logo_foto_y,"logo",self::$logo_foto_resize,self::$logo_foto_ratio_crop);
        }else{
            $logo = $settings[0]["logo_yolu"];
        }

        $url = $_POST["url"];
        $mesai = $_POST["mesai"];
        $fax = $_POST["fax"];

        if($_FILES[self::$background_image_input_name]["error"] == 0) {
            unlink('../uploads/images/background/'.$settings[0]["arkaplan_yolu"]);
            $arkaplan_yolu = $this->myFunctions->ResimYukle(self::$background_image_input_name,self::$background_image_x,self::$background_image_y,"background",self::$background_image_resize,self::$background_image_ratio_crop);
        }else{
            $arkaplan_yolu = $settings[0]["arkaplan_yolu"];
        }

        if($_FILES[self::$footer_logo_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/logo/'.$settings[0]["footer_logo"]);
            $footer_logo = $this->myFunctions->ResimYukle(self::$footer_logo_foto_input_name,self::$footer_logo_foto_x,self::$footer_logo_foto_y,"logo",self::$footer_logo_foto_resize,self::$footer_logo_foto_ratio_crop);
        }else{
            $footer_logo = $settings[0]["footer_logo"];
        }


        $ga_p12_key_yolu = $settings[0]["ga_p12_key_yolu"];
        if($_FILES["ga_p12_key_yolu"]["error"] == 0) {
            unlink('../uploads/analystics/'.$settings[0]["ga_p12_key_yolu"]);

            if( isset($_FILES['ga_p12_key_yolu']) ){
                if( $_FILES['ga_p12_key_yolu']['error'] ){
                    echo 'Bir hata olustu ve dosyaniz alinamadi.';
                }else{
                    copy($_FILES['ga_p12_key_yolu']['tmp_name'],'../uploads/analystics/'.$_FILES['ga_p12_key_yolu']['name']);
                    $ga_p12_key_yolu = $_FILES['ga_p12_key_yolu']['name'];
                }
            }

        }


        if($_POST["google_analystic_aktif"] == 'on'){
            $google_analystic_aktif = 1;
        }else
        {
            $google_analystic_aktif = 0;
        }

        if($_POST["coklu_dil_destegi_aktif"] == 'on'){
            $coklu_dil_destegi_aktif = 1;
        }else
        {
            $coklu_dil_destegi_aktif = 0;
        }


        $insert = $this->dbh->prepare("UPDATE ayarlar SET
        adres = ?,
        telefon1 = ?,
        telefon2 = ?,
        eposta = ?,
        facebook = ?,
        twitter = ?,
        instagram = ?,
        gplus = ?,
        firma_adi = ?,
        title = ?,
        description = ?,
        keywords = ?,
        map = ?,
        smtp_host = ?,
        smtp_username = ?,
        smtp_password = ?,
        smtp_authentication = ?,
        smtp_secure = ?,
        smtp_port = ?,
        logo_yolu = ?,
        url = ?,
        mesai = ?,
        fax = ?,
        arkaplan_yolu = ?,
        hakkinda_kisa = ?,
        footer_logo = ?,
        ziyaretci_mesajlari_epostama_gelsin = ?,
        ziyaretci_telefonlari_epostama_gelsin = ?,
        ga_email = ?,
        ga_profile_id = ?,
        ga_p12_key_yolu = ?,
        google_analystic_aktif = ?,
        varsayilan_dil = ?,
        coklu_dil_destegi_aktif = ?,
        youtube = ?,
        slayt_gecis_suresi = ?
        where id= 1");

        if($smtp_authentication == "on"){
            $smtp_authentication = 1;
        }else
        {
            $smtp_authentication = 0;
        }

        $insert->bindParam(1,$adres);
        $insert->bindParam(2,$telefon1);
        $insert->bindParam(3,$telefon2);
        $insert->bindParam(4,$eposta);
        $insert->bindParam(5,$facebook);
        $insert->bindParam(6,$twitter);
        $insert->bindParam(7,$instagram);
        $insert->bindParam(8,$gplus);
        $insert->bindParam(9,$firma_adi);
        $insert->bindParam(10,$title);
        $insert->bindParam(11,$description);
        $insert->bindParam(12,$keywords);
        $insert->bindParam(13,$map);
        $insert->bindParam(14,$smtp_host);
        $insert->bindParam(15,$smtp_username);
        $insert->bindParam(16,$smtp_password);
        $insert->bindParam(17,$smtp_authentication);
        $insert->bindParam(18,$smtp_secure);
        $insert->bindParam(19,$smtp_port);
        $insert->bindParam(20,$logo);
        $insert->bindParam(21,$url);
        $insert->bindParam(22,$mesai);
        $insert->bindParam(23,$fax);
        $insert->bindParam(24,$arkaplan_yolu);
        $insert->bindParam(25,$hakkinda_kisa);
        $insert->bindParam(26,$footer_logo);
        $insert->bindParam(27,$ziyaretci_mesajlari_epostama_gelsin);
        $insert->bindParam(28,$ziyaretci_telefonlari_epostama_gelsin);
        $insert->bindParam(29,$ga_email);
        $insert->bindParam(30,$ga_profile_id);
        $insert->bindParam(31,$ga_p12_key_yolu);
        $insert->bindParam(32,$google_analystic_aktif);
        $insert->bindParam(33,$varsayilan_dil_adi);
        $insert->bindParam(34,$coklu_dil_destegi_aktif);
        $insert->bindParam(35,$youtube);
        $insert->bindParam(36,$slayt_gecis_suresi);
        $insert->execute();

        $this->Audit("Update", 12, 0, "site ayarlarını");
    }
    public function SlaytEkle(){

        $yazi = $_POST['yazi'];
        $aciklama = $_POST['aciklama'];
        $icerik = $_POST['icerik'];
        $sira = $_POST['sira'];
        $seo = $this->myFunctions->turkce_karakter_temizle($yazi);
        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $resim = $this->myFunctions->ResimYukle(self::$slayt_foto_input_name,self::$slayt_foto_x,self::$slayt_foto_y,self::$slayt_foto_tablename,self::$slayt_foto_resize,self::$slayt_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$slayt_foto_input_name,self::$slayt_foto_thumbnail_x,self::$slayt_foto_thumbnail_y,self::$slayt_foto_tablename,self::$slayt_foto_resize,self::$slayt_foto_ratio_crop);

        $insert = $this->dbh->prepare("INSERT INTO slayt SET sira = ?, yazi = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, aktif = ?, aciklama = ?, icerik = ?, seo = ?");
		$insert->bindParam(1,$sira);
        $insert->bindParam(2,$yazi);
        $insert->bindParam(3,$resim);
        $insert->bindParam(4,$resim_thumbnail);
        $insert->bindParam(5,$chcGorunurluk);
        $insert->bindParam(6,$aciklama);
        $insert->bindParam(7,$icerik);
        $insert->bindParam(8,$seo);

        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert", 3, $id, $yazi." başlıklı slaytı");
			return $id;
		}else{
			return 0;
		}
    }
    public function SlaytGuncelle(){

        $id = $_POST['slayt_id'];
        $yazi = $_POST['yazi'];
        $aciklama = $_POST['aciklama'];
        $icerik = $_POST['icerik'];
        $sira = $_POST['sira'];
        $seo = $this->myFunctions->turkce_karakter_temizle($yazi);
        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        $params = array();
        array_push($params, $id);
        $foto = $this->select("select *from ".self::$slayt_foto_tablename." where id = ?", $params);

        if($_FILES[self::$slayt_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$slayt_foto_tablename.'/'.$foto[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$slayt_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
            $resim = $this->myFunctions->ResimYukle(self::$slayt_foto_input_name,self::$slayt_foto_x,self::$slayt_foto_y,self::$slayt_foto_tablename,self::$slayt_foto_resize,self::$slayt_foto_ratio_crop);
            $resim_thumbnail = $this->myFunctions->ResimYukle(self::$slayt_foto_input_name,self::$slayt_foto_thumbnail_x,self::$slayt_foto_thumbnail_y,self::$slayt_foto_tablename,self::$slayt_foto_resize,self::$slayt_foto_ratio_crop);
        }else
        {
            $resim = $foto[0]["resim_yolu"];
            $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        }

        $insert = $this->dbh->prepare("UPDATE slayt SET sira = ?, yazi = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, aktif = ?, aciklama = ?, icerik = ?, seo = ? WHERE id = ?");
        $insert->bindParam(1,$sira);
        $insert->bindParam(2,$yazi);
        $insert->bindParam(3,$resim);
        $insert->bindParam(4,$resim_thumbnail);
        $insert->bindParam(5,$chcGorunurluk);
        $insert->bindParam(6,$aciklama);
        $insert->bindParam(7,$icerik);
        $insert->bindParam(8,$seo);
        $insert->bindParam(9,$id);

        $insert->execute();
        if ($insert->rowCount() == 1) {
            $this->Audit("Update",3,$id, $yazi." başlıklı slaytı");
            return $id;
        }else{
            return 0;
        }
    }
    public function SayfaEkle(){

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        $icerik= $_POST['icerik'];
        $modul_id = $_POST['modul_id'];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $resim = $this->myFunctions->ResimYukle(self::$sayfa_foto_input_name,self::$sayfa_foto_x,self::$sayfa_foto_y,self::$sayfa_foto_tablename,self::$sayfa_foto_resize,self::$sayfa_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$sayfa_foto_input_name,self::$sayfa_foto_thumbnail_x,self::$sayfa_foto_thumbnail_y,self::$sayfa_foto_tablename,self::$sayfa_foto_resize,self::$sayfa_foto_ratio_crop);

        $insert = $this->dbh->prepare("INSERT INTO sayfa SET sira = ?, ad = ?, icerik = ?, modul_id = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, seo = ?, aktif = ?");
		$insert->bindParam(1,$sira);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$icerik);
        $insert->bindParam(4,$modul_id);
        $insert->bindParam(5,$resim);
        $insert->bindParam(6,$resim_thumbnail);
        $insert->bindParam(7,$seo);
        $insert->bindParam(8,$chcGorunurluk);

        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",2,$id,$ad." isimli sayfayı");
			return $id;
		}else{
			return 0;
		}
    }
    public function SayfaGuncelle(){

        $id = $_POST["sayfa_id"];
        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        $icerik= $_POST['icerik'];
        $modul_id = $_POST['modul_id'];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $params = array();
        array_push($params, $id);
        $foto = $this->select("select *from ".self::$sayfa_foto_tablename." where id = ?", $params);

        if($_FILES[self::$sayfa_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$sayfa_foto_tablename.'/'.$foto[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$sayfa_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
            $resim = $this->myFunctions->ResimYukle(self::$sayfa_foto_input_name,self::$sayfa_foto_x,self::$sayfa_foto_y,self::$sayfa_foto_tablename,self::$sayfa_foto_resize,self::$sayfa_foto_ratio_crop);
            $resim_thumbnail = $this->myFunctions->ResimYukle(self::$sayfa_foto_input_name,self::$sayfa_foto_thumbnail_x,self::$sayfa_foto_thumbnail_y,self::$sayfa_foto_tablename,self::$sayfa_foto_resize,self::$sayfa_foto_ratio_crop);
        }else
        {
            $resim = $foto[0]["resim_yolu"];
            $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        }

        $insert = $this->dbh->prepare("UPDATE sayfa SET sira = ?, ad = ?, icerik = ?, modul_id = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, seo = ?, aktif = ?  WHERE id = ?");
		$insert->bindParam(1,$sira);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$icerik);
        $insert->bindParam(4,$modul_id);
        $insert->bindParam(5,$resim);
        $insert->bindParam(6,$resim_thumbnail);
        $insert->bindParam(7,$seo);
        $insert->bindParam(8,$chcGorunurluk);
        $insert->bindParam(9,$id);

        $insert->execute();
        if ($insert->rowCount() == 1) {
            $this->Audit("Update",2,$id,$ad." isimli sayfayı");
            return $id;
        }else{
            return 0;
        }
    }
    public function SayfaActiveStateChange($id){

        $params = array();
        array_push($params, $id);
        $select = $this->select("select *from sayfa where id = ?" ,$params);

        $gelen = $_POST["durum"];

        if($gelen == "true"){ $durum = 1; }else{ $durum = 0; }
        if($gelen == "true"){ $aktifPasif = "aktif"; }else{ $aktifPasif = "pasif"; }
        $update = $this->dbh->prepare("UPDATE sayfa SET aktif = ? where id = ?");
        $update->bindParam(1, $durum);
        $update->bindParam(2, $id);
        $this->Audit("Update",2,$id,$select[0]["ad"]." isimli sayfanın görünürlük durumunu ".$aktifPasif." olarak");
        return $update->execute();
    }
    public function FotoEkle(){

        $resim = $this->myFunctions->ResimYukle(self::$fotogaleri_foto_input_name,self::$fotogaleri_foto_x,self::$fotogaleri_foto_y,self::$fotogaleri_foto_tablename,self::$fotogaleri_foto_resize,self::$fotogaleri_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$fotogaleri_foto_input_name,self::$fotogaleri_foto_thumbnail_x,self::$fotogaleri_foto_thumbnail_y,self::$fotogaleri_foto_tablename,self::$fotogaleri_foto_resize,self::$fotogaleri_foto_ratio_crop);

        $yazi = $_POST['yazi'];
        $sira = $_POST['sira'];
        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $seo = $this->myFunctions->turkce_karakter_temizle($yazi);

        $insert = $this->dbh->prepare("INSERT INTO fotogaleri SET sira = ?, yazi = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, aktif = ?, seo = ?");
		$insert->bindParam(1,$sira);
        $insert->bindParam(2,$yazi);
        $insert->bindParam(3,$resim);
        $insert->bindParam(4,$resim_thumbnail);
        $insert->bindParam(5,$chcGorunurluk);
        $insert->bindParam(6,$seo);

		if ($insert->execute()) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",4,$id,"fotoğraf");
            $this->SessiondakiResimleriAta($id, self::$fotogaleri_foto_tablename);
			return $id;
		}else{
			return 0;
		}
    }
    public function FotoGuncelle(){

        $id = $_POST['foto_id'];
        $yazi = $_POST['yazi'];
        $sira = $_POST['sira'];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }
        $seo = $this->myFunctions->turkce_karakter_temizle($yazi);

        $params = array();
        array_push($params, $id);
        $foto = $this->select("select *from ".self::$fotogaleri_foto_tablename." where id = ?", $params);

        if($_FILES[self::$fotogaleri_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$fotogaleri_foto_tablename.'/'.$foto[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$fotogaleri_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
            $resim = $this->myFunctions->ResimYukle(self::$fotogaleri_foto_input_name,self::$fotogaleri_foto_x,self::$fotogaleri_foto_y,self::$fotogaleri_foto_tablename,self::$fotogaleri_foto_resize,self::$fotogaleri_foto_ratio_crop);
            $resim_thumbnail = $this->myFunctions->ResimYukle(self::$fotogaleri_foto_input_name,self::$fotogaleri_foto_thumbnail_x,self::$fotogaleri_foto_thumbnail_y,self::$fotogaleri_foto_tablename,self::$fotogaleri_foto_resize,self::$fotogaleri_foto_ratio_crop);
        }else
        {
            $resim = $foto[0]["resim_yolu"];
            $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        }

        $update = $this->dbh->prepare("UPDATE fotogaleri SET sira = ?, yazi = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, aktif = ?, seo = ? WHERE id = ?");
        $update->bindParam(1,$sira);
        $update->bindParam(2,$yazi);
        $update->bindParam(3,$resim);
        $update->bindParam(4,$resim_thumbnail);
        $update->bindParam(5,$chcGorunurluk);
        $update->bindParam(6,$seo);
        $update->bindParam(7,$id);

        if ($update->execute()) {
            $this->Audit("Update",4,$id,"fotoğrafı");
            $this->SessiondakiResimleriAta($id, self::$fotogaleri_foto_tablename);
            return $id;
        }else{
            return 0;
        }
    }
    public function FotoActiveStateChange($id){
        $gelen = $_POST["durum"];
        if($gelen == "true"){ $aktifPasif = "aktif"; }else{ $aktifPasif = "pasif"; }
        if($gelen == "true"){ $durum = 1; }else{ $durum = 0; }
        $update = $this->dbh->prepare("UPDATE fotogaleri SET aktif = ? where id = ?");
        $update->bindParam(1, $durum);
        $update->bindParam(2, $id);
        $this->Audit("Update",4,$id,"fotoğrafın görünürlük durumunu ".$aktifPasif." olarak");
        return $update->execute();
    }
    public function HaberEkle(){

        $resim = $this->myFunctions->ResimYukle(self::$haber_foto_input_name,self::$haber_kapak_foto_x,self::$haber_kapak_foto_y,self::$haber_foto_tablename,self::$haber_foto_resize,self::$haber_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$haber_foto_input_name,self::$haber_kapak_foto_thumbnail_x,self::$haber_kapak_foto_thumbnail_y,self::$haber_foto_tablename,self::$haber_foto_resize,self::$haber_foto_ratio_crop);

        $tarih = $_POST['tarih'];
        $ad = $_POST['ad'];
        $icerik= $_POST['icerik'];
        $cboHaberKategori = $_POST["cboHaberKategori"];
        $etiket = $_POST["etiket"];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $insert = $this->dbh->prepare("INSERT INTO haber SET tarih = ?, ad = ?, icerik = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, seo = ?, aktif = ?, kategori_id = ?, etiket = ?");
		$insert->bindParam(1,$tarih);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$icerik);
        $insert->bindParam(4,$resim);
        $insert->bindParam(5,$resim_thumbnail);
        $insert->bindParam(6,$seo);
        $insert->bindParam(7,$chcGorunurluk);
        $insert->bindParam(8,$cboHaberKategori);
        $insert->bindParam(9,$etiket);
        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",5,$id,$ad." başlıklı haberi");

            $this->SessiondakiResimleriAta($id, self::$haber_foto_tablename);

			return $id;
		}else{
			return 0;
		}
    }
    public function HaberGuncelle(){

        $id = $_POST["haber_id"];
        $tarih = $_POST['tarih'];
        $ad = $_POST['ad'];
        $icerik= $_POST['icerik'];
        $cboHaberKategori = $_POST["cboHaberKategori"];
        $etiket = $_POST["etiket"];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $params = array();
        array_push($params, $id);
        $foto = $this->select("select *from ".self::$haber_foto_tablename." where id = ?", $params);

        if($_FILES[self::$haber_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$haber_foto_tablename.'/'.$foto[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$haber_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
            $resim = $this->myFunctions->ResimYukle(self::$haber_foto_input_name,self::$haber_kapak_foto_x,self::$haber_kapak_foto_y,self::$haber_foto_tablename,self::$haber_foto_resize,self::$haber_foto_ratio_crop);
            $resim_thumbnail = $this->myFunctions->ResimYukle(self::$haber_foto_input_name,self::$haber_kapak_foto_thumbnail_x,self::$haber_kapak_foto_thumbnail_y,self::$haber_foto_tablename,self::$haber_foto_resize,self::$haber_foto_ratio_crop);
        }else
        {
            $resim = $foto[0]["resim_yolu"];
            $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        }


        $update = $this->dbh->prepare("UPDATE haber SET tarih = ?, ad = ?, icerik = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, seo = ?, aktif = ?, kategori_id = ?, etiket = ?  WHERE id = ?");
        $update->bindParam(1,$tarih);
        $update->bindParam(2,$ad);
        $update->bindParam(3,$icerik);
        $update->bindParam(4,$resim);
        $update->bindParam(5,$resim_thumbnail);
        $update->bindParam(6,$seo);
        $update->bindParam(7,$chcGorunurluk);
        $update->bindParam(8,$cboHaberKategori);
        $update->bindParam(9,$etiket);
        $update->bindParam(10,$id);

        if ($update->execute()) {
            $this->Audit("Update",5,$id,$ad." başlıklı haberi");
            $this->SessiondakiResimleriAta($id, self::$haber_foto_tablename);
            return $id;
        }else{
            return $update->errorCode();
        }
    }
    public function HaberKategoriEkle(){
        $sira = $_POST["sira"];
        $kategori_adi = $_POST["adi"];
        $aktif = $_POST["aktif"];
        if($aktif == "true"){ $aktif = 1; } else { $aktif = 0; }

        $seo = strtolower($this->myFunctions->turkce_karakter_temizle($kategori_adi));

        $insert = $this->dbh->prepare("INSERT INTO haber_kategori SET sira = ?, ad = ?, aktif = ?, seo = ?");
        $insert->bindParam(1,$sira);
        $insert->bindParam(2,$kategori_adi);
        $insert->bindParam(3,$aktif);
        $insert->bindParam(4,$seo);

        if($insert->execute()){
            return $this->dbh->lastInsertId();
        }else{
            return false;
        }
    }
    public function HaberKategoriGuncelle(){

        $sira = $_POST["sira"];
        $kategori_adi = $_POST["adi"];
        $aktif = $_POST["aktif"];
        if($aktif == "true"){ $aktif = 1; } else { $aktif = 0; }
        $kategori_id = $_POST["kategori_id"];

        $seo = strtolower($this->myFunctions->turkce_karakter_temizle($kategori_adi));

        $update = $this->dbh->prepare("UPDATE haber_kategori SET sira = ?, ad = ?, aktif = ?, seo = ? WHERE id = ?");
        $update->bindParam(1, $sira);
        $update->bindParam(2, $kategori_adi);
        $update->bindParam(3, $aktif);
        $update->bindParam(4, $seo);
        $update->bindParam(5, $kategori_id);

        return $update->execute();

    }


    public function ReferansEkle(){

        $ad = $_POST['ad'];
        $cboHaberKategori = $_POST["cboReferansKategori"];

        $insert = $this->dbh->prepare("INSERT INTO referans SET ad = ?, kategori_id = ?");
		$insert->bindParam(1,$ad);
        $insert->bindParam(2,$cboHaberKategori);

        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",5,$id,$ad." isimli referansı ");
			return $id;
		}else{
			return 0;
		}
    }
    public function ReferansGuncelle(){

        $id = $_POST["referans_id"];
        $ad = $_POST['ad'];
        $cboHaberKategori = $_POST["cboReferansKategori"];

        $update = $this->dbh->prepare("UPDATE referans SET ad = ?, kategori_id = ? WHERE id = ?");
        $update->bindParam(1,$ad);
        $update->bindParam(2,$cboHaberKategori);
        $update->bindParam(3,$id);

        if ($update->execute()) {
            $this->Audit("Update",5,$id,$ad." isimli referansı");
            return $id;
        }else{
            return $update->errorCode();
        }
    }



    public function SubeEkle(){

        $ad = $_POST['ad'];
        $adres = $_POST['adres'];
        $telefon = $_POST['telefon'];
        $eposta = $_POST['eposta'];


        $resim="";
        $upload = new upload($_FILES["resim_yolu"]);
        if ($upload->uploaded){
            $upload->image_resize         = true;
            $upload->image_x              = 255;
            $upload->image_y              = 128;
            $upload->file_auto_rename = true;
            $upload->process('../uploads/images/sube');
            if ($upload->processed){
                $resim = $upload->file_dst_name;
            }
        }


        $insert = $this->dbh->prepare("INSERT INTO sube SET ad = ?, adres = ?, telefon = ?, eposta = ?, resim_yolu = ?");
        $insert->bindParam(1,$ad);
        $insert->bindParam(2,$adres);
        $insert->bindParam(3,$telefon);
        $insert->bindParam(4,$eposta);
        $insert->bindParam(5,$resim);

        if ($insert->execute()) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",5,$id,$ad." isimli referansı ");
            return $id;
        }else{
            return 0;
        }
    }
    public function SubeGuncelle(){

        $id = $_POST["sube_id"];
        $ad = $_POST['ad'];
        $adres = $_POST['adres'];
        $telefon = $_POST['telefon'];
        $eposta = $_POST['eposta'];

        $params = array();
        $ofis = $this->select("select *from sube where id = ?", $params);

        if($_FILES['resim_yolu']["error"] == 0) {

            $resim="";
            $upload = new upload($_FILES["resim_yolu"]);
            if ($upload->uploaded){
                $upload->image_resize         = true;
                $upload->image_x              = 255;

                $upload->file_auto_rename = true;
                $upload->process('../uploads/images/sube');
                if ($upload->processed){

                    $resim = $upload->file_dst_name;

                    unlink("../uploads/images/sube/".$ofis[0]["resim_yolu"]);
                }
            }

        }else
        {
            $resim = $ofis[0]["resim_yolu"];
        }


        $update = $this->dbh->prepare("UPDATE sube SET ad = ?, adres = ?, telefon = ?, eposta = ?, resim_yolu = ? where id = ?");
		$update->bindParam(1,$ad);
        $update->bindParam(2,$adres);
        $update->bindParam(3,$telefon);
        $update->bindParam(4,$eposta);
        $update->bindParam(5,$resim);
        $update->bindParam(6,$id);

        if ($update->execute()) {
            $this->Audit("Update",5,$id,$ad." isimli referansı");
            return $id;
        }else{
            return $update->errorCode();
        }
    }








    public function VideoEkle(){

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        $chcGorunurluk = $_POST['chcGorunurluk'];
        $url = $_POST['url'];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $insert = $this->dbh->prepare("INSERT INTO video SET sira = ?, ad = ?, url = ?, aktif = ?");
        $insert->bindParam(1,$sira);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$url);
        $insert->bindParam(4,$chcGorunurluk);


        if ($insert->execute()) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",5,$id,$ad." baslikli video ");
            return $id;
        }else{
            return 0;
        }
    }
    public function VideoGuncelle(){

        $id = $_POST['video_id'];
        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        $chcGorunurluk = $_POST['chcGorunurluk'];
        $url = $_POST['url'];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }

        $update = $this->dbh->prepare("UPDATE video SET sira = ?, ad = ?, url = ?, aktif = ? WHERE id = ?");
		$update->bindParam(1,$sira);
        $update->bindParam(2,$ad);
        $update->bindParam(3,$url);
        $update->bindParam(4,$chcGorunurluk);
        $update->bindParam(5,$id);

        if ($update->execute()) {
            $this->Audit("Update",5,$id,$ad." isimli video");
            return $id;
        }else{
            return $update->errorCode();
        }
    }

    public function VideoActiveStateChange($id){
        $gelen = $_POST["durum"];
        if($gelen == "true"){ $aktifPasif = "aktif"; }else{ $aktifPasif = "pasif"; }
        if($gelen == "true"){ $durum = 1; }else{ $durum = 0; }
        $update = $this->dbh->prepare("UPDATE video SET aktif = ? where id = ?");
        $update->bindParam(1, $durum);
        $update->bindParam(2, $id);
        $this->Audit("Update",4,$id,"videonun görünürlük durumunu ".$aktifPasif." olarak");
        return $update->execute();
    }








    public function ReferansKategoriEkle(){
        $sira = $_POST['sira'];
        $ad = $_POST['adi'];
        $seo = strtolower($this->myFunctions->turkce_karakter_temizle($ad));

        $insert = $this->dbh->prepare("INSERT INTO referans_kategori SET sira = ?, ad = ?, seo = ?");
        $insert->bindParam(1,$sira);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$seo);

        if($insert->execute()){
            return $this->dbh->lastInsertId();
        }else{
            return false;
        }
    }
    public function ReferansKategoriGuncelle(){

        $id = $_POST["kategori_id"];
        $sira = $_POST['sira'];
        $ad = $_POST['adi'];
        $seo = strtolower($this->myFunctions->turkce_karakter_temizle($ad));

        $update = $this->dbh->prepare("UPDATE referans_kategori SET sira = ?, ad = ?, seo = ? WHERE id = ?");
        $update->bindParam(1, $sira);
        $update->bindParam(2, $ad);
        $update->bindParam(3, $seo);
        $update->bindParam(4, $id);

        return $update->execute();

    }



    public function ModulEkle(){

        $id = $_POST['modul_id'];

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];

        $widget = 0;
        if($_POST['chcWidget1'] == "on"){
            $widget = 1;
        }

        $aktif = 0;
        if($_POST['chcGorunurluk1'] == "on"){
            $aktif = 1;
        }

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $insert = $this->dbh->prepare("INSERT INTO modul SET sira = ?, ad = ?, anasayfada_goster = ?, aktif = ?, seo = ?");
		$insert->bindParam(1,$sira);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$widget);
        $insert->bindParam(4,$aktif);
        $insert->bindParam(5,$seo);

        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",1,$id, $ad." isimli modülü");
			return $id;
		}else{
			return 0;
		}
    }
    public function ModulGuncelle(){

        $id = $_POST['modul_id'];

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];

        $widget = 0;
        if($_POST['chcWidget1'] == "on"){
            $widget = 1;
        }

        $aktif = 0;
        if($_POST['chcGorunurluk1'] == "on"){
            $aktif = 1;
        }

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $insert = $this->dbh->prepare("UPDATE modul SET sira = ?, ad = ?, anasayfada_goster = ?, aktif = ?, seo = ? WHERE id = ?");
		$insert->bindParam(1,$sira);
        $insert->bindParam(2,$ad);
        $insert->bindParam(3,$widget);
        $insert->bindParam(4,$aktif);
        $insert->bindParam(5,$seo);
        $insert->bindParam(6,$id);

        $insert->execute();
		if ($insert->rowCount() > 0) {
            $this->Audit("Update",1,$id,$ad." isimli modülü");
			return $id;
		}else{
			return 0;
		}
    }
    public function ModulActiveStateChange($id){
        $gelen = $_POST["durum"];

        $params = array();
        array_push($params, $id);
        $select = $this->select("select *from modul where id = ?" ,$params);
        if($gelen == "true"){ $aktifPasif = "aktif"; }else{ $aktifPasif = "pasif"; }
        if($gelen == "true"){ $durum = 1; }else{ $durum = 0; }
        $update = $this->dbh->prepare("UPDATE modul SET aktif = ? where id = ?");
        $update->bindParam(1, $durum);
        $update->bindParam(2, $id);
        $this->Audit("Update",2,$id,$select[0]["ad"]." isimli modülün görünürlük durumunu ".$aktifPasif." olarak");
        return $update->execute();
    }
    public function ModulWidgetStateChange($id){
        $gelen = $_POST["durum"];
        $params = array();
        array_push($params, $id);
        $select = $this->select("select *from modul where id = ?" ,$params);
        if($gelen == "true"){ $aktifPasif = "aktif"; }else{ $aktifPasif = "pasif"; }
        if($gelen == "true"){ $durum = 1; }else{ $durum = 0; }
        $update = $this->dbh->prepare("UPDATE modul SET anasayfada_goster = ? where id = ?");
        $update->bindParam(1, $durum);
        $update->bindParam(2, $id);
        $this->Audit("Update",2,$id,$select[0]["ad"]." isimli modülün görünürlük durumunu ".$aktifPasif." olarak");
        return $update->execute();
    }
    public function KullaniciEkle(){

        $ad_soyad = $_POST['ad_soyad'];
        $kullanici_adi = $_POST['kullanici_adi'];
        $cboKullaniciGrubu = $_POST['cboKullaniciGrubu'];
        $eposta = $_POST['eposta'];
        $parola = $_POST['parola'];
        $aktif = $_POST['aktif'] == "on"?1:0;
        $parola2 =  md5(crc32($parola));
        $guid = $this->getGUID();

        $insert = $this->dbh->prepare("INSERT INTO users SET ad_soyad = ?, eposta = ?, username = ?, password = ?, aktif = ?, guid = ?, u_users_group_id = ?");
		$insert->bindParam(1,$ad_soyad);
        $insert->bindParam(2,$eposta);
        $insert->bindParam(3,$kullanici_adi);
        $insert->bindParam(4,$parola2);
        $insert->bindParam(5,$aktif);
        $insert->bindParam(6,$guid);
        $insert->bindParam(7,$cboKullaniciGrubu);

        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",11,$id,$kullanici_adi." isimli kullanıcıyı");
			return $id;
		}else{
			return 0;
		}
    }
    public function KullaniciGuncelle(){

        $id = $_POST["id"];
        $params = array();
        array_push($params, $id);
        $users = $this->select("select *from users where id = ?", $params);

        $ad_soyad = $_POST['ad_soyad'];
        $kullanici_adi = $_POST['kullanici_adi'];
        $cboKullaniciGrubu = $_POST['cboKullaniciGrubu'];
        $eposta = $_POST['eposta'];
        $parola = $_POST['parola'];
        $aktif = $_POST['aktif'] == "on"?1:0;
        $panel_dili = $_POST["panel_dili"];


        if(empty($cboKullaniciGrubu)){
            $cboKullaniciGrubu = $users[0]["u_users_group_id"];
        }

        if($parola == $users[0]["password"] || empty($parola)){
            $parola2 = $users[0]["password"];
        }else
        {
            $parola2 =  md5(crc32($parola));
        }

        $insert = $this->dbh->prepare("UPDATE users SET ad_soyad = ?, username = ?, eposta = ?, password = ?, aktif = ?, u_users_group_id = ?, panel_dili = ?  WHERE id = ?");
        $insert->bindParam(1,$ad_soyad);
        $insert->bindParam(2,$kullanici_adi);
        $insert->bindParam(3,$eposta);
        $insert->bindParam(4,$parola2);
        $insert->bindParam(5,$aktif);
        $insert->bindParam(6,$cboKullaniciGrubu);
        $insert->bindParam(7,$panel_dili);
        $insert->bindParam(8,$id);

        $insert->execute();
        if ($insert->rowCount() == 1) {
            $_SESSION['username'] = $kullanici_adi;
            $_SESSION['ad_soyad'] = $ad_soyad;
            $_SESSION['eposta'] = $eposta;
            $_SESSION['panel_dil_id'] = $panel_dili;

            $this->Audit("Update",11,$id,$kullanici_adi." isimli kullanıcıyı");
            return $id;
        }else{
            return 0;
        }
    }
    public function KullaniciProfilResmiYukle(){

        $id = $_POST["id"];
        $params = array();
        array_push($params, $id);
        $users = $this->select("select *from users where id = ?", $params);

        $resim="";
        $upload = new upload($_FILES["resim_yolu"]);
        if ($upload->uploaded){
            $upload->upload_max_filesize = 4000;
            $upload->post_max_size = 4000;
            $upload->file_auto_rename = true;
            $upload->process('../uploads/images/profile');
            if ($upload->processed){
                $resim = $upload->file_dst_name;
                unlink("../uploads/images/profile/".$users[0]["resim_yolu"]);
            }
        }



        $insert = $this->dbh->prepare("UPDATE users SET resim_yolu = ? WHERE id = ?");
        $insert->bindParam(1,$resim);
        $insert->bindParam(2,$id);

        $insert->execute();
        if ($insert->rowCount() == 1) {
            $this->Audit("Update",11,$id," profil resmi");
            return $resim;
        }else{
            return 0;
        }
    }
    public function KullaniciProfilResmiSil(){
        $id = $_POST["id"];
        $params = array();
        array_push($params, $id);
        $users = $this->select("select *from users where id = ?", $params);

        unlink("../uploads/images/profile/".$users[0]["resim_yolu"]);
        $resim="";
        $insert = $this->dbh->prepare("UPDATE users SET resim_yolu = ? WHERE id = ?");
        $insert->bindParam(1,$resim);
        $insert->bindParam(2,$id);
        $insert->execute();

        if ($insert->rowCount() == 1) {
            $this->Audit("Update",11,$id," profil resmini sildiniz");
            return $id;
        }else{
            return 0;
        }
    }

    public function ProjeKategoriEkle(){
        $sira = $_POST["sira"];
        $kategori_adi = $_POST["adi"];
        $aktif = $_POST["aktif"];
        if($aktif == "on"){ $aktif = 1; } else { $aktif = 0; }

        $seo = strtolower($this->myFunctions->turkce_karakter_temizle($kategori_adi));

        $insert = $this->dbh->prepare("INSERT INTO proje_kategori SET sira = ?, ad = ?, aktif = ?, seo = ?");
        $insert->bindParam(1,$sira);
        $insert->bindParam(2,$kategori_adi);
        $insert->bindParam(3,$aktif);
        $insert->bindParam(4,$seo);

        if($insert->execute()){
            return $this->dbh->lastInsertId();
        }else{
            return false;
        }
    }
    public function ProjeKategoriGuncelle(){

        $sira = $_POST["sira"];
        $kategori_adi = $_POST["adi"];
        $aktif = $_POST["aktif"];
        if($aktif == "true"){ $aktif = 1; } else { $aktif = 0; }
        $kategori_id = $_POST["kategori_id"];

        $seo = strtolower($this->myFunctions->turkce_karakter_temizle($kategori_adi));

        $update = $this->dbh->prepare("UPDATE proje_kategori SET sira = ?, ad = ?, aktif = ?, seo = ? WHERE id = ?");
        $update->bindParam(1, $sira);
        $update->bindParam(2, $kategori_adi);
        $update->bindParam(3, $aktif);
        $update->bindParam(4, $seo);
        $update->bindParam(5, $kategori_id);

        return $update->execute();

    }

    public function ProjeEkle(){

        $sira = $_POST["sira"];
        $proje_adi = $_POST["proje_adi"];
        $kategori_id = $_POST["kategori_id"];
        $icerik = $_POST["icerik"];
        $aktif = $_POST["aktif"];
        if($aktif == "on"){ $aktif = 1; } else { $aktif = 0; }
        $seo = $this->myFunctions->turkce_karakter_temizle($proje_adi);

        $baslangic_t = $_POST["baslangic_t"];
        $bitis_t = $_POST["bitis_t"];



        $kapak_buyuk = $this->myFunctions->ResimYukle(self::$proje_foto_input_name,self::$proje_foto_x,self::$proje_foto_y,self::$proje_foto_tablename,self::$proje_foto_resize,self::$proje_foto_ratio_crop);
        $kapak_kucuk = $this->myFunctions->ResimYukle(self::$proje_foto_input_name,self::$proje_foto_thumbnail_x,self::$proje_foto_thumbnail_y,self::$proje_foto_tablename,self::$proje_foto_resize,self::$proje_foto_ratio_crop);

        $insert = $this->dbh->prepare("INSERT INTO proje SET sira = ?, ad = ?, kategori_id = ?, icerik = ?, aktif = ?, resim_yolu_thumbnail = ?, resim_yolu = ?, seo = ?, baslangic_t = ?, bitis_t = ?");
        $insert->bindParam(1,$sira);
        $insert->bindParam(2,$proje_adi);
        $insert->bindParam(3,$kategori_id);
        $insert->bindParam(4,$icerik);
        $insert->bindParam(5,$aktif);
        $insert->bindParam(6,$kapak_kucuk);
        $insert->bindParam(7,$kapak_buyuk);
        $insert->bindParam(8,$seo);
        $insert->bindParam(9,$baslangic_t);
        $insert->bindParam(10,$bitis_t);
        $insert->execute();
        $id = $this->dbh->lastInsertId();
        $this->SessiondakiResimleriAta($id, self::$proje_foto_tablename);
    }
    public function ProjeGuncelle(){

        $id = $_POST["id"];
        $sira = $_POST["sira"];
        $proje_adi = $_POST["proje_adi"];
        $kategori_id = $_POST["kategori_id"];
        $icerik = $_POST["icerik"];
        $aktif = $_POST["aktif"];
        if($aktif == "on"){ $aktif = 1; } else { $aktif = 0; }
        $seo = $this->myFunctions->turkce_karakter_temizle($proje_adi);

        $baslangic_t = $_POST["baslangic_t"];
        $bitis_t = $_POST["bitis_t"];


        $params = array();
        array_push($params, $id);
        $proje = $this->select("select *from ".self::$proje_foto_tablename." where id = ?", $params);

        if($_FILES[self::$proje_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$proje_foto_tablename.'/'.$proje[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$proje_foto_tablename.'/'.$proje[0]["resim_yolu_thumbnail"]);
            $kapak_buyuk = $this->myFunctions->ResimYukle(self::$proje_foto_input_name,self::$proje_foto_x,self::$proje_foto_y,self::$proje_foto_tablename,self::$proje_foto_resize,self::$proje_foto_ratio_crop);
            $kapak_kucuk = $this->myFunctions->ResimYukle(self::$proje_foto_input_name,self::$proje_foto_thumbnail_x,self::$proje_foto_thumbnail_y,self::$proje_foto_tablename,self::$proje_foto_resize,self::$proje_foto_ratio_crop);
        }else
        {
            $kapak_buyuk = $proje[0]["resim_yolu"];
            $kapak_kucuk = $proje[0]["resim_yolu_thumbnail"];
        }

        $update = $this->dbh->prepare("UPDATE proje SET sira = ?, ad = ?, kategori_id = ?, icerik = ?, aktif = ?, resim_yolu = ?, resim_yolu_thumbnail = ?, seo = ?, baslangic_t = ?, bitis_t = ?  WHERE id = ?");
        $update->bindParam(1,$sira);
        $update->bindParam(2,$proje_adi);
        $update->bindParam(3,$kategori_id);
        $update->bindParam(4,$icerik);
        $update->bindParam(5,$aktif);
        $update->bindParam(6,$kapak_buyuk);
        $update->bindParam(7,$kapak_kucuk);
        $update->bindParam(8,$seo);
        $update->bindParam(9,$baslangic_t);
        $update->bindParam(10,$bitis_t);
        $update->bindParam(11,$id);
        $update->execute();

        $this->SessiondakiResimleriAta($id,self::$proje_foto_tablename);
    }

    public function SessiondakiResimleriAta($id,$tableName){

        $deletes = $this->select("select *from resim where secili = 1");
        foreach ($deletes as $delete)
        {
            $this->delete("resim", $delete["id"], "resim");
            unlink("../uploads/images/$tableName/".$delete['kucuk']);
            unlink("../uploads/images/$tableName/".$delete['buyuk']);
        }

        $session_id = session_id();
        $update = $this->dbh->prepare("UPDATE resim SET record_id = ? WHERE record_id = ?");
        $update->bindParam(1,$id);
        $update->bindParam(2,$session_id);
        $sonuc = $update->execute();
        return $sonuc;
    }
    public function TamponTemizle($dosya){
        $updates = $this->dbh->prepare("UPDATE resim SET secili = 0 where secili = 1");
        $updates->execute();

        $params = array();
        array_push($params, session_id());
        $deletes = $this->select("select *from resim where record_id = ?", $params);
        foreach ($deletes as $delete)
        {
            $this->delete("resim", $delete["id"], "resim");
            unlink("../../uploads/images/$dosya/".$delete['kucuk']);
            unlink("../../uploads/images/$dosya/".$delete['buyuk']);
        }

        return true;
    }





    public function EkipEkle(){

        $resim = $this->myFunctions->ResimYukle(self::$ekip_foto_input_name,self::$ekip_foto_x,self::$ekip_foto_y,self::$ekip_foto_tablename,self::$ekip_foto_resize,self::$ekip_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$ekip_foto_input_name,self::$ekip_foto_thumbnail_x,self::$ekip_foto_thumbnail_y,self::$ekip_foto_tablename,self::$ekip_foto_resize,self::$ekip_foto_ratio_crop);

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        $gorev = $_POST['gorev'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $gplus = $_POST['gplus'];
        $telefon = $_POST['telefon'];
        $eposta = $_POST['eposta'];
        $cboKategori = $_POST['cboKategori'];


        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        $insert = $this->dbh->prepare("INSERT INTO ekip SET
                                    sira = ?,
                                    ad = ?,
                                    gorev = ?,
                                    facebook = ?,
                                    twitter = ?,
                                    instagram = ?,
                                    gplus = ?,
                                    telefon = ?,
                                    eposta = ?,
                                    resim_yolu = ?,
                                    resim_yolu_thumbnail = ?,
                                    seo = ?,
                                    aktif = ?,
                                    kategori_id = ?");
        $insert->bindParam(1,$sira);
		$insert->bindParam(2,$ad);
        $insert->bindParam(3,$gorev);
        $insert->bindParam(4,$facebook);
        $insert->bindParam(5,$twitter);
        $insert->bindParam(6,$instagram);
        $insert->bindParam(7,$gplus);
        $insert->bindParam(8,$telefon);
        $insert->bindParam(9,$eposta);
        $insert->bindParam(10,$resim);
        $insert->bindParam(11,$resim_thumbnail);
        $insert->bindParam(12,$seo);
        $insert->bindParam(13,$chcGorunurluk);
        $insert->bindParam(14,$cboKategori);

        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",15, $id," ekip eklendi");

            $this->SessiondakiResimleriAta($id, self::$ekip_foto_tablename);

			return $id;
		}else{
			return 0;
		}
    }
    public function EkipGuncelle(){

        $resim = $this->myFunctions->ResimYukle(self::$ekip_foto_input_name,self::$ekip_foto_x,self::$ekip_foto_y,self::$ekip_foto_tablename,self::$ekip_foto_resize,self::$ekip_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$ekip_foto_input_name,self::$ekip_foto_thumbnail_x,self::$ekip_foto_thumbnail_y,self::$ekip_foto_tablename,self::$ekip_foto_resize,self::$ekip_foto_ratio_crop);

        $id = $_POST['ekip_id'];
        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        $gorev = $_POST['gorev'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $gplus = $_POST['gplus'];
        $telefon = $_POST['telefon'];
        $eposta = $_POST['eposta'];
        $seo = $this->myFunctions->turkce_karakter_temizle($ad);
        $cboKategori = $_POST['cboKategori'];

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        $params = array();
        array_push($params, $id);
        $foto = $this->select("select *from ".self::$ekip_foto_tablename." where id = ?", $params);

        if($_FILES[self::$ekip_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$ekip_foto_tablename.'/'.$foto[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$ekip_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
            $resim = $this->myFunctions->ResimYukle(self::$ekip_foto_input_name,self::$ekip_foto_x,self::$ekip_foto_y,self::$ekip_foto_tablename,self::$ekip_foto_resize,self::$ekip_foto_ratio_crop);
            $resim_thumbnail = $this->myFunctions->ResimYukle(self::$ekip_foto_input_name,self::$ekip_foto_thumbnail_x,self::$ekip_foto_thumbnail_y,self::$ekip_foto_tablename,self::$ekip_foto_resize,self::$ekip_foto_ratio_crop);
        }else
        {
            $resim = $foto[0]["resim_yolu"];
            $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        }


        $update = $this->dbh->prepare("UPDATE ekip SET
                                                        sira = ?,
                                                        ad = ?,
                                                        gorev = ?,
                                                        facebook = ?,
                                                        twitter = ?,
                                                        instagram = ?,
                                                        gplus = ?,
                                                        telefon = ?,
                                                        eposta = ?,
                                                        resim_yolu = ?,
                                                        resim_yolu_thumbnail = ?,
                                                        seo = ?,
                                                        aktif = ?,
                                                        kategori_id = ?
                                                        WHERE id = ?");
        $update->bindParam(1,$sira);
		$update->bindParam(2,$ad);
        $update->bindParam(3,$gorev);
        $update->bindParam(4,$facebook);
        $update->bindParam(5,$twitter);
        $update->bindParam(6,$instagram);
        $update->bindParam(7,$gplus);
        $update->bindParam(8,$telefon);
        $update->bindParam(9,$eposta);
        $update->bindParam(10,$resim);
        $update->bindParam(11,$resim_thumbnail);
        $update->bindParam(12,$seo);
        $update->bindParam(13,$chcGorunurluk);
        $update->bindParam(14,$cboKategori);
        $update->bindParam(15,$id);

        if ($update->execute()) {
            $this->Audit("Update",15,$id,"ekip güncellendi");
            $this->SessiondakiResimleriAta($id, self::$ekip_foto_tablename);
            return $id;
        }else{
            return $update->errorCode();
        }
    }








    public function OrtakSegmentEkle(){

        //$resim = $this->myFunctions->ResimYukle(self::$ortak_segment_foto_input_name,self::$ortak_segment_foto_x,self::$ortak_segment_foto_y,self::$ortak_segment_foto_tablename,self::$ortak_segment_foto_resize,self::$ortak_segment_foto_ratio_crop);
        //$resim_thumbnail = $this->myFunctions->ResimYukle(self::$ortak_segment_foto_input_name,self::$ortak_segment_foto_thumbnail_x,self::$ortak_segment_foto_thumbnail_y,self::$ortak_segment_foto_tablename,self::$ortak_segment_foto_resize,self::$ortak_segment_foto_ratio_crop);

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];
        //$icerik = $_POST['icerik'];
        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        $insert = $this->dbh->prepare("INSERT INTO ortaklik_segment SET
                                    sira = ?,
                                    ad = ?,
                                    aktif = ?,
                                    seo = ?");

        $insert->bindParam(1,$sira);
		$insert->bindParam(2,$ad);
        //$insert->bindParam(3,$icerik);
        $insert->bindParam(3,$chcGorunurluk);
        $insert->bindParam(4,$seo);
        //$insert->bindParam(6,$resim);
        //$insert->bindParam(7,$resim_thumbnail);


        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",15, $id," ortaklik segmenti eklendi");

            $this->SessiondakiResimleriAta($id, self::$ortak_segment_foto_tablename);

			return $id;
		}else{
			return 0;
		}
    }
    public function OrtakSegmentGuncelle(){


        $id = $_POST['segment_id'];
        $sira = $_POST['sira'];
        $ad = $_POST['ad'];

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        //$params = array();
        //array_push($params, $id);
        //$foto = $this->select("select *from ".self::$ortak_segment_foto_tablename." where id = ?", $params);

        //if($_FILES[self::$ortak_segment_foto_input_name]["error"] == 0) {
        //    unlink('../uploads/images/'.self::$ortak_segment_foto_tablename.'/'.$foto[0]["resim_yolu"]);
        //    unlink('../uploads/images/'.self::$ortak_segment_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
        //    $resim = $this->myFunctions->ResimYukle(self::$ortak_segment_foto_input_name,self::$ortak_segment_foto_x,self::$ortak_segment_foto_y,self::$ortak_segment_foto_tablename,self::$ortak_segment_foto_resize,self::$ortak_segment_foto_ratio_crop);
        //    $resim_thumbnail = $this->myFunctions->ResimYukle(self::$ortak_segment_foto_input_name,self::$ortak_segment_foto_thumbnail_x,self::$ortak_segment_foto_thumbnail_y,self::$ortak_segment_foto_tablename,self::$ortak_segment_foto_resize,self::$ortak_segment_foto_ratio_crop);
        //}else
        //{
        //    $resim = $foto[0]["resim_yolu"];
        //    $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        //}


        $update = $this->dbh->prepare("UPDATE ortaklik_segment SET
                                    sira = ?,
                                    ad = ?,
                                    aktif = ?,
                                    seo = ?
                                    WHERE id = ?");


        $update->bindParam(1,$sira);
		$update->bindParam(2,$ad);
        $update->bindParam(3,$chcGorunurluk);
        $update->bindParam(4,$seo);
        $update->bindParam(5,$id);

        if ($update->execute()) {
            $this->Audit("Update",16,$id,"ortak segmenti güncellendi");
            $this->SessiondakiResimleriAta($id, self::$ortak_segment_foto_tablename);
            return $id;
        }else{
            return $update->errorCode();
        }
    }



    public function OrtakEkle(){

        $resim = $this->myFunctions->ResimYukle(self::$ortak_foto_input_name,self::$ortak_foto_x,self::$ortak_foto_y,self::$ortak_foto_tablename,self::$ortak_foto_resize,self::$ortak_foto_ratio_crop);
        $resim_thumbnail = $this->myFunctions->ResimYukle(self::$ortak_foto_input_name,self::$ortak_foto_thumbnail_x,self::$ortak_foto_thumbnail_y,self::$ortak_foto_tablename,self::$ortak_foto_resize,self::$ortak_foto_ratio_crop);

        $sira = $_POST['sira'];
        $ad = $_POST['ad'];

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        $insert = $this->dbh->prepare("INSERT INTO ortak SET
                                    sira = ?,
                                    ad = ?,
                                    aktif = ?,
                                    seo = ?,
                                    resim_yolu = ?,
                                    resim_yolu_thumbnail = ?");

        $insert->bindParam(1,$sira);
		$insert->bindParam(2,$ad);
        $insert->bindParam(3,$chcGorunurluk);
        $insert->bindParam(4,$seo);
        $insert->bindParam(5,$resim);
        $insert->bindParam(6,$resim_thumbnail);


        $insert->execute();
		if ($insert->rowCount() == 1) {
            $id = $this->dbh->lastInsertId();
            $this->Audit("Insert",15, $id," ortak eklendi");

            $this->SessiondakiResimleriAta($id, self::$ortak_foto_tablename);

			return $id;
		}else{
			return 0;
		}
    }
    public function OrtakGuncelle(){


        $id = $_POST['ortak_id'];
        $sira = $_POST['sira'];
        $ad = $_POST['ad'];

        $seo = $this->myFunctions->turkce_karakter_temizle($ad);

        $chcGorunurluk = 0;
        if($_POST['chcGorunurluk'] == "on"){ $chcGorunurluk = 1; }


        $params = array();
        array_push($params, $id);
        $foto = $this->select("select *from ".self::$ortak_foto_tablename." where id = ?", $params);

        if($_FILES[self::$ortak_foto_input_name]["error"] == 0) {
            unlink('../uploads/images/'.self::$ortak_foto_tablename.'/'.$foto[0]["resim_yolu"]);
            unlink('../uploads/images/'.self::$ortak_foto_tablename.'/'.$foto[0]["resim_yolu_thumbnail"]);
            $resim = $this->myFunctions->ResimYukle(self::$ortak_foto_input_name,self::$ortak_foto_x,self::$ortak_foto_y,self::$ortak_foto_tablename,self::$ortak_foto_resize,self::$ortak_foto_ratio_crop);
            $resim_thumbnail = $this->myFunctions->ResimYukle(self::$ortak_foto_input_name,self::$ortak_foto_thumbnail_x,self::$ortak_foto_thumbnail_y,self::$ortak_foto_tablename,self::$ortak_foto_resize,self::$ortak_foto_ratio_crop);
        }else
        {
            $resim = $foto[0]["resim_yolu"];
            $resim_thumbnail = $foto[0]["resim_yolu_thumbnail"];
        }


        $update = $this->dbh->prepare("UPDATE ortak SET
                                    sira = ?,
                                    ad = ?,
                                    aktif = ?,
                                    seo = ?,
                                    resim_yolu = ?,
                                    resim_yolu_thumbnail = ?
                                    WHERE id = ?");


        $update->bindParam(1,$sira);
		$update->bindParam(2,$ad);
        $update->bindParam(3,$chcGorunurluk);
        $update->bindParam(4,$seo);
        $update->bindParam(5,$resim);
        $update->bindParam(6,$resim_thumbnail);
        $update->bindParam(7,$id);

        if ($update->execute()) {
            $this->Audit("Update",16,$id,"ortak güncellendi");
            $this->SessiondakiResimleriAta($id, self::$ortak_foto_tablename);
            return $id;
        }else{
            return $update->errorCode();
        }
    }


    public function JoinNetwork(){

        $ad = $_POST["ad"];
        $sektor = $_POST["sektor"];
        $yetkili = $_POST["yetkili"];
        $telefon = $_POST["telefon"];
        $eposta = $_POST["eposta"];
        $tarih = date("m/d/Y");
        $ip = $this->myFunctions->get_client_ip();


        $insert = $this->dbh->prepare("INSERT INTO join_form SET firma_adi = ?, sektor = ?, yetkili = ?, telefon = ?, eposta = ?, tarih = ?, ip = ?");
        $insert->bindParam(1, $ad);
        $insert->bindParam(2, $sektor);
        $insert->bindParam(3, $yetkili);
        $insert->bindParam(4, $telefon);
        $insert->bindParam(5, $eposta);
        $insert->bindParam(6, $tarih);
        $insert->bindParam(7, $ip);

        if($insert->execute()){


            $mesaj = "Company Name : ".$ad."<br/>"."Sector : ".$sektor."<br/>"."Contact Name : ".$yetkili."<br/>"."Contact Number :".$telefon."<br/>"."E-mail : ".$eposta."<br/>Join Date :".$tarih."<br/>Ip Address :".$ip;
            $settings = $this->select("select *from ayarlar limit 1");

            $this->myFunctions->mailGonder($this, $settings[0]["smtp_username"], "Join Network Form",$mesaj, "WGI","WGI");
            return $this->dbh->lastInsertId;

        }else
        {
            return 0;
        }


    }



    public function KullaniciGrupEkle(){
        $grup_name = $_POST["grup_name"];
        $islem_loglarini_goruntule = $_POST["islem_loglarini_goruntule"];

        if($islem_loglarini_goruntule == "true"){ $islem_loglarini_goruntule = 1; } else { $islem_loglarini_goruntule = 0; }

        $insert_grup = $this->dbh->prepare("INSERT INTO u_users_group SET name = ?, islem_loglarini_goster = ?");
        $insert_grup->bindParam(1, $grup_name);
        $insert_grup->bindParam(2, $islem_loglarini_goruntule);
        $insert_grup->execute();

        $id = $this->dbh->lastInsertId();

        $this->Audit("Insert",11,$id,$grup_name." isimli kullanıcı grubu");

        return $id;
    }
    public function KullaniciGrupGuncelle(){

        $grup_id = $_POST["grup_id"];
        $grup_name = $_POST["grup_name"];
        $islem_loglarini_goruntule = $_POST["islem_loglarini_goruntule"];

        if($islem_loglarini_goruntule == "true"){ $islem_loglarini_goruntule = 1; } else { $islem_loglarini_goruntule = 0; }

        $update = $this->dbh->prepare("UPDATE u_users_group SET name = ?, islem_loglarini_goster = ? WHERE id = ?");
        $update->bindParam(1, $grup_name);
        $update->bindParam(2, $islem_loglarini_goruntule);
        $update->bindParam(3, $grup_id);
        $update->execute();

        if($update->rowCount() > 0){
            $this->Audit("Update",11, $grup_id,$grup_name." isimli kullanıcı grubu");
            return true;
        }else
        {
            return false;
        }
    }
    public function izinEkle($modul_id){

        $columns = $_POST["columns"];
        $grup_id = $_POST["grup_id"];

        $ekle = 0;
        $sil = 0;
        $duzenle = 0;
        $goruntule = 0;
        $guncelle = 0;
        //$modul_id = 0;

        foreach ($columns as $column)
        {
            $modul_id = $column[0];
            $field = $column[1];

            switch ($field)
            {
                case 'ekle':
                    $value = $column[2];
                    $ekle = $value == "true"?1:0;
                    break;
                case 'sil':
                    $value = $column[2];
                    $sil = $value == "true"?1:0;
                    break;
                case 'duzenle':
                    $value = $column[2];
                    $duzenle = $value == "true"?1:0;
                    break;
                case 'goruntule':
                    $value = $column[2];
                    $goruntule = $value == "true"?1:0;
                    break;
                case 'guncelle':
                    $value = $column[2];
                    $guncelle = $value == "true"?1:0;
                    break;
            }
        }

        $insert_permission = $this->dbh->prepare("INSERT INTO u_module_permission SET ekle = ?, duzenle = ?, sil = ?, goruntule = ?, guncelle = ? , u_users_group_id = ?, panel_modul_id = ?");
        $insert_permission->bindParam(1, $ekle);
        $insert_permission->bindParam(2, $duzenle);
        $insert_permission->bindParam(3, $sil);
        $insert_permission->bindParam(4, $goruntule);
        $insert_permission->bindParam(5, $guncelle);
        $insert_permission->bindParam(6, $grup_id);
        $insert_permission->bindParam(7, $modul_id);
        $sonuc = $insert_permission->execute();

        $rtrn = $this->lastInsertId();
        return $rtrn;
    }
    public function izinGuncelle(){

        $permission_id = $_POST["permission_id"];

        if($_POST["ekle"] == "true"){ $ekle = 1; }else{ $ekle = 0; }
        if($_POST["sil"] == "true"){ $sil = 1; }else{ $sil = 0; }
        if($_POST["duzenle"] == "true"){ $duzenle = 1; }else{ $duzenle = 0; }
        if($_POST["goruntule"] == "true"){ $goruntule = 1; }else{ $goruntule = 0; }
        if($_POST["guncelle"] == "true"){ $guncelle = 1; }else{ $guncelle = 0; }

        $update = $this->dbh->prepare("UPDATE u_module_permission SET ekle = ?, sil = ?, duzenle = ?, goruntule = ?, guncelle = ? WHERE id = ?");
        $update->bindParam(1,$ekle);
        $update->bindParam(2,$sil);
        $update->bindParam(3,$duzenle);
        $update->bindParam(4,$goruntule);
        $update->bindParam(5,$guncelle);
        $update->bindParam(6,$permission_id);
        $update->execute();

    }
    public function HaberOkumaSayisiUpdate($okuma, $id){
        $update = $this->dbh->prepare("UPDATE haber SET okuma = ? WHERE id = ?");
        $update->bindParam(1, $okuma);
        $update->bindParam(2, $id);
        return $update->execute();
    }
    public function ModulGoruntulemeSayisiUpdate($goruntuleme, $id){
        $update = $this->dbh->prepare("UPDATE modul SET goruntuleme = ? WHERE id = ?");
        $update->bindParam(1, $goruntuleme);
        $update->bindParam(2, $id);
        $update->execute();
    }
    public function SayfaGoruntulemeSayisiUpdate($tablo, $goruntuleme_sayisi, $id){
        $update = $this->dbh->prepare("UPDATE ".$tablo." SET goruntuleme = ? WHERE id = ?");
        $update->bindParam(1, $goruntuleme_sayisi);
        $update->bindParam(2, $id);
        $sonuc = $update->execute();
        return $sonuc;
    }
    public function MesajGonder($gelen0Giden1, $eposta = null, $telefon = null, $konu = null, $mesaj = null){

        $tarih = date("d-m-Y");
        $ip = $this->myFunctions->get_client_ip();

        if($gelen0Giden1 == 0){
            $ad = $_POST['ad'];
            $eposta = $_POST['eposta'];
            $telefon = $_POST['telefon'];
            $konu = $_POST['konu'];
            $mesaj = $_POST['mesaj'];

            $mesajVarmi = $this->dbh->prepare("select *from mesaj where ip = ? and tarih = ?");
            $mesajVarmi->bindParam(1, $ip);
            $mesajVarmi->bindParam(2, date("d-m-Y"));
            $mesajVarmi->execute();

            if($mesajVarmi->rowCount() == 3){
                return "true";
            }
        }else
        {
            $ad = $_SESSION["ad_soyad"];
        }

        $insert = $this->dbh->prepare("INSERT INTO mesaj SET ad = ?, eposta = ?, konu = ?, mesaj = ?, tarih = ?, ip = ?, gelengiden = ?, telefon = ?");
        $insert->bindParam(1,$ad);
        $insert->bindParam(2,$eposta);
        $insert->bindParam(3,$konu);
        $insert->bindParam(4,$mesaj);
        $insert->bindParam(5,$tarih);
        $insert->bindParam(6,$ip);
        $insert->bindParam(7,$gelen0Giden1);
        $insert->bindParam(8,$telefon);


        if ($insert->execute()) {

            $id = $this->dbh->lastInsertId();

            if($gelen0Giden1 == 0){
                $settings = $this->select("select *from ayarlar where id = 1");
                if($settings[0]["ziyaretci_mesajlari_epostama_gelsin"] == 1){
                    $mesajYeni = "Mesaj Tarihi : ".$tarih."<br/>Gönderen eposta :".$eposta."<br/>İp : ".$ip."<br/><br/>".$mesaj;
                    $mail_sonuc = $this->myFunctions->mailGonder($this, $settings[0]["smtp_username"], "ZİYARETÇİ MESAJI - ".$ad, $mesajYeni,"", $ad);
                    return $mail_sonuc;
                }
            }else{

                $kullanici_ad_soyad = $_SESSION["ad_soyad"];
                $mail_sonuc = $this->myFunctions->mailGonder($this, $eposta,$konu, $mesaj, "" ,$kullanici_ad_soyad);
                $this->Audit("Eposta", 8, $id, $eposta." alıcısına ".$konu." konulu bir eposta");
            }
            return $id;
        }else{
            return 0;
        }
    }
    public function ZiyaretciTelefonEkle(){
        $ad_soyad = $_POST['ad_soyad'];
        $telefon_no = $_POST['telefon_no'];
        $tarih = date("d-m-Y");
        $ip = $this->myFunctions->get_client_ip();


        $telefonVarmi = $this->dbh->prepare("select *from ziyaretci_telefon where telefon_no = ?");
        $telefonVarmi->bindParam(1, $telefon_no);
        $telefonVarmi->execute();

        if($telefonVarmi->rowCount() == 1){
            return "true";
        } else {
            $insert = $this->dbh->prepare("INSERT INTO ziyaretci_telefon SET ad_soyad = ?, telefon_no = ?, tarih = ?, ip = ?");
            $insert->bindParam(1,$ad_soyad);
            $insert->bindParam(2,$telefon_no);
            $insert->bindParam(3,$tarih);
            $insert->bindParam(4,$ip);

            $insert->execute();
            if ($insert->rowCount() == 1) {
                $id = $this->dbh->lastInsertId();
                $settings = $this->select("select *from ayarlar LIMIT 1");
                if($settings[0]["ziyaretci_telefonlari_epostama_gelsin"] == 1){
                    $mail_sonuc = $this->myFunctions->mailGonder($this, $settings[0]["smtp_username"], "ZİYARETÇİ ARAMA TALEBİ", $ad_soyad." İSİMLİ ZİYARETÇİ ARAMANIZ İÇİN TELEFON NUMARASINI BIRAKTI. <BR/> TELEFON NO : ".$telefon_no, $ad_soyad);
                    return $mail_sonuc;
                }else
                {
                    return $id;
                }
            }else{
                return 0;
            }
        }
    }
    public function ZiyaretciEbultenGoruldu($id = null){
        if($id == null)
        {
            $update = $this->dbh->prepare("UPDATE ebulten SET goruldu = 1");
        }else{
            $update = $this->dbh->prepare("UPDATE ebulten SET goruldu = 1 WHERE id = ?");
            $update->bindParam(1, $id);
        }
        return $update->execute();
    }
    public function ZiyaretciTelefonGoruldu($id = null){
        if($id == null)
        {
            $update = $this->dbh->prepare("UPDATE ziyaretci_telefon SET goruldu = 1");
        }else{
            $update = $this->dbh->prepare("UPDATE ziyaretci_telefon SET goruldu = 1 WHERE id = ?");
            $update->bindParam(1, $id);
        }
        return $update->execute();
    }
    public function EbultenEpostaEkle(){

        $eposta = $_POST['eposta'];
        $tarih = date("d-m-Y");
        $ip = $this->myFunctions->get_client_ip();

        $epostaVarmi = $this->dbh->prepare("select *from ebulten where eposta = ?");
        $epostaVarmi->bindParam(1, $eposta);
        $epostaVarmi->execute();

        if($epostaVarmi->rowCount() > 0 ){
            return "true";
        } else {
            $insert = $this->dbh->prepare("INSERT INTO ebulten SET eposta = ?, ip = ?, tarih = ?");
            $insert->bindParam(1,$eposta);
            $insert->bindParam(2,$ip);
            $insert->bindParam(3,$tarih);

            $insert->execute();
            if ($insert->rowCount() == 1) {
                $id = $this->dbh->lastInsertId();
                return $id;
            }else{
                return 0;
            }
        }
    }
    public function DilEkle()
    {
        $dil_adi = $_POST["adi"];
        if($_POST["aktif"] == 'on'){
            $aktif = 1;
        }else
        {
            $aktif = 0;
        }

        $resim = "";
        $upload = new upload($_FILES["resim_yolu"]);
        if ($upload->uploaded){
            $upload->file_auto_rename = true;
            $upload->process('../uploads/images/language/'.$_POST["resim_yolu"]);
            if ($upload->processed){
                $resim = $upload->file_dst_name;
            }
        }

        $insert = $this->dbh->prepare("INSERT INTO language SET name = ?, aktif = ?, flag = ?");
        $insert->bindParam(1, $dil_adi);
        $insert->bindParam(2, $aktif);
        $insert->bindParam(3, $resim);
        $insert->execute();

        if($insert->rowCount() > 0){
            $id = $this->lastInsertId();
            $this->Audit("Insert",13,$id,$dil_adi." isimli dili");
            return true;
        }else
        {
            return false;
        }

    }
    public function DilGuncelle()
    {
        $id = $_POST["id"];
        $dil_adi = $_POST["adi"];
        if($_POST["aktif"] == 'on'){
            $aktif = 1;
        }else
        {
            $aktif = 0;
        }

        $params = array();
        array_push($params, $id);
        $setting = $this->select("select *from language where id = ?", $params);
        $resim = $setting[0]["flag"];

        $upload = new upload($_FILES["resim_yolu"]);
        if ($upload->uploaded){
            $upload->file_auto_rename = true;
            $upload->process('../uploads/images/language/'.$_POST["resim_yolu"]);
            if ($upload->processed){
                unlink('../uploads/images/language/'.$resim);
                $resim = $upload->file_dst_name;
            }
        }

        $insert = $this->dbh->prepare("UPDATE language SET name = ?, aktif = ?, flag = ? WHERE id = ?");
        $insert->bindParam(1, $dil_adi);
        $insert->bindParam(2, $aktif);
        $insert->bindParam(3, $resim);
        $insert->bindParam(4, $id);
        $insert->execute();

        $this->Audit("Update",13,$id,$dil_adi." isimli dili");
    }
    public function DilAktifPasif($dil_id){
        $deger = $_POST["value"];
        if($deger == "true"){ $deger = 1; }else{ $deger = 0; }
        $update = $this->dbh->prepare("UPDATE language SET aktif = ? where id = ?");
        $update->bindParam(1, $deger);
        $update->bindParam(2, $dil_id);
        return $update->execute();
    }
    public function Cevirmen($kelime, $language_id, $site = 0){
        $return_value = "";
        $params = array();
        array_push($params, $kelime);
        array_push($params, $site);
        $words = $this->select("SELECT *FROM words WHERE word = ? and site = ?", $params);
        if(count($words) > 0){
            $params = array();
            array_push($params, $language_id);
            array_push($params, $words[0]["id"]);
            $ceviriler = $this->select("SELECT *FROM dictionary WHERE language_id = ? and word_id = ?", $params);
            if(count($ceviriler) > 0){
                $return_value = $ceviriler[0]["translation"];
            }else
            {
                $return_value = $kelime;
            }
        }else
        {
            $insert = $this->dbh->prepare("INSERT INTO words SET word = ?, site = ?");
            $insert->bindParam(1, $kelime);
            $insert->bindParam(2, $site);
            $insert->execute();
            $return_value = $kelime;
        }
        return $return_value;
    }
    public function CeviriEkle(){

        $language = $_POST["language"];
        $words = $_POST["words"];
        $value = $_POST["value"];

        $insert = $this->dbh->prepare("INSERT INTO dictionary SET language_id = ?, word_id = ?, translation = ?");
        $insert->bindParam(1, $language);
        $insert->bindParam(2, $words);
        $insert->bindParam(3, $value);
        $insert->execute();

        $params = array();
        array_push($params, $language);
        $select_language = $this->select("select *from language where id = ?",$params);

        $id = $this->dbh->lastInsertId();
        $this->Audit("Insert",13,$id,$words." kelimesini ".$select_language[0]["name"]." diline");
    }
    public function CeviriGuncelle(){

        $cevirilen_kelime = $_POST["cevirilen_kelime"];
        $id = $_POST["id"];

        $update = $this->dbh->prepare("UPDATE dictionary SET translation = ? WHERE id = ?");
        $update->bindParam(1, $cevirilen_kelime);
        $update->bindParam(2, $id);
        $update->execute();


        $this->Audit("Update",13,$id,"çeviriyi");

    }
    public function CevirilecekKelimeSayisi($language_id){
        $kelime_sayisi = 0;
        $words = $this->select("select *from words");
        foreach ($words as $word)
        {
            $word_id = $word["id"];
            $params = array();
            array_push($params, $language_id);
            array_push($params, $word_id);
            $dictionaries = $this->select("SELECT language_id, word_id FROM dictionary WHERE language_id = ? and word_id = ?", $params);
            if(count($dictionaries) == 0){
                $kelime_sayisi++;
            }
        }
        return $kelime_sayisi;
    }
    public function Audit($islem, $modul_id, $kayit_id, $aciklama){
        $kullanici_id = $_SESSION["id"];
        $tarih = date("d-m-Y");
        $saat = date("H:i:s");
        $ip = $this->myFunctions->get_client_ip();

        $insert = $this->dbh->prepare("INSERT INTO audit SET tarih = ?, saat = ?, kullanici_id = ?, modul_id = ?, islem = ?, ip = ?, kayit_id = ?, aciklama = ?, kullanici_adi = ?");
        $insert->bindParam(1, $tarih);
        $insert->bindParam(2, $saat);
        $insert->bindParam(3, $kullanici_id);
        $insert->bindParam(4, $modul_id);
        $insert->bindParam(5, $islem);
        $insert->bindParam(6, $ip);
        $insert->bindParam(7, $kayit_id);
        $insert->bindParam(8, $aciklama);
        $insert->bindParam(9, $_SESSION["username"]);
        $insert->execute();

        if($insert->rowCount()>0){
            return true;
        }else
        {
            return false;
        }

    }

    public function ResimEkle($modul_adi, $record_id, $buyuk_resim, $kucuk_resim)
    {
        $insert = $this->dbh->prepare("INSERT INTO resim SET modul_adi = ?, record_id = ?, buyuk = ?, kucuk = ?");
        $insert->bindParam(1, $modul_adi);
        $insert->bindParam(2, $record_id);
        $insert->bindParam(3, $buyuk_resim);
        $insert->bindParam(4, $kucuk_resim);
        $sonuc = $insert->execute();
        return $sonuc;
    }
}

class myFunctions {

    function __construct()  {

    }

    function ResimYukle($input_name, $x, $y, $db_table_name, $image_resize = false, $image_ratio_crop = false, $directory_level = 1)
    {
        $resim="";
        $upload = new upload($_FILES[$input_name]);
        if ($upload->uploaded){
            $upload->upload_max_filesize = Database::$MaxUploadFileSize;
            $upload->post_max_size = Database::$MaxUploadFileSize;
            $upload->file_dst_name_body   = $db_table_name;
            $upload->image_resize         = $image_resize;

            if($x != 0){
                $upload->image_x              = $x;
            }

            if($y != 0){
                $upload->image_y              = $y;
            }

            $upload->image_ratio_crop = $image_ratio_crop;
            $upload->file_auto_rename = true;
            if($directory_level == 1){
                $upload->process('../uploads/images/'.$db_table_name);
            }else
            {
                $upload->process('../../uploads/images/'.$db_table_name);
            }

            if ($upload->processed){
                $resim = $upload->file_dst_name;
            }
        }
        return $resim;
    }

    public function mailGonder($dbh, $sendMail = null, $subject, $message, $alici_ad, $gonderen_ad)
    {
        $smtpAyarlari = $dbh->select("SELECT *FROM ayarlar limit 1");

        $smtpHost = $smtpAyarlari[0]["smtp_host"];
        $smtpUsername = $smtpAyarlari[0]["smtp_username"];
        $smtpPassword = $smtpAyarlari[0]["smtp_password"];


        if(empty($gonderen_ad)){
            $gonderen_ad = $smtpAyarlari[0]["firma_adi"];
        }

        $smtpSecure = $smtpAyarlari[0]["smtp_secure"];
        $smtpAuth = $smtpAyarlari[0]["smtp_authentication"];
        if($smtpAuth == 1){ $smtpAuth = true; }else{ $smtpAuth = false; }
        $smtpPort = $smtpAyarlari[0]["smtp_port"];

        $new = explode(",",$sendMail);

        foreach ($new as $value)
        {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = $smtpAuth;
            $mail->Host = $smtpHost;
            $mail->Port = $smtpPort;
            //$mail->SMTPSecure = $smtpSecure;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SetFrom($mail->Username, $gonderen_ad);
            $mail->AddAddress($value, $value);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $content = $message;
            $mail->MsgHTML($content);
            if($mail->Send()) {

            } else {
                //return $mail->ErrorInfo;
            }
        }

        $sonuc ="";
        if(count($new) > 1){
            $adresler = "";
            foreach ($new as $value){
                $adresler = $adresler.",".$value;
            }
            $sonuc = $adresler. " kullanıcılarına mesajınız gönderildi.";
        }else
        {
            $sonuc = $sendMail." kullanıcısına mesajınız gönderildi.";
        }
        return $sonuc;
    }

    public function sifirlamaBaglantisiGonder($dbh, $sendMail)
    {
        $smtpAyarlari = $dbh->select("SELECT *FROM ayarlar limit 1");
        foreach ($smtpAyarlari as $ayar)
        {
            $url = $ayar["url"];
            $smtpHost = $ayar["smtp_host"];
            $smtpUsername = $ayar["smtp_username"];
            $smtpPassword = $ayar["smtp_password"];
            $smtpIsim = $ayar["firma_adi"];
            $smtpSecure = $ayar["smtp_secure"];
            $smtpAuth = $ayar["smtp_authentication"];
            if($smtpAuth == 1){ $smtpAuth = true; }else{ $smtpAuth = false; }
            $smtpPort = $ayar["smtp_port"];
        }

        include("classes/class.phpmailer.php");

        $params = array();

        array_push($params, $sendMail);

        $kullanicilar = $dbh->select("select *from users where eposta = ?", $params);

        foreach ($kullanicilar as $kullanici)
        {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = $smtpAuth;
            $mail->Host = $smtpHost;
            $mail->Port = $smtpPort;
            $mail->SMTPSecure = 'ssl';
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SetFrom($mail->Username, $smtpIsim);
            $mail->AddAddress($sendMail, $gonderen_ad);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Parola Sıfırlama İletisi";
            $mail->IsHTML(true);
            $mail->Body = "Bu adrese gidin: ".$url.'?guid='.$kullanici["guid"];
            if($mail->Send()) {
                return true;
            } else {
                return $mail->ErrorInfo;
            }
        }
        return false;
    }

    public function smsGonder(){


        function sendSMS__(
        $gsm='Gönderen Telefon Numarası',
        $msj='Göndereceğiniz Mesajı Yazın.'){
            $dtysms_['Kullanici'] = "kullanici_adi";
            $dtysms_['sifre'] = "sifre";
            $dtysms_['baslik'] = "Başlık";

            $dtysms_['gsm'] = (string)$gsm;
            $dtysms_['mesaj'] = (string)$msj;
            $dtysms_['tarih'] = (string)date('d.m.Y');
            $dtysms_['saat'] = (string)date('H:i');
            $dtysms_['gecerlilik'] = "";
            $dtysms_['op'] = "";
            $sms = new SoapClient("http://sunucu_ismi/Service.asmx?WSDL");
            $sms = $sms->__call("sendsms", array($dtysms_));
            $sms = $sms->sendsmsResult;
            return $sms;
        }
        print sendSMS__('Gönderilecek Telefon Numarası');


    }

    public function textOverflow($Text, $MaxLenght )
    {
        $max_length = $MaxLenght;
        if (strlen($Text) > $max_length)
        {
            $offset = ($max_length - 3) - strlen($Text);
            $Text = substr($Text, 0, strrpos($Text, ' ', $offset)) . '...';
        }
        return $Text;
    }

    public function strtoupperTR($str)
    {
        $upperTR = mb_convert_case(str_replace(array(“i”,”ı”),array(“İ”,”I”),$str), MB_CASE_UPPER, "UTF-8");
        return strtoupper($upperTR);
    }

    public function turkceTarih ($tarih, $dbh, $language_id) {
        date_default_timezone_set('Europe/Istanbul');

        $gunler = array('Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi');
        $aylar = array('','Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık');

        $tarih = strtotime($tarih);
        $gun = $dbh->Cevirmen($gunler[date('n',$tarih)], $language_id);
        $ay = $dbh->Cevirmen($aylar[date('n',$tarih)], $language_id);


        return date('d',$tarih).' '.$ay.' '.date('Y',$tarih);
    }

    public function turkce_karakter_temizle($tr1) {
        $turkce=array("ş","Ş","ı","ü","Ü","ö","Ö","ç","Ç","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü");
        $duzgun=array("s","S","i","u","U","o","O","c","C","s","S","i","g","G","I","o","O","C","c","u","U");
        $tr1=str_replace($turkce,$duzgun,$tr1);
        $tr1 = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i","-",$tr1);
        return $tr1;
    }

    public function post($par, $st=false){
        if($st){
            return htmlspecialchars(addslashes(trim(htmlentities($_POST[$par]))));
        }else{
            return addslashes(trim(htmlentities($_POST[$par])));
        }
    }

    public function get($par, $st=false){
        if($st){
            return htmlspecialchars(addslashes(trim(htmlentities($_GET[$par]))));
        }else{
            return addslashes(trim(htmlentities($_GET[$par])));
        }
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
?>


