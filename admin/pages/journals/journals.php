<?php
session_start();
if (isset($_SESSION['userName'])) {
?>
	<!doctype html>
	<html lang="en">

	<head>
		<title>SERVED HUMANITY</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

		<link rel="stylesheet" href="./../../assets/css/style.css">
	</head>

	<body>
		<div class="container-fluid">
			<div class="row  nav-row">
				<div class="col-lg-12">
					<nav class="nav d-flex justify-content-end">
						<li class="nav-item">
							<a class="nav-link active" href="./../home.html"><span class="fa fa-user mr-2"></span>Admin</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="javascript:void(0)" onclick="LogOut(sessionStorage.getItem('user'));"><span class="fa fa-sign mr-2"></span>Logout</a>
						</li>
					</nav>
				</div>
			</div>
			<div class="row">
				<?php include_once("./../../include/header.php")  ?>
				<div class="col-lg-10">
					<div class="container mt-5">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">Journal Upload</div>
									<div class="card-body">
										<form id="uploadJournal" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label for="title">Title</label>
														<input type="text" class="form-control" name="title" id="title" placeholder="Title here" require>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label for="author">Author</label>
														<input type="text" class="form-control" name="author" id="author" placeholder="author here" require>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label for="Topic">Topic</label>
														<input type="text" class="form-control" name="Topic" id="Topic" placeholder="Topic here" require>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label for="Description">Description</label>
														<input type="text" class="form-control" name="Description" id="Description" placeholder="Description here" require>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label for="image">Image</label>
														<input type="file" class="form-control" name="image" id="image" require>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12">
													<button type="submit" class="btn btn-success">Upload Journal</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="./../../assets/js/main.js"></script>
	</body>

	</html>
<?php
} else {
	header("Location:./../index.php");
	exist();
} ?>
