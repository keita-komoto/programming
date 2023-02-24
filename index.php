<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog 掲示板</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $pdo = new PDO(
        'mysql:dbname=lesson01;host=localhost;charset=utf8mb4',
        'root',
        '',
    );
    $stmt = $pdo->query("SELECT * FROM diworks_keijiban");
    ?>

    <header>
        <h1><img src="diblog_logo.jpg"></h1>
        <div class="menu">
            <ul>
                <li><a href="#">トップ</a></li>
                <li><a href="#">プロフィール</a></li>
                <li><a href="#">D.I.Blogについて</a></li>
                <li><a href="#">登録フォーム</a></li>
                <li><a href="#">問い合わせ</a></li>
                <li><a href="regist.php">アカウント登録</a></li>
                <li><a href="#">その他</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="twoclm">
            <div class="box left">
                <h2>プログラミングに役立つ掲示板</h2>
                <div class="kakiko-box">
                    <h3 class="kakiko-title">入力フォーム</h3>
                    <form method="post" action="insert.php">
                        <div>
                            <label>ハンドルネーム</label><br>
                            <input type="text" class="text" name="handlename">
                        </div>
                        <div>
                            <label>タイトル</label><br>
                            <input type="text" class="text" name="title">
                        </div>
                        <div>
                            <label>コメント</label><br>
                            <textarea cols="35" rows="7" name="comments"></textarea>
                        </div>
                        <div>
                            <input type="submit" class="submit" value="投稿する">
                        </div>
                    </form>
                </div>
                <?php
                while($row = $stmt->fetch()){
                    echo "<div class='kiji'>";
                    echo "<h4>".$row['title']."</h4>";
                    echo "<div class='contents'>";
                    echo $row['comments'];
                    echo "<div class='handlename'>posted by ".$row['handlename']."</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="box right">
                <div class="popular">
                    <p class="mokuji">人気の記事</p>
                    <ul>
                        <li>PHPオススメ本</li>
                        <li>PHP MyAdminの使い方</li>
                        <li>いま人気のエディタTops</li>
                        <li>HTMLの基礎</li>
                    </ul>
                </div>
                <div class="recommend">
                    <p class="mokuji">オススメリンク</p>
                    <ul>
                        <li>ディーアイワークス株式会社</li>
                        <li>XAMMPのダウンロード</li>
                        <li>Eclipseのダウンロード</li>
                        <li>Braketsのダウンロード</li>
                    </ul>
                </div>
                <div class="category">
                    <p class="mokuji">カテゴリ</p>
                    <ul>
                        <li>HTML</li>
                        <li>PHP</li>
                        <li>MySQL</li>
                        <li>JavaScript</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>

    </footer>
</body>
</html>