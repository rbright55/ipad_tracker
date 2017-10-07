<!---Add a new kid--->
<!---Edit student--->
<!---Student Dropped-->
<!--change ipad status
--need to collect, Active, In-IT,
student status
--clear,owes fine, distributed, not distributed,dropped
-->
<?php
	/*_______Edit Student Section_____*/
		if (isset($_SESSION['edit_StudentButton']) && isset($_GET['studentid'])){
			//paid selection
			if ($student['Paid'] == 1){ 
				$yes = "Selected";
				$no = "";
			}else{
				$yes = "";
				$no = "Selected";
			}
			//student status selection
			$stat=$student['Student Status'];
			if ($stat === 'Good'){
				$stat1 = "Selected";
				$stat2 = "";
				$stat3 = "";
			} elseif ($stat === 'Owes Fine'){
				$stat1 = "";
				$stat2 = "Selected";
				$stat3 = "";
			} elseif ($stat === 'Red Cased'){
				$stat1 = "";
				$stat2 = "";
				$stat3 = "Selected";
			}
			//Edit Form
			echo '
				<!--Edit Students-->
				
					<div class="inner">
					<h2 align="center"><strong>Edit</strong> student</h2>
						<form method=post>
							<p><label for="upd_StudentID">Student ID</label>
							<input class="smallbox"type="text" readonly required name="upd_StudentID" value="'.$student['Student ID'].'"></p>
							<p><label for="upd_FirstName">First Name</label>
							<input autosuggest="off" class="smallbox"type="text" required name="upd_FirstName" value="'.$student['First Name'].'"></p>
							<p><label for="upd_Last Name">Last Name</label>
							<input autosuggest="off" class="smallbox"type="text" required name="upd_LastName" value="'.$student['Last Name'].'"></p>
							<p><label for="upd_Username">Username</label>
							<input autosuggest="off" class="smallbox"type="text" required name="upd_Username" value="'.$student['Username'].'"></p>
							<p><label for="upd_Grade">Grade</label>
							<input autosuggest="off" class="smallbox" type="number" pattern="[0-9]*" min="5" max="8" maxlength="1" name="upd_Grade" style=" width: 40px;" required value="'.$student['Grade'].'"></p>
							<p><label for="upd_Homeroom">Homeroom</label>
							<input class="smallbox"type="text" name="upd_Homeroom" value="'.$student['Homeroom'].'"></p>
							<p><label for="upd_iPad">iPad #</label>
							<input class="smallbox" type="number" style=" width: 50px;" name="upd_iPad" value="'.$student['iPad #'].'"></p>
							<p>
							<label for "upd_Paid">Paid?</label>
							<select name="upd_Paid">
								<option '.$yes.'>Yes</option>
								<option '.$no.'>No</option>
							</select>
							</p>
							<p><label for="upd_StudentStatus">Student Status</label>
							<select name="upd_StudentStatus">
								<option value="Good" '.$stat1.'>Good</option>
								<option value="Owes Fine" '.$stat2.'>Owes Fine</option>
								<option value="Red Cased" '.$stat3.'>Red Cased</option>
							</select></p>
							<p align="center"><input type="submit" value="Update"/></p>
						</form>
						<form name method="post" action="classes/manageStudent.php">
			<input type="hidden" name="Cancel" value="Cancel"/>';
			if (isset($_GET['studentid'])){
						echo "<input type='hidden' name='student' value='".$_GET['studentid']."'>";
					}
			echo '
			<p align="center"><input type="submit" value="Cancel"/></p></form>
					</div>
				
			';
		
		}
	/*_______Add New Student Section_____*/
		if (isset($_SESSION['add_StudentButton'])){
				//Add New Student Form
			echo '';
			echo '
				<!--Add new Students-->
					<div class="inner">
					<h2 align="center"><strong>Add</strong> new student</h2>
						<form method=post >
							<p><label for="add_StudentID">Student ID</label>
							<input autosuggest="off" class="smallbox"type="text" required name="add_StudentID"></p>
							<p><label for="add_FirstName">First Name</label>
							<input id="fname" onkeyup="userName();" type="text" required name="add_FirstName" autosuggest="off" class="smallbox"/></p>
							<p><label for="add_Last Name">Last Name</label>
    						<input id="lname" onkeyup="userName();" type="text" autosuggest="off" class="smallbox" required name="add_LastName" /></p>
    						<p><label for="add_Grade">Grade</label>
    						<input id="grade" onkeyup="userName();" autosuggest="off" class="smallbox" type="number" pattern="[0-9]*" min="5" max="8" maxlength="1" name="add_Grade" style=" width: 40px;" required/></p>
    						<p><label for="add_Username">Username</label>
    						<input id="uname" type="text" autosuggest="off" class="smallbox"type="text" required name="add_Username"/></p>
							<p><label for="add_Homeroom">Homeroom</label>
							<input class="smallbox"type="text" name="add_Homeroom" ></p>
							<p><label for="add_iPad">iPad #</label>
							<input autosuggest="off" class="smallbox"type="number" pattern="[0-9]*" min="0" maxlength="3" style=" width: 50px;" name="add_iPad" ></p>
							<p>
							<label for "add_Paid">Paid?</label>
							<select name="add_Paid">
								<option>Yes</option>
								<option Selected >No</option>
							</select>
							</p>
							<p align="center"><input type="submit" value="Add Student"/></p>
							</form>
							<form name method="post">
			<input type="hidden" name="Cancel" value="Cancel"/>
			<p align="center"><input type="submit" value="Cancel"/></p></form>
					</div>
			';

		}

?>
