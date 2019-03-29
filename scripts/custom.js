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
	$('button.manual-crawling').click(function () {
		$('div.loading').removeClass('hidden');
		var jqxhr = $.ajax({
				url: "scripts/ajax/single-crawling.php",
				method: "POST",
				dataType: "json",
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				alert(feedback.msg);
				reloadCrawlingLogsTable();
				$('div.loading').addClass('hidden');
			} else {
				$('div.loading').addClass('hidden');
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	});


	/**
		Load the table of the Crawlings;
	*/
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


	/**
		Load the list of products to the Product - selector => For the filtering process;
	*/
	function reloadProductListSelector() {
		var container = $('select#productSelector');
		$.ajax({
				url: "scripts/ajax/product-list.php",
				method: "GET",
				dataType: "json"
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				container.html(feedback.data);
			} else {
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	}

	reloadProductListSelector();


	/**
		Doing a manual search with the datepickers;
	*/
	$('button.show-crawling-data').click(function () {
		$('div.loading').removeClass('hidden');

		var startDate 	= $('input[name="start-date"]').val();
		var endDate 	= $('input[name="end-date"]').val();
		var product 	= $('select#productSelector').val();

		var jqxhr = $.ajax({
				url: "scripts/ajax/crawling-filter.php",
				method: "POST",
				dataType: "json",
				data: {'startdate': startDate, 'enddate': endDate, 'product': product }
			})
		.done(function(feedback) {
			if (feedback.code == '200') {
				$('div.crawling-history').html(feedback.data);
				$('div.loading').addClass('hidden');
				$('table#historyTable').DataTable();
			} else {
				$('div.loading').addClass('hidden');
				alert(feedback.msg);
			}
		})
		.fail(function(feedback) {
			alert(feedback.msg);
		});
	});
});