<?php
session_start();
//Cancel button
if (isset($_POST['Cancel'])){
	unset($_SESSION['add_iPad#']);
	unset($_SESSION['add_TicketButton']);
	unset($_SESSION['edit_Ticket#']);
	unset($_SESSION['edit_TicketButton']);
	unset($_SESSION['edit_TicketChanges']);
	header("Location: #");
	return;
}

//add ticket button
if (isset($_POST['add_TicketButton'])){
	$_SESSION['add_TicketButton']=$_POST['add_TicketButton'];
	unset($_POST['add_TicketButton']);
	unset($_SESSION['edit_TicketButton']);
	header("Location: #");
	return;
}
//edit ticket button
if (isset($_POST['edit_TicketButton'])){
	$_SESSION['edit_TicketButton']=$_POST['edit_TicketButton'];
	unset($_POST['edit_TicketButton']);
	unset($_SESSION['add_TicketButton']);
	header("Location: #");
	return;
}
//EDIT ticket number?
if(isset($_POST['edit_Ticket#'])){
	$_SESSION['edit_Ticket#']=$_POST['edit_Ticket#'];
	header("Location: #");
	return;
}
//changes made?
if(isset($_POST['edit_TicketChanges']) ){
	$_SESSION['edit_iPad#']=$_POST['edit_iPad#'];
	$_SESSION['edit_StudentStatus']=$_POST['edit_StudentStatus'];
	$_SESSION['edit_iPadStatus']=$_POST['edit_iPadStatus'];
	$_SESSION['edit_TicketChanges']=$_POST['edit_TicketChanges'];
	$replace_str = array('"', "'");
	$_SESSION['edit_Description'] = str_replace($replace_str, "’", $_POST['edit_Description']);
	header("Location: #");
	return;

}
//ADD TICKET ipad number entered
if (isset($_POST['add_iPad#'])){
	$_SESSION['add_iPad#']=$_POST['add_iPad#'];
	$_SESSION['add_iPadStatus']= $_POST['add_iPadStatus'];
	$replace_str = array('"', "'");
	$_SESSION['add_Description'] = str_replace($replace_str, "’", $_POST['add_Description']);
	$_SESSION['add_StudentStatus']=$_POST['add_StudentStatus'];
	header("Location: #");
	return;
}
?>
<!DOCTYPE HTML>
<!--
	Twenty by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<!--HEAD-->
<?php
	include "head.php";
?>
	<body class="no-sidebar">
	
		<!-- Header -->
			<header id="header">
			<?php
				include "navigation.php";
			?>
			</header>
		
		<?php
		
			if (isset($_SESSION['account'])){
				if ($_SESSION['account'] === "admin") {

					include "ticketedits.php";
					
					}}
		?>
		
<!-- Main -->
<article id="main">
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2>MTA  <strong>IT Work Log</strong></h2>
		<p>Check status of iPad.</p>
	</header>
				
	<!-- One -->
	<section class="wrapper style6 container">
				
		<!-- Content -->
		<div class="content">
		<section>
			<!-- All Students In iPad Office -->
			<caption>All Open Tickets</caption>
				<div class="blocky">
					<table>
			  <thead>
			    <tr>
			      <th>T#</th> 
			      <th>Ipad #</th> 
			      <th>Student</th> 
			      <th>Status</th>
			      <th>Description</th> 
			    </tr>
			  </thead>
			  </table>
			  <div class="scrolls"><table>
			  <tbody>
			  	<?php
			  		require_once "pdo.php";
					$sql = "SELECT l.*, s.`Student Status`, s.`First Name`, s.`Last Name`  FROM log AS l INNER JOIN `students14_15` AS s ON l.tStatus='Open' AND s.`Student ID`=l.`Student ID`";
					$stmt = $pdo->query($sql);
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){	
						echo '<tr><td>';
						echo $row['Ticket #'];
						echo '</td><td>';
						echo $row['iPad #'];
						echo '</td><td>';
						echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
						echo '</td><td>';
						echo $row['Student Status'];
						echo '</td><td>';
						echo $row['Comments'];
						echo '</td></tr>';
					}							
				?>
			  </tbody>
			</table>
			</div></div>
			<p></p>

			<!-- Needs Work -->
			<caption><i class="fa fa-exclamation-circle" style="color:red" ></i>  Needs Work</caption>
											<div class="blocky">
												<table>
			  <thead>
			    <tr>
			      <th>T#</th> 
			      <th>Ipad #</th> 
			      <th>Student</th> 
			      <th>Status</th>
			      <th>Description</th> 
			    </tr>
			  </thead>
			  </table>
			  <div class="scrolls"><table>
			  <tbody>
			  	<?php
			  		require_once "pdo.php";
					$sql = "SELECT l.`Ticket #`, i.`iPad #`, s.`First Name`, s.`Last Name`,s.`Student Status`,l.`Comments` FROM log AS l INNER JOIN iPads AS i INNER JOIN `students14_15` AS s ON l.tStatus='Open'AND i.Status='Damaged' AND i.`iPad #`=l.`iPad #` AND s.`Student ID`=l.`Student ID`";
					$stmt = $pdo->query($sql);
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){	
						echo '<tr><td>';
						echo $row['Ticket #'];
						echo '</td><td>';
						echo $row['iPad #'];
						echo '</td><td>';
						echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
						echo '</td><td>';
						echo $row['Student Status'];
						echo '</td><td>';
						echo $row['Comments'];
						echo '</td></tr>';
					}							
				?>
			  </tbody>
			</table>
			</div></div>
			<p></p>
			<!-- Good to Go -->
			<caption><i class="fa fa-check-circle" style="color:green"></i> Good to Go</caption>
											<div class="blocky">
												<table>
			  <thead>
			    <tr>
			      <th>T#</th> 
			      <th>Ipad #</th> 
			      <th>Student</th> 
			      <th>Status</th>
			      <th>Description</th> 
			    </tr>
			  </thead>
			  </table>
			  <div class="scrolls"><table>
			  <tbody>
			  	<?php
		  		require_once "pdo.php";
				$sql = "SELECT l.`Ticket #`, i.`iPad #`, s.`First Name`, s.`Last Name`,s.`Student Status`,l.`Comments` FROM log AS l INNER JOIN iPads AS i INNER JOIN `students14_15` AS s ON l.tStatus='Open'AND i.Status='Good to Go' AND i.`iPad #`=l.`iPad #` AND s.`Student ID`=l.`Student ID` AND s.`Student Status`='Good'";
				$stmt = $pdo->query($sql);
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){	
					echo '<tr><td>';
					echo $row['Ticket #'];
					echo '</td><td>';
					echo $row['iPad #'];
					echo '</td><td>';
					echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
					echo '</td><td>';
					echo $row['Student Status'];
					echo '</td><td>';
					echo $row['Comments'];
					echo '</td></tr>';
				}							
				?>
			  </tbody>
			</table>
			</div></div>
			<p></p>
			<!-- All History -->
			<caption>All Work History</caption>
			<div class="blocky">
		
				<table>
					<thead>
					<tr>
				    <th>Date</th>
				    <th>T#</th> 
				    <th>Ipad #</th> 
				    <th>Student</th> 
				    <th>Condition</th>
				    <th>Description</th> 
				    </tr>
					</thead>
				</table>
				<div class="scrolls2">
					  <table>
					  <tbody>
					  	<?php
				  		require_once "pdo.php";
						$sql = "SELECT l.*, s.`First Name`, s.`Last Name` FROM `log`as l INNER JOIN `students14_15`as s WHERE l.`Student ID`=s.`Student ID` ORDER BY `num` DESC";
						$stmt = $pdo->query($sql);
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){	
							echo '<tr><td>';
							echo date_format(date_create($row['Date']), 'M jS');
							echo '</td><td>';
							echo $row['Ticket #'];
							echo '</td><td>';
							echo $row['iPad #'];
							echo '</td><td>';
							echo $row['First Name'].' '.substr($row['Last Name'], 0,1).'.';
							echo '</td><td>';
							echo $row['Status'];
							echo '</td><td>';
							echo $row['Comments'];
							echo '</td></tr>';
						}							
						?>
					  </tbody>
					</table>
				</div>
			</div></div>

		</section>
	</section>

</article>	
		<?php
			include "footer.php";
		?>
	</body>
</html>