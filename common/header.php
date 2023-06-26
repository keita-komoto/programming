<?php 
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
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
}
?>
 <header>
        <h1><img src=""></h1>
        <div class="menu">
            <ul>
                <li><a href="./index.php">トップ</a></li>
                <li><a href="#">プロフィール</a></li>
                <li><a href="#">D.I.Blogについて</a></li>
                <li><a href="#">登録フォーム</a></li>
                <li><a href="#">問い合わせ</a></li>
                <li><a href="#">その他</a></li>
                <?php if(!isset($authority)) {
                    echo '<li><a href="./regist.php">アカウント登録</a></li>';
                } 
                if (isset($authority) === "1") { 
                    echo '<li><a href="./regist.php">アカウント登録</a></li>';
                    echo '<li><a href="./list.php">アカウント一覧</a></li>';
                }
                if(isset($id)){ 
                    echo '<li><a href="#">ログアウト</a></li>';
                } else {
                    echo '<li><a href="./login.php">ログイン</a></li>';
                } ?>
            </ul>
        </div>
    </header>
