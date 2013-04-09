
<!DOCTYPE html>
<html lang="en">
  <?php

  ?>
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
    </style>
    
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

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
  <script src="http://d3js.org/d3.v3.min.js"></script>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type="text/javascript">
    google.load('visualization', '1', {packages:['table']});
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(visualizations);
    function visualizations() {
        <?php
        include 'GetData.php';
        include 'visualizations.php';
        $data = colRange(rowRange(getData("testdata.csv"),1,1000),0,7);
        visualizations($data);
        ?>
        var options = {
            showRowNumber: false,
            page: 'enable',
            pageSize: 20,
            sortColumn: 0
        }
        var options1 = {
          title: 'Race Percentages',
          legend: {position:'none'},
          height: 250
        };
        var options2 = {
          title: 'Race vs. Income Comparison',
          hAxis: {title: 'Income', minValue: 0},
          vAxis: {title: 'Percentage Race', minValue: 0},
          colors: ['wheat','#993300'],
          legend: 'none',
          height: 250
        };
        
        var table = new google.visualization.Table(document.getElementById('contactdiv'));
        table.draw(data, options);
        var chart1 = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart1.draw(data1, options1);
        var chart2 = new google.visualization.ScatterChart(document.getElementById('scatter_div'));
        chart2.draw(data2, options2);
    }
    
    $(document).ready(function(){
        $("#main-container").load("home.php");
    });
    function initialize(){
        $(".viz").hide();
        $("#homediv").show();
        $(".reload").click(function(){
            $(".viz").hide();
            $("#main-container").show()
            $("#main-container").html("<p style='text-align:center'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>");
            hash = this.href.indexOf("#");
            val = this.href.substring(hash+1);
            $("li").removeClass("active");
            $("li#"+val).addClass("active");
            $("#"+val+"div").show();
            $("#main-container").load(val+".php");
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
          <a class="brand reload" href="#home"><img style="height:40px;position:absolute;top:0px" src="assets/img/CPDlogo.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chicago Park District</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li id="home" class="active"><a class="reload" href="#home">Home</a></li>
              <li id="segment"><a class="reload" href="#segment">Segmentation</a></li>
              <li id="rules"><a class="reload" href="#rules">Association Rules</a></li>
              <li id="email"><a class="reload" href="#email">Email Lists</a></li>
              <li id="forecasts"><a class="reload" href="#forecasts">Forecasts</a></li>
              <li id="about"><a class="reload" href="#about">About</a></li>
              <li id="contact"><a class="reload" href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
      
    <div id="main-container" class="container"></div>
    <div id="contactdiv" class="viz container"></div>
    <div class="viz container" id="homediv">
        <div id="chart_div" class="span4">
            <p style='text-align:center'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
        </div>
        <div id="scatter_div" class="span4">
            <p style='text-align:center'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
        </div>
        <div id="d3div" class="span4">
            <p style='text-align:center'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
        </div>
    </div>
    <!-- /container -->
    <div id="footer">
      <div class="container">
          <br>
        <p class="muted credit">Portal courtesy of <a href="#">Scott Albrecht</a>, <a href="#">David Cooperberg</a>, <a href="#">Laura Siahaan</a> and <a href="#">Alice Zhao</a>.</p>
      </div>
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
