<?php
if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}

if (!empty($_REQUEST)) {
    if (!empty($_REQUEST['comment'])) {
        $stmt = $db->prepare("INSERT INTO bbs (username, content, datetime) VALUES (:username, :content, :datetime)");
        $stmt->bindParam(':username', $_SESSION['name'], PDO::PARAM_STR);
        $stmt->bindParam(':content', $_REQUEST['comment'], PDO::PARAM_STR);
        $stmt->bindParam(':datetime', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>

<p>Hello, <?php echo h($_SESSION['name']); ?></p>

<form method="" action="">
    <div class="row">
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" name="comment"></textarea>
        </div>
        <div class="formgroup"><button type="submit" class="btn btn-info pull-right" value="post">Post</button></div>
    </div>
</form>

<?php
$stmt = $db->query("SELECT * FROM bbs ORDER BY id DESC");
while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    foreach($row as $r) {
?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?php echo $r['username']; ?></h3></div>
            <div class="panel-body"><?php echo $r['content']; ?></div>
            <div class="panel-footer pull-right"><?php echo $r['datetime']; ?></div>
        </div>
    </div>
    </br>
<?php
    }
}
?>
