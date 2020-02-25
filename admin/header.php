<html>
    <head>
        <title>Dashboard</title>
		<script src="js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
		<style>
		    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]
		    {
		        display : none;
		    }
		</style>
    </head>
    <body>
        <div class="container">
            <h2>Chrissia's Admin Panel</h2>
        <nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="branch.php" class="navbar-brand">Home</a>
					</div>
					<ul class="nav navbar-nav">
					
						<li><a href="user.php">Bakers Account</a></li>
						<li><a href="category.php">My Products</a></li>
						<!--<li><a href="product.php">Product</a></li> <-->
						<li><a href="branch.php">Branches</a></li>
						<li><a href="admin-account.php">MyAccounts</a></li>

						
						
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