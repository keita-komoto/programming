<?php
session_start();
function myExceptionHandler ($e) {
    header("Location:http://localhost/diworks/programming/update_complete.php");
}
set_exception_handler('myExceptionHandler');


extract($_POST, $flags = EXTR_OVERWRITE, $prefix = "");
echo $id;
$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    ''
);
$hash = password_hash($password, PASSWORD_DEFAULT);
date_default_timezone_set('Asia/Tokyo');
$date = date('Y-m-d H:i:s');

$sql = "UPDATE account SET family_name = :family_name, last_name = :last_name, family_name_kana = :family_name_kana, last_name_kana = :last_name_kana, mail = :mail, `password` = :password, gender = :gender, postal_code = :postal_code, prefecture = :prefecture, address_1 = :address_1, address_2 = :address_2, authority = :authority, delete_flag = :delete_flag, update_time = :update_time WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':family_name', $family_name);
$stmt->bindValue(':last_name', $last_name);
$stmt->bindValue(':family_name_kana', $family_name_kana);
$stmt->bindValue(':last_name_kana', $last_name_kana);
$stmt->bindValue(':mail', $mail);
$stmt->bindValue(':password', $hash);
$stmt->bindValue(':gender', $gender);
$stmt->bindValue(':postal_code', $postal_code);
$stmt->bindValue(':prefecture', $prefecture);
$stmt->bindValue(':address_1', $address_1);
$stmt->bindValue(':address_2', $address_2);
$stmt->bindValue(':authority', $authority);
$stmt->bindValue(':delete_flag', '0');
$stmt->bindValue(':update_time', $date);
$stmt->bindValue(':id', $id);

$stmt->execute();

header("Location: http://localhost/diworks/programming/update_complete.php?success=1");
exit;
?>