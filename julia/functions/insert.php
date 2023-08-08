<?php 

include('connect.php');

if (isset($_POST["model"]))
{
    $brand = $_POST ['brand'];
    $model = $_POST ['model'];
    $vintage = $_POST ['vintage'];
    $type = $_POST ['type'];
    $color = $_POST ['color'];
    $hp = $_POST ['hp'];

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, 'INSERT INTO cars_table VALUES ("",?,?,?,?,?,?)')) 
    { 
        mysqli_stmt_bind_param($stmt, "ssissi", $brand,$model,$vintage,$type,$color,$hp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
};
};
?>