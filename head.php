<head>
  <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="icon" href="images/apple-touch-icon-57x57-precomposed.png" type="image/x-icon">
    <!-- 57x57 (precomposed) for iPhone 3GS, 2011 iPod Touch and older Android devices -->
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57x57-precomposed.png">
    <!-- 72x72 (precomposed) for 1st generation iPad, iPad 2 and iPad mini -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72x72-precomposed.png">
    <!-- 114x114 (precomposed) for iPhone 4, 4S, 5 and 2012 iPod Touch -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114x114-precomposed.png">
    <!-- 144x144 (precomposed) for iPad 3rd and 4th generation -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144x144-precomposed.png">
    <!-- iPhone SPLASHSCREEN-->
    <link href="images/apple-touch-startup-image-320x460.png" media="(device-width: 320px)" rel="apple-touch-startup-image">
    <!-- iPhone (Retina) SPLASHSCREEN-->
    <link href="images/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (device-height: 460px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <!-- iPhone 5 (Retina) SPLASHSCREEN-->
    <link href="images/apple-touch-startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <!-- iPad (non-Retina) (Portrait) -->
    <link href="images/apple-touch-startup-image-768x1004.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" rel="apple-touch-startup-image" />
    <!-- iPad (non-Retina) (Landscape) -->
    <link href="images/apple-touch-startup-image-1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" rel="apple-touch-startup-image" />
    <!-- iPad (Retina) (Portrait) -->
    <link href="images/apple-touch-startup-image-1536x2008.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <!-- iPad (Retina) (Landscape) -->
    <link href="images/apple-touch-startup-image-2048x1496.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dropotron.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/jquery.scrollgress.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <noscript>
      <link rel="stylesheet" href="css/skel.css" />
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="css/style-wide.css" />
      <link rel="stylesheet" href="css/style-noscript.css" />
    </noscript>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript">
  if(("standalone" in window.navigator) && window.navigator.standalone){
    var noddy, remotes = false;
    document.addEventListener('click', function(event) {
      noddy = event.target;
      while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
        noddy = noddy.parentNode;
      }
      if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes)){
        event.preventDefault();
        document.location.href = noddy.href;
      }
    },false);
  }
</script>
<script>
  jQuery(document).ready(function(){
    $('#addname').autocomplete({
      source : 'autosuggest.php',
      autoFocus: true,
      select: function( event, ui ) {
      event.preventDefault();
      document.getElementById("blue").value= ui.item.value;
      document.getElementById("addname").value= ui.item.label;
      },

    });
  });
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".scroll").click(function(event){   
      event.preventDefault();
      $('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
    });
  });
</script>
<script type="text/javascript">
  function searchq() {
    var searchTxt = $("input[name='search']").val();

    $.post("search.php", {searchVal: searchTxt}, function(output){
      $("#output").html(output);
    });
  }
</script>
<script type="text/javascript">
  function userName(){
      var user = document.getElementById("uname");
      var fname = document.getElementById("fname").value;
      var lname = document.getElementById("lname").value;
      var grade = document.getElementById("grade").value;
      var d = new Date();
      var mon = d.getMonth();
      var n = d.getFullYear();
      if (mon > 6){
      	n= n+1;
      }
      var gyear = n - 2000;
      var syear = gyear+(8-grade);
      if (grade <1){
         syear = "";
      }
      uname.value = syear + fname.charAt(0) + lname;
  }
</script>
<script type="text/javascript">
  function removeIpad(){
    var status = document.getElementById("removeipad").checked;
    var oldnum = document.getElementById("editnum").value;
    var oldnumm = document.getElementById("oldnum").value;

    if(status === true){
      document.getElementById("oldnum").value = oldnum;
      document.getElementById("editnum").value = null;
    }
    if (status === false){
      document.getElementById("editnum").value = oldnumm;
    }
  }
</script>
</head>