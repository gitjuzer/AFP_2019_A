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
?> 