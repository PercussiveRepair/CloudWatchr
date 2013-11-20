<?php
date_default_timezone_set('Europe/London'); //Set to your timezone
require_once dirname(__FILE__) . '/ec2_data.php';
?>
<html lang="en">
<head>
<title>CW Graphs</title>
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
<div class="container">
<div class="page-header">
<h2>EGO CW Graphs</h2>
</div>
<?php include 'nav.php'; ?>


</body>
</html>
