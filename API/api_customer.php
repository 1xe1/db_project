<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $cus_firstname = $_POST['cus_firstname'];
        $cus_lastname = $_POST['cus_lastname'];
        $cus_address = $_POST['cus_address'];
        $cus_subdis = $_POST['cus_subdis'];
        $cus_district = $_POST['cus_district'];
        $cus_province = $_POST['cus_province'];
        $cus_postcode = $_POST['cus_postcode'];
        $cus_phone = $_POST['cus_phone'];
        $cus_email = $_POST['cus_email'];

        $maxID = mysqli_query($conn, "SELECT MAX(cus_id) AS id FROM customer ORDER BY cus_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO customer VALUES ('$id','$cus_firstname','$cus_lastname','$cus_address','$cus_subdis','$cus_district', '$cus_province','$cus_postcode','$cus_phone','$cus_email',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 2: //Update
        $cus_firstname = $_POST['cus_firstname'];
        $cus_lastname = $_POST['cus_lastname'];
        $cus_address = $_POST['cus_address'];
        $cus_subdis = $_POST['cus_subdis'];
        $cus_district = $_POST['cus_district'];
        $cus_province = $_POST['cus_province'];
        $cus_postcode = $_POST['cus_postcode'];
        $cus_phone = $_POST['cus_phone'];
        $cus_email = $_POST['cus_email'];

        $spl = mysqli_query($conn, "UPDATE customer SET cus_firstname = '$cus_firstname', cus_lastname = '$cus_lastname',cus_address = '$cus_address'
        ,cus_subdis = '$cus_subdis',cus_district = '$cus_district', cus_province = '$cus_province', cus_postcode = '$cus_postcode', 
        cus_phone = '$cus_phone', cus_email = '$cus_email' Where cus_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $sql = "DELETE FROM customer WHERE cus_id = $id";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Deletion was not successful.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Data was deleted successfully.'));
        }
        break;
}
