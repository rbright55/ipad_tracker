<?php	
    session_start();

		$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
		setcookie(session_name(),session_id(),time()+$cookieLifetime);

    if ( isset($_POST['ipadnumber']) ) {
        $inumber = $_POST['ipadnumber'] + 0;
        $_SESSION['ipadnumber'] = $inumber;
        $_SESSION['previous'] = $inumber;
        if ( $inumber < 0 ) {
            unset($_SESSION['ipadnumber']);
        } else if ( $inumber == 0) {
            unset($_SESSION['ipadnumber']);
        }
        	header("Location: ./#ipadinfo");
        	return;
    } 
    $inumber = isset($_SESSION['ipadnumber']) ? $_SESSION['ipadnumber'] : '';
    $inum = isset($_SESSION['previous']) ? $_SESSION['previous'] : '';
    unset($_SESSION['ipadnumber']);



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
			include "head.php"
?>

	<body class="index">
		<header id="header" class="alt">
		<?php
			include "navigation.php";
		?>
			</header>
			
		<!-- Banner -->		
			<section id="banner">



				<article >
				<!--
					".inner" is set up as an inline-block so it automatically expands
					in both directions to fit whatever's inside it. This means it won't
					automatically wrap lines, so be sure to use line breaks where
					appropriate (<br />).
				-->
<!--Student Search-->
				<p><div id="completesearch">
<form onSubmit="return false;" method="post" id="searchform">
	<input type="standard" name="search" id="searchbox" autocomplete="off"  placeholder="Search Students" onkeyup="searchq();" onfocus="this.select()" />
</form>
<div id="output"></div>
</div>
</p>
</br>

				<div class="inner">
					<p><strong>Find iPad Assignment</strong></p>
					<header>
					<form name="numlookup" method="post">
						<?php
						echo '<h2><input placeholder="iPad #" onclick="this.select();" type="number" value="'."$inum".'" pattern="[0-9]*" min="0" maxlength="3" name="ipadnumber" size="40" required></h2>';
						unset($_SESSION['previous']);
						?>
					</header>
					<p>Please enter
					<br>iPad #</br></p>
					<footer>
						<input type="submit" value="Search iPad"/></form>						
					</footer>
				
				</div>
				
			</section>

		<!-- Ipadinfo -->
			<?php
			if ($inumber !== '' ) {
				include "info.php";
			}
			?>
		<?php
			if (isset($_SESSION['account'])){
				if ($_SESSION['account'] === "admin") {
					echo ' 

		<!-- CTA -->
			<section id="cta">
			
				<header>
					<h2>Need to change <strong>something</strong>?</h2>
					<p>Add new or update existing entries.</p>
				</header>
				<footer>
					<ul class="buttons">
						<li><a href="#" class="button">ipads</a></li>
						<li><a href="#" class="button">Students</a></li>
					</ul>
				</footer>
			
			</section>
							';}}
		?>
		</article>
		<?php
			include "footer.php";
		?>


	</body>
</html>