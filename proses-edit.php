<?php

include("config.php");

if(isset($_POST['simpan'])){

    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $cipher = $_POST['cipher'];

    $sql = "UPDATE message SET subject='$subject', text='$cipher' WHERE id='$id'";
    $query = mysqli_query($db, $sql);

    if( $query ) {
        header('Location: main.php');
    } else {
        die("gagal menambahkan data...");
    }

}

?>