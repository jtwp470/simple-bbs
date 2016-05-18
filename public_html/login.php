<?php
if (!empty($_POST)) {
    // ログイン処理
    if (!empty($_POST['name']) && !empty($_POST['pass'])) {
        // DB につなげログイン成功と仮定する
        $stmt = $db->prepare('SELECT * FROM users WHERE username=:username');
        $stmt->bindParam(":username", $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();

        if ($r = $stmt->fetch()) {
            if (password_verify($_POST['pass'], $r['password'])) {
                session_regenerate_id();
                $_SESSION['id'] = $r['id'];
                $_SESSION['name'] = $r['username'];
                $_SESSION['is_admin'] = $r['is_admin'];
            } else {
                $_SESSION['err_msg'] = alert('input password wrong', 'danger');
            }
        } else {
            $_SESSION['err_msg'] = alert("Username or password unmached", 'danger');
        }
        header("Location: index.php"); exit();
    }
}
?>
<?php if (empty($_SESSION['name'])) { ?>
<h3>Login</h3>
<form method="POST" action="">
     <div class="formgroup">Username:<input name="name" type="text" class="form-control"/></div>
     <div class="formgroup">Password:<input name="pass" type="password" class="form-control"/></div>
     <div class="formgroup"><button type="submit" class="btn btn-success" value="login">Login</button></div>
</form>
<?php } ?>