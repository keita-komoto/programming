<?php
session_start();
if (isset($_SESSION['login_auth'])) {
    if (!$_SESSION['login_auth'] == 1) {
        header("Location:http://localhost/diworks/programming/fail.php?st=authority");
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント削除</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_reg.css">
</head>
<body>
    <?php include(dirname(__FILE__).'/common/header.php'); ?>
    <main>
        <div class="regist">
            <div class="regist-contents">
                <h2>アカウント削除完了画面</h2>
                <div class="kanryo">
                    <?php if(isset($_GET['success'])) {
                        echo "<h3 class=\"dai\">登録完了しました</h3>";
                    } else {
                        echo '<h3 class="error">エラーが発生したためアカウント削除できません。</h3>';
                    } ?>
                </div>
                <div class="btn-box">
                    <form method="post" action="index.php">
                        <input type="submit" class="submit" name="submit" value="TOPへ戻る">
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