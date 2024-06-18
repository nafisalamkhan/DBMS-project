<?php

include("../../admin/db.php");

if (isset($_GET["Reservation_ID"])) {
    $Reservation_ID = $_GET["Reservation_ID"];

    $sql = "DELETE FROM reservation WHERE Reservation_ID=$Reservation_ID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    } else {
        header("location: ./reservation.php");
    }

    $conn->close();

}
