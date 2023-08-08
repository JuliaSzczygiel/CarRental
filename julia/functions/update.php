<?php
include ('connect.php');
if(isset($_POST['model'])) {
    $id = $_POST ['id'];
    $brand = $_POST ['brand'];
    $model = $_POST ['model'];
    $vintage = $_POST ['vintage'];
    $type = $_POST ['type'];
    $color = $_POST ['color'];
    $hp = $_POST ['hp'];

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, 'UPDATE cars_table SET brand=?, model=?, vintage=?, type=?, color=?, hp=? WHERE id=?'))
    {
        mysqli_stmt_bind_param($stmt, "ssissii", $brand, $model, $vintage, $type, $color, $hp, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    };
};
?>