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

// ELB data
$elb = new AmazonELB();
$elb->set_region(AmazonELB::REGION_EU_W1);
$elbs = $elb->describe_load_balancers();

$chart_parameters = array();

//if ($elbs->isOK())
//{
  foreach($elbs->body->DescribeLoadBalancersResult->LoadBalancerDescriptions->children() as $elbItem)
    {
      $elb_name = (string)$elbItem->LoadBalancerName;
      $dimensions = array('LoadBalancerName' => $elb_name);
      $elb_label = str_replace('-','_',$elb_name);
      
      $chart_parameters['request_count_data_'.$elb_label] = array(
                        'namespace' => 'AWS/ELB',				
                        'metric' => 'RequestCount', 		
                        'fromtime' => $fromtime, 				
                        'endtime' => $endtime, 					
                        'period' => $period, 					//interval between points in seconds ( >= 60 )
                        'result' => 'Sum', 					//Aggregation of required metric
                        'unit' => 'Count', 					//Unit of metric
                        'dimensions' => $dimensions, 	//Filter based on dimensions - Define the value on $dimension array above and use the name here
                        'multiplier' => 1, 					//If the value of plot has to be multiplied before plotting on chart - useful for byte to MB conversions
                        'graph_variable_name' => "request_count_data_".$elb_label, 		// Must be key value of this element in $chart_parameters array
                        'graph_label_name' => $elb_name, 			//Label name when plotted on chart
                        'graph_color' => array_rand($chart_colours,1),				//Color of chart to be plotted 
                        'chart_name' => "d1"					//id of html <div> where the chart has to be plotted, divname
                        );

		$chart_parameters['latency_data_'.$elb_label] = array(
                        'namespace' => 'AWS/ELB',
                        'metric' => 'Latency',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Maximum',
                        'unit' => 'Seconds',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => "latency_data_".$elb_label,
                        'graph_label_name' => $elb_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d2"
                        );
                        
		$chart_parameters['healthy_host_data_'.$elb_label] = array(
                        'namespace' => 'AWS/ELB',
                        'metric' => 'HealthyHostCount',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Average',
                        'unit' => 'Count',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => 'healthy_host_data_'.$elb_label,
                        'graph_label_name' => $elb_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d3"
                        );
    $chart_parameters['backend_http_2xx_data_'.$elb_label] = array(
                        'namespace' => 'AWS/ELB',
                        'metric' => 'HTTPCode_Backend_2XX',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Sum',
                        'unit' => 'Count',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => 'backend_http_2xx_data_'.$elb_label,
                        'graph_label_name' => $elb_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d4"
                        );
    $chart_parameters['backend_http_4xx_data_'.$elb_label] = array(
                        'namespace' => 'AWS/ELB',
                        'metric' => 'HTTPCode_Backend_4XX',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Sum',
                        'unit' => 'Count',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => 'backend_http_4xx_data_'.$elb_label,
                        'graph_label_name' => $elb_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d5"
                        );
    $chart_parameters['backend_http_5xx_data_'.$elb_label] = array(
                        'namespace' => 'AWS/ELB',
                        'metric' => 'HTTPCode_Backend_5XX',
                        'fromtime' => $fromtime,
                        'endtime' => $endtime,
                        'period' => $period,
                        'result' => 'Sum',
                        'unit' => 'Count',
                        'dimensions' => $dimensions,
                        'multiplier' => 1,
                        'graph_variable_name' => 'backend_http_5xx_data_'.$elb_label,
                        'graph_label_name' => $elb_name,
                        'graph_color' => array_rand($chart_colours,1),
                        'chart_name' => "d6"
                        );
    
     }
//}

require 'graph.php';

//echo "<pre>";
//print_r ($elbs);
//echo "</pre>";

?>
