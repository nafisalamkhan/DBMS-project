<?php

include("../../admin/db.php");

if (isset($_GET["Employee_ID"])) {
    $Employee_ID = $_GET["Employee_ID"];

    $sql = "DELETE FROM employee WHERE Employee_ID=$Employee_ID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
        header("location: ./employee_table.php");
    }

    $conn->close();

}
