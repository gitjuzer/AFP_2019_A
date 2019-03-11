<?php
require_once('./config.php');
require_once('./DatabaseConnection.php');
$db = new DatabaseConnection();
$connection = $db.getConnection();
$request_method = $_SERVER['REQUEST_METHOD'];


switch($request_method) {
    case 'GET':
        break;
    case 'POST':
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo 'Invalid Request method.';
        break;
}

