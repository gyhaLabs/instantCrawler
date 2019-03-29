<?php
	/**
	* @note Cron File for the Crawling application. It will be run twice an hour.
	* @author Hunor-Arpad GYORGY;
	* @date 2019-03-29
	*/

	include('../classes/Crawler.php');

	try{
		$crawler = new Crawler();
		$crawler->doACrawlingCycle();
		echo "Successfull cronjob running process.";
	} catch (Exception $e) {
		echo "Cronjob running failed.";
	}
?>