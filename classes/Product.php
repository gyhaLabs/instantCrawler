<?php
/**
* @note Product class - for handling Product ulrs stored in DB;
* @author Hunor-Arpad GYORGY;
* @date 2019-03-28
*/

include_once('DataBaseConnection.php');

class Product
{
	private $id;
	private $url;
	private $store;	

	function __construct($url, $store)
	{
		$this->url = $url;
		$this->store = $store;
	}


	/**
	*	@note Saving a product (URL, Store) to the database;
	* 	@return int, Last inserted ID
	*/
	public function saveProduct()
	{
		$conn = DataBaseConnection::getDBConnection();

		$statement = $conn->prepare('INSERT INTO products (url, store) VALUES (:url, :store)');

		$statement->execute([
		    'url' => $this->url,
		    'store' => $this->store
		]);

		return $conn->lastInsertId(); 
	}


	/**
	*	@note Getting a product (URL, Store) from the database;
	* 	@param productId, int, Id of searched product;
	* 	@return obj, Product
	*/
	public static function get($productId)
	{
		$conn = DataBaseConnection::getDBConnection();

		$statement = $conn->prepare('SELECT * FROM product WHERE id=:productId');
		$statement->execute([
		    'id' => $productId
		]);

		return $statement->fetch();
	}


	/**
	*	@note Getting all the products (with ID, URL, Store) from the database;
	* 	@return array, of Product objects;
	*/
	public static function getAll()
	{
		$conn = DataBaseConnection::getDBConnection();

		$statement = $conn->query('SELECT * FROM products ORDER BY id DESC');
		return $statement->fetchAll();
	}
}

?>