<?php
    $pdo = new PDO(
        'mysql:dbname=programming;host=localhost;charset=utf8mb4',
        'root',
        '',
    );

$pdo->exec("insert into registration(handlename,title,comments)
values('".$_POST['handlename']."','".$_POST['title']."','".$_POST['comments']."');");

header("Location:http://localhost/diworks/registration/regist.php");

?>