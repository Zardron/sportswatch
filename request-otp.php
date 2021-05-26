<?php
include 'database.php';

$phone = $phone = mysqli_real_escape_string($conn, $_POST['phone']);
$otp = random_int(100000, 999999);



$sql = mysqli_query($conn, "SELECT * FROM user_data WHERE phone = '$phone'");


if (mysqli_num_rows($sql)  == 1) {

    while ($row = mysqli_fetch_array($sql)) {

        if ($row['verified'] == 0) {
            echo json_encode(array("statusCode" => 401));
        } else {
            $update_otp = "UPDATE user_data SET otp = '$otp' WHERE phone = '$phone' AND verified = '1'";

            if (mysqli_query($conn, $update_otp)) {
                echo json_encode(array("statusCode" => 200, "phone" => $phone));
            }
        }
    }
} else if (mysqli_num_rows($sql)  == 0) {
    echo json_encode(array("statusCode" => 404));
}

mysqli_close($conn);
