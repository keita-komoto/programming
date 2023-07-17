<?php 


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
            <?php 
            if (isset($_SESSION['login_auth']) && $_SESSION['login_auth'] === 1) { 
                echo '<li><a href="./regist.php">アカウント登録</a></li>';
                echo '<li><a href="./list.php">アカウント一覧</a></li>';
            }
            if(isset($_SESSION['login_id'])){ 
                echo '<li><a href="./logout.php">ログアウト</a></li>';
            } else {
                echo '<li><a href="./login.php">ログイン</a></li>';
            } ?>
        </ul>
    </div>
</header>
