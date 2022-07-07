<?php

include("config.php");

if(isset($_GET['kode'])){

    $id = $_GET['kode'];

    $sql = "DELETE FROM message WHERE id='$id'";
    $query = mysqli_query($db, $sql);

    if( $query ) {
        header('Location: main.php');
    } else {
        die("gagal menambahkan data...");
    }

}

?>