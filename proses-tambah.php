<?php

include("config.php");

if(isset($_POST['tambah'])){

    $result = mysqli_query($db, "SELECT MAX(id) FROM message");
    $row = mysqli_fetch_row($result);
    $highest_id = $row[0];
    $id = $highest_id + 1;

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $subject = $_POST['subject'];
    $cipher = $_POST['cipher'];

    $sql = "INSERT INTO message (id, sender, receiver, subject, text) VALUE ('$id', '$sender', '$receiver', '$subject', '$cipher')";
    $query = mysqli_query($db, $sql);

    if( $query ) {
        header('Location: main.php');
    } else {
        die("gagal menambahkan data...");
    }

}

?>