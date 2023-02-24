<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['text'])) {
    $isset_status = 'POSTED, isset() True';
    $text_value = $_POST['text'];
  } else {
    $isset_status = 'POSTED, isset() False';
    $text_value = '';
  }
} else {
  $isset_status = 'started without POST';
  $text_value = '';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント登録</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_reg.css">
</head>
<body>
    <?php
    $pdo = new PDO(
        'mysql:dbname=programming;host=localhost;charset=utf8mb4',
        'root',
        '',
    );
    $stmt = $pdo->query("SELECT * FROM account");
    ?>

    <header>
        <h1><img src=""></h1>
        <div class="menu">
            <ul>
                <li><a href="#">トップ</a></li>
                <li><a href="#">プロフィール</a></li>
                <li><a href="#">D.I.Blogについて</a></li>
                <li><a href="#">登録フォーム</a></li>
                <li><a href="#">問い合わせ</a></li>
                <li><a href="#">アカウント登録</a></li>
                <li><a href="#">その他</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="regist">
            <div class="regist-contents">
                <h2>プログラミングに役立つ掲示板</h2>
                <div class="reg_container">
                    <h3 class="ttl">アカウント登録画面</h3>
                    <form method="post" action="reg_insert.php">
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name" maxlength="10" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name" maxlength="10" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>カナ（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name_kana" maxlength="10" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>カナ（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name_kana" maxlength="10" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>メールアドレス</label>
                            </div>
                            <div class="reg_right">
                                <input type="email" class="text" name="mail" maxlength="100" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>パスワード</label>
                            </div>
                            <div class="reg_right">
                                <input type="password" class="text" name="password" maxlength="100" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label></label>
                            </div>
                            <div class="reg_right">
                                <input type="password" class="text" name="password" maxlength="100" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>パスワード</label>
                            </div>
                            <div class="reg_right">
                                <input type="password" class="text" name="password" maxlength="100" required>
                            </div>
                        </div>



                        <div>
                            <input type="submit" class="submit" value="投稿する">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>

    </footer>
</body>
</html>