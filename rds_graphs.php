<?php
date_default_timezone_set('Europe/London'); //Set to your timezone
require_once dirname(__FILE__) . '/rds_data.php';
?>
<html lang="en">
<head>
<title>RDS Graphs</title>
<!--you can replace the below stylesheet with your own style sheet -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!--need to include the following javascripts for graphing tool flot-->
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="jquery/excanvas.min.js"></script><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
include("nav.php");
?>
<div class="container">
<div class="page-header">
<h2>EGO RDS Graphs</h2>
</div>

<!--the div where chart has to be plotted should have an id="divname_div", use divname on cloudwatch.chart.php-->

  <h4>CPU Usage:</h4>
  <div class='chart' id='d1_div'></div>
  <h4>Connections:</h4>
  <div class='chart' id='d2_div'></div>
  <h4>Replica Lag:</h4>
  <div class='chart' id='d4_div'></div>
  <h4>Read IOPS:</h4>
  <div class='chart' id='d5_div'></div>
  <h4>Write IOPS:</h4>
  <div class='chart' id='d3_div'></div>
  <h4>Free Memory MB:</h4>
  <div class='chart' id='d6_div'></div>
  <h4>Free Storage MB:</h4>
  <div class='chart' id='d7_div'></div>
  <h4>Binlog Disk Usage MB:</h4>
  <div class='chart' id='d8_div'></div>
  <h4>Read Latency:</h4>
  <div class='chart' id='d9_div'></div>
  <h4>Write Latency:</h4>
  <div class='chart' id='d10_div'></div>


<!--call this function in body division at end, this starts rendering chart after the page is loaded until here -->
<script src="//code.jquery.com/jquery.js"></script>
<script language="javascript" type="text/javascript" src="jquery/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="jquery/jquery.flot.hiddengraphs.js"></script>
<script language="javascript" type="text/javascript" src="jquery/jquery.flot.time.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<?php print_cloudwatch_charts(); ?>

</body>
</html>
