<?php
if (!empty($_SESSION['err_msg']))
    unset($_SESSION['err_msg']);
if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}

if (!empty($_POST)) {
    if (!empty($_POST['comment']) && checkToken($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $stmt = $db->prepare("INSERT INTO bbs (username, content, datetime) VALUES (:username, :content, :datetime)");
        $stmt->bindParam(':username', $_SESSION['name'], PDO::PARAM_STR);
        $stmt->bindParam(':content', $_POST['comment'], PDO::PARAM_STR);
        $stmt->bindParam(':datetime', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
    }
}

// CSRF対策
function setToken() {
    $TOKEN_LENGTH = 16;
    $d = openssl_random_pseudo_bytes($TOKEN_LENGTH);
    return bin2hex($d);
}

/*
 * @param  $token    generate from setToken
 * @param  $reveive  from post hidden parametor
 * @return boolean
 */
function checkToken($token, $receive) {
    if ($token == $receive) {
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_SESSION['csrf_token'] = setToken();
}

?>

<p>Hello, <?php echo h($_SESSION['name']); ?></p>

<form method="POST" action="">
    <div class="row">
        <div class="form-group">
            <label for="comment">Comment:</label>
            <input type="hidden" name="csrf_token" value="<?php echo h($_SESSION['csrf_token']); ?>">
            <textarea class="form-control" rows="5" name="comment"></textarea>
        </div>
        <div class="formgroup"><button type="submit" class="btn btn-info pull-right" value="post">Post</button></div>
    </div>
</form>

<?php
$stmt = $db->query("SELECT * FROM bbs ORDER BY id DESC");
while ($row = $stmt->fetchAll()) {
    foreach($row as $r) {
?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?php echo h($r['username']); ?></h3></div>
            <div class="panel-body"><?php echo h($r['content']); ?></div>
            <div class="panel-footer pull-right"><?php echo h($r['datetime']); ?></div>
        </div>
    </div>
    </br>
<?php
    }
}
?>
