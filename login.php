<?php
session_start();
if (isset($_SESSION['login_auth'])) {
    if (!$_SESSION['login_auth'] == 1) {
        header("Location:http://localhost/diworks/programming/fail.php?st=authority");
    }
}
function login() {
    // POSTを変数に
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // データベースからアカウント情報を取得する
    try {
        $pdo = new PDO(
            'mysql:dbname=programming;host=localhost;charset=utf8mb4',
            'root',
            '',
        );
        $sql = "SELECT * FROM account WHERE mail = :mail AND delete_flag = 0";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $db = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($db)) {
            var_dump($db);
            $db_password = $db['password'];

            // ログイン成功の場合はセッションに渡す
            if (password_verify( $password, $db_password,)) {
                $_SESSION['login_id'] = $db['id'];
                $_SESSION['login_auth'] = $db['authority'];
                // ログイン後のリダイレクト
                header("Location: http://localhost/diworks/programming/index.php");
                exit();
            } else {
                // パスワードが一致しない場合
                $error = "パスワードが一致しませんでした";
                return $error;
            }
        } else {
        // レコードが存在しない場合の処理
        $error = "メールアドレスが見つかりませんでした";
        return $error;
        //var_dump($error);
        }
    } catch (PDOException $error) {
        $error = "エラーが発生したためログイン情報を取得できません。";
        return $error;
    }
    //var_dump($db);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    login();
    $error = login();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント一覧</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_reg.css">
    <link rel="stylesheet" type="text/css" href="style_list.css">
</head>
<body>
    <?php include(dirname(__FILE__).'/common/header.php'); ?>
    <main>
        <h2>ログイン画面</h2>
        <div class="login">
            <form  action="" method="POST">
                <div>
                    <label for="mail" >メールアドレス</label>
                    <input type="mail" id="mail" name="mail" maxlength="100" value="<?php if(isset($_POST['mail'])){echo $_POST['mail']; } ?>" required>
                </div>
                <div>
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" maxlength="10" value="" required>
                </div>
                <div>
                    <input type="submit" class="submit" value="ログイン">
                </div>
                <div>
                    <?php if (isset($error)) { 
                        echo $error;
                    } ?>
                </div>
            </form>
        </div>

    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>