<?php
$pdo = new PDO(
    'mysql:dbname=lesson01;host=localhost;charset=utf8mb4',
    'root',
    '',
);

$pdo->exec("insert into diworks_keijiban(handlename,title,comments)
values('".$_POST['handlename']."','".$_POST['title']."','".$_POST['comments']."');");

header("Location:http://localhost/diworks_keijiban/index.php");

?>