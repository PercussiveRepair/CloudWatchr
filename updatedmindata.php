<?php

try {
	if( isset($chart_parameters[$_GET['chart']]) === true && empty($chart_parameters[$_GET['chart']]) === false) {
		$chart = $chart_parameters[$_GET['chart']];
		$data = getCloudWatchData($chart['namespace'], $chart['metric'], '-5 minute', 'now', 60, $chart['result'], $chart['unit'], $chart['dimensions'], $chart['multiplier']);
		$data_index = count($data) -1; //Get data for latest among the returned set, we just cannot get for last min due to time sync issues between machines
		$result = array();
		if(!empty($data[$data_index])) {
			$result['Status'] = 200;
			$result['Timestamp'] = $data[$data_index]['Timestamp'];
			$result[$chart['result']] = $data[$data_index][$chart['result']];
			print json_encode($result);
		}
	} else {
		$result['Status'] = -998;
		print json_encode($result);
	}
} catch ( exception $e) {
	$result['Status'] = -999;
	print json_encode($result);
}
?>

