<?php
session_start();

$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    '',
);
$hash = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

print_r($pdo -> errorInfo());
$pdo -> exec("INSERT INTO account(family_name,last_name,family_name_kana,last_name_kana,
    mail,`password`,gender,
    postal_code,prefecture,address_1,address_2,
    authority)
values(
    '".$_SESSION['family_name']."','".$_SESSION['last_name']."','".$_SESSION['family_name_kana']."','".$_SESSION['last_name_kana']."',
    '".$_SESSION['mail']."','.$hash.','".$_SESSION['gender']."',
    '".$_SESSION['postal_code']."','".$_SESSION['prefecture']."','".$_SESSION['address_1']."','".$_SESSION['address_2']."',
    '".$_SESSION['authority']."');"
);
print_r($pdo -> errorInfo());

header("Location:http://localhost/diworks/programming/regist_complete.php");

?>