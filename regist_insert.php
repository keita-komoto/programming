<?php
$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    '',
);
print_r($pdo -> errorInfo());
$pdo -> exec("INSERT INTO account(family_name,last_name,family_name_kana,last_name_kana,
    mail,`password`,gender,
    postal_code,prefecture,address_1,address_2,
    authority)
values(
    '".$_POST['family_name']."','".$_POST['last_name']."','".$_POST['family_name_kana']."','".$_POST['last_name_kana']."',
    '".$_POST['mail']."','".$_POST['password']."','".$_POST['gender']."',
    '".$_POST['postal_code']."','".$_POST['prefecture']."','".$_POST['address_1']."','".$_POST['address_2']."',
    '".$_POST['authority']."');"
);
print_r($pdo -> errorInfo());

header("Location:http://localhost/diworks/registration/regist.php");

?>