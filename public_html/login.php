<?php
if (!empty($_REQUEST)) {
    // ログイン処理
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['pass'])) {
        // DB につなげログイン成功と仮定する
        $sql = 'SELECT * FROM users WHERE username="'.$_REQUEST['name'].'" AND password="'.$_REQUEST['pass'].'"';
        $result = $db->query($sql);
        // var_dump($sql);
        if ($r = $result->fetch()) {
            $_SESSION['id'] = $r[0];
            $_SESSION['name'] = $r[1];
            $_SESSION['is_admin'] = $r[3];
            header("Location: index.php"); exit();
        } else {
            $_SESSION['err_msg'] = "Username or password unmached";
        }
    }
}
?>
<?php if (empty($_SESSION['name'])) { ?>
<h3>Login</h3>
<form method="" action="">
     <div class="formgroup">Username:<input name="name" type="text" class="form-control"/></div>
     <div class="formgroup">Password:<input name="pass" type="text" class="form-control"/></div>
     <div class="formgroup"><button type="submit" class="btn btn-success" value="login">Login</button></div>
</form>
<?php } ?>