<?php

include("../../admin/db.php");

if (isset($_GET["Event_ID"])) {
    $Event_ID = $_GET["Event_ID"];

    $sql = "DELETE FROM eventss WHERE Event_ID=$Event_ID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
        header("location: ./events.php");
    }

    $conn->close();

}
