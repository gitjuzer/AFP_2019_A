 <?php
	function getConnection(){
		$servername = "localhost";	//nem tudom az adatbázist, aki tudja írja át az adatokat hozzá
		$username = "root";
		$password = "";
		$dbname = "Quiz";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		return $conn;
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
?> 