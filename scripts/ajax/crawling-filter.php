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
		$startDate 	= (isset($_POST['startdate'])) 	? $_POST['startdate'] 	: "";
		$endDate 	= (isset($_POST['enddate'])) 	? $_POST['enddate'] 	: "";
		$product 	= (isset($_POST['product'])) 	? $_POST['product'] 	: "";

		$allLogs = Pricelog::getCrawlingHistory($product, $startDate, $endDate);
		
		if (empty($allLogs)) {
			$response['data'] = '<p>There are not results to show for this search.</p>';
		} else {
			$inc = 0;
			$tableHtml = "<table id='historyTable'>".
							"<thead>".
								"<tr>".
									"<th>#</th>".
									"<th>Name</th>".
									"<th>Price</th>".
									"<th>Time</th>".
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
		}

	} catch (Exception $e) {
		$response = array(
			'code' => '500',
			'msg' => 'Some error occured while we have tried to display the crawling data.',
			'data' => ''
		);
	}

	echo json_encode($response);
?>