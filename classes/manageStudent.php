<?php
session_start();
/*------session buttons-----*/
//Cancel button
if (isset($_POST['Cancel'])){
	unset($_SESSION['drop_StudentButton']);
	unset($_SESSION['edit_StudentButton']);
	unset($_SESSION['add_StudentButton']);	
	if (isset($_POST['student'])){
		header("Location: ../students.php?studentid=".$_POST['student']."");
	}else{
		header("Location: ../students.php");
	}
}
/*----Update student Post to session--*/
	//edits
	if (isset($_POST['upd_StudentID'])){
		if (empty($_POST['upd_iPad'])){
			$_POST['upd_iPad']='NULL';
		}
		if (empty($_POST['upd_Homeroom'])){
			$_POST['upd_Homeroom']=NULL;
		}
		$_POST['upd_Paid'] = $_POST['upd_Paid'] === "Yes"?1:0;

		$_SESSION['upd_StudentID'] = $_POST['upd_StudentID'];
		$_SESSION['upd_LastName'] = $_POST['upd_LastName'];
		$_SESSION['upd_FirstName'] = $_POST['upd_FirstName'];
		$_SESSION['upd_Homeroom'] = $_POST['upd_Homeroom'];
		$_SESSION['upd_Paid'] = $_POST['upd_Paid'];
		$_SESSION['upd_Username'] = $_POST['upd_Username'];
		$_SESSION['upd_Grade'] = $_POST['upd_Grade'];
		$_SESSION['upd_iPad'] = $_POST['upd_iPad'];
		header("Location: ../students.php?studentid=".$_SESSION['upd_StudentID']."");
		//header("Location: #");
		return;
	}
	//add
	if (isset($_POST['add_StudentID'])){
		if (empty($_POST['add_iPad'])){
			$_POST['add_iPad']=NULL;
		}
		if (empty($_POST['add_Homeroom'])){
			$_POST['add_Homeroom']=NULL;
		}
		$_POST['add_Paid'] = $_POST['add_Paid'] === "Yes"?1:0;

		$_SESSION['add_StudentID'] = $_POST['add_StudentID'];
		$_SESSION['add_iPad'] = $_POST['add_iPad'];
		$_SESSION['add_LastName'] = $_POST['add_LastName'];
		$_SESSION['add_FirstName'] = $_POST['add_FirstName'];
		$_SESSION['add_Homeroom'] = $_POST['add_Homeroom'];
		$_SESSION['add_Paid'] = $_POST['add_Paid'];
		$_SESSION['add_Username'] = $_POST['add_Username'];
		$_SESSION['add_Grade'] = $_POST['add_Grade'];
		$_SESSION['add_iPad'] = $_POST['add_iPad'];

		unset($_SESSION['add_StudentButton']);
		header("Location: ../students.php?studentid=".$_SESSION['add_StudentID']."");
		//return;
	}

/* buttons */
if(isset($_POST['buttons'])){

	//edit student
	if ($_POST['buttons'] === 'edit'){
		$_SESSION['edit_StudentButton'] = "edit";
		unset($_SESSION['drop_StudentButton']);
		unset($_SESSION['add_StudentButton']);
		unset($_SESSION['info_StudentButton']);
	//drop student
	} elseif ($_POST['buttons'] === 'drop') {
		$_SESSION['drop_StudentButton'] = "drop";
		unset($_SESSION['edit_StudentButton']);
		unset($_SESSION['add_StudentButton']);
		unset($_SESSION['info_StudentButton']);
	//add new student
	} elseif ($_POST['buttons'] === 'add') {
		$_SESSION['add_StudentButton'] = "add";
		unset($_SESSION['drop_StudentButton']);
		unset($_SESSION['edit_StudentButton']);
		unset($_SESSION['info_StudentButton']);
	} else {
		$_SESSION['info_StudentButton'] = "info";
		unset($_SESSION['drop_StudentButton']);
		unset($_SESSION['edit_StudentButton']);
		unset($_SESSION['add_StudentButton']);
	}
	if (isset($_POST['student'])){
		header("Location: ../students.php?studentid=".$_POST['student']."");
	}else{
		header("Location: ../students.php");
	}
	//header("Location: #");
	//return;
}


