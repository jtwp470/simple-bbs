<?php
session_start();
include_once('config.php');

// register
if (!empty($_REQUEST)) {
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['pass']) && !empty($_REQUEST['repass'])) {
        $sql = "SELECT * FROM users WHERE username=:name";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $_REQUEST['name'], PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (count($row) > 0) {
                $_SESSION['err_msg'] = alert("user already exists", "danger");
                header('Location: /?op=register'); exit();
            }
        } else {
            // ユーザー登録
            if ($_REQUEST['pass'] == $_REQUEST['repass']) {
                $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $_REQUEST['name'], PDO::PARAM_STR);
                $stmt->bindParam(':password', $_REQUEST['pass'], PDO::PARAM_STR);
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
<form method="" action="register.php">
     <div class="formgroup">Username:<input name="name" type="text" class="form-control"/></div>
     <div class="formgroup">Password:<input name="pass" type="text" class="form-control"/></div>
     <div class="formgroup">Re-type password:<input name="repass" type="text" class="form-control"/></div>
     <div class="formgroup"><button type="submit" class="btn btn-success" value="register">Register</button></div>
</form>
<?php } ?>
