<html>
    <head>
	<title>Dashboard</title>
		
		<link rel="stylesheet" href="admin/css/bootstrap.min.css" />
		<script src="admin/js/jquery.dataTables.min.js"></script>
		<script src="admin/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css" />
		<script src="admin/js/bootstrap.min.js"></script>

		
		<!-- jquery -->
		<script src="admin/assests/jquery/jquery.min.js"></script>
		<!-- jquery ui -->  
		<link rel="stylesheet" href="admin/assests/jquery-ui/jquery-ui.min.css">
		<script src="admin/assests/jquery-ui/jquery-ui.min.js"></script>

		<!-- bootstrap js -->
			<script src="admin/assests/bootstrap/js/bootstrap.min.js"></script>
		<style>
		    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]
		    {
		        display : none;
		    }
		</style>
    </head>
    <body>
        <div class="container">
		<?php
				require_once 'bakerFunctions.php';
				$database = new bakersFunctions();
				$bid = $_SESSION["branch_id"];
				$get = $database->getBranchName($bid);
				
				$name = $get["branch_name"];
				$address = $get["address"]
			?>
            <h2>
				Welcome to <?php echo $name ?> Bakery
			</h2>
			<h5>
				<?php echo $address ?>
			</h5>
        <nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="baker-product.php" class="navbar-brand">Home</a>
					</div>
					<ul class="nav navbar-nav">
						<li><a href="baker-product.php">Product</a></li>
						<li><a href="baker-expenses.php">Expenses</a></li>
						<li><a href="baker-cash-advance.php">Cash Advance</a></li>
						<li><a href="baker-generate_report.php">Generate Report</a></li>
						<li><a href="baker-my-cash.php">My Cash</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a>
							<ul class="dropdown-menu">
								<li><a href="">Profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</nav>
        </div>
    </body>
</html>