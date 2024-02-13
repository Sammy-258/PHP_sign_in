<?php
session_start();

if(isset($_SESSION["google_account_info"])){
    var_dump($_SESSION["google_account_info"]);
}else{
    header("location: index.php");
}


