<?php

include("../../admin/db.php");

if (isset($_GET["Product_ID"])) {
    $Product_ID = $_GET["Product_ID"];

    $sql = "DELETE FROM inventory WHERE Product_ID=$Product_ID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
        header("location: ./inventory.php");
    }

    $conn->close();

}
