<?php
session_start();

function login() {
    // POSTを変数に
    $email = $_POST['email'];
    $password = $_POST['password'];

    // データベースからアカウント情報を取得する
    try {
        $pdo = new PDO(
            'mysql:dbname=programming;host=localhost;charset=utf8mb4',
            'root',
            '',
        );
        $sql = "SELECT * FROM account WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $db = $stmt->fetch(PDO::FETCH_ASSOC);
        $db_email = $db['email'];
        $db_password = $db['password'];
        
        echo $db['email'];
    // ログイン成功の場合はセッションに渡す
        if (password_verify($password, $db_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['authority'] = $authority;

            // ログイン後のリダイレクト
            header("Location: http://localhost/diworks/programming/index.php");
            exit();
        } else {
            // パスワードが一致しない場合
            // エラーメッセージの表示
            session_destroy();
        }
    } catch (PDOException $e) {
        echo "接続エラー: " . $e->getMessage();
    }
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
    <header>
        <h1><img src=""></h1>
        <div class="menu">
            <ul>
                <li><a href="index.php">トップ</a></li>
                <li><a href="#">プロフィール</a></li>
                <li><a href="#">D.I.Blogについて</a></li>
                <li><a href="#">登録フォーム</a></li>
                <li><a href="#">問い合わせ</a></li>
                <li><a href="#">その他</a></li>
                <li><a href="regist.php">アカウント登録</a></li>
                <li><a href="list.php">アカウント一覧</a></li>
            </ul>
        </div>
    </header>
    <main>
        <h2>ログイン画面</h2>
        <form action="" method="POST">
            <div>
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" name="email" maxlength="100" value="" required>
            </div>
            <div>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" maxlength="10" value="" required>
            </div>
            <div>
                <input type="submit" value="ログイン">
            </div>
        </form>
        <?php if (isset($error) && $error) { ?>
            <p style="color: red;">エラーが発生したためログイン情報を取得できません。</p>
        <?php } ?>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>