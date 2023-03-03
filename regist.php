<?php
session_start();

if (!empty($_POST)) {
    /* 入力情報の不備を検知 */
    if ($_POST['family_name'] === "") {
        $error['family_name'] = "blank";
    }
    if ($_POST['last_name'] === "") {
        $error['last_name'] = "blank";
    }
    /* エラーがなければ次のページへ */
    if (!isset($error)) {
        $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
        header('Location: regist_confirm.php');   // regist_confirm.phpへ移動
        exit();
    }
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
    $pref_array = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県', '新潟県','富山県','石川県','福井県', '茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');   
    ?>

    <header>
        <h1><img src=""></h1>
        <div class="menu">
            <ul>
                <li><a href="index.php">トップ</a></li>
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
        <div class="regist">
            <div class="regist-contents">
                <h2>アカウント登録画面</h2>
                <div class="reg_container">
                    <form method="post" action="regist_confirm.php">
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name" maxlength="10" autocomplete="family-name">
                                <?php if (!empty($error["family_name"]) && $error['family_name'] === 'blank'): ?>
                                    <p class="error">名前（姓）が未入力です。</p>
                                <?php endif ?>
                                <!-- <input type="text" class="text" name="family_name" maxlength="10" autocomplete="family-name" value="<?php echo $_POST['family_name'] ?>" required> -->
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name" maxlength="10" autocomplete="given-name" required>
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
                                <input type="password" class="text" name="password" maxlength="10" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>性別</label>
                            </div>
                            <div class="reg_right">
                                <input type="radio" class="radio" name="gender" value="0" required checked>男
                                <input type="radio" class="radio" name="gender" value="1" required>女
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>郵便番号</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="postal_code" maxlength="7" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（都道府県）</label>
                            </div>
                            <div class="reg_right">
                                <select name="prefecture">
                                    <option value="" selected></option>
                                    <?php for($i = 0; $i < 47; $i++ ) {
                                        echo "<option value='$i'>";
                                        echo $pref_array[$i];
                                        echo '</option>';
                                    };
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（市区町村）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="address_1" maxlength="10" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（番地）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="address_2" maxlength="100" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>アカウント権限</label>
                            </div>
                            <div class="reg_right">
                                <select name="authority">
                                    <option value="0" selected>一般</option>
                                    <option value="1">管理者</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="submit" value="確認する">
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