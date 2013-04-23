
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>CPD Analytics Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }

        .selected {
            height: 50;
        }
    </style>
    
    <!--<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">-->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/img/CPDlogo.png">
  </head>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript' src="assets/js/jquery.js"></script>
  <script type='text/javascript' src='assets/js/bootleg.js'></script>
  <script type='text/javascript' src='assets/js/controller.js'></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

  <script type="text/javascript">
    google.load('visualization', '1', {packages:['table']});
    google.load("visualization", "1", {packages:["corechart"]});
    var programs = new Array();
    var prodescs = new Array();
    var loyalty = new Array();
    var loydescs = new Array();
    
    <?php
        include 'GetData.php';
        include 'visualizations.php';
        $data = colRange(rowRange(getData("testdata1.csv"),0,300),0,29);
        $programs = getData('testcluster1.csv');
        $loyalty = getData('testcluster2.csv');
        $market = getData('mbtest.csv');
        $parks = getData('CPD_Park Performance Data_v1.csv');
        for ($i = 1; $i<count($programs);$i++){
            $loc = strpos($programs[$i][0],"|");
            echo "programs.push('".substr($programs[$i][0],0,$loc)."');\n";
            echo "prodescs.push('".substr($programs[$i][0],$loc+1)."');\n";
        }
        for ($j = 1; $j<count($loyalty);$j++){
            $loc2 = strpos($loyalty[$j][0],"|");
            echo "loyalty.push('".substr($loyalty[$j][0],0,$loc2)."');\n";
            echo "loydescs.push('".substr($loyalty[$j][0],$loc2+1)."');\n";
        }
        //$paths = file_get_contents("parks.txt");
    ?>
    
    $(document).ready(function(){
        
    });
    function initialize(){
        <?php
        googleTable(addCluster(addCluster($data,$programs,"Program Cluster"),$loyalty,"Loyalty Cluster"),"data");
        googleTable($market,"market");
        googleTable($parks,"parkdata");
        ?>
            navScripts("home",data,market,parkdata);
        $(".reload").click(function(){
            $("#main-container").html("<p class='spinner' style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>");
            var hash = this.href.indexOf("#");
            var val = this.href.substring(hash+1);
            $("li").removeClass("active");
            $("li#"+val).addClass("active");
            $("#"+val+"div").show();
            navScripts(val,data,market);
        });
    }
</script>
  <body onload="initialize()">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand reload" href="#home"><img class="img-circle" style="height:40px;position:absolute;top:0px" src="assets/img/CPDlogo.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chicago Park District</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li id="home" class="active"><a class="reload" href="#home">Home</a></li>
              <li id="parks"><a class="reload" href="#parks">Park Performance</a></li>
              <li id="segment"><a class="reload" href="#segment">Segmentation</a></li>
              <li id="rules"><a class="reload" href="#rules">Association Rules</a></li>
              <li id="about"><a class="reload" href="#about">About</a></li>
              <li id="contact"><a class="reload" href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
      
    <div id="main-container" class="container"></div>
    <!-- /container -->
    <hr>
    <div id="footer">
      <div class="container">
        <p class="muted credit">Portal courtesy of 
            <a target="_blank" href="http://www.analytics.northwestern.edu/student/student_profiles/Albrecht-Scott-Northwestern-University-Master-of-Science-in-Analytics.html">Scott Albrecht</a>, 
            <a target="_blank" href="http://www.analytics.northwestern.edu/student/student_profiles/David-Cooperberg-Master-of-Science-in-Analytics-Northwestern-Universityg-.html">David Cooperberg</a>, 
            <a target="_blank" href="http://www.analytics.northwestern.edu/student/student_profiles/Siahaan-Laura-Northwestern-University-Master-of-Science-in-Analytics.html">Laura Siahaan</a> and 
            <a target="_blank" href="http://www.analytics.northwestern.edu/student/student_profiles/Zhao-Alice-Northwestern-University-Master-of-Science-in-Analytics.html">Alice Zhao</a>.</p>
      </div>
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>

  </body>
</html>
