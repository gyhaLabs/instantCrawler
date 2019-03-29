<?php
/**
* @note PriceLog class - for handling Pricelogs stored in DB;
* @author Hunor-Arpad GYORGY;
* @date 2019-03-28
*/

include_once('DataBaseConnection.php');

class Pricelog
{
	private $product_id;
	private $name;
	private $price;
	private $timestamp;

	
	function __construct($product_id, $name, $price, $timestamp)
	{
		$this->product_id = $product_id;
		$this->name = $name;
		$this->price = $price;
		$this->timestamp = $timestamp;
	}


	/**
	*	@note Saving the result of a single crawling for a single URL;
	* 	@return int, Last inserted ID
	*/
	public function saveLog()
	{
		$conn = DataBaseConnection::getDBConnection();

		$statement = $conn->prepare(
			'INSERT INTO pricelogs (product_id, name, price, timestamp) VALUES (:product_id, :name, :price, :timestamp)'
		);

		$statement->execute([
		    'product_id' => $this->product_id,
		    'name' => $this->name,
		    'price' => $this->price,
		    'timestamp' => $this->timestamp
		]);

		return $conn->lastInsertId(); 
	}

	/**
	*	@note Getting all the price logs from the database;
	* 	@return array, of Pricelog objects;
	*/
	public static function getAll()
	{
		$conn = DataBaseConnection::getDBConnection();

		$statement = $conn->query('SELECT * FROM pricelogs ORDER BY id DESC');
		return $statement->fetchAll();
	}


	/**
	*	@note Getting all the products - from the crawling logs from the database;
	* 	@return array, names of the logged products;
	*/
	public static function getAllCrawledProducts()
	{
		$conn = DataBaseConnection::getDBConnection();

		$statement = $conn->query('SELECT product_id, name FROM pricelogs GROUP BY product_id ORDER BY name ASC');
		return $statement->fetchAll();
	}


	/**
	*	@note Getting the products based on the inputs - from the crawling logs from DB;
	* 	@param product, string, Product name
	* 	@param startDate, string, Start Date for the filter
	* 	@param endDate, string, End Date for the filter
	* 	@return array, of Pricelog objects;
	*/
	public static function getCrawlingHistory($product, $startDate, $endDate)
	{
		if (empty($product)) {
			return false;
		}

		$conn = DataBaseConnection::getDBConnection();

		/* When both Start-Date and End-Date is present */
		if (!empty($startDate) && !empty($endDate)) {
			$startDate 	.= " 00:00:00";
			$endDate 	.= " 23:59:59";

			$statement = $conn->prepare(
				'SELECT * FROM pricelogs WHERE product_id = :product AND timestamp >= :startDate AND timestamp <= :endDate ORDER BY timestamp DESC'
			);

			$statement->execute([
			    'product' 	=> $product,
			    'startDate' => $startDate,
			    'endDate'	=> $endDate
			]);
		}

		/* When none of the dates is present */
		if (empty($startDate) && empty($endDate)) {
			$statement = $conn->prepare('SELECT * FROM pricelogs WHERE product_id = :product ORDER BY timestamp DESC');
			$statement->execute([
			    'product' 	=> $product
			]);
		}

		/* When only End-Date is present */
		if (empty($startDate) && !empty($endDate)) {
			$endDate 	.= " 23:59:59";

			$statement = $conn->prepare(
				'SELECT * FROM pricelogs WHERE product_id = :product AND timestamp <= :endDate ORDER BY timestamp DESC'
			);

			$statement->execute([
			    'product' 	=> $product,
			    'endDate'	=> $endDate
			]);
		}

		/* When only Start-Date is present */
		if (!empty($startDate) && empty($endDate)) {
			$startDate 	.= " 00:00:00";

			$statement = $conn->prepare(
				'SELECT * FROM pricelogs WHERE product_id = :product AND timestamp >= :startDate ORDER BY timestamp DESC'
			);

			$statement->execute([
			    'product' 	=> $product,
			    'startDate'	=> $startDate
			]);
		}

		return $statement->fetchAll();
	}
}

?>