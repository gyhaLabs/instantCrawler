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
				$title = $this->matchTitle($currentPage);
				$price = $this->matchPrice($currentPage);
				
				$priceLog = new Pricelog($prod['id'], $title, $price, date('Y-m-d H:i:s'));
				$priceLog->saveLog();
			}
		}

		return;
	}


	public function matchTitle( $content )
	{
		preg_match('/<h1.*?>(.*)<\/h1>/msi', $content, $matches);
		if (isset($matches[1]) && !empty($matches[1])) {
			return strip_tags(trim($matches[1]));
		}

		return '';
	}


	public function matchPrice( $content )
	{
		preg_match_all('/<meta itemprop=\"price\" content=\"([0-9]+.[0-9]+)\"/msi', $content, $matches);
		if (isset($matches[1][0]) && !empty($matches[1][0])) {
			return strip_tags(trim($matches[1][0]));
		} else {
			preg_match_all('/\"price\": \"([0-9]+).([0-9]+)\",/msi', $content, $matches2);
			if (isset($matches2[1][0]) && !empty($matches2[1][0])) {
				return floatval($matches2[1][0].".".$matches2[2][0]);
			}
		}

		return 0;
	}
}

?>