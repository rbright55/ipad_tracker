<script>
function userName(){
    var user = document.getElementById("uname");
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var grade = document.getElementById("grade").value;
    var d = new Date();
    var n = d.getFullYear() - 2000;
    var syear = n+(8-grade);
    if (grade <1){
       syear = ""
    }
    uname.value = syear.toString().concat(fname.charAt(0), lname);
}
</script>
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