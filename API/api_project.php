<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $project_name = $_POST['project_name'];
        $cus_id = $_POST['cus_id'];
        $project_start = $_POST['project_start'];
        $project_end = $_POST['project_end'];
        $project_valueprice = $_POST['project_valueprice'];
        $emp_id = $_POST['emp_id'];
        $project_status = $_POST['project_status'];

        $maxID = mysqli_query($conn, "SELECT MAX(project_id) AS id FROM project ORDER BY project_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO project VALUES ('$id','$project_name','$cus_id','$project_start','$project_end',
        '$project_valueprice', '$emp_id','$project_status', 0)");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 2: //Update
        $project_name = $_POST['project_name'];
        $cus_id = $_POST['cus_id'];
        $project_start = $_POST['project_start'];
        $project_end = $_POST['project_end'];
        $project_valueprice = $_POST['project_valueprice'];
        $emp_id = $_POST['emp_id'];
        $project_status = $_POST['project_status'];

        $spl = mysqli_query($conn, "UPDATE project SET project_name = '$project_name', cus_id = '$cus_id',project_start = '$project_start'
        ,project_end = '$project_end',project_valueprice = '$project_valueprice', emp_id = '$emp_id', project_status = '$project_status' Where project_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $sql = "DELETE FROM project WHERE project_id = $id";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Deletion was not successful.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Data was deleted successfully.'));
        }
        break;
}
