<!DOCTYPE html>
<html lang="tr" class="coming-soon">
<head>
    <meta charset="utf-8" />
    <title>YÖNETİM PANELİ</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <link type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500' rel='stylesheet' />
    <link type='text/css' href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="assets/plugins/progress-skylo/skylo.css" type="text/css" rel="stylesheet" />
    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/styles.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/pines-notify/pnotify.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/snackbar/snackbar.min.css" type="text/css" rel="stylesheet" />
    <!--[if lt IE 9]>
        <link href="assets/css/ie8.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="focused-form animated-content" style="padding-top:100px;">
    <div class="container" id="login-form">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div id="forgot" class="panel panel-danger">
                    <div class="panel-heading">
                        <h2>Parolanızı Sıfırlayın</h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group mb-n">
                            <div class="col-xs-12">
                                <p>Eposta adresinizi yazarak parolanızı sıfırlayabilirsiniz.</p>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                    <input type="email" class="form-control" id="eposta" placeholder="Eposta Adresi" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                            <a href="?q=login" class="btn btn-default pull-left">Geri</a>
                            <input type="hidden" name="islem" value="forgot" />
                            <button id="btnForgot" class="btn btn-primary btn-raised pull-right">Sıfırla</button>
                        </div>
                    </div>
                </div>
                <div id="login" class="panel panel-blue">
                    <div class="panel-heading">
                        <h2>YÖNETİM PANELİ GİRİŞİ</h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group mb-md">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                    <input type="text" id="kullanici_adi" class="form-control" placeholder="Kullanıcı adı" data-parsley-minlength="6" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-md">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ti ti-key"></i>
                                    </span>
                                    <input type="password" class="form-control" id="parola" placeholder="Parola" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-n" style="margin-top:10px;padding-top:0px;">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-primary pull-left" style="margin-left:10px;">
                                        <label>
                                            <?php
                                            $checked_remember = "";
                                            if(isset($_COOKIE["panel2016_remember"]))
                                            {
                                                $checked_remember = "checked";
                                            }
                                            ?>
                                            <input type="checkbox" id="beni_hatirla" <?php echo $checked_remember;?> />
                                            Beni Hatırla
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="col-md-6 pull-left">
                            <a href="?q=forgot" class="pull-left" style="margin-top:20px;margin-left:30px;">Şifremi Unuttum</a>
                        </div>
                        <div class="clearfix col-md-6 pull-right">
                            <button id="btnLogin" type="button" class="btn btn-primary btn-raised pull-right">GİRİŞ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jqueryui-1.10.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/enquire.min.js"></script>
    <script src="assets/plugins/velocityjs/velocity.min.js"></script>
    <script src="assets/plugins/velocityjs/velocity.ui.min.js"></script>
    <script src="assets/plugins/progress-skylo/skylo.js"></script>
    <script src="assets/plugins/wijets/wijets.js"></script>
    <script src="assets/plugins/sparklines/jquery.sparklines.min.js"></script>
    <script src="assets/plugins/codeprettifier/prettify.js"></script>
    <script src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>
    <script src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script>
    <script src="assets/plugins/dropdown.js/jquery.dropdown.js"></script>
    <script src="assets/plugins/bootstrap-material-design/js/material.min.js"></script>
    <script src="assets/plugins/bootstrap-material-design/js/ripples.min.js"></script>
    <script src="assets/js/application.js"></script>

    <script>
        $(function () {
            $("#btnForgot").click(function () {
                var eposta = $("#eposta").val();
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { modul: 'forgot', eposta: eposta },
                    url: 'system/ajax.php',
                    success: function (result) {
                        if (result[0] === "true") {
                            mesaj = "Eposta adresinize bir sıfırlama bağlantısı gönderdik.\n Lütfen eposta adresinizi kontrol edin.";
                            window.location = '?view=panel';
                        } else {
                            mesaj = result[0];
                        }
                        alert(mesaj);
                    },
                    error: function (a, b, c) {
                        alert(c);
                    }
                });

            });
            $("#btnLogin").click(function () {

                var kullanici_adi = $("#kullanici_adi").val();
                var parola = $("#parola").val();
                var beni_hatirla = $("#beni_hatirla").prop("checked");

                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { modul: 'login', kullanici_adi: kullanici_adi, parola: parola, beni_hatirla: beni_hatirla },
                    url: 'system/ajax.php',
                    success: function (result) {
                        var mesaj = "";
                        var type = "error";
                        if (result[0] === "true") {
                            type = "success"; mesaj = "Giriş işlemi başarılı."; window.location = "/panel/index.php?view=panel";
                        } else {
                            mesaj = result[0];
                        }
                        new PNotify({
                            title: mesaj,
                            type: type,
                            delay: 10000,
                        });
                    },
                    error: function (a, b, c) {
                        alert(a.responseText, b.responseText, c.responseText);
                    }
                });

            });
        });
    </script>

    <?php
    error_reporting(0);
    $q = $_GET["q"];
    switch ($q)
    {
        case "forgot":
    ?>
    <script> $(function () { $("#login").remove(); }); </script>
    <?php
            break;
        case "login":
    ?>
    <script> $(function () { $("#forgot").remove(); }); </script>
    <?php
            break;
        default:
    ?>
    <script> $(function () { $("#forgot").remove(); }); </script>
    <?php
            break;
    }
    ?>

    <script src="/panel/assets/plugins/pines-notify/pnotify.min.js"></script>
    <script src="/panel/assets/plugins/snackbar/snackbar.min.js"></script>
    <style>
        input[type=text], input[type=password] {
            text-align: center;
        }
        body {
            background: url(/panel/assets/img/login_bg.jpg) !important;
        }
    </style>
</body>
</html>