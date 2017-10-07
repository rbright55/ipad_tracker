<?php
include_once( 'database.php');
class student {
	public $link;

	function __construct(){
		$db_connection = new dbConnection;
		$this->link = $db_connection->connect();
		return $this->link;
	}



	//get all students
	public function getStudents(){

	}
	//get students by grade
	public function getStudentsbyGrade($grade){
		$query = $this->link->query("SELECT * FROM students14_15 WHERE $grade ORDER BY `Grade` ASC, `Homeroom` ASC, `Last Name` ASC");
		if($query->rowCount() > 0){
			return $query->fetchAll();
		}else{
			return 0;
		}
	}

	//get one student from id
	public function getStudentbyId($id){
		$query = $this->link->query("SELECT * FROM students14_15 WHERE `Student ID`= '$id'");
		if($query->rowCount() == 1){
			return $query->fetchAll()[0];
		}else{
			return $query->rowCount();
		}
	}

	//get one student from name
	public function getStudentbyName(){

	}

	//create student
	public function createStudent($student_id, $lname, $fname, $email, $uname, $grade, $hroom, $ipad, $paid){
		$query = $this->link->prepare("INSERT INTO `students14_15` (`Student ID`, `Last Name`, `First Name`, `Email`, `Username`, `Grade`, `Homeroom`, `iPad #`, `Paid`) VALUES (?,?,?,?,?,?,?,?,?)");
		$values = array($student_id, $lname, $fname, $email, $uname, $grade, $hroom, $ipad, $paid);
		$query->execute($values);
		return $query->rowCount();
	}

	//edit student
	public function editStudent($id){

	}

	//delete student
	public function deleteStudent($id){

	}
}