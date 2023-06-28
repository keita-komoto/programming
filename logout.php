<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog エラー</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_reg.css">
</head>
<body>
    <?php include(dirname(__FILE__).'/common/header.php'); ?>
    <main>
        <div class="logout_box">
            <div class="logout-contents">
                <h2>ログアウト画面</h2>
                <div class="logout">
                    <h3 class="logout_title">
                        ログアウトしました
                    </h3>
                </div>

                <div class="btn-box">
                    <form method="post" action="index.php">
                        <input type="submit" class="submit" value="TOPへ戻る">
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