<?php
if (getenv('HEROKU_APP_DIR')) {
    header('Location: index.php'); exit();
} else {
    phpinfo();
}