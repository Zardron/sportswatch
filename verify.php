<?php
include 'database.php';

$otp = $_POST['otp'];

$detail = mysqli_query($conn, "SELECT * FROM user_data WHERE otp = '$otp'");

if (mysqli_num_rows($detail) == 1) {
    $sql = "UPDATE `user_data` SET verified = 1 WHERE otp = '$otp'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    }
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
