<?php
require 'PDOClass.php';
$connection= new DataBase();
echo  "burada";
if(isset($_POST["action"]) && $_POST["action"] == "submit") {
    echo $_POST['tur'];

    $kartArray=array(
        "TurAdi"=>$_POST['tur'] );

    $data=$connection->insert('tur',$kartArray);


     Header("Location:http://localhost/example1/admin.php");


}
