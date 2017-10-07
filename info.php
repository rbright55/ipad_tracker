		<!-- Main -->
			<a name="ipadinfo"></a>	
			<article id="main">
			
					<header class="special container">

					<span class="icon fa-tablet"></span>
					<?php
						if ($inumber !== '' ) {
							echo "<h3><strong>"."iPad #"."$inumber</h3>\n";
					}
					?>
					</header>
					
				<!-- Info section -->
					<section>
							<div class="inner">
							<?php
							    require_once "pdo.php";
								$stmt = $pdo->query("SELECT * FROM students14_15 WHERE `iPad #` = $inumber");
								
		//check if iPad is assigned to a student
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
								if ($row === FALSE) {
									$ipadmsg = "iPad not Assigned to student";
								} else { 
		//find Student information associated with the iPad
								echo '<table class="smals">'."\n";
								    echo '<thead><tr><th align="left">';
								    echo "Name:";
								    echo('</th><th align="left">');
								    if (isset($_SESSION['account']) && $_SESSION['account'] === "admin"){
										echo '<a href="./students.php?studentid='.$row["Student ID"].'">';
									}
								    echo($row['First Name']);
								    echo " ";
								    echo ($row['Last Name']);
								    if (isset($_SESSION['account']) && $_SESSION['account'] === "admin"){
										echo '</a>';
									}
								    echo('</th></tr></thead><tbody><tr><td align="left">');
								    echo "Username:";
								    echo('</td><td align="left">');
								    echo($row['Username']);
								    echo('</td></tr><tr><td align="left">');
								    echo "Password:";
								    echo('</td><td align="left">');
								    $id = substr($row['Student ID'], -5);
								    echo("Mta"."$id");
								    echo('</td></tr><tr><td align="left">');
								    echo "Homeroom:";
								    echo('</td><td align="left">');
								    echo("Grade ".$row['Grade']." ".$row['Homeroom']);
								    echo("</td></tr>\n");
								    echo "</tbody></table>\n";
								} 

//display message if ipad not assigned or doesn't exist
								$stmt = $pdo->query("SELECT * FROM iPads WHERE `iPad #` = $inumber");
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
									if (! $row === FALSE) {
										echo '<h2>'.$ipadmsg.'</h2>';
									} else {
										$ipadmsg = "iPad does not exist";
										echo '<h2>'.$ipadmsg.'</h2>';
									} 
							?>

							
							</div>
					</section>
			</article>