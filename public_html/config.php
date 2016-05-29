<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
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
    $HOST = "172.18.0.2"; // TODO: 直書きは修正したい
    $PORT = 3306;
    $DB_USERNAME = "root";
    $DB_PASSWORD = "secret";
    $DB_NAME = "bbs";
}

if (getenv("CLEARDB_DATABASE_URL")) { // if this env exists, maybe run on heroku
    // Basic Authentication
    $user = getenv("BASIC_AUTH_USERNAME");
    $pass = getenv("BASIC_AUTH_PASSWORD");
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Private Page"');
        header('HTTP/1.0 401 Unauthorized');
        die("<h1>401 Unauthorized</h1>");
    } else {
        if ($_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass) {
            header('WWW-Authenticate: Basic realm="Private Page"');
            header('HTTP/1.0 401 Unauthored');
            die();
        }
    }
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

// enhancement security
header('X-XSS-Protection: "1; mode=block"');
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' maxcdn.bootstrapcdn.com fonts.googleapis.com; font-src 'self' maxcdn.bootstrapcdn.com fonts.gstatic.com;");
