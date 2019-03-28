<?php
	/**
	* @note Retrieve all the saved product-urls;
	* @author Hunor-Arpad GYORGY;
	* @date 2019-03-28
	*/

	header('Content-Type: application/json');
	include('../../classes/Product.php');

	$response = array(
		'code' => '200',
		'msg' => 'Successfully retrieved!',
		'data' => ''
	);

	try{
		$allProducts = Product::getAll();
		
		$inc = 0;
		$tableHtml = "<table id='prodList'>".
						"<thead>".
							"<tr>".
								"<th>#</th>".
								"<th>URL</th>".
								"<th>Store</th>".
							"</tr>".
						"</thead>".
						"<tbody>";

		foreach ($allProducts as $row) {
			$inc++;
			$tableHtml .= "<tr><td>".$inc."</td><td>".$row['url']."</td><td>".$row['store']."</td></tr>";
		}

		$tableHtml .= "</tbody>".
					"</table>";
		
		$response['data'] = $tableHtml;

	} catch (Exception $e) {
		$response = array(
			'code' => '500',
			'msg' => $e,
			'data' => ''
		);
	}

	echo json_encode($response);
?>