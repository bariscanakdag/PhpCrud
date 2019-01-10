<?php require_once 'PDOClass.php';
ob_start();
session_start();
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
    <h2 class="text-center">Tür Oluşturunuz.</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">


            <form action="admincontroller.php" id="cartvisit" name="cartvisit" method="post" >
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2">

                            <p class="m-0">Tür Seçiniz.</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text"  class="form-control" id="tur" name="tur" placeholder="Albüm türünü giriniz." >
                            </div>
                        </div>
                        <!--Body-->
                        <input type="hidden" name="action" value="submit" />

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
    <a style="margin-left: 500px" href="http://localhost/example1/home.php">Anasayfa</a>
</div>

</body>

<script>
    function ValidetForm() {

        var tur=document.getElementById('tur').value;
        if (!tur){
            alertify.error("Adınızı giriniz.");
        }



        if(tur){
            var form=document.getElementById('cartvisit');
            document.getElementById('tur').value=tur;
            form.submit();
        }
    }
</script>
</html>