<?php
	/**
	* @note Product Insert script - for the ajax request fired by the user;
	* @author Hunor-Arpad GYORGY;
	* @date 2019-03-28
	*/

	header('Content-Type: application/json');
	include('../../classes/Product.php');

	$response = array(
		'code' => '200',
		'msg' => 'Successfully inserted!',
		'data' => ''
	);

	if (isset($_POST['url'])) {
		$url = $_POST['url'];
		$store = 'other';

		if (preg_match('/(emag.ro)/', $_POST['url'])) {
			$store = 'Emag.ro';
		}

		if (preg_match('/(altex.ro)/', $_POST['url'])) {
			$store = 'Altex.ro';
		}

		if (preg_match('/(cel.ro)/', $_POST['url'])) {
			$store = 'Cel.ro';
		}

		try{
			$newProduct = new Product($url, $store);
			$insertedId = $newProduct->saveProduct();
			$response['data'] = $insertedId;

		} catch (Exception $e) {
			$response = array(
				'code' => '500',
				'msg' => $e,
				'data' => ''
			);
		}
	}

	echo json_encode($response);
?>