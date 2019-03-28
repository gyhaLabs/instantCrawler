<?php
	/**
	* @note Initiating a single cycle of crawling;
	* @author Hunor-Arpad GYORGY;
	* @date 2019-03-28
	*/

	header('Content-Type: application/json');
	include('../../classes/Crawler.php');

	$response = array(
		'code' => '200',
		'msg' => 'Successfully crawled!',
		'data' => ''
	);

	try{
		$crawler = new Crawler();
		$crawler->doACrawlingCycle();
		$response['data'] = 'Success';

	} catch (Exception $e) {
		$response = array(
			'code' => '500',
			'msg' => "The crawling process has been finished with some errors.",
			'data' => ''
		);
	}

	echo json_encode($response);
?>