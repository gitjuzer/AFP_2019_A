 <?php
	function getConnection(){
		
		//az adatbázis adatait át kell írni
		$DB_TYPE = 'mysql';
		$DB_HOST = 'localhost';
		$DB_NAME = '';
		$USER = 'root';
		$PASS = '';
		
		$connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',USER, PASS);
		$connection->exec("SET NAMES 'utf8'");
		return $connection;
	}
	
	function insertQuestion($question,$answer1,$answer2,$answer3,$answer4) {
		$conn = getConnection();
		//a mező neveit át kell írni!!
		$sql = "INSERT INTO Questions (question, 1st_answer, 2nd_answer,3rd_answer,4th_answer)
		VALUES (".$question.",".$answer1.",".$answer2.",".$answer3",".$answer4")";

		if ($conn->query($sql) === TRUE) {
			echo "Successful insert!";


		$conn->close();
	}
	
	function getRecord($id) {
		
	}
	
?> 