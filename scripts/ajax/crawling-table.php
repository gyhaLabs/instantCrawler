<?php
	/**
	* @note Retrieve all the crawled data;
	* @author Hunor-Arpad GYORGY;
	* @date 2019-03-28
	*/

	header('Content-Type: application/json');
	include('../../classes/Pricelog.php');

	$response = array(
		'code' => '200',
		'msg' => 'Successfully retrieved!',
		'data' => ''
	);

	try{
		$allLogs = Pricelog::getAll();
		
		$inc = 0;
		$tableHtml = "<table id='logList'>".
						"<thead>".
							"<tr>".
								"<th>#</th>".
								"<th>Name</th>".
								"<th>Price</th>".
								"<th>Timestamp</th>".
							"</tr>".
						"</thead>".
						"<tbody>";

		foreach ($allLogs as $row) {
			$inc++;
			$tableHtml .= "<tr><td>".$inc."</td><td>".$row['name']."</td><td>".$row['price']."</td><td>".$row['timestamp']."</td></tr>";
		}

		$tableHtml .= "</tbody>".
					"</table>";
		
		$response['data'] = $tableHtml;

	} catch (Exception $e) {
		$response = array(
			'code' => '500',
			'msg' => 'Some error occured while we have tried to display the crawling data.',
			'data' => ''
		);
	}

	echo json_encode($response);
?>