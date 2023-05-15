<?php
session_start();



$pref_array = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県', '新潟県','富山県','石川県','福井県', '茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');   
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント登録</title>
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
        <?php 
            // 遷移前ページから渡されたIDを取得
            $id = $_GET['id'];
            $pdo = new PDO(
                'mysql:dbname=programming;host=localhost;charset=utf8mb4',
                'root',
                '',
                );
            // アカウント情報を取得するクエリを準備
            $sql = 'SELECT * FROM account WHERE id = :id AND delete_flag = 0';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // クエリを実行
            $stmt->execute();

            // 結果を取得
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // 取得したアカウント情報を表示
            if ($user) {
            echo '名前（姓）　' . $user['family_name'] . '<br>';
            echo '名前（名）　' . $user['last_name'] . '<br>';
            echo 'カナ（姓）　' . $user['family_name_kana'] . '<br>';
            echo 'カナ（名）　' . $user['last_name_kana'] . '<br>';
            echo 'メールアドレス　' . $user['mail'] . '<br>';
            echo 'パスワード　' . "●●●●" . '<br>';
            echo '性別　' . $user['gender'] . '<br>';
            echo '郵便番号　' . $user['postal_code'] . '<br>';
            echo '住所（都道府県）　' . $user['prefecture'] . '<br>';
            echo '住所（市区町村）　' . $user['address_1'] . '<br>';
            echo '住所（番地）　' . $user['address_2'] . '<br>';
            echo 'アカウント権限　' . $user['authority'] . '<br>';
            } else {
            echo 'アカウントが見つかりませんでした。';
        } ?>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>