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
}

?>