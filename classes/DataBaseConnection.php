<?php
/**
* @note Database Connection class;
* @author Hunor-Arpad GYORGY;
* @date 2019-03-28
*/

class DataBaseConnection
{
	protected static $conn = null;

	private static function createConnection()
	{
		$hostname='localhost';
		$username='root';
		$password='';

		try {
		    $dbh = new PDO("mysql:host=$hostname;dbname=instantcrawler",$username,$password);

		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    
		    return $dbh;
		    }
		catch(PDOException $e)
		    {
		    echo $e->getMessage();
		}

		return false;
	}

	public static function getDBConnection()
	{
		if (!self::$conn) {
			self::$conn = self::createConnection();
		}
		return self::$conn;
	}
}
?>