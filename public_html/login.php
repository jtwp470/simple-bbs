<?php
if (!empty($_REQUEST)) {
    // ログイン処理
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['pass'])) {
        // DB につなげログイン成功と仮定する
        $sql = 'SELECT * FROM users WHERE username="'.$_REQUEST['name'].'" AND password="'.$_REQUEST['pass'].'"';
        $result = $db->query($sql);
        // var_dump($sql);
        if ($result) {
            foreach ($result as $r) {
                $_SESSION['id'] = $r['id'];
                $_SESSION['name'] = $r['username'];
                $_SESSION['is_admin'] = $r['is_admin'];
            }
            header("Location: index.php"); exit();
        } else {
            $err_msg = "Username or password unmached";
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