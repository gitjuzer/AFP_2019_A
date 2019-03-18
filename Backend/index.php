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
			 getAllQuiz();
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

function getQuizById($id=0)
{
	global $connection;
	$query="SELECT * FROM test";

	if($id != 0)
	{
		$query.=" WHERE id=".$id." LIMIT 1";
	}

	$response=array();
	$result=mysqli_query($connection, $query);
	while($row=mysqli_fetch_array($result))
	{
		$response[]=$row;
	}

	header('Content-Type: application/json');
	echo json_encode($response);
}



function registerUser() {
    global $connection;
    $data = json_decode(file_get_contents("php://input"), true);
    $user = $data['user'];

    if(!checkIfUserExists($user)) {
        $password = $data['password'];
        if($data['email'] != null && !empty($data['email'])) {
            $email = $data['email'];
        } else {
            $email = null;
        }
        $token = uniqid("");

        $query = $connection->prepare("INSERT INTO user VALUES (?,?,?,?);");
        $query->bind_param("ssss", $user, $password, $email, $token);
        $query->execute();
        $query->close();

        $response = array(
            "status" => 1,
            "status_message" => "User registered.";
        );
    } else {
        $response = array(
            "status" => 0,
            "status_message" => "User already exists."
        );
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}

function checkIfUserExists($user) {
    global $connection;

    $query = $connection->prepare("SELECT username FROM user WHERE username=?";
    $query->bind_param("s", $user);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    
    $res = array();
    while($row = mysqli_fetch_array($result)){
        $res[] = $row;
    }
 
    if($res != null && !empty($res)){
        return true;
    }
    else {
        return false;
    }
    
}