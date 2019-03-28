$(document).ready(function() {

	/**
		Saving a new Product URL to the DB;
	*/
	$('button.new-product-save').click(function (){
		var urlInput = $(this).parent().prev();
		
		var jqxhr = $.ajax({
				url: "scripts/ajax/product-insert.php",
				method: "POST",
				dataType: "json",
				data: {'url': urlInput.val()}
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				alert(feedback.msg);
				reloadProductTable();
			} else {
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	});


	/**
		Load the table of the ProductURLs;
	*/
	function reloadProductTable() {
		var container = $('div.product-container');

		$.ajax({
				url: "scripts/ajax/product-table.php",
				method: "GET",
				dataType: "json"
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				container.html(feedback.data);
				$('table#prodList').DataTable();
			} else {
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	}

	reloadProductTable();


	/**
		Doing a crawling cycle - initiated by the end-user on the UI;
	*/
	$('button.manual-crawling').click(function (){		
		var jqxhr = $.ajax({
				url: "scripts/ajax/single-crawling.php",
				method: "POST",
				dataType: "json",
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				alert(feedback.msg);
				reloadCrawlingLogsTable();
			} else {
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	});


	function reloadCrawlingLogsTable() {
		var container = $('div.log-container');

		$.ajax({
				url: "scripts/ajax/crawling-table.php",
				method: "GET",
				dataType: "json"
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				container.html(feedback.data);
				$('table#logList').DataTable();
			} else {
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	}

	reloadCrawlingLogsTable();
});