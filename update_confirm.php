<?php
session_start();
if(isset($_SESSION['family_name'])){
    extract($_SESSION, $flags = EXTR_OVERWRITE, $prefix = "");
} else {
    header("Location:http://localhost/diworks/programming/update_fail.php?");
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
                <li><a href="regist.php">アカウント登録</a></li>
                <li><a href="#">その他</a></li>
            </ul>
        </div>
    </header>
    <main>
        <h2>アカウント更新確認画面</h2>
        <div class="confirm">
            <div class="reg_box">
                <div class="reg_left">
                    <label>名前（姓）</label>
                </div>
                <div class="reg_right">
                    <?php echo $family_name ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>名前（名）</label>
                </div>
                <div class="reg_right">
                    <?php echo $last_name ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>カナ（姓）</label>
                </div>
                <div class="reg_right">
                    <?php echo $family_name_kana ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>カナ（名）</label>
                </div>
                <div class="reg_right">
                    <?php echo $last_name_kana ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>メールアドレス</label>
                </div>
                <div class="reg_right">
                    <?php echo $mail ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>パスワード</label>
                </div>
                <div class="reg_right">
                    <?php if (empty($password)){
                        echo "変更なし";
                    } else { for ($i = 0; $i < mb_strlen($password); $i++){
                        echo "●";
                    }} ?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>性別</label>
                </div>
                <div class="reg_right">
                    <?php if( $gender === "0") {
                        echo '男性';
                    } else {
                        echo '女性';
                    }; ?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>郵便番号</label>
                </div>
                <div class="reg_right">
                    <?php echo $postal_code ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>住所（都道府県）</label>
                </div>
                <div class="reg_right">
                    <?php echo $pref_array[$prefecture] ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>住所（市区町村）</label>
                </div>
                <div class="reg_right">
                    <?php echo $address_1 ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>住所（番地）</label>
                </div>  
                <div class="reg_right">
                    <?php echo $address_2 ;?>
                </div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>アカウント権限</label>
                </div>
                <div class="reg_right">
                    <?php if( $authority === "0") {
                        echo '一般';
                    } else {
                        echo '管理者';
                    }; ?>
                </div>
            </div>
            <div class="btn-box">
                <form method="post" action="update.php?edit=0">
                    <input type="hidden" value="<?php echo $family_name ;?>" name="family_name">
                    <input type="hidden" value="<?php echo $last_name ;?>" name="last_name">
                    <input type="hidden" value="<?php echo $family_name_kana ;?>" name="family_name_kana">
                    <input type="hidden" value="<?php echo $last_name_kana ;?>" name="last_name_kana">
                    <input type="hidden" value="<?php echo $mail ;?>" name="mail">
                    <input type="hidden" value="<?php echo $password ;?>" name="password">
                    <input type="hidden" value="<?php echo $gender ;?>" name="gender">
                    <input type="hidden" value="<?php echo $postal_code ;?>" name="postal_code">
                    <input type="hidden" value="<?php echo $prefecture ;?>" name="prefecture">
                    <input type="hidden" value="<?php echo $address_1 ;?>" name="address_1">
                    <input type="hidden" value="<?php echo $address_2 ;?>" name="address_2">
                    <input type="hidden" value="<?php echo $authority ;?>" name="authority">
                    <input type="hidden" value="<?php echo $id ;?>" name="id">
                    <input type="submit" class="submit" name="submit" value="前に戻る">
                </form>
                <form method="post" action="update_insert.php">
                    <input type="hidden" value="<?php echo $family_name ;?>" name="family_name">
                    <input type="hidden" value="<?php echo $last_name ;?>" name="last_name">
                    <input type="hidden" value="<?php echo $family_name_kana ;?>" name="family_name_kana">
                    <input type="hidden" value="<?php echo $last_name_kana ;?>" name="last_name_kana">
                    <input type="hidden" value="<?php echo $mail ;?>" name="mail">
                    <input type="hidden" value="<?php echo $password ;?>" name="password">
                    <input type="hidden" value="<?php echo $gender ;?>" name="gender">
                    <input type="hidden" value="<?php echo $postal_code ;?>" name="postal_code">
                    <input type="hidden" value="<?php echo $prefecture ;?>" name="prefecture">
                    <input type="hidden" value="<?php echo $address_1 ;?>" name="address_1">
                    <input type="hidden" value="<?php echo $address_2 ;?>" name="address_2">
                    <input type="hidden" value="<?php echo $authority ;?>" name="authority">
                    <input type="hidden" value="<?php echo $id ;?>" name="id">
                    <input type="submit" class="submit" value="更新する">
                </form>
            </div>
        </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>