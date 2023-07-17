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
    <?php include(dirname(__FILE__).'/common/header.php'); ?>
    <main>
        <div class="regist">
            <div class="regist-contents">
                <h2>エラー</h2>
                <div class="kanryo">
                    <h3 class="error">
                        <?php if (isset($_GET['st'])) {
                            if ($_GET['st'] == "err" ) {
                                echo "データベースの接続に失敗しました";
                            } elseif ($_GET['st'] == "confirm") {
                                echo "データの呼び出しに失敗しました";
                            } elseif ($_GET['st'] == "authority") {
                                echo "権限がありません";
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