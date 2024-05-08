<?php 
    session_start();
    if(isset($_COOKIE['username'])){
      $output = $_COOKIE['username'];
    }else{
      header('location: login.php');
    }
?>

<?php
  include('connection.php');

  $retrieve = mysqli_query($con, "SELECT tblstudents.*, tblaccounts.username, tblaccounts.password FROM tblstudents JOIN tblaccounts ON tblstudents.studID = tblaccounts.studID");
  if(!$retrieve){
    die(mysqli_error());
  }

  if(isset($_GET['m'])){
    if($_GET['m'] == "delete"){
      echo "<strong>Record deleted successfully!</strong><hr/>";
    }elseif($_GET['m'] == "update"){
      echo "<div class='alert alert-primary' role='alert'>
              Record updated successfully!
            </div>";
    }
  }
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

	</head>

	<body>

    <div class="d-flex">

      <div class="d-flex flex-column flex-shrink-0 text-white bg-dark" style="height:100vh;">
          <div class="sidebar-heading bg-dark mx-3 mt-2 mb-3"><img src="./img/logo-dark.svg"></div>
          <div class="list-group">
              <a class="active list-group-item bg-primary text-white p-3" href=""><i class="bi bi-microsoft"></i> Dashboard</a>
              <a class="list-group-item bg-dark text-white p-3" href=""><i class="bi bi-bar-chart-line-fill"></i> Charts</a>
          </div>
      </div>

      <div style="width:100%;">
        <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color:black;">
            <div class="container-fluid">
                <div class="navbar-collapse">
                    <ul class="navbar-nav ms-auto mt-lg-0">
                        <li><a class="nav-link text-white" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="px-3 pt-2 pb-4 bg-light">
          <h5>Dashboard</h5>

          <div class="mx-2 pt-2 row d-flex justify-content-between">

            <div class="card bg-info text-white" style="width: 10rem;">
              <div class="card-body">
                <h5 class="card-title d-flex justify-content-center"><i class="bi bi-microsoft"></i></h5>
                <h6 class="card-subtitle d-flex justify-content-center mb-2">Dashboard</h6>
              </div>
            </div>

            <div class="card bg-primary text-white" style="width: 10rem;">
              <div class="card-body">
                <h5 class="card-title d-flex justify-content-center"><i class="bi bi-arrows-move"></i></h5>
                <h6 class="card-subtitle d-flex justify-content-center mb-2">Full Width</h6>
              </div>
            </div>

            <div class="card bg-primary text-white" style="width: 10rem;">
              <div class="card-body">
              <h5 class="card-title d-flex justify-content-center"><i class="bi bi-arrows-move"></i></h5>
                <h6 class="card-subtitle d-flex justify-content-center mb-2">Full Width</h6>
              </div>
            </div>

            <div class="card bg-warning text-white" style="width: 10rem;">
              <div class="card-body">
                <h5 class="card-title d-flex justify-content-center"><i class="bi bi-microsoft"></i></h5>
                <h6 class="card-subtitle d-flex justify-content-center mb-2">Widgets</h6>
              </div>
            </div>

            <div class="card bg-danger text-white" style="width: 10rem;">
              <div class="card-body">
                <h5 class="card-title d-flex justify-content-center"><i class="bi bi-table"></i></h5>
                <h6 class="card-subtitle d-flex justify-content-center mb-2">Tables</h6>
              </div>
            </div>

            <div class="card bg-primary text-white" style="width: 10rem;">
              <div class="card-body">
                <h5 class="card-title d-flex justify-content-center"><i class="bi bi-arrows-move"></i></h5>
                <h6 class="card-subtitle d-flex justify-content-center mb-2">Full Width</h6>
              </div>
            </div>

          </div>
          

        
        </div>

        <div class="px-3 pt-3">

          <div class="row d-flex pb-2">
            <h3 class="col">Customer <b>Details</b></h3>
            <div class="col">
              <input type="text" class="form-control float-end" style="width:250px;" placeholder="Search"/>
              <a type="button" class="btn btn-info text-white float-end mx-4" href="adduser.php"><i class="bi bi-plus-lg"></i> Add New</a>
            </div>
          </div>

          <table class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Photo</th>
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
                <?php
                  while($row = mysqli_fetch_array($retrieve)){ ?>
                    <tr>
                        <td><?php echo $row['studID']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['middlename']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><img style="width: 30%;" src="<?php echo $row['photo']; ?>"></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td>
                          <a style="text-decoration:none;" href="update.php?studID=<?php echo $row['studID']; ?>">Update</a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
          </table>
        </div>


        <footer class="footer py-3 bg-primary navbar-fixed-bottom">
            <div class="container d-flex justify-content-between">
                <span class="text-white">Copyright &copy 2020. All rights reserved.</span>
                <span class="text-white">
                    <i class="mx-2 bi bi-facebook"></i>
                    <i class="mx-2 bi bi-twitter"></i>
                    <i class="mx-2 bi bi-google"></i>
                    <i class="mx-2 bi bi-linkedin"></i>
                </span>
            </div>
        </footer>



      </div>

    </div>

    
	</body>
</html>
<?php include('closeconnection.php');?>

