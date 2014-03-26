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

// EC2 data
$ec2 = new AmazonEC2();
$ec2->set_region(AmazonEC2::REGION_EU_W1);
$instances = $ec2->describe_instances();

$chart_parameters = array();

if ($instances->isOK())
{
   foreach($instances->body->reservationSet->children() as $reservationItem) 
   {
      foreach($reservationItem->instancesSet->children() as $instanceItem)
      {
         // only instances that are up have a public dns name
         // if the instance is not running; we'll assume it's down
         $dnsName = "down";
         if ($instanceItem->instanceState->name == "running")
            $dnsName = $instanceItem->dnsName;
            
         $instance_id = $instanceItem->instanceId;
 
         // lets go through the tags and find the value of the one with
         // the key "Name"
         $ec2_name = "";
         foreach($instanceItem->tagSet->children() as $tag)
            if ($tag->key == "Name") {
               $ec2_name = $tag->value;
               break;
            }
 
        // echo($ec2_name.": ".$dnsName." - ".$instance_id."<br>");


      $dimensions = array('InstanceId' => $instance_id);
      //if (strpos($ec2_name,'live') !== false) {
      $ec2_label = str_replace('-','_',$ec2_name);
      
      $chart_parameters['cpu_data_'.$ec2_label] = array( 
                        'namespace' => 'AWS/EC2',
                        'metric' => 'CPUUtilization',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Percent',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "cpu_data_".$ec2_label,
                        'graph_label_name' => $ec2_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d1"
                       );
      //requires ec2 memory custom metric cron running: https://gist.github.com/PercussiveRepair/9781858
      // $chart_parameters['memusage_'.$ec2_label] = array(
      //                   'namespace' => 'EC2/Memory',
      //                   'metric' => 'MemUsage',
      //                   'fromtime' => $fromtime,
      //                   'endtime' => $endtime,
      //                   'period' => $period,
      //                   'result' => 'Average',
      //                   'unit' => 'Percent',
      //                   'dimensions' => $dimensions,
      //                   'multiplier' => 1,
      //                   'graph_variable_name' => "memusage_".$ec2_label,
      //                   'graph_label_name' => $ec2_name,
      //                   'graph_color' => array_rand($chart_colours,1),
      //                   'chart_name' => "d2"
      //                   );
      $chart_parameters['network_in_'.$ec2_label] = array(
                        'namespace' => 'AWS/EC2',
                        'metric' => 'NetworkIn',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Bytes',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "network_in_".$ec2_label,
                        'graph_label_name' => $ec2_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d2"
                        );
      $chart_parameters['network_out_'.$ec2_label] = array(
                        'namespace' => 'AWS/EC2',
                        'metric' => 'NetworkOut',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Bytes',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "network_out_".$ec2_label,
                        'graph_label_name' => $ec2_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d3"
                        );
 
    //}
   }
}
}

//add chart data to the array

require 'graph.php';

//echo "<pre>";
//print_r ($instances);
//echo "</pre>";


?>
