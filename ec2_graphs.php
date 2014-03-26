<?php
date_default_timezone_set('Europe/London'); //Set to your timezone
require_once dirname(__FILE__) . '/ec2_data.php';
?>
<html lang="en">
<head>
<title>EC2 Graphs</title>
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
<?php include 'nav.php'; ?>
<div class="container">
<div class="page-header">
<h2>EGO EC2 Graphs</h2>
</div>

<!--the div where chart has to be plotted should have an id="divname_div", use divname on cloudwatch.chart.php-->

  <h4>EC2 - CPU Usage:</h4>
  <div class='chart' id='d1_div'></div>
 <!--  <h4>EC2 - Memory Usage:</h4>
  <div class='chart' id='d2_div'></div> -->
  <h4>EC2 - Network Received:</h4>
  <div class='chart' id='d3_div'></div>
  <h4>EC2 - Network Sent:</h4>
  <div class='chart' id='d4_div'></div>
  
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
