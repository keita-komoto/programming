<?php
session_start();

function kakunou ($str) {
    return '$'.$str.' = '.'$_SESSION['."'".$str."'".']';
}

$pw_pt = "/^[0-9A-Za-z]+$/";

if(isset($_POST['submit'])) {
    $_SESSION = $_POST;
    $family_name = $_SESSION['family_name'];
    $last_name = $_SESSION['last_name'];
    $family_name_kana = $_SESSION['family_name_kana'];
    $last_name_kana = $_SESSION['last_name_kana'];
    $mail = $_SESSION['mail'];
    $password = $_SESSION['password'];
    $gender = $_SESSION['gender'];
    $postal_code = $_SESSION['postal_code'];
    $prefecture = $_SESSION['prefecture'];
    $address_1 = $_SESSION['address_1'];
    $address_2 = $_SESSION['address_2'];
    $authority = $_SESSION['authority'];
    $errors = [];

    if (empty($password)) {
        $errors['password'] = "パスワードが未入力です";
    } elseif (preg_match($pw_pt, $password) === 0 ) { 
        $errors['password'] = "パスワードを英数字で入力してください";
    }
    if(count($errors) === 0 ) {
        header("Location:http://localhost/diworks/programming/regist_confirm.php");
    }
    
    
}
if(isset($_GET['action'])){
    $family_name = $_SESSION['family_name'];
    $last_name = $_SESSION['last_name'];
    $family_name_kana = $_SESSION['family_name_kana'];
    $last_name_kana = $_SESSION['last_name_kana'];
    $mail = $_SESSION['mail'];
    $password = $_SESSION['password'];
    $gender = $_SESSION['gender'];
    $postal_code = $_SESSION['postal_code'];
    $prefecture = $_SESSION['prefecture'];
    $address_1 = $_SESSION['address_1'];
    $address_2 = $_SESSION['address_2'];
    $authority = $_SESSION['authority'];
}

$pref_array = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県', '新潟県','富山県','石川県','福井県', '茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');   
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
                    <form method="post" action="regist.php">
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name" maxlength="10" autocomplete="family-name"
                                value="<?php if(isset($family_name)) {echo $family_name ;} ?>" patttern="[\u4E00-\u9FFF\u3040-\u309Fー]*">
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>名前（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name" maxlength="10" autocomplete="given-name"
                                value="<?php if(isset($last_name)) {echo $last_name ;} ?>" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>カナ（姓）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="family_name_kana" maxlength="10"
                                value="<?php if(isset($family_name_kana)) {echo $family_name_kana ;} ?>" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>カナ（名）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="last_name_kana" maxlength="10"
                                value="<?php if(isset($last_name_kana)) {echo $last_name_kana ;} ?>" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>メールアドレス</label>
                            </div>
                            <div class="reg_right">
                                <input type="email" class="text" name="mail" maxlength="100"
                                value="<?php if(isset($mail)) {echo $mail ;} ?>" required>

                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>パスワード</label>
                            </div>
                            <div class="reg_right">
                                <input type="password" class="text" name="password" maxlength="10"
                                value="<?php if(isset($password)) {echo $password ;} ?>">
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>性別</label>
                            </div>
                            <div class="reg_right">
                                <input type="radio" class="radio" name="gender" value="0" required <?php if(isset($gender) && $gender === "0"){echo "checked";} else {echo "checked";} ?> >男
                                <input type="radio" class="radio" name="gender" value="1" required <?php if(isset($gender) && $gender === "1"){echo "checked";} ?> >女
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>郵便番号</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="postal_code" maxlength="7"
                                value="<?php if(isset($postal_code)) {echo $postal_code ;} ?>" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（都道府県）</label>
                            </div>
                            <div class="reg_right">
                                <select name="prefecture">

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
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（市区町村）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="address_1" maxlength="10"
                                value="<?php if(isset($address_1)) {echo $address_1 ;} ?>" required>
                            </div>
                        </div>
                        <div class="reg_box">
                            <div class="reg_left">
                                <label>住所（番地）</label>
                            </div>
                            <div class="reg_right">
                                <input type="text" class="text" name="address_2" maxlength="100"
                                value="<?php if(isset($address_2)) {echo $address_2 ;} ?>" required>
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
                        <div>
                            <input type="submit" class="submit" name="submit" value="確認する">
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