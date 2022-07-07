<?php 

    include("config.php");

    if(isset($_POST['login'])){

        $username=$_POST["username"];
        $password=md5($_POST["password"]);

        $sql = "SELECT * FROM users WHERE username='$username'";
        $query = mysqli_query($db, $sql);
        $user = mysqli_fetch_assoc($query);
        
        if ($username==$user['username'] && $password==$user['password']){
            session_start();
            $_SESSION["username"]=$username;
            $_SESSION["name"]=$user['name'];
            header("location:main.php");
        }else{
            echo '<script>alert("Username atau password tidak valid")</script>';
        }

    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style-index.css">
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header text-center text-white">
                        <h3>Sign In</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group  mb-3 text-white">
                                <label for="username">Username </label>
                                <input type="text" class="form-control" name="username" placeholder="Input username" required>
                            </div>
                            <div class="form-group  mb-3 text-white">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Input Password" required>
                            </div>
                            <br>
                            <div class="form-group d-flex justify-content-center">
                                <input type="submit" value="Login" class="btn btn-primary" name="login">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-white">
                        <div class="d-flex justify-content-center links">
                            Don't have an account?<a href="register.php">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
