<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $emp_firstname = $_POST['emp_firstname'];
        $emp_lastname = $_POST['emp_lastname'];
        $emp_address = $_POST['emp_address'];
        $emp_subdis = $_POST['emp_subdis'];
        $emp_district = $_POST['emp_district'];
        $emp_province = $_POST['emp_province'];
        $emp_postcode = $_POST['emp_postcode'];
        $emp_phone = $_POST['emp_phone'];
        $emp_email = $_POST['emp_email'];
        $emp_startworking = $_POST['emp_startworking'];
        $emp_password = $_POST['emp_password'];
        $emp_department = $_POST['emp_department'];

        $maxID = mysqli_query($conn, "SELECT MAX(emp_id) AS id FROM employee ORDER BY emp_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO employee VALUES ('$id','$emp_firstname','$emp_lastname','$emp_address','$emp_subdis',
        '$emp_district', '$emp_province','$emp_postcode','$emp_phone','$emp_email','$emp_startworking','$emp_password','$emp_department',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 2: //Update
        $emp_firstname = $_POST['emp_firstname'];
        $emp_lastname = $_POST['emp_lastname'];
        $emp_address = $_POST['emp_address'];
        $emp_subdis = $_POST['emp_subdis'];
        $emp_district = $_POST['emp_district'];
        $emp_province = $_POST['emp_province'];
        $emp_postcode = $_POST['emp_postcode'];
        $emp_phone = $_POST['emp_phone'];
        $emp_email = $_POST['emp_email'];
        $emp_startworking = $_POST['emp_startworking'];
        $emp_password = $_POST['emp_password'];
        $emp_department = $_POST['emp_department'];

        $spl = mysqli_query($conn, "UPDATE employee SET emp_firstname = '$emp_firstname', emp_lastname = '$emp_lastname',emp_address = '$emp_address'
        ,emp_subdis = '$emp_subdis',emp_district = '$emp_district', emp_province = '$emp_province', emp_postcode = '$emp_postcode', 
        emp_phone = '$emp_phone', emp_email = '$emp_email',emp_startworking = '$emp_startworking' , emp_password = '$emp_password'
        , emp_department = '$emp_department' Where emp_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $sql = "DELETE FROM employee WHERE emp_id = $id";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Deletion was not successful.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Data was deleted successfully.'));
        }
        break;
}
