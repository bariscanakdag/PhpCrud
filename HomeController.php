<?php
require 'PDOClass.php';
session_start();
$connection=new DataBase();


$check = getimagesize($_FILES["resim"]["tmp_name"]);
echo $_FILES["resim"]["size"];
if($check !== false) {
    if($check["mime"]!='image/jpeg'){
     echo   "LÜTFEN JPEG FORMATINDA YOLLAYINIZ.";
     echo  "</br>";
     echo "YOLLADIĞINIZ FORMAT : ". $check["mime"] ;
    };

} else {
    echo "Lütfen resim yükleyiniz.";

}

echo "</br>";

if ($_FILES["resim"]["size"] > 5000000) {
    echo "5MB'dan büyük dosyalar atılamaz.";

}
if(isset($_POST["action"]) && $_POST["action"] == "submit") {
    $today = date("dmY");
var_dump($_FILES["resim"]["name"]);
    $saat=date("his");
    $ctoday = date("d-m-Y");
    $csaat=date("h-i-s");

    $info = pathinfo($_FILES['resim']['name']);
    $ext = $info['extension']; // get the extension of the file
    $newname = $info['filename']."-".$today."-".$saat.".".$ext;
    $target = 'Image/'.$newname."";
    var_dump($_FILES['resim']['tmp_name']);
    move_uploaded_file( $_FILES['resim']['tmp_name'], $target);
   $userId=$_SESSION['UserId'];

    $lines=  $_POST['adresbilgi'].";".$_POST['adsoyad'].";".$userId.";".$_POST['email'].";".$newname.";".$_POST['tur'].";".$target.";".$csaat.";".$ctoday.";".$_POST['tel']."\r";

   $myfile=fopen("kayit.txt","a+");
   fwrite($myfile,$lines);
    fclose($myfile);


    $kartArray=array(
        "Adres"=>$_POST['adresbilgi'],
        "AdSoyad"=>$_POST['adsoyad'],
        "CreatedUser"=>$userId,
        "Mail"=>$_POST['email'],
        "ResimAd"=>$newname,
        "ResimTür"=>$_POST['tur'],
        "ResimYol"=>$target,
        "Saat"=>$csaat,
        "Tarih"=>$ctoday,
        "Telefon"=>$_POST['tel'] );


    $data=$connection->insert('kart',$kartArray);

   Header("Location:http://localhost:63342/example1/VisiblePhoto.php?selectedId=1");


}
