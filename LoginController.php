<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 23.11.2018
 * Time: 09:29
 */


require 'PDOClass.php';


$connection= new DataBase();
if(isset($_POST['loginForm'])){


    $loginAraay=array("UserName"=>$_POST['UserName'],"UserPassword"=>$_POST['UserPassword']);
    $data= $connection->selectAnd('user',$loginAraay);

    if (!empty($data)) {
        session_start();
        $_SESSION['UserId']=$data[0]['UserId'];
        $_SESSION['UserPassword']=$data[0]['UserPassword'];
        $_SESSION['UserName']=$data[0]['UserName'];


        if($data[0]['UserAdmin']==1){
            Header("Location:http://localhost:63342/example1/AdminRezervation.php");
        }else{
            //Header("Location:http://localhost:63342/TaxiBooking/Home.php");
            Header("Location:http://localhost:63342/example1/home.php");
        }

        exit();

    }else{
        //Header('Location:https://bariscanakdag155.000webhostapp.com/Login.php?register=2');
        Header('Location:http://localhost:63342/example1/Login.php?register=2');
    }



}

if(isset($_POST['registerForm'])){

    $insertArray=array("UserName"=>$_POST['UserName'],"UserPassword"=>$_POST['UserPassword']);
    $checkArray=array("UserName"=>$_POST['UserName']);
    $checkUser= $connection->selectAnd('user',$checkArray);


    if(count($checkUser)==0){

        $insertResponse= $connection->insert("user",$insertArray);

        Header('Location:http://localhost:63342/example1/Login.php?register=0');
        exit();


    }else{
        Header('Location:http://localhost:63342/example1/Login.php?register=1');
        exit();
    }

}