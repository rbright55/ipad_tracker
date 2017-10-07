<?php
require_once "pdo.php";
$stmt = $pdo->query("SELECT * FROM students14_15 WHERE `iPad #` = 13");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	print_r($row);
}
?>