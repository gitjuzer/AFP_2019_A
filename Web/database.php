 <?php
	function getConnection(){
		
		//az adatbázis adatait át kell írni
		$DB_TYPE = 'mysql';
		$DB_HOST = 'localhost';
		$DB_NAME = 'quiz';
		$USER = 'root';
		$PASS = '';
		
		$connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',USER, PASS);
		$connection->exec("SET NAMES 'utf8'");
		return $connection;
	}
	
	function insertQuestion($question,$answer1,$answer2,$answer3,$answer4) {
		$conn = getConnection();
		//a mező neveit át kell írni!!
		$sql = 'INSERT INTO Questions (question, 1st_answer, 2nd_answer,3rd_answer,4th_answer) VALUES ('.$question.','.$answer1.','.$answer2.','.$answer3.','.$answer4.')';

		if ($conn->query($sql) === TRUE) {
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
	
	function registerUser($username, $password, $szerepkor) {
		$conn = getConnection();
		
		$sql = 'Insert INTO Users (username,password,szerepkor) VALUES ('.$username.','.$password.','.$szerepkorkor.')';
		
		if ($conn->query($sql) === TRUE) {
			echo "Sikeres regisztráció!"
		}
		
		$conn->close();
	}
	
	function getUser($username){
		$conn = getConnection();
		
		$sql = 'SELECT * FROM Users WHERE usrename = '.$username;
		$result = $cnon=ó->query()ó$sql);
		
		return $result;
	}
?>