<?php
session_start();
function myExceptionHandler ($e) {
    header("Location:http://localhost/diworks/programming/regist_fail.php");
}
set_exception_handler('myExceptionHandler');



if ( isset($_SESSION['family_name'])){
    $family_name = $_SESSION['family_name'];
    $last_name = $_SESSION['last_name'];
    $family_name_kana = $_SESSION['family_name_kana'];
    $last_name_kana = $_SESSION['last_name_kana'];
    $mail = $_SESSION['mail'];
    $password = $_SESSION['password'];
    $gender = $_SESSION['gender'];
    $postal_code = $_SESSION['postal_code'];
    $prefecture = $_SESSION['prefecture'];
    $address_1 = $_SESSION['address_1'];
    $address_2 = $_SESSION['address_2'];
    $authority = $_SESSION['authority'];
}
$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    '',
    );
    $hash = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');
    $pdo -> exec("INSERT INTO account(family_name,last_name,family_name_kana,last_name_kana,
        mail,`password`,gender,
        postal_code,prefecture,address_1,address_2,
        authority,
        delete_flag,registered_time)
    values(
        '".$_SESSION['family_name']."','".$_SESSION['last_name']."','".$_SESSION['family_name_kana']."','".$_SESSION['last_name_kana']."',
        '".$_SESSION['mail']."','.$hash.','".$_SESSION['gender']."',
        '".$_SESSION['postal_code']."','".$_SESSION['prefecture']."','".$_SESSION['address_1']."','".$_SESSION['address_2']."',
        '".$_SESSION['authority']."',
        '"."0"."','".$date."');"
    );
    header("Location:http://localhost/diworks/programming/regist_complete.php");
?>
