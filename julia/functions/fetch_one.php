<?php 
require_once('connect.php');

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $sql = "SELECT * FROM cars_table where id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $arr=[
            "id" => $row['id'],
            "brand" => $row['brand'],
            "model" => $row['model'],
            "vintage" => $row['vintage'],
            "type" => $row['type'],
            "color" => $row['color'],
            "hp" => $row['hp'],
        ];
        echo json_encode($arr);
    };
};
?>