<?php
session_start();

/* 会員登録の手続き以外のアクセスを飛ばす */
if (!isset($_SESSION['join'])) {
    header('Location: regist.php');
    exit();
}

$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    '',
);

$hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);

print_r($pdo -> errorInfo());
$pdo -> exec("INSERT INTO account(family_name,last_name,family_name_kana,last_name_kana,
    mail,$hash,gender,
    postal_code,prefecture,address_1,address_2,
    authority)
values(
    '".$_SESSION['join']['family_name']."','".$_POST['last_name']."','".$_POST['family_name_kana']."','".$_POST['last_name_kana']."',
    '".$_POST['mail']."','.$hash.','".$_POST['gender']."',
    '".$_POST['postal_code']."','".$_POST['prefecture']."','".$_POST['address_1']."','".$_POST['address_2']."',
    '".$_POST['authority']."');"
);
print_r($pdo -> errorInfo());

header("Location:http://localhost/diworks/registration/regist.php");

?>