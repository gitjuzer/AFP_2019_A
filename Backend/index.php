<?php
require_once('./config.php');
require_once('./DatabaseConnection.php');
$db = new DatabaseConnection();
$connection = $db.getConnection();
$request_method = $_SERVER['REQUEST_METHOD'];


switch($request_method) {
    case 'GET':
        if(!empty($_GET["id"]))
		{
			$id=intval($_GET["id"]);
			getQuizById($id);
		}
		  else
		{
			 getAllQuiz()
		}
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


function getAllQuiz() {
    global $connection;
    $query = 'SELECT * FROM test';

    $response = [];
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

