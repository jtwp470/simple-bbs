<?php
if (empty($_SESSION)) {
    echo "Plz login";
    header("Location: index.php");
    exit();
}
?>

<p>Hello, <?php echo h($_SESSION['name']); ?></p>


<?php
$msg = [1=>"test message", 2=>"admin nicely"];  // 本当はDBからの値をセット
foreach ($msg as $key => $m) {
    print <<<EOF
<div class="panel panel-default">
  <div class="panel-heading">$key</div>
  <div class="panel-body">$m</div>
</div>
EOF;
}

?>

<a href="logout.php">Logout</a>
