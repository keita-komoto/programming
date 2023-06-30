<?php
session_start();
if (isset($_SESSION['login_auth'])) {
    if (!$_SESSION['login_auth'] == 1) {
        header("Location:http://localhost/diworks/programming/fail.php?st=authority");
    }
}
// 遷移前ページから渡されたIDを取得

if(isset($_POST['id'])) {
    $id = $_POST['id'];
} 
try {
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
    $account = $stmt->fetch(PDO::FETCH_ASSOC);

    //結果を変数へ展開
    extract($account, $flags = EXTR_OVERWRITE, $prefix = "");
} catch (PDOException $e) {
    header("Location:http://localhost/diworks/programming/fail.php?st=err");
}
$pref_array = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県', '新潟県','富山県','石川県','福井県', '茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');   
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント削除</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_reg.css">
    <link rel="stylesheet" type="text/css" href="style_list.css">
</head>
<body>
    <?php include(dirname(__FILE__).'/common/header.php'); ?>
    <main>
        <h2>アカウント削除画面</h2>
        <div class="delete">
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
                <div class="reg_right"><span class="passmoji">パスワードは表示できません</span></div>
            </div>
            <div class="reg_box">
                <div class="reg_left">
                    <label>性別</label>
                </div>
                <div class="reg_right">
                    <?php if( $gender === "0") {
                        echo '男性';
                    }
                    else {
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
                    }
                    else {
                        echo '管理者';
                    }; ?>
                </div>
            </div>
            <div class="btn-box">
                <form method="post" action="delete_confirm.php">
                    <input type="hidden" value="<?php echo $id ;?>" name="id">               
                    <input type="submit" class="submit" name="submit" value="確認する">
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>