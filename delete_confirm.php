<?php

if(isset($_SESSION['family_name'])){
    // ポストから変数へ
    $account = $_POST;
    // 結果を変数へ展開
    extract($account, $flags = EXTR_OVERWRITE, $prefix = "");
} else {
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
        <h2>アカウント削除確認画面</h2>
        <div class="delete">
            <p class="dai">本当に削除してよろしいですか？</p>
            <div class="btn-box">
                <form method="post" action="delete.php">
                    <input type="hidden" value="<?php echo $id ;?>" name="id">
                    <input type="submit" class="submit" value="前に戻る">                    
                </form>
                <form method="post" action="delete_insert.php">
                    <input type="hidden" value="<?php echo $id ;?>" name="id">
                    <input type="submit" class="submit" value="削除する">
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>