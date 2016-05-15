<?php
if ($_SESSION['is_admin']) {
?>
    <h2>Admin Panel</h2>
    <p>Access admin only page.</p>
    <div class='alert alert-warning'>Under Constructing Page</div>
<?php } else {
    header('HTTP/1.1 403 Forbidden');
    header('Location: index.php'); exit();
}
?>
