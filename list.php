<?php
session_start();

//権限判別
if ($_SESSION['login_auth'] == 1 ) {

} elseif (!$_SESSION['login_auth'] == 1) {
    header("Location:http://localhost/diworks/programming/fail.php?st=authority");
}

try {
    $pdo = new PDO(
        'mysql:dbname=programming;host=localhost;charset=utf8mb4','root','',
    );
} catch (PDOException $e) {
    header("Location:http://localhost/diworks/programming/fail.php?st=err");
}   
if (isset($_GET['search'])) {
    extract($_GET, $flags = EXTR_OVERWRITE, $prefix = "");
    $serch_family_name = isset($_GET['family_name']) ? $_GET['family_name'] : '';
    $serch_last_name = isset($_GET['last_name']) ? $_GET['last_name'] : '';
    $serch_family_name_kana = isset($_GET['family_name_kana']) ? $_GET['family_name_kana'] : '';
    $serch_last_name_kana = isset($_GET['last_name_kana']) ? $_GET['last_name_kana'] : '';
    $serch_mail = isset($_GET['mail']) ? $_GET['mail'] : '';
    $serch_gender = isset($_GET['gender']) ? $_GET['gender'] : '';
    $serch_authority = isset($_GET['authority']) ? $_GET['authority'] : '';
    // クエリの条件部分
    $conditions = [];
    $parameters = [];

    if ($serch_family_name !== '') {
        $conditions[] = 'family_name LIKE :family_name';
        $parameters[':family_name'] = '%' . $serch_family_name . '%';
    }
    
    if ($serch_last_name !== '') {
        $conditions[] = 'last_name LIKE :last_name';
        $parameters[':last_name'] = '%' . $serch_last_name . '%';
    }
    
    if ($serch_family_name_kana !== '') {
        $conditions[] = 'family_name_kana LIKE :family_name_kana';
        $parameters[':family_name_kana'] = '%' . $serch_family_name_kana . '%';
    }
    
    if ($serch_last_name_kana !== '') {
        $conditions[] = 'last_name_kana LIKE :last_name_kana';
        $parameters[':last_name_kana'] = '%' . $serch_last_name_kana . '%';
    }
    
    if ($serch_mail !== '') {
        $conditions[] = 'mail LIKE :mail';
        $parameters[':mail'] = '%' . $serch_mail . '%';
    }
    
    if ($serch_gender !== '') {
        $conditions[] = 'gender = :gender';
        $parameters[':gender'] = $serch_gender;
    }

    if ($serch_authority !== '') {
        $conditions[] = 'authority = :authority';
        $parameters[':authority'] = $serch_authority;
    }
    // クエリの条件部分を結合
    $where = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';

    // クエリを実行する準備
    $sql = 'SELECT * FROM account ' . $where . ' ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);

    // パラメータをバインド
    foreach ($parameters as $parameter => $value) {
        $stmt->bindValue($parameter, $value);
    }
    $stmt->execute();
} elseif (isset($_GET['list']))  {
    $sql = 'SELECT * FROM account ORDER BY id DESC';
    $stmt = $pdo->query($sql);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Worksblog アカウント一覧</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_reg.css">
    <link rel="stylesheet" type="text/css" href="style_list.css">
</head>
<body>
    <?php include(dirname(__FILE__).'/common/header.php'); ?>
    <main>
        <h2>アカウント一覧</h2>

        <form method="get" action="list.php">
            <div class="search_container">
                <div class="search_left">
                    <label for="family_name">名前（姓）:</label>
                    <input type="text" name="family_name" id="family_name" value="<?php if(isset($family_name)) {echo $family_name ;} ?>">
                </div>
                <div class="search_right">
                    <label for="last_name">名前（名）:</label>
                    <input type="text" name="last_name" id="last_name" value="<?php if(isset($last_name)) {echo $last_name ;} ?>">
                </div>
                <div class="search_left">
                    <label for="family_name_kana">カナ（姓）:</label>
                    <input type="text" name="family_name_kana" id="family_name_kana" value="<?php if(isset($family_name_kana)) {echo $family_name_kana ;} ?>">
                </div>
                <div class="search_right">
                    <label for="last_name_kana">カナ（名）:</label>
                    <input type="text" name="last_name_kana" id="last_name_kana" value="<?php if(isset($last_name_kana)) {echo $last_name_kana ;} ?>">
                </div>
                <div class="search_right">
                    <label for="mail">メールアドレス:</label>
                    <input type="text" name="mail" id="mail" value="<?php if(isset($mail)) {echo $mail ;} ?>">
                </div>
                <div class="search_right">
                    <label for="gender">性別:</label>
                    <input type="radio" name="gender" id="male" value="0" <?php if(isset($gender) && $gender === "0"){echo "checked";} ?>>
                    <label for="male">男</label>
                    <input type="radio" name="gender" id="female" value="1" <?php if(isset($gender) && $gender === "1"){echo "checked";} ?>>
                    <label for="female">女</label>
                    <input type="radio" name="gender" id="female" value="" <?php if(isset($gender) && $gender === "") {echo "checked";} ?>>
                    <label for="female">未選択</label>
                </div>
                <div class="search_right">
                    <label for="authority">アカウント権限:</label>
                    <select name="authority" id="authority">
                        <option value="" selected>未選択</option>
                        <option value="0" <?php if(isset($authority) && $authority == 0 ){echo 'selected';} ?>>一般</option>
                        <option value="1" <?php if(isset($authority) && $authority == 1 ){echo 'selected';} ?>>管理者</option>
                    </select>
                </div>
                <div>
                    <input type="submit" name="search" value="検索">
                    <input type="submit" name="list" value="全件表示"> 
                </div>
            </div>
        </form>
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
                if (isset($_GET['search']) || isset($_GET['list'])) {
                    if (isset($sql)) {
                        $accountExists = false; // 初期値を設定
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
                            if ($account['delete_flag'] == 0){
                                echo '<td>';
                                    echo '<form method="post" action="update.php?edit=1">';
                                        echo '<input type="hidden" value="' . $account['id'] . '" name="id">';
                                        echo '<input type="submit" class="submit" name="submit" value="更新する">';
                                    echo '</form>';
                                echo '</td>';
                                echo '<td>';
                                    echo '<form method="post" action="delete.php">';
                                        echo '<input type="hidden" value="' . $account['id'] . '" name="id">';
                                        echo '<input type="submit" class="submit" name="submit" value="削除する">';
                                    echo '</form>';
                            } else {
                                echo '<td colspan="2">削除済み</td>';
                            }
                            echo '</tr>';
                            $accountExists = true; // レコードが存在する場合にフラグを更新
                        }
                        if (!$accountExists) {
                            echo '<tr>';
                            echo '<td colspan="13">' . "条件に一致するアカウントがありませんでした" . '</td>';
                            echo '</tr>';
                        }
                    }
                } elseif (empty($_GET)) {
                echo '<tr>';
                echo '<td colspan="12">' . "検索してください" . '</td>';
                echo '</tr>';
                } else {
                    echo "a";
                }
            $pdo = null; ?>
        </table>
    </main>
    <footer>
        <p class="copy">Copyright D.I.Works｜D.I.Blog is the one wich provides A to Z about programming</p>
    </footer>
</body>
</html>