<?php
session_start();
/*_______new ticket information_____*/
if (isset($_SESSION['add_iPad#'])){
	$inum=$_SESSION['add_iPad#'];
	unset($_SESSION['add_iPad#']);

	require_once "pdo.php";
	$stmt = $pdo->query("SELECT `Student ID`, `First Name`, `Last Name` FROM students14_15 WHERE `iPad #`=$inum");
	$stuinfo = $stmt->fetch(PDO::FETCH_ASSOC);								
			//check if iPad is assigned to a student
									if ($stuinfo === FALSE) {
										$_SESSION['newTicketMessage'] = "iPad not Assigned to student";
									} else{
									//check if there is a ticket already created
									require_once "pdo.php";
									$existingTicket = $pdo->query("SELECT * FROM `log` WHERE `iPad #`=$inum AND `tStatus`='Open'");
									$eTicket=$existingTicket->fetch(PDO::FETCH_ASSOC);
										if (!$eTicket === FALSE){
											$_SESSION['newTicketMessage']="Ticket already exists for this iPad";
										} else{
									//create ticket information
										//ticket Number
										require_once "pdo.php";
										$lstTick = $pdo->query("SELECT `Ticket #`  FROM  `log` ORDER BY `log`.`Ticket #` DESC LIMIT 1");
										$ltick=$lstTick->fetch(PDO::FETCH_ASSOC);
										$ticknum=$ltick['Ticket #'] + 1 ;
										//Date 
									$dte=date("Y"."-"."m"."-"."d");
										//Student ID
									$sID=$stuinfo['Student ID'];
										//Name
									$LastInitial = substr($stuinfo['Last Name'], 0,1);
									$Name = $stuinfo['First Name']." ".$LastInitial.".";
										//ipad Status
									$status= $_SESSION['add_iPadStatus'];
										//Comments
									$comments= $_SESSION['add_Description'];
									//enter information in log
									$add_sql="INSERT INTO `log` (`num`, `Ticket #`, `Date`, `iPad #`, `Student ID`, `Status`, `tStatus`, `Comments`) VALUES (NULL, '".$ticknum."', '".$dte."', '".$inum."', '".$sID."', '".$status."', 'Open', '".$comments."')";
									require_once "pdo.php";
									$stmadd = $pdo->prepare ($add_sql);
									$stmadd->execute();
									$_SESSION['newTicketMessage']= $stmadd->rowCount() . " entry added succesfully";
									//update student status in table
									require_once "pdo.php";
									$stuStatus=$_SESSION['add_StudentStatus'];
									$stustat_sql="UPDATE `ipad`.`students14_15` SET `Student Status` = '".$stuStatus."' WHERE `students14_15`.`Student ID` = ".$sID.";";
									$stustat_upd = $pdo->prepare ($stustat_sql);
									$stustat_upd->execute();
									//update ipad status in table
									require_once "pdo.php";
									$ipadstat_sql="UPDATE `ipad`.`iPads` SET `Status` = '".$status."' WHERE `ipads`.`iPad #` = ".$inum.";";
									$ipadstat_upd=$pdo->prepare ($ipadstat_sql);
									$ipadstat_upd->execute();
									}}
									//echo $_SESSION['add_Description'];
	unset($_SESSION['add_TicketButton']);
	if (isset($_SESSION['newTicketMessage'])){
		echo "<H1>.</H1>";
		echo $_SESSION['newTicketMessage'];
		unset($_SESSION['newTicketMessage']);
	}
}
/*_______edit ticket information_____*/
if (isset($_SESSION['edit_TicketChanges'])){
	//check for changes
	require_once "pdo.php";
	$edit_stmt = $pdo->query("SELECT l.*, s.`Student Status` AS sStatus, i.`Status` AS ipadstatus FROM `log`as l
Left JOIn`iPads`as i on l.`iPad #`=i.`iPad #`
INNER JOIN `students14_15` as s where `tStatus`='Open' and s.`Student ID`= l.`Student ID` and `Ticket #`=".$_SESSION['edit_Ticket#']);
	$tickinfo = $edit_stmt->fetch(PDO::FETCH_ASSOC);
	if(!isset($tickinfo['iPad #'])){
		$_SESSION['edit_iPadStatus']= NULL;
	}
	
	
	if ($tickinfo['iPad #'] != $_SESSION['edit_iPad#'] || $tickinfo['sStatus']!== $_SESSION['edit_StudentStatus'] || $tickinfo['ipadstatus']!== $_SESSION['edit_iPadStatus'] || $_SESSION['edit_Description']) {
		echo "<H1>.</H1>";
		echo "changes made";

		//update student status
		require_once "pdo.php";
		$stustat_sql="UPDATE `ipad`.`students14_15` SET `Student Status` = '".$_SESSION['edit_StudentStatus']."' WHERE `students14_15`.`Student ID` = ".$tickinfo['Student ID'].";";
		$stustat_upd = $pdo->prepare ($stustat_sql);
		$stustat_upd->execute();
		
		//update ipad status
		if(isset($tickinfo['iPad #']) ){
			require_once "pdo.php";
			$ipadstat_sql="UPDATE `ipad`.`iPads` SET `Status` = '".$_SESSION['edit_iPadStatus']."' WHERE `ipads`.`iPad #` = ".$tickinfo['iPad #'].";";
			$ipadstat_upd=$pdo->prepare ($ipadstat_sql);
			$ipadstat_upd->execute();
		}
		
		//add to history
			//mark all old as closed
			require_once "pdo.php";
			$close_sql="UPDATE `log` SET `tStatus` = 'Closed' WHERE `Ticket #`=".$_SESSION['edit_Ticket#'];
			$stmclose=$pdo->prepare ($close_sql);
			$stmclose->execute();

			//insert new history
		$dte=date("Y"."-"."m"."-"."d");
		$edit_sql="INSERT INTO `log` (`num`, `Ticket #`, `Date`, `iPad #`, `Student ID`, `Status`, `tStatus`, `Comments`) VALUES (NULL, '".$_SESSION['edit_Ticket#']."', '".$dte."', '".$_SESSION['edit_iPad#']."', '".$tickinfo['Student ID']."', '".$_SESSION['edit_iPadStatus']."', 'Open', '".$_SESSION['edit_Description']."')";
		
		if(!isset($_SESSION['edit_iPad#']) || $_SESSION['edit_iPad#']=''|| $_SESSION['edit_iPad#']=false || !$_SESSION['edit_iPad#']){
			$edit_sql="INSERT INTO `log` ( `Ticket #`, `Date`,  `Student ID`,  `tStatus`, `Comments`) VALUES ( '".$_SESSION['edit_Ticket#']."', '".$dte."', '".$tickinfo['Student ID']."', 'Open', '".$_SESSION['edit_Description']."')";
			
		}
		require_once "pdo.php";
		$stmedits = $pdo->prepare ($edit_sql);
		$stmedits->execute();
		$_SESSION['newTicketMessage']= $stmedits-> rowCount() . " entry added successfully";


		unset($_SESSION['edit_Ticket#']);
		unset($_SESSION['edit_TicketButton']);
		unset($_SESSION['edit_TicketChanges']);
	} else{
		$editsmsg= "No Changes Made";
	}
}
?>

<!-- Information section -->
			<section id="cta">
			
				<header>
					<h2>Need to change <strong>something</strong>?</h2>
					<p>Add new or update existing entries.</p>
				</header>
				<footer>
					<ul class="buttons">
						<li>
						<form method=post>
						<input type="hidden" name="add_TicketButton" value="True"></input>
						<input type="submit" value="Add Entry"/>
						</form>
						</li>

						<li>
						<form method=post>
						<input type="hidden" name="edit_TicketButton" value="True"></input>
						<input type="submit" value="Edit Entry"/>
						</form>
						</li>
						
					</ul>
				</footer>
				</br>
<?php

//New Ticket Section
if (isset($_SESSION['add_TicketButton'])){
echo "	<div class='inner'>
      <h3 align='center'>New Ticket</h3>
      <form method=post id='addTicket'>
      <p><label for='add_name'>Student Name</label>
      <input  id='addname' class='smallbox' required name='add_name' data-autocomplete='true'>
      <input id='blue' class='smallbox'>
			
			<p><label for='add_iPad#'>iPad #</label>
			<input  class='smallbox' type='number' pattern='[0-9]*' min='0' maxlength='3' required name='add_iPad#' value=''></p>
			
			<p><label for='add_StudentStatus'>Student Status</label>
			<select name='add_StudentStatus'>
				<option value='Good'>Good</option>
				<option value='Owes Fine'>Owes Fine</option>
				<option value='Red Cased'>Red Cased</option>
			</select></p>
			<p><label for='add_iPadStatus'>iPad Status</label>
			<select name='add_iPadStatus'>
				
	        		<option value='Distributed' >Distributed</option>
					<option value='Distributed'>Cart</option>
	    		<option disabled>──────────</option>
	        		<option value='Damaged'>Damaged</option>
					<option value='Good to Go'>Good to Go</option>
				<option disabled>──────────</option>
	    			<option value='Lost/Stolen'>Lost/Stolen</option>
			</select></p>
			<p><label for='add_Description'>Description</label>
			<textarea  name='add_Description' form='addTicket' placeholder='Enter description here'></textarea></p>

			<p align='center'><input type='submit' value='Add Entry'/></p>
			</form>
			<form method='post'>
			<input type='hidden' name='Cancel' value='Cancel'/>
			<p align='center'><input type='submit'  value='Cancel'/></p></form>
			</div>
			
	";}

//edit Ticket Section
if (isset($_SESSION['edit_TicketButton'])){
	if(! isset($_SESSION['edit_Ticket#'])){
		echo "
			<!--edit Ticket -->
			<div class='inner'>
			<h3 align='center'>Edit Ticket</h3>
			<form method=post id='editTicket'>
			<label for='edit_Ticket#'>Ticket #</label>
			<input  class='smallbox' type='number' pattern='[0-9]*' min='0'  required name='edit_Ticket#' value=''>
			<p></p>
			<p align='center'><input  type='submit' value='Continue'/></p>
			</form>
			<form method='post'>
			<input type='hidden' name='Cancel' value='Cancel'/>
			<p align='center'><input type='submit'  value='Cancel'/></p></form>
			</div>
			";
	} else {
		//pull previous ticket information
		require_once "pdo.php";
		$oldinfo_sql = "SELECT l.*, s.`Student Status` FROM log AS l INNER JOIN `students14_15` AS s ON s.`Student ID`=l.`Student ID` Where `tStatus`='Open' AND `Ticket #`=".$_SESSION['edit_Ticket#'];
		$oldinfostmt = $pdo->query($oldinfo_sql);
		$oinfo=$oldinfostmt->fetch(PDO::FETCH_ASSOC);
		$numofticks=$oldinfostmt->rowCount();
		//does ticket exist???
		if($numofticks===0){
			$ticknoexist="Not an existing open ticket";
			echo"
				<div class='inner'>
				<h3 align='center'>".$ticknoexist."</h3>
				</div>
			";
			unset($_SESSION['edit_Ticket#']);
			unset($_SESSION['edit_TicketButton']);
		} else {
			//student status
			if ($oinfo['Student Status']==="Owes Fine"){
				$o1=NULL;
				$o2="Selected";
				$o3=NULL;
			} elseif ($oinfo['Student Status']==="Red Cased") {
				$o1=NULL;
				$o2=NULL;
				$o3="Selected";
			} else {
				$o1="Selected";
				$o2=NULL;
				$o3=NULL;
			}
			//ipad status
			if ($oinfo['ipadstatus']==="Distributed"){
				$s1=NULL;
				$s2=NULL;
				$s3=NULL;
				$s4=NULL;
				$s5=NULL;
			} elseif ($oinfo['ipadstatus']==="Cart") {
				$s1=NULL;
				$s2="Selected";
				$s3=NULL;
				$s4=NULL;
				$s5=NULL;
			} elseif ($oinfo['ipadstatus']==="Damaged") {
				$s1=NULL;
				$s2=NULL;
				$s3="Selected";
				$s4=NULL;
				$s5=NULL;
			} elseif ($oinfo['ipadstatus']==="Good to Go"){
				$s1=NULL;
				$s2=NULL;
				$s3=NULL;
				$s4="Selected";
				$s5=NULL;
			} elseif ($oinfo['ipadstatus']==="Lost/Stolen") {
				$s1=NULL;
				$s2=NULL;
				$s3=NULL;
				$s4=NULL;
				$s5="Selected";
			} else{
				$s1=NULL;
				$s2=NULL;
				$s3=NULL;
				$s4=NULL;
				$s5=NULL;
			}
		
		//edit ticket form
		echo "
			<!--Edit Ticket -->
			<div class='inner'>
			<h3 align='center'>Edit Ticket #".$_SESSION['edit_Ticket#']."</h3>
			<form method=post id='editTicketinfo'>
			<label for='edit_iPad#'>iPad #</label>
			<input id='editnum' class='smallbox' type='number' pattern='[0-9]*' min='0' name='edit_iPad#' readonly value='".$oinfo['iPad #']."'>
			<input id='oldnum' type='hidden' value=''/>
			<p><label for='edit_removeipad'>Unassign ipad</label>
			<input type='checkbox' id='removeipad' name='edit_removeipad' style='display:initial;' onchange='removeIpad()'/></p>
			<p><label for='edit_StudentStatus'>Student Status</label>
			<select name='edit_StudentStatus'>

				<option ".$o1." value='Good'>Good</option>
				<option ".$o2." value='Owes Fine'>Owes Fine</option>
				<option ".$o3." value='Red Cased'>Red Cased</option>
			</select></p>
			<p><label for='edit_iPadStatus'>iPad Status</label>
			<select name='edit_iPadStatus'>
				
	        		<option value='Distributed' ".$s1.">Distributed</option>
					<option value='Cart' ".$s2.">Cart</option>
	    		<option disabled>──────────</option>
	        		<option value='Damaged' ".$s3.">Damaged</option>
					<option value='Good to Go' ".$s4.">Good to Go</option>
				<option disabled>──────────</option>
	    			<option value='Lost/Stolen' ".$s5.">Lost/Stolen</option>
			</select></p>
			<p><label for='edit_Description'>Description</label>
			<textarea  style='font: normal 14px verdana; min-height: 80px;' name='edit_Description' form='editTicketinfo' placeholder='".$oinfo['Comments']."'></textarea></p>
			
			<input type='hidden' name='edit_TicketChanges' value='go'/>
			<p align='center'><input type='submit' value='Submit Changes'/></p>
			</form>
			<form method='post'>
			<input type='hidden' name='Cancel' value='Cancel'/>
			<p align='center'><input type='submit'  value='Cancel'/></p></form>
			</div>
			
			";
		}

	}


}
	?>	
	</section>