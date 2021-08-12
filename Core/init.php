<?php
define("PROJECTPATH", dirname(__DIR__));
define("APPPATH", PROJECTPATH . '/App');
define("CONTROLLER_NAMESPACE", "\App\Controllers\\");
define("DEBUG", true);
define("MIDDLEWARE_NAMESPACE", "\Middleware\\");
define("SERVER_NAME", "localhost");
date_default_timezone_set('America/La_Paz');

$allowedOrigins = [
    "http://localhost:3000",
    "http://127.0.0.1:3000"
];

if (isset($_SERVER["HTTP_ORIGIN"]) && in_array($_SERVER["HTTP_ORIGIN"], $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
}
header('Access-Control-Allow-Headers:Content-type,CALL-TYPE,Authorization,refresh_token,client_id');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Credentials:true');
