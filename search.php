<?php
require "pdo.php";

if(isset($_POST['searchVal'])){

	$searchq = $_POST['searchVal'];
	if (strlen($searchq) > 2){
	$sql_search = '
	SELECT `Last Name`,`First Name`,`Student ID` 
	FROM students14_15
	WHERE `First Name` LIKE "%'.$searchq.'%"
	or `Last Name` LIKE "%'.$searchq.'%" 
	or concat(`First Name`, " " , `Last Name`) LIKE "%'.$searchq.'%" 
	or concat(`Last Name`, " " , `First Name`) LIKE "%'.$searchq.'%"
	';

	$stmt_search = $pdo->query($sql_search);
	$totalrows = $stmt_search->rowCount();
	
	if($totalrows == 0){
		$output = 'There was no search results!';
	}else{

		while ($result = $stmt_search->fetch(PDO::FETCH_ASSOC)) {

			$Sname = $result['First Name'].' '.$result['Last Name'];
			$Searchid = $result['Student ID'];
			$black = $Searchid;
			$output .= '<div id="searchname"><a id="searchlink" href="students.php?studentid='.$Searchid.'"><span></span><div> '.$Sname.' </div></a></div>';
		}
	}
}
echo $output;
}
?>