<?php
session_start();

if(isset($_GET['edit']) && $_GET['edit'] == 1) {
    // 遷移前ページから渡されたIDを取得
        $pdo = new PDO(
            'mysql:dbname=programming;host=localhost;charset=utf8mb4',
            'root',
            '',
        );
        $id = $_POST['id'];
        // アカウント情報を取得するクエリを準備
        $sql = 'SELECT * FROM account WHERE id = :id AND delete_flag = 0';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // クエリを実行
        $stmt->execute();
        // 結果を取得
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        // 結果を変数へ展開
        extract($account, $flags = EXTR_OVERWRITE, $prefix = "");
} else {
    extract($_POST, $flags = EXTR_OVERWRITE, $prefix = "");
}

//バリデーションパターン
$name_pt = "/^[ぁ-んー一-龠]+$/u";
$kana_pt = "/^[ァ-ヶー]+$/u";
//空欄許可
$pw_pt = "/^[a-zA-Z0-9]*$/";
$mail_pt = "/^[a-zA-Z0-9@.-]+$/";
$post_pt = "/^[0-9]{3}([0-9]{4})?$/";
$adrs_pt = "/^[0-9０-９ぁ-んァ-ヶー一-龠　－\-\s]+$/u";

//登録ボタンが押されたら
if(isset($_POST['submit2'])) {
    extract($_POST, $flags = EXTR_OVERWRITE, $prefix = "");
    //エラー内容
    $errors = [];
    if (isset($family_name) && $family_name === '') {
        $errors['family_name'] = "名前（姓）が未入力です";
    } elseif (preg_match($name_pt, $family_name) === 0 ) { 
        $errors['family_name'] = "ひらがなと漢字で入力してください";
    }
    if (isset($last_name) && $last_name === '') {
        $errors['last_name'] = "名前（名）が未入力です";
    } elseif (preg_match($name_pt, $last_name) === 0 ) { 
        $errors['last_name'] = "ひらがなと漢字で入力してください";
    }
    if (isset($family_name_kana) && $family_name_kana === '') {
        $errors['family_name_kana'] = "カナ（姓）が未入力です";
    } elseif (preg_match($kana_pt, $family_name_kana) === 0 ) { 
        $errors['family_name_kana'] = "全角カタカナで入力してください";
    }
    if (isset($last_name_kana) && $last_name_kana === '') {
        $errors['last_name_kana'] = "カナ（名）が未入力です";
    } elseif (preg_match($kana_pt, $last_name_kana) === 0 ) { 
        $errors['last_name_kana'] = "全角カタカナで入力してください";
    }
    if (preg_match($pw_pt, $password) === 0 ) { 
        $errors['password'] = "パスワードは英数字のみ使用可能です";
    }
    if (isset($mail) && $mail === '') {
        $errors['mail'] = "メールアドレスが未入力です";
    } elseif (preg_match($mail_pt, $mail) === 0 ) { 
        $errors['mail'] = "メールアドレスは英数字と一部の記号のみ使用可能です";
    }
    if (isset($postal_code) && $postal_code === '') {
        $errors['postal_code'] = "郵便番号が未入力です";
    } elseif (preg_match($post_pt, $postal_code) === 0 ) { 
        $errors['postal_code'] = "郵便番号は半角数字3桁か7桁で入力してください";
    }
    if (isset($prefecture) && $prefecture === ''){
        $errors['prefecture'] = "都道府県が未選択です";
    }
    if (isset($address_1) && $address_1 === '') {
        $errors['address_1'] = "住所（市区町村）が未入力です";
    } elseif (preg_match($adrs_pt, $address_1) === 0 ) { 
        $errors['address_1'] = "住所（市区町村）は、ひらがな、漢字、数字、カタカナと一部の記号が使用可能です";
    }
    if (isset($address_2) && $address_2 === '') {
        $errors['address_2'] = "住所（番地）が未入力です";
    } elseif (preg_match($adrs_pt, $address_2) === 0 ) { 
        $errors['address_2'] = "住所（番地）は、ひらがな、漢字、数字、カタカナと一部の記号が使用可能です";
    }
    //エラーなければ確認画面へ
    if(count($errors) === 0 ) {
        //POSTを格納しないと次に渡せない
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
        header("Location:http://localhost/diworks/programming/update_confirm.php");
    }   
}

$pref_array = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県', '新潟県','富山県','石川県','福井県', '茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');   
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント更新</title>
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
                <h2>アカウント更新画面</h2>
                <div class="reg-container">
                    <form method="post" action="update.php">
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name" maxlength="10" autocomplete="family-name"
                                value="<?php if(isset($family_name)) {echo $family_name ;} ?>">
                                <?php if(isset($errors['family_name'])) {
                                     echo "<br><label>".$errors['family_name']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name" maxlength="10" autocomplete="given-name"
                                value="<?php if(isset($last_name)) {echo $last_name ;} ?>">
                                <?php if(isset($errors['last_name'])) {
                                     echo "<br><label>".$errors['last_name']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>カナ（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name_kana" maxlength="10"
                                value="<?php if(isset($family_name_kana)) {echo $family_name_kana ;} ?>">
                                <?php if(isset($errors['family_name_kana'])) {
                                     echo "<br><label>".$errors['family_name_kana']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>カナ（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name_kana" maxlength="10"
                                value="<?php if(isset($last_name_kana)) {echo $last_name_kana ;} ?>">
                                <?php if(isset($errors['last_name_kana'])) {
                                     echo "<br><label>".$errors['last_name_kana']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>メールアドレス</label>
                            </div>
                            <div class="reg_right">
                                <input type="email" class="text" name="mail" maxlength="100" title="メールアドレスの形式で入力してください。"
                                value="<?php if(isset($mail)) {echo $mail ;} ?>">
                                <?php if(isset($errors['mail'])) {
                                     echo "<br><label>".$errors['mail']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>パスワード</label>
                            </div>
                            <div class="reg_right">
                                <input type="password" class="text" name="password" maxlength="10"
                                value="<?php 
                                if(isset($_GET['edit']) && $_GET['edit'] == 1) {
                                    echo "";
                                } else {
                                    echo $password;
                                } ?>">
                                <?php if(isset($errors['password'])) {
                                     echo "<br><label>".$errors['password']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>性別</label>
                            </div>
                            <div class="reg_right">
                                <input type="radio" class="radio" name="gender" value="0" <?php if(isset($gender) && $gender == 0) {
                                    echo "checked";
                                } elseif (isset($gender) && $gender == 1) {
                                    echo "";
                                } else {
                                    echo "checked";
                                } ?>>男
                                <input type="radio" class="radio" name="gender" value="1" <?php if(isset($gender) && $gender == 1) { echo "checked";
                                } ?>>女
                                <?php if(isset($errors['gender'])) {
                                     echo "<br><label>".$errors['gender']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>郵便番号</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="postal_code" maxlength="7"
                                value="<?php if(isset($postal_code)) {echo $postal_code ;} ?>">
                                <?php if(isset($errors['postal_code'])) {
                                     echo "<br><label>".$errors['postal_code']."</label>";
                                } ?>
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
                                    echo '<option value="'.$i.'"';
                                    if(isset($prefecture) && $prefecture == $i) {
                                        echo 'selected';
                                    };
                                    echo '>';
                                    echo $pref_array[$i];
                                    echo '</option>';
                                }
                                ?> 
                                </select>
                                <?php if(isset($errors['prefecture'])) {
                                     echo "<br><label>".$errors['prefecture']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（市区町村）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="address_1" maxlength="10"
                                value="<?php if(isset($address_1)) {echo $address_1 ;} ?>">
                                <?php if(isset($errors['address_1'])) {
                                     echo "<br><label>".$errors['address_1']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（番地）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="address_2" maxlength="100"
                                value="<?php if(isset($address_2)) {echo $address_2 ;} ?>">
                                <?php if(isset($errors['address_2'])) {
                                     echo "<br><label>".$errors['address_2']."</label>";
                                } ?>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>アカウント権限</label>
                            </div>
                            <div class="reg_right">
                                <select name="authority">
                                    <option value="0" <?php if(isset($authority) && $authority == 0 ){echo 'selected';} ?> >一般</option>
                                    <option value="1" <?php if(isset($authority) && $authority == 1 ){echo 'selected';} ?> >管理者</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn-box">
                            <input type="hidden" value="<?php echo $id ;?>" name="id">
                            <input type="submit" class="submit" name="submit2" value="確認する">
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