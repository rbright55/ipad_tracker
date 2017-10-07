
<html>
<head>
	<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollgress.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>

<script type="text/javascript">
	function searchq() {
		var searchTxt = $("input[name='search']").val();

		$.post("search.php", {searchVal: searchTxt}, function(output){
			$("#output").html(output);
		});
	}
</script>
</head>
<i class="icon fa-search" id="searchmag" type="text"></i>
<div id="completesearch">
<form action="test.php" method="post" id="searchform">
	<input type="text" name="search" id="searchbox" autocomplete="off"  placeholder="Search Students"onkeyup="searchq();" />
</form>
<div id="output"></div>
</div>
</html>