<?php include('server.php'); ?>
<?php
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

	if (@count($record) == 1) {
		$n = mysqli_fetch_array($record);
		$name = $n['name'];
		$address = $n['address'];
		$emails = $n['emails'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Address</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

	<?php if (isset($_SESSION['message'])) : ?>
		<div class="alert alert-primary text-center">
			<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>
	<?php $results = mysqli_query($db, "SELECT * FROM info"); ?>
	<div>
		<h1 class="text-center display-1 text-danger">Far From Home</h1>
	</div>


	<div class="container">

		<div class="container form justify-content-center">
			<form method="post" action="server.php">

				<input type="hidden" name="id" value="<?php echo $id; ?>">


				<div class="form-floating mb-3">
					<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="floatingInput" placeholder="Please Enter Your Name" required>
					<label for="floatingInput">Name</label>
				</div>
				<div class="form-floating mb-3">
					<input type="email" name="emails" value="<?php echo $emails; ?>" class="form-control" id="floatingInput" placeholder="Please Enter Your emails Address" required>
					<label for="floatingInput">email</label>
				</div>
				<div class="form-floating mb-3">
					<input type="text" name="address" value="<?php echo $address; ?>" class="form-control" id="floatingInput" placeholder="Please Enter Your Address" required>
					<label for="floatingInput">Address</label>
				</div>

				<div class="input-group mb-3">

					<?php if ($update == true) : ?>
						<button class="btn btn-success" type="submit" name="update">update</button>
					<?php else : ?>
						<button class="btn btn-primary" type="submit" name="save">Save</button>
					<?php endif ?>



				</div>
			</form>
		</div>
		<table class="table table-hover table-bordered table-sm overflow-auto">
			<div class="table-responsive ">
				<thead>
					<tr>
						<th scope="col" >Name</th>
						<th scope="col">emails</th>
						<th scope="col" class="col-md-1">Address</th>
						<th scope="col">Action</th>

					</tr>
				</thead>

				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo wordwrap($row['name'],30,"<br>\n",TRUE); ?></td>
						<td><?php echo wordwrap($row['emails'],30,"<br>\n",TRUE); ?></td>
						<td><?php echo wordwrap($row['address'],30,"<br>\n",TRUE); ?></td>

						<td>
							<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary "></i>Edit</a>

							<a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
				<?php } ?>
		</table>
	</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>