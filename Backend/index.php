<?php
require_once './config.php';
require_once('./DatabaseConnection.php');
$db = new DatabaseConnection();
$connection = $db->getConnection();
$request_method = $_SERVER['REQUEST_METHOD'];


switch($request_method) {
    case 'GET':
    if (!empty($_GET["testscores"]))
        {
            $test_id=intval($_GET["testscores"]);
            getScoresByTestId($test_id);
        }
        else if(!empty($_GET["id"]))
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
        login();
        break;
    case 'PUT':
        registerUser();
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
    $query="SELECT * FROM question WHERE test='$id'";
    
    $result=mysqli_query($connection, $query);
    $questions = [];
	while($row=mysqli_fetch_array($result))
	{
		$questions[] = $row;
    }
    
    $length = count($questions);
    for($i = 0; $i<$length; $i++) {
        $query = "SELECT * FROM answer WHERE question =".$questions[$i][0].";";
        $res = mysqli_query($connection, $query);
        $answers = [];
        while($row=mysqli_fetch_array($res))
	    {
            $answers[] = $row;
        }
        $questions[$i]["answers"] = $answers;
    }


	header('Content-Type: application/json');
	echo json_encode($questions);
}

function getScoresByTestId($id)
{
    global $connection;

    $query = $connection->prepare("SELECT score.score, user.username FROM score LEFT JOIN user ON score.user_id = user.id WHERE score.test_id =? ORDER BY score.score DESC;");  
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    $response = array();
    while($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function login() {
    global $connection;
    $data = json_decode(file_get_contents("php://input"), true);
    $user = $data['user'];
    $password = $data['password'];

    $query = $connection->prepare("SELECT username, token, role.name FROM user INNER JOIN user_role ON user.id = user_role.user_id INNER JOIN role ON user_role.role_id = role.id WHERE username=? AND password=?");
    $query->bind_param("ss", $user, $password);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    
    $res = array();
    while($row = mysqli_fetch_array($result)){
        $res[] = $row;
    }
 
    if($res != null && !empty($res)){
        $response = array(
            "status" => 1,
            "status_message" => $res[0][1]
        );
    }
    else {
        $response = array(
            "status" => 0,
            "status_message" => "Login failed."
        );
    }

    header("Content-Type: application/json");
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

        if($query = $connection->prepare("INSERT INTO `user`(`username`, `password`, `email`, `token`) VALUES (?,?,?,?);")) {
            $query->bind_param("ssss", $user, $password, $email, $token);
            $query->execute();
            $query->close();

            $query = $connection->prepare("SELECT id FROM user WHERE username=?");
            $query->bind_param("s", $user);
            $query->execute();
            $result = $query->get_result();
            $query->close();
    
            $res = array();
            while($row = mysqli_fetch_array($result)){
                $res[] = $row;
            }

            $query = $connection->prepare("INSERT INTO `user_role`(`user_id`, `role_id`) VALUES (?,1);");
            $query->bind_param("i", $res[0]);
            $query->execute();
            $query->close();

        }
        $response = array(
            "status" => 1,
            "status_message" => "User registered."
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

    $query = $connection->prepare("SELECT username FROM user WHERE username=?");
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

function submitScore($token)
{
    global $connection;
    $data = json_decode(file_get_contents("php://input"), true);

    if(checkToken($token))
    {
        $score = $data["score"];
        $test_id=$data["test_id"];
        $user_id = $data["user_id"];
        
        if($query = $connection->prepare("INSERT INTO `score` (`score`, `test_id`, `user_id`) VALUES (?, ?, ?);")) {
            $query->bind_param("iii", $score,$test_id,$user_id);
            $query->execute();
            $query->close();
            $response = array(
                "status" => 1,
                "status_message" => "Score submitted."
            );
        }         
        else 
        {
            $response = array(
                "status" => 0,
                "status_message" => "Score submit failed."
            );
        }
    }
    else
    {
        $response = array(
            "status" => 0,
            "status_message" => "Invalid token."
        );
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}

function checkToken($token){
    global $connection;
    $query = "SELECT username FROM user WHERE token='".$token."'";

    $result = mysqli_query($connection, $query);
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