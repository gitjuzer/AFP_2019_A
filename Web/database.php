 <?php
 class Database{
     
	function getConnection(){
		
		$DB_HOST = 'localhost';
		$DB_NAME = 'quiz';
		$USER = 'root';
		$PASS = '';
		
                $connection = new mysqli($DB_HOST, $USER, $PASS, $DB_NAME);
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                } 
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
		$conn = $this->getConnection();
		
		//mező és tábla nevet át kell írni
		$sql = "SELECT question,1st_answer, 2nd_answer,3rd_answer,4th_answer FROM Questions WHERE id =$id;";
		$result = $conn->query($sql);
		
		$conn->close();
		
		return mysqli_fetch_array($result);
	}
	
	function getQuestionsList(){
		$conn = $this->getConnection();
		
		$sql = 'SELECT * FROM Questions';
		
		$result = $conn->query($sql);
		
		return $result;
	}
	
	function getUsersList(){
		$conn = $this->getConnection();
		
		$sql = 'SELECT * FROM Users';
		
		$result = $conn->query($sql);
		
		return $result;
	}
	
	function registerUser($username, $password, $role) {
		$conn = $this->getConnection();
		
		$sql = "Insert INTO Users (username,password,role) VALUES ('$username','$password','$role')";
		
		if ($conn->query($sql) == TRUE) {
			echo "Sikeres regisztráció!";
		}
		
		$conn->close();
	}
	
	function getUser($username){
		$conn = $this->getConnection();
		
		$sql = 'SELECT * FROM Users WHERE uername = '.$username;
		$result = $conn->query($sql);
		
		return $result;
	}
	
	function changePassword($username, $new_password){
		$conn = $this->getConnection();
		
		$sql = 'UPDATE Users SET password = '.$new_password.' WHERE username = '.$username;
		
		if  ($conn->query($sql) == TRUE) {
			echo 'Sikeres jelszó módosítás!';
		}
	}
	
	function changeRole($username, $new_role){
		$conn = $this->getConnection();
		
		$sql = 'UPDATE Users SET role = '.$new_role.' WHERE username = '.$username;
		
		if ($conn->query($sql) == TRUE) {
			echo 'Sikeres szerepkör változtatás!';
		}	
	}
	
	function deleteUser($username){
		$conn = $this->getConnection();
		
		$sql = 'DELETE FROM Users WHERE username = '.$username;
		
		if ($conn->query($sql) == TRUE){
			echo 'Felhasználó sikeresen törölve';
		}
	}
	
	function deleteQuestion($id){
		$conn = $this->getConnection();
		
		$sql = 'DELETE FROM Questions WHERE id = '.$id;
		
		if ($conn->query($sql) == TRUE){
			echo 'Kérdés sikeresen törölve!';
		}
	}

 }
 
 class MyTest{
     
    function getConnectionTest(){
        
        $classDb = new Database();
        
        $expected = new mysqli('localhost', 'root', '', 'quiz');
        if (assert($expected, $classDb->getConnection()) == true){
            echo '<br>getConnection teszt sikeres';
        }
        else {
            echo '<br>getConnection teszt sikertelen';
        }
    }
    
    function getQuestionTest(){
        
        $classDb = new Database();
        
        $expected = array(0=>'test?', 'question'=>'test?', 1=>'test1', '1st_answer'=>'test1',2=>'test2', '2nd_answer'=>'test2',3=>'test3', '3rd_answer'=>'test3',4=>'test4', '4th_answer'=>'test4');
        if (assert($expected, $classDb->getQuestion(1)) == true){
            echo '<br>getQuestion teszt sikeres';
        }
        else {
            echo '<br>getQuestion teszt sikertelen';
        }
    }
 }

$test = new MyTest();

$test->getConnectionTest();

$test->getQuestionTest();

?>