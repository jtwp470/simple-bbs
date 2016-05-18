<?php
function h($str) {
    return htmlspecialchars($str);
}

function alert($s, $type = "success") {
    return "<div class='alert alert-$type'>".h($s)."</div>";
}

// DB
if ($url = getenv("CLEARDB_DATABASE_URL")) {
    $url = parse_url($url);
    $HOST = $url['host'];
    $DB_USERNAME = $url['user'];
    $DB_PASSWORD = $url['pass'];
    $DB_NAME = substr($url['path'], 1);
    error_reporting(0); // Enable on heroku
} else {
    $HOST = "172.18.0.2";
    $PORT = 3306;
    $DB_USERNAME = "root";
    $DB_PASSWORD = "secret";
    $DB_NAME = "bbs";
}

try {
    if (isset($PORT)) {
        $db = new PDO("mysql:host=$HOST;port=$PORT;dbname=$DB_NAME;charset=utf8", $DB_USERNAME, $DB_PASSWORD);
    } else {
        $db = new PDO("mysql:host=$HOST;dbname=$DB_NAME;charset=utf8", $DB_USERNAME, $DB_PASSWORD);
    }
} catch (PDOException $e) {
    header("HTTP/1.1 500 Internal Server Error");
    die("Cannot connect db: " . $e->getMessage());
}

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);