<!DOCTYPE html>
<html>
	<head>
		<title>Instant Crawler</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="style/custom.css">
	</head>

	<body>
		<div class="container">
			
			<div class="row title-block">
				<div class="col-md-12 col-xs-12">
					<h1>Instant Crawler</h1>
				</div>
			</div>

			<div class="row content-block">
				<div class="col-md-12 col-xs-12">
					<p>Insert a new product to the DB - in order to be crawled.</p>
				</div>

				<div class="col-md-12 col-xs-12">
					<div class="input-group mb-3">
					  	<input type="text" class="form-control" name="new-product-url" placeholder="URL of the product" aria-label="URL of the product" aria-describedby="basic-addon2">
					  	<div class="input-group-append">
					    	<button class="btn btn-secondary new-product-save" type="button">Save this Product URL</button>
					  	</div>
					</div>
				</div>
			</div>

			<div class="row content-block">
				<div class="col-md-12 col-xs-12">
					<div class="product-container"></div>
				</div>
			</div>

			<div class="row content-block">
				<div class="col-md-12 col-xs-12">
					<button class="btn btn-secondary manual-crawling" type="button">Do a manual crawling cycle</button><br><br>
				</div>
				<div class="col-md-12 col-xs-12">
					<div class="log-container"></div>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="scripts/custom.js"></script>
	</body>
</html>