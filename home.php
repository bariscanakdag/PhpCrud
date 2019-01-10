<?php require_once 'PDOClass.php';
ob_start();
session_start();
$con=new DataBase();
if(empty($_SESSION['UserName'])|| empty($_SESSION['UserPassword'])){
    Header("Location:http://localhost:63342/example1/Login.php");
    exit();
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="Script/alertify.js"></script>
    <link href="Style/alertify.rtl.css" rel="stylesheet" type="text/css" />
    <link href="Style/default.rtl.css" rel="stylesheet" type="text/css"/>
    <script src='js/jquery-2.2.3.min.js'></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="text-center">Kart Visit.</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">


            <form action="HomeController.php" id="cartvisit" name="cartvisit"  method="post" enctype="multipart/form-data">
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2">

                            <p class="m-0">Bilgilerinizi Giriniz.</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="file"  class="form-control" id="resim" name="resim" placeholder="Resminizi Seçiniz." >
                            </div>
                        </div>
                        <!--Body-->
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text"  class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad ve Soyadı  Giriniz." >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="email" name="email" placeholder="baris@gmail.com" >
                            </div>
                        </div>
                        <input type="hidden" name="action" value="submit" />
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="tel" name="tel" placeholder="Telefon Giriniz." >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <select  id="select_id" onchange="ComboChange()">
                                   <?php
                                   $connection= new PDO('mysql:host=localhost;dbname=example2;charset=utf8', 'root', 'lordbys155');
                                   $sql="select * from tur";
                                   $sqlcommand=$connection->query($sql);
                                   $data=$sqlcommand->fetchAll();

                                   foreach ($data as $tur){

                                   ?>
                                    <option value="<?php echo $tur['TurId'] ?>"><?php echo $tur['TurAdi'] ?></option>

                                    <?php } ?>


                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="tur" id="tur" value="" />
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                </div>
                                <textarea class="form-control" id="adresbilgi" name="adresbilgi" placeholder="Adresinizi Giriniz." ></textarea>
                            </div>
                        </div>


                        <div class="text-center">
                            <input type="button" onclick="ValidetForm()"  name="cartvisit"  value="Oluştur"  class="btn btn-info btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form>
            <!--Form with header-->


        </div>
    </div>
</div>
<div class="container">
    <a style="margin-left: 500px" href="http://localhost/example1/admin.php">Admin Yönetim Paneli</a>
</div>

</body>

<script>

    $( document ).ready(function() {
        var selectedValue = document.getElementById("select_id").value;
        document.getElementById('tur').value=selectedValue;
    });

    function ComboChange() {
        var selectedValue = document.getElementById("select_id").value;
        document.getElementById('tur').value=selectedValue;
    }
    function ValidetForm() {

        var adsoyad=document.getElementById('adsoyad').value;
        if (!adsoyad){
            alertify.error("Adınızı giriniz.");
        }
        var resim=document.getElementById('resim').value;
        if(!resim){

            alertify.error("Resim Giriniz");

        }

        var imageMime=resim.split('.');
        if(imageMime[imageMime.length-1]!=="jpg"){
            alertify.error("Jpeg Formatında Giriniz");
        }

        var tel=document.getElementById('tel').value;
        if(!tel){
            alertify.error("Telefon Giriniz.");
        }

        var email=document.getElementById('email').value;
        if(!email){
            alertify.error("Email Giriniz.");
        }


        var adresbilgi=document.getElementById('adresbilgi').value;
        if(!adresbilgi){
            alertify.error("Adres  Giriniz.");
        }

        if(adsoyad && resim && tel && email && adresbilgi && imageMime[imageMime.length-1] ==="jpg"){
            var form=document.getElementById('cartvisit');
            form.submit();
        }
    }
</script>
</html>