<?php 
include("config.php"); 
session_start(); 
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Main Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style-main.css">
    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <a class="navbar-header" href="main.php">
                    <img src="assets/image/logo.png" alt="logo" style="height:50px;">
                </a>
                <strong class="nav justify-content-center"><?php echo $_SESSION['name']; ?></strong>
                <div class="nav navbar-nav navbar-right">
                    <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
                </div>
            </div>
        </nav>

        <header>
            <div class="jumbotron text-center bg-dark text-light">
                <h1>Secret Message</h1>
                <h5>Website for send message to other user with privately and securely</h5>
                <p>Message encrypted with Block Cipher OFB (Output Feed Back)</p>
            </div>
            <div class="jumbotron text-center bg-secondary jumbotron-inside">
                <a class="btn btn-primary" href="form-tambah.php" role="button"><i class="	fa fa-comment"></i>   Send Message</a>
            </div>
        </header>

        <div class="container">
            <div class="card bg-light">
                <div class="card-body">
                    <b>Received Message</b>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead">
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM message WHERE receiver='$username'";
                    $query = mysqli_query($db, $sql);

                    while($message = mysqli_fetch_array($query)){
                        echo "<tr>";

                        echo "<td class='w-25'>".$message['sender']."</td>";
                        echo "<td class='w-50'>".$message['subject']."</td>";
                        echo "<td class='w-25'>";
                        echo "<a class='btn btn-success btn-sm' href='form-baca.php?kode=".$message['id']."' role='button'>See Message</a>   ";
                        echo "<a class='btn btn-danger btn-sm' href='hapus.php?kode=".$message['id']."' role='button'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <br>
            <div class="card bg-light">
                <div class="card-body">
                    <b>Sended Message</b>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead">
                    <tr>
                        <th>Receiver</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM message WHERE sender='$username'";
                    $query = mysqli_query($db, $sql);

                    while($message = mysqli_fetch_array($query)){
                        echo "<tr>";

                        echo "<td class='w-25'>".$message['receiver']."</td>";
                        echo "<td class='w-50'>".$message['subject']."</td>";
                        echo "<td class='w-25'>";
                        echo "<a class='btn btn-success btn-sm' href='form-edit.php?kode=".$message['id']."' role='button'>See Message</a>   ";
                        echo "<a class='btn btn-danger btn-sm' href='hapus.php?kode=".$message['id']."' role='button'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        
        <footer>
            <div class="jumbotron text-center bg-dark text-light">
                <div class="text-center">
                    <p>A11.2019.11656 || Kriptografi 2022</p>
                </div>
            </div>
        </footer>            
    </body>
</html>