<?php
session_start();
include_once('config.php');

// register
if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['repass'])) {
        $sql = "SELECT * FROM users WHERE username=:name";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            if (count($row) > 0) {
                $_SESSION['err_msg'] = alert("user already exists", "danger");
                header('Location: /?op=register'); exit();
            }
        } else {
            // ユーザー登録
            if ($_POST['pass'] == $_POST['repass']) {
                $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $_POST['name'], PDO::PARAM_STR);
                $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['err_msg'] = alert("User registation success", "success");
                header('Location: index.php'); exit();
            } else {
                $_SESSION['err_msg'] = alert("Password unmatched", "danger");
                header('Location: /?op=register');
            }
        }
    }
}
?>

<h3>Register</h3>
<?php if (empty($_SESSION['name'])) { ?>
<form method="POST" action="register.php">
     <div class="formgroup">Username:<input name="name" type="text" class="form-control"/></div>
     <div class="formgroup">Password:<input name="pass" type="password" class="form-control"/></div>
     <div class="formgroup">Re-type password:<input name="repass" type="password" class="form-control"/></div>
     <div class="formgroup"><button type="submit" class="btn btn-success" value="register">Register</button></div>
</form>
<?php } ?>
