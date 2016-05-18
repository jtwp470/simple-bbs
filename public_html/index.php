<?php
include("config.php");
session_start();

if (empty($_SESSION['name'])) {
    $op = 'login';
} else {
    $op = 'bbs';
}

if (!empty($_REQUEST['op'])) {
    $op = $_REQUEST['op'];
}
if (!is_string($op) || preg_match('/\.\./', $op))
    die('no hacking');
ob_start('ob_gzhandler');

function page_top($op) {
?><!DOCTYPE html lang="en">
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-yxFy3Tt84CcGRj9UI7RA25hoUMpUPoFzcdPtK3hBdNgEGnh9FdKgMVM+lbAZTKN2" crossorigin="anonymous">
        <title>More Secure BBS</title>
    </head>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">More Secure BBS</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
<?php if (!empty($_SESSION['name'])) { ?>
                    <li><a href="?op=logout">Logout</a></li>
<?php } ?>
<?php if ($_SESSION['is_admin']) { ?>
                    <li><a href="?op=admin">Admin Panel</a></li>
<?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>BBS</h2>
        <p>Very simpliy BBS</p>
<?php } ?>
<?php
function page_bottom() {
?>
    </div>
</html><?php
ob_end_flush();
}

register_shutdown_function('page_bottom');
page_top($op);

if (!empty($_SESSION['err_msg'])) {
    echo $_SESSION['err_msg'];
}
@include(basename($op) . '.php');

?>