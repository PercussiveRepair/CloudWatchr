<?php
require_once dirname(__FILE__) . '/AWS-sdk/sdk.class.php';
include 'chart_colours.php';

if ($_GET["period"]) {
  $period = htmlspecialchars($_GET["period"]);
} else {
  $period = 300;
}
if ($_GET["fromtime"]) {
  $fromtime = htmlspecialchars($_GET["fromtime"]);
} else {
  $fromtime = "-6 hour";
}
if ($_GET["endtime"]) {
  $endtime = htmlspecialchars($_GET["endtime"]);
} else {
  $endtime = "now";
}

// RDS data
$rds = new AmazonRDS();
$rds->set_region(AmazonRDS::REGION_EU_W1);
$dbinstances = $rds->describe_db_instances();

$chart_parameters = array();

if ($dbinstances->isOK())
{
   foreach($dbinstances->body->DescribeDBInstancesResult->DBInstances->children() as $dbItem) 
   {
      $rds_name = (string)$dbItem->DBInstanceIdentifier;
      $dimensions = array('DBInstanceIdentifier' => $rds_name);
      //Remove this if in order to show all instances
      if (strpos($rds_name,'live') !== false) {  
      //javascript was all like 'Waaah! I don't like hyphens in vars, cos they look like minus signs!' So I was like 'Fine. There. You happy now?'
      $rds_label = str_replace('-','_',$rds_name);
      
      $chart_parameters['cpu_data_'.$rds_label] = array( 
                        'namespace' => 'AWS/RDS',
                        'metric' => 'CPUUtilization',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Percent',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "cpu_data_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d1"
                       );
      $chart_parameters['connections_data_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'DatabaseConnections',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Count',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "connections_data_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d2"
                        );
      $chart_parameters['write_iops_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'WriteIOPS',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Count/Second',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "write_iops_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d3"
                        );
      $chart_parameters['replica_lag_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'ReplicaLag',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Seconds',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "replica_lag_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d4"
                        );
      $chart_parameters['read_iops_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'ReadIOPS',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Count/Second',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "read_iops_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d5"
                        );
      $chart_parameters['free_memory_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'FreeableMemory',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Maximum',
                        'unit' => 'Bytes',
                        'dimensions' => $dimensions,
                        'multiplier' => 0.00000095367431640625,
                        'graph_variable_name' => "free_memory_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d6"
                        );
      $chart_parameters['free_storage_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'FreeStorageSpace',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Maximum',
                        'unit' => 'Bytes',
                        'dimensions' => $dimensions,
                        'multiplier' => 0.00000095367431640625,
                        'graph_variable_name' => "free_storage_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d7"
                        );
      $chart_parameters['binlog_usage_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'BinLogDiskUsage',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Maximum',
                        'unit' => 'Bytes',
                        'dimensions' => $dimensions,
                        'multiplier' => 0.00000095367431640625,
                        'graph_variable_name' => "binlog_usage_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d8"
                        );
      $chart_parameters['read_latency_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'ReadLatency',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Maximum',
                        'unit' => 'Seconds',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "read_latency_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d9"
                        );
      $chart_parameters['write_latency_'.$rds_label] = array(
                        'namespace' => 'AWS/RDS',
                        'metric' => 'WriteLatency',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Maximum',
                        'unit' => 'Seconds',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "write_latency_".$rds_label,
                        'graph_label_name' => $rds_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d10"
                        );
      }
   }
}

//add chart data to the array

require 'graph.php';

//echo "<pre>";
//print_r ($chart_parameters);
//echo "</pre>";


?>
