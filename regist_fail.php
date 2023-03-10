<?php

session_start();

if ( isset($_SESSION['family_name'])){
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
                <h2>アカウント登録エラー</h2>
                <div class="kanryo">
                    <h3 class="error">エラーが発生したためアカウント登録できません。</h3>
                </div>

                <div class="btn-box">
                    <form method="post" action="index.php">
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
                        <input type="submit" class="submit" name="submit" value="前に戻る">
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