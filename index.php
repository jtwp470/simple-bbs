<?php
include_once("config.php");
session_start();

if (!empty($_REQUEST)) {
    // ログイン処理
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['pass'])) {
        // DB につなげログイン成功と仮定する
        $_SESSION['name'] = $_REQUEST['name']; // 本当はDBから返ってくる値をセットする
        $_SESSION['time'] = time();
        $_SESSION['admin'] = true;
    } else {
        $err_msg = "Login failed";
    }
}
?>
<!DOCTYPE html lang="en">
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-yxFy3Tt84CcGRj9UI7RA25hoUMpUPoFzcdPtK3hBdNgEGnh9FdKgMVM+lbAZTKN2" crossorigin="anonymous">
        <title>Simple BBS</title>
    </head>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Simple BBS</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if (!empty($_SESSION)) { ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>BBS</h2>
        <p>Very simpliy BBS</p>
        <?php if (isset($err_msg)) { alert($err_msg, "warning"); } ?>
        <?php if (empty($_SESSION['name'])) { ?>
        <h3>Login</h3>
        <form method="" action="">
            <div class="formgroup">Username:<input name="name" type="text" class="form-control"/></div>
            <div class="formgroup">Password:<input name="pass" type="text" class="form-control"/></div>
            <div class="formgroup"><button type="submit" class="btn btn-success" value="login">Login</button></div>
        </form>
        <?php } else {
    include("bbs.php");
    } ?>
        </div>
</html>
