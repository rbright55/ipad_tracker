<?php
session_start();

include_once('classes/classStudent.php');

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
	<body class="right-sidebar">
	<header id="header">
	
<?php
/*_____Filters____*/
	//Grade filter
	if (isset($_GET['grade'])){
		$grade = "`Grade` =". $_GET['grade']. " ";
		$title = "Grade ".$_GET['grade'];
	} else {
		$grade = "1=1 ";
	}
	//Homeroom Filter
	if (isset($_GET['homeroom'])){
		$homeroom = "`Homeroom` =". $_GET['homeroom']. " ";
		$title += " ".$_GET['homeroom'];
	} else {
		$homeroom = "1=1 ";
	}
//Navigation Bar
	include "navigation.php";
?>
			</header>		
		<?php
		/*take info and update it in database*/
		if (isset($_SESSION['upd_StudentID'])){
			require_once "pdo.php";
			
			$update = 'UPDATE `students14_15` SET `Last Name`= "'.$_SESSION["upd_LastName"].'",`First Name`= "'.$_SESSION["upd_FirstName"].'",`Paid`= "'.$_SESSION["upd_Paid"].'",`Email`= "'.$_SESSION["upd_Username"].'@mtacademy.us'.'",`Username`= "'.$_SESSION["upd_Username"].'",`Grade`= "'.$_SESSION["upd_Grade"].'",`Homeroom`="'.$_SESSION["upd_Homeroom"].'",`iPad #`= '.$_SESSION["upd_iPad"].' WHERE `Student ID`= '.$_SESSION["upd_StudentID"];
			
			$stmtupd = $pdo->prepare ($update);
			$stmtupd->execute();
			$_SESSION['studentmessage'] = $stmtupd->rowCount() . " record(s) UPDATED succesfully";
			echo '<h1>.</h1>';
			echo $_SESSION['studentmessage'];
			unset($_SESSION['studentmessage']);
			unset($_SESSION['upd_StudentID']);
			unset($_SESSION['upd_iPad']);
			unset($_SESSION['upd_LastName']);
			unset($_SESSION['upd_FirstName']);
			unset($_SESSION['upd_Homeroom']);
			unset($_SESSION['upd_Paid']);
			unset($_SESSION['upd_Username']);
			unset($_SESSION['upd_Grade']);
			unset($_SESSION['upd_iPad']);
			unset($_SESSION['edit_StudentButton']);
		}
		//add student in database
		if (isset($_SESSION['add_StudentID'])){
			require_once "pdo.php";
			$mail = $_SESSION['add_Username']."@mtacademy.us";
			$user =$_SESSION['add_Username'];
			$adds = "INSERT INTO `students14_15` (`Student ID`, `Last Name`, `First Name`, `Email`, `Username`, `Grade`, `Homeroom`, `iPad #`, `Paid`) VALUES (:id, :lname, :fname, :email, :uname, :grade, :hroom, :ipad, :paid)";
			$stmtadd = $pdo->prepare ($adds);
			$stmtadd->execute(array(':id' =>$_SESSION['add_StudentID'] ,
									':lname' =>$_SESSION['add_LastName'] ,
									':fname' =>$_SESSION['add_FirstName'] ,
									':email' =>$mail ,
									':uname' =>$user ,
									':grade' =>$_SESSION['add_Grade'] ,
									':hroom' =>$_SESSION['add_Homeroom'] ,
									':ipad' =>$_SESSION['add_iPad'] ,
									':paid' =>$_SESSION['add_Paid']));
			$_SESSION['studentmessage'] = $stmtadd->rowCount() . " record(s) ADDED succesfully";
			echo '<h1>.</h1>';
			echo $_SESSION['studentmessage'];
			unset($_SESSION['studentmessage']);
			unset($_SESSION['add_StudentID']);
			unset($_SESSION['add_iPad']);
			unset($_SESSION['add_LastName']);
			unset($_SESSION['add_FirstName']);
			unset($_SESSION['add_Homeroom']);
			unset($_SESSION['add_Paid']);
			unset($_SESSION['add_Username']);
			unset($_SESSION['add_Grade']);
			unset($_SESSION['add_iPad']);
		}

		//Get information for student id
		if (isset($_GET['studentid'])){
			$students = new student;
			$student = $students->getStudentbyId($_GET['studentid']);
		}

			//student inforamtion
			if(isset($_GET['studentid']) || $_SESSION['account'] === "admin"){
				
				echo' <section id="cta">';
				//edit, add, drop student
				if (isset($_SESSION['account']) && $_SESSION['account'] === "admin"){
						include "studentedits.php";	
				}	
				if (isset($_GET['studentid']) && !isset($_SESSION['edit_StudentButton']) && !isset($_SESSION['add_StudentButton'])){
					echo'<title>'.$student['First Name'].' '.$student['Last Name'].'</title>';
					echo'
					<!--info-->
						<div class="inner">
						';
							echo '<table class="smals">'."\n";
									    echo '<thead><tr><th align="left">';
									    echo "Name:";
									    echo('</th><th align="left">');
									    echo($student['First Name']);
									    echo " ";
									    echo ($student['Last Name']);
									    echo('</th></tr></thead><tbody><tr><td align="left">');
									    echo "Username:";
									    echo('</td><td align="left">');
									    echo($student['Username']);
									    echo('</td></tr><tr><td align="left">');
									    echo "Password:";
									    echo('</td><td align="left">');
									    $id = substr($student['Student ID'], -5);
									    echo("Mta"."$id");
									    echo('</td></tr><tr><td align="left">');
									    echo "Homeroom:";
									    echo('</td><td align="left">');
									    echo("Grade ".$student['Grade']." ".$student['Homeroom']);
									    echo('</td></tr><tr><td align="left">');
									    echo "iPad #:";
									    echo('</td><td align="left">');
									    echo $student['iPad #'];
									    echo("</td></tr>\n");

									    echo "</tbody></table>\n";
						echo '</div>';
				};
				

				if (isset($_SESSION['account']) && $_SESSION['account'] === "admin"){
					echo "<form method='post' action='classes/manageStudent.php'>
					<select  name='buttons' onchange='this.form.submit()'>
					<option selected disabled>──Student Options──</option>
					<option value='info'>Student Info</option>
					<option value='edit'>Edit Student</option>
					<option value='add'>Add a New Student</option>
					</select>";
				
					
					if (isset($_GET['studentid'])){
						echo "<input type='hidden' name='student' value='".$_GET['studentid']."'>";
					}

					echo "
					</form>";
				}
				if (!isset($_GET['studentid']) && (isset($_SESSION['edit_StudentButton']) || isset($_SESSION['info_StudentButton']))){
					echo'</br><p>Please Select a student</p>';
					echo'
					<!--Student Search-->
				<p><div style="padding-top: 50px;"id="completesearch">
					<form action="test.php" method="post" id="searchform">
						<input onclick="this.select()" type="text" name="search" id="searchbox" autocomplete="off" placeholder="Search Students" onkeyup="searchq();" onfocus="this.select()" />
					</form>
					<div id="output"></div>
				</div></p>
					';
					unset($_SESSION['info_StudentButton']);
				}

				echo '</section>';
				
			}

				
		?>

<!-- Main -->
			<article id="main">
				<!--Student Search-->
				<p><div style="padding-top: 50px;"id="completesearch">
					<form onsubmit="" ="searchq();" method="post" id="searchform">
						<input onclick="this.select()" type="text" name="search" id="searchbox" autocomplete="off" placeholder="Search Students"onkeyup="searchq();" />
					</form>
					<div id="output"></div>
				</div></p>
			<!--Student Section-->
				<header class="special container">
					<span class="icon fa-child"></span>
					<h2><strong><?php echo($title); ?> students</strong></h2>
					
					<p><a href="#filters">Click here to filter data</a></p>
				</header>		
				<!-- Table -->
					<section class="wrapper style5 container">

						<!-- Content -->
							<div class="content">
								<section>

     					
     					
     					
						<div id="tabley">
						<div class="header-roww roww">
	   						<span class="cell primary">Name</span>
	    					<span class="cell"> Student ID </span>
	     					<span class="cell">Username</span>
	    					<span class="cell">Password</span>
	     					<span class="cell">Homeroom</span>
	     					<span class="cell">iPad #</span>
	     					<span class="cell">Paid?</span>
  						</div>
  						
							<?php
								$students_conn = new student;
								$students = $students_conn->getStudentsbyGrade($grade);
								
								if($students){
									foreach ($students as $student) {
										echo '<div class="roww">';
										echo '<input type="radio" name="expand">';
										echo '<span class="cell primary" data-label="Name">'.$student["Last Name"].", ".$student["First Name"].'</span>';
	    								echo '<span class="cell" data-label="Student ID"><a href="./students.php?studentid='.$student["Student ID"].'">'.$student["Student ID"].'</a></span>';
										echo '<span class="cell" data-label="Username">'.$student["Username"].'</span>';
										echo '<span class="cell" data-label="Password">'."Mta".substr($student['Student ID'], -5).'</span>';
										echo '<span class="cell" data-label="Homeroom">'.'Grade '.$student['Grade']." ".$student['Homeroom'].'</span>';
										if ($student['iPad #'] === ""){
											echo '<span class="cell" data-label="iPad #">---</span>';
										} else {
											echo '<span class="cell" data-label="iPad #">'.$student['iPad #'].'</span>';
										}
										
										$paid = $student['Paid']?'<i class="icon fa-check"></i>':'<i class="icon fa-close"></i>';
										

										echo '<span class="cell" data-label="Paid?">'.$paid.'</span>';
	  									echo'</div>';										
									}
								}
								

							?>
					</div>
								</section>
							</div>

					</section>	
			</article>


			<!-- Filter Section -->
				<a name='filters'></a>
				<section id="cta">
					<header>
						<h2><strong>Filters</strong>?</h2>
					</header>
					<footer>
						<ul class="buttons">
						
							<li><a href="./students.php?grade=5" class="button">5th Grade</a></li>
							<li><a href="./students.php?grade=6" class="button">6th Grade</a></li>
							<li><a href="./students.php?grade=7" class="button">7th Grade</a></li>
							<li><a href="./students.php?grade=8" class="button">8th Grade</a></li>
						</ul>
					</footer>
				
				</section>
<!--Footer-->
		<?php
			include "footer.php";
		?>

	</body>
	
</html>