<?php
function h($str) {
    return htmlspecialchars($str);
}

function alert($s, $type = "success") {
    return "<div class='alert alert-$type'>".h($s)."</div>";
}


// DB
$HOST = "172.17.0.2";
$PORT = 3306;

$DB_USERNAME = "root";
$DB_PASSWORD = "secret";
$DB_NAME = "bbs";


try {
    $db = new PDO("mysql:host=$HOST;port=$PORT;dbname=$DB_NAME;charset=utf8", $DB_USERNAME, $DB_PASSWORD);
} catch (PDOException $e) {
    header("HTTP/1.1 500 Internal Server Error");
    die("Cannot connect db: " . $e->getMessage());
}
