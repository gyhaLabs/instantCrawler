<?php
/**
* @note Crawler class - for crawling the store URLS;
* @author Hunor-Arpad GYORGY;
* @date 2019-03-28
*/

include_once('DataBaseConnection.php');
include_once('Product.php');
include_once('Pricelog.php');

class Crawler
{
	private $productList = array();

	
	function __construct()
	{
		$this->productList = Product::getAll();
	}

	/**
	* @note Making a single crawling cycle;
	* (Event may be fired by the User from the UI or by the cron);
	*/
	public function doACrawlingCycle()
	{
		if (!empty($this->productList)) {
			foreach ($this->productList as $key => $prod) {
				$currentPage = file_get_contents($prod['url']);
				preg_match('/<h1.*?>(.*)<\/h1>/msi', $currentPage, $matches);
				if (isset($matches[1]) && !empty($matches[1])) {
					$priceLog = new Pricelog($prod['id'], strip_tags(trim($matches[1])), 0, date('Y-m-d H:i:s'));
					$priceLog->saveLog();
				}
			}
		}

		return;
	}
}

?>