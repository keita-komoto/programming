<?php
session_start();

function myExceptionHandler ($e) {
    header("Location:http://localhost/diworks/programming/delete_complete.php?");
}
set_exception_handler('myExceptionHandler');


if(isset($_POST['id'])) {
    $id = $_POST['id'];
}
$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    '',
    );
    $sql = 'UPDATE account SET delete_flag = 1 WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location:http://localhost/diworks/programming/delete_complete.php?success=1");
?>
