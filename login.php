<?php
    session_start();

    require("connection.php");
    
    if (isset($_COOKIE['username']) != null) {
        header("location: dashboard.php");
    }else{
        if (isset($_POST['btn_submit'])){

            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM tblaccounts WHERE username = '$username'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) { 
                $row = mysqli_fetch_assoc($result);
                
                if ($password == $row['password']) {
                    setcookie('username', $username ,time() + 1000000); 
                    header('location: dashboard.php');
                } else {
                    echo "<div class='alert alert-warning' role='alert'>
                            Invalid Password!
                        </div>";
                }
            } else {
                echo "<div class='alert alert-info' role='alert'>
                            User not found!
                        </div>";
            }
            
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        .circle{
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: blue;
            align-items: center;
            justify-content: center;
            display: flex;
        }

    </style>

  </head>
  <body>

    <div class="container">
	    <div class="row" style="padding-top:10%; padding-bottom:10%;">

            <div class="col">
                <img src="./img/draw2.webp" class="card-img-top" style="width: 500px;">
            </div>

            <div class="col">

                <div class="d-flex">
                    <h3 class="me-3">Sign in with</h3>
                    <span class="me-2 circle text-white">
                        <i class="bi bi-facebook"></i>
                    </span>
                    <span class="me-2 circle text-white">
                        <i class="bi bi-twitter"></i>
                    </span>
                    <span class="me-2 circle text-white">
                        <i class="bi bi-linkedin"></i>
                    </span>
                </div>
                <br>

                <div class="row">
                    <div class="col"><hr></div>
                    Or
                    <div class="col"><hr></div>
                </div>
                <br>

                <form action="login.php" method="POST">
                    <input type="text" class="form-control" name="username" placeholder="Email address" required />
                    <br/>
                    <input type="password" class="form-control" name="password" placeholder="Password" required/>
                    <br>
                    <div class="mb-2 form-check position-relative">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label">Remember This Device</label>

                        <a href="" class="position-absolute bottom-0 end-0" style="text-decoration:none;">Forgot Password?</a>
                    </div>
                    </br>
                    <input type="submit" class="btn btn-primary" name="btn_submit" style="width:90px;" value="Login"/>
                </form>
                <br> 

                <p>Dont have an account? <a style="text-decoration:none; color:red;" href="register.php">Register</a></p>
            </div>

        </div>
    </div>

    <footer class="footer py-3 bg-primary">
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

  </body>
</html>
