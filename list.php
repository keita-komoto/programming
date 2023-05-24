<?php

$pdo = new PDO(
    'mysql:dbname=programming;host=localhost;charset=utf8mb4',
    'root',
    '',
);
$sql = 'SELECT * FROM account WHERE delete_flag = 0 ORDER BY id DESC';
$stmt = $pdo->query($sql);

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
        <h2>アカウント一覧</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>名前（姓）</th>
                <th>名前（名）</th>
                <th>カナ（姓）</th>
                <th>カナ（名）</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>アカウント権限</th>
                <th>削除フラグ</th>
                <th>登録日時</th>
                <th>更新日時</th>
                <th colspan="2">操作</th>
            </tr>
            <?php 
            while ($account = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $account['id'] . '</td>';
                echo '<td>' . $account['family_name'] . '</td>';
                echo '<td>' . $account['last_name'] . '</td>';
                echo '<td>' . $account['family_name_kana'] . '</td>';
                echo '<td>' . $account['last_name_kana'] . '</td>';
                echo '<td class="mail">' . $account['mail'] . '</td>';
                echo '<td>' . ($account['gender'] == 0 ? '男' : '女') . '</td>';
                echo '<td>' . ($account['authority'] == 0 ? '一般' : '管理者') . '</td>';
                echo '<td>' . ($account['delete_flag'] == 0 ? '有効' : '無効') . '</td>';
                echo '<td>' . date('Y/m/d', strtotime($account['registered_time'])) . '</td>';
                echo '<td>';
                if ($account['update_time'] == '0000-00-00 00:00:00') {
                    echo '更新履歴なし';
                } else {
                    echo date('Y/m/d', strtotime($account['update_time']));
                }
                echo '</td>';
                echo '<td>
                    <form method="post" action="update.php?edit=1">
                        <input type="hidden" value="' . $account['id'] . '" name="id">               
                        <input type="submit" class="submit" name="submit" value="確認する">
                    </form>
                </td>';
                echo '<td>
                    <form method="post" action="delete.php">
                        <input type="hidden" value="' . $account['id'] . '" name="id">               
                        <input type="submit" class="submit" name="submit" value="削除する">
                    </form>
                </td>';
                echo '</tr>';
            }
            $pdo = null; ?>
        </table>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>