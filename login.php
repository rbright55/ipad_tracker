<?php	
session_start();
if (isset($_SESSION['signedin'])){
    	header('Location: index.php');
		
}
if (isset($_POST['username']) && isset($_POST['password'])){
    		unset ($_SESSION['username']);
    		unset ($_SESSION['password']);
    		$_SESSION['username'] = $_POST['username'];
    		$_SESSION['password'] = $_POST['password'];
    		unset ($_POST['username']);
    		unset ($_POST['password']);
    		
}
if (isset($_SESSION['username']) && isset($_SESSION['password'])){
        	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    		require_once "pdo.php";
			$stmt = $pdo->prepare("SELECT * FROM admin WHERE `Username` = :us AND `Password` = :pw");
			$stmt->execute(array(
				':us' => $_SESSION['username'],
				':pw' => $_SESSION['password']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			   if (! $row === FALSE ) {  
			    
			  	 $_SESSION['msg'] = "Login Successful"; 				
      				if ($row['Super?'] = 1){
						$_SESSION['super'] = "TRUE";
						$_SESSION['account'] = "admin";
						$_SESSION['signedin'] = "true";
						
					} else {
						$_SESSION['account'] = "admin";
						$_SESSION['signedin'] = "true";
					}

   				} else if ( $row === FALSE ){
   				    unset ($_SESSION['username']);
    				unset ($_SESSION['password']);
   				 	$_SESSION['msg'] = "Login Incorrect";
   				}
   		unset ($_SESSION['username']);
    		unset ($_SESSION['password']);
   		header('Location: #');
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
	<body class="index">
		<header id="header" class="alt">
		<?php
			include "navigation.php";
		?>
			</header>
		<!-- Banner -->		
			<section id="banner">
				
				<!--
					".inner" is set up as an inline-block so it automatically expands
					in both directions to fit whatever's inside it. This means it won't
					automatically wrap lines, so be sure to use line breaks where
					appropriate (<br />).
				-->
				<div class="inner">
					<p><strong>Enter User Information</strong></p>
					<header>
					<form method="post">
					<p>Username:</p>
						<?php
						echo '<input onclick="this.select()" value="'."$username".'" type="text"  name="username" size="" required>';
						unset($_SESSION["username"]);
						?>
						<p>Password:</p>
						<?php
						echo '<input onclick="this.select()" type="password"  name="password" size="" required>';
						?>
					</header>
					
					<footer>
					<?php
					if ( isset($_SESSION['msg']) ) {
      					echo "<h1>".$_SESSION["msg"]."</h1>\n";
      				 	unset($_SESSION["msg"]);
   					}
   					 	
					?>
						<input class="button special" type="submit" value="Sign In"/>
						</form>						
					</footer>
				
				</div>
				
			</section>

				
	
		<?php
			include "footer.php";
			    
		?>


	</body>
</html>