<?php 
date_default_timezone_set('America/Detroit');
?>
				<h1 id="logo"><a href="index.php">MTA <span>ipad info</span></a></h1>
				<!--search
				<i class="icon fa-search"></i>
				<input class="searchbox" placeholder="Search Students" type="text"></input>	</h1>
				-->
				
				<nav id="nav">
				
					<ul>

						<li class="current"><a  href="index.php"><i class="icon fa-home fa-lg"></i> Home</a></li>
						<li class="submenu">
							<a href="">More Info</a>
							<ul>
								<li><a class="icon fa-tablet" href="ipads.php"> iPads</a></li>
								<li><a class="icon fa-child" href="students.php"> Students</a></li>
								<li><a class="icon fa-book" href="log.php"> Log</a></li>
								<li><a href="settings.php"><i class="icon fa-cog fa-spin"></i> Settings</a></li>
							</ul>
						</li>
						<?php
						if (! isset($_SESSION['signedin'])){ echo '
						<li><a  href="login.php" class="button special icon fa-sign-in">Sign In</a></li>
						';}
						else { echo '
						<li><a href="logout.php" class="button special icon fa-sign-out">Sign Out</a></li>
						';}
						?>
					</ul>
				</nav>

				
	
