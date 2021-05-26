<?php
include 'database.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$otp = random_int(100000, 999999);

$sql = "INSERT INTO `user_data` (`id`, `fname`, `lname`, `username`, `phone`, `otp`, `verified`) VALUES (NULL, '$fname', '$lname', '$username', '$phone', '$otp', '0')";
if (mysqli_query($conn, $sql)) {


    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
