<?php
if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}
?>

<p>Hello, <?php echo h($_SESSION['name']); ?></p>

<form method="" action="">
    <div class="row">
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" id="comment"></textarea>
        </div>
        <div class="formgroup"><button type="submit" class="btn btn-info pull-right" value="login">Post</button></div>
    </div>
</form>

<a href="logout.php">Logout</a>
