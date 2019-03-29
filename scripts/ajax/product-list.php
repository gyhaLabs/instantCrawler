<?php
	/**
	* @note Retrieve all the crawled products;
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
		$allLogs = Pricelog::getAllCrawledProducts();

		$tableHtml = '';
		foreach ($allLogs as $row) {
			$tableHtml .= "<option value='".$row['product_id']."'>".$row['name']."</option>";
		}

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