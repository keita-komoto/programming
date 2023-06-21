<?php

session_start();

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
        <div class="regist">
            <div class="regist-contents">
                <h2>エラー</h2>
                <div class="kanryo">
                    <h3 class="error">
                        <?php if (isset($_GET['st'])){
                            if ($_GET['st'] == "err" ) {
                                echo "データの呼び出しに失敗しました";
                            } elseif ($_GET['st'] == "confirm") {
                                echo "データの呼び出しに失敗しました";
                            }
                        } else {
                            echo "エラー画面";
                        }
                        ?>
                    </h3>
                </div>

                <div class="btn-box">
                    <form method="post" action="list.php">
                        <input type="submit" class="submit" value="一覧へ戻る">
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