<?php 
include('connect.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM cars_table WHERE id=$id";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    };
?>

