<?php

include("../../admin/db.php");

if (isset($_GET["Marchent_ID"])) {
    $Marchent_ID = $_GET["Marchent_ID"];

    $sql = "DELETE FROM supplier WHERE Marchent_ID=$Marchent_ID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
       // echo "Record deleted successfully";
        header("location: ./suppliers.php");
    }

    $conn->close();

}
