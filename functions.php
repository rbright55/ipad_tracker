<?php
require('pdo.php');
function autoSuggest($query)
{
	$sql_search = '
	SELECT `Last Name`,`First Name`,`Student ID` 
	FROM students14_15
	WHERE `First Name` LIKE "%'.$query.'%"
	or `Last Name` LIKE "%'.$query.'%"
	';

	$stmt_search = $pdo->query($sql_search);
	$totalrows = $stmt_search->rowCount();
	
		$items = '<ul class="autoSuggest">';

		while ($result = $stmt_search->fetch(PDO::FETCH_ASSOC)) {
			$items .= '<li>.$result['First Name'].' '.$result['Last Name']</li>';
		}
		
		$items .= '</ul>';
	
	
	echo $items;
}
?>