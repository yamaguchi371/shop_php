<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
</head>
<body>
    <div class="container">
    <?php
        try {

            $staff_code=$_POST['staffcode'];
            
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root'; // ユーザー名とパスワードはサーバーごとに変更
            $password = 'tooled371';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name FROM mst_staff WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[]=$staff_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name=$rec['name'];

            $dbh = null;

        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    <p>スタッフ修正<br>
<br>スタッフコード<br>
<?php print $staff_code; ?><br><br></p>
<form method="post" action="staff_edit_check.php">
    <input type="hidden" name="code" value="<?php print $staff_code; ?>">
    <p>スタッフ名</p>
    <input type="text" name="name" style="width: 200px;" value="<?php print $staff_name; ?>"><br>
    <p>パスワードを入力してください。</p><br>
    <input type="password" name="pass" style="width: 100px;"><br>
    <p>パスワードをもう一度入力してください。</p><br>
    <input type="password" name="pass2" style="width: 100px;"><br>
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>
    </div>
</body>
</html>