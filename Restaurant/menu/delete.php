<?php

include("../../admin/db.php");

if (isset($_GET["Item_Number"])) {
    $Item_Number = $_GET["Item_Number"];

    $sql = "DELETE FROM menu WHERE Item_Number=$Item_Number";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
        header("location: ./menu.php");
    }

    $conn->close();

}
