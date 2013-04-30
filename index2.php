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
  <link rel="shortcut icon" href="assets/img/CPDlogo.png">
  </head>
  
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript' src="assets/js/jquery.js"></script>
  <script type='text/javascript' src='assets/js/bootleg2.js'></script>
  <script type='text/javascript' src='assets/js/controller2.js'></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

  <script type="text/javascript">
    google.load('visualization', '1', {packages:['table']});
    google.load("visualization", "1", {packages:["corechart"]});
    
    <?php
        //Combine all PHP into one file
        include 'GetData.php';
        
        //Load Customer Data
        $customers = calcFields(rowRange(getData("CPD_Customer Attr and Park Use Data_v2.csv"),0,30000));
        //$custpark = getData('CPD_Customer Park Use Data_v1.csv');
        
        //Load Parks Data
        $parks = getData('CPD_Park Performance Data_v2.csv');
        $latlong = getData('CPD Park Locations.csv');
    ?>
    
    function initialize(){
        <?php
        //Assemble tables in PHP
        $parkdata = addParkData($parks,$latlong);
        
        //Create appropriate Google Tables
        googleTable($customers,"customers"); // 30-50k by 20
        googleTable($parkdata,"parkdata"); //15-30k by 8
        //googleTable($custpark,"custpark"); //200k by 2
        
        ?>
        //Load Welcome Page
        navScripts("home2",customers,parkdata);
        
        //Controller for Navigation Menu
        $(".reload").click(function(){
            $("#main-container").html("<p class='spinner' style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>");
            var hash = this.href.indexOf("#");
            var val = this.href.substring(hash+1);
            $("li").removeClass("active");
            $("li#"+val).addClass("active");
            navScripts(val,customers,parkdata);
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
              <li id="home2" class="active"><a class="reload" href="#home2">Home</a></li>
              <li id="parks2"><a class="reload" href="#parks2">Parks</a></li>
              <li id="customers3"><a class="reload" href="#customers3">Customers</a></li>
              <li id="about"><a class="reload" href="#about">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
      
    <div id="main-container" class="container"></div>
    <!-- /container -->
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
