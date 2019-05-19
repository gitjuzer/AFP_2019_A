 <?php
 class Database{
     
	function getConnection(){
		
		//az adatbázis adatait át kell írni
		//$DB_TYPE = 'mysql';
		$DB_HOST = 'localhost';
		$DB_NAME = 'quiz';
		$USER = 'root';
		$PASS = '';
		
		//$connection = new PDO($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';',$USER, $PASS);
                $connection = new mysqli($DB_HOST, $USER, $PASS, $DB_NAME);
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                } 
		//$connection->exec("SET NAMES 'utf8'");
		//echo 'Sikeres csatlakozás!';
		return $connection;
	}
	
	function insertQuestion($question,$answer1,$answer2,$answer3,$answer4,$correct) {
		$conn = $this->getConnection();
		//a mező neveit át kell írni!!
		$sql = "insert into questions(question,1st_answer,2nd_answer,3rd_answer,4th_answer,correct_answer) values ('$question','$answer1','$answer2','$answer3','$answer4',$correct);";

		if ($conn->query($sql) == TRUE) {
			echo "Sikeres felvitel!";
		}
                $conn->close();
	}
	
	function getQuestion($id) {
		$conn = getConnection();
		
		//mező és tábla nevet át kell írni
		$sql = "SELECT question,1st_answer, 2nd_answer,3rd_answer,4th_answer FROM Quiz WHERE id =".$id;
		$result = $conn->query($sql);
		
		$conn->close();
		
		return $result;
	}
	
	function getQuestionsList(){
		$conn = getConnection();
		
		$sql = 'SELECT * FROM Questions';
		
		$result = $conn->query($sql);
		
		return $result;
	}
	
	function getUsersList(){
		$conn = getConnection();
		
		$sql = 'SELECT * FROM Users';
		
		$result = $conn->query($sql);
		
		return $result;
	}
	
	function registerUser($username, $password, $role) {
		$conn = getConnection();
		
		$sql = 'Insert INTO Users (username,password,role) VALUES ('.$username.','.$password.','.$role.')';
		
		if ($conn->query($sql) == TRUE) {
			echo "Sikeres regisztráció!";
		}
		
		$conn->close();
	}
	
	function getUser($username){
		$conn = getConnection();
		
		$sql = 'SELECT * FROM Users WHERE uername = '.$username;
		$result = $conn->query($sql);
		
		return $result;
	}
	
	function changePassword($username, $new_password){
		$conn = getConnection();
		
		$sql = 'UPDATE Users SET password = '.$new_password.' WHERE username = '.$username;
		
		if  ($conn->query($sql) == TRUE) {
			echo 'Sikeres jelszó módosítás!';
		}
	}
	
	function changeRole($username, $new_role){
		$conn = getConnection();
		
		$sql = 'UPDATE Users SET role = '.$new_role.' WHERE username = '.$username;
		
		if ($conn->query($sql) == TRUE) {
			echo 'Sikeres szerepkör változtatás!';
		}	
	}
	
	function deleteUser($username){
		$conn = getConnection();
		
		$sql = 'DELETE FROM Users WHERE username = '.$username;
		
		if ($conn->query($sql) == TRUE){
			echo 'Felhasználó sikeresen törölve';
		}
	}
	
	function deleteQuestion($id){
		$conn = getConnection();
		
		$sql = 'DELETE FROM Questions WHERE id = '.$id;
		
		if ($conn->query($sql) == TRUE){
			echo 'Kérdés sikeresen törölve!';
		}
	}

 }
 
 class MyTest{
     
    function getConnectionTest(){
        
        $classDb = new Database();
        
        $expected = new PDO('mysql:host=localhost;dbname=quiz','root','');
        if (assert($expected, $classDb->getConnection()) == true){
            echo 'getConnection teszt sikeres';
        }
        else {
            echo 'getConnection teszt sikertelen';
        }
    }
 }

$Db = new Database();
$Db->insertQuestion("test?", "test1", "test2", "test3", "test4",2);
//getConnectionTest();
?>