<?php
if ($_SESSION['is_admin']) {
?>
    <h2>Admin Panel</h2>
    <p>Access admin only page.</p>
    <div class='alert alert-warning'>Under Constructing Page</div>
<?php } else { ?>
    <h2>403 Forbidden</h2>
<?php
    header('Location: index.php'); exit();
}
?>
