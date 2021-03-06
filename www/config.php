<?php

include('.env.php');
include('enums.php');

// config
define('DEFAULT_TITLE', 'Bulletin Board');
define('UPLOAD_DIR', '/var/www/html/uploads/');
define('AVATARS_DIR', '/var/www/html/avatars/');
define('LOG_FILE', '/var/log/ws/php.log');

// const
define('REDIRECT_TO_INDEX', '<meta http-equiv="refresh" content="0;url=/">');
define('REFRESH', '<meta http-equiv="refresh" content="0;url=">');

// security
ini_set('display_errors', 0);
ini_set('memory_limit', '128M');

// db settings
define('TIMEZONE', 'Asia/Taipei');
date_default_timezone_set(TIMEZONE);
ini_set('date.timezone', 'Asia/Taipei');

try {
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $link->set_charset("utf8mb4");

    if (!$link) {
        logError('config.php', '30', mysqli_connect_error(), '');
        die("ERROR: Server error QQ");
    }
} catch (Exception $exception) {
    logError($th->getFile(), $th->getLine(), $th->getMessage(), $th->getTraceAsString());
    die("ERROR: Server error QQ");
}

// header
header('X-XSS-Protection: 1');
header("Content-Security-Policy: default-src 'self'; script-src 'self'; img-src *; object-src 'none'; style-src 'self' 'unsafe-inline'; require-trusted-types-for 'script';");
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=16070400; includeSubDomains');

session_set_cookie_params([
    'lifetime' => '3600',
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'strict'
]);
session_start();
