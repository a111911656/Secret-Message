<?php

    include("config.php");

    if(isset($_POST['register'])){

        $name=$_POST["name"];
        $username=$_POST["username"];
        $password=md5($_POST["password"]);

        $sql = "INSERT INTO users (username, name, password) VALUE ('$username', '$name', '$password')";
        $query = mysqli_query($db, $sql);

        if( $query ) {
            header('Location: index.php');
        } else {
            die("gagal menambahkan data...");
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
        <style>
            .card{
                height: 450px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header text-center text-white">
                        <h3>Sign Up</h3>
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
                            <div class="form-group mb-3 text-white">
                                <label for="name">Nick Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Input Nick Name">
                            </div>
                            <br>
                            <div class="form-group d-flex justify-content-center">
                                <input type="submit" value="Register" class="btn btn-primary" name="register">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-white">
                        <div class="d-flex justify-content-center links">
                            Have an account?<a href="index.php">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
