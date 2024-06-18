<?php

include("../../admin/db.php");

if (isset($_GET["Shift_ID"])) {
    $Shift_ID = $_GET["Shift_ID"];

    $sql = "DELETE FROM shift WHERE Shift_ID=$Shift_ID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
        header("location: ./shift.php");
    }

    $conn->close();

}
