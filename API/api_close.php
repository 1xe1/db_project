<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $dateclose = $_POST['dateclose'];
        $project_id = $_POST['project_id'];
        $cost = $_POST['cost'];
        $pay = $_POST['pay'];
        $emp_id = $_POST['emp_id'];
        $comment = $_POST['comment'];

        $maxID = mysqli_query($conn, "SELECT MAX(headcode) AS id FROM project_close ORDER BY headcode");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO project_close VALUES ('$id','$dateclose','$project_id','$cost','$pay','$emp_id', '$comment',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 2: //Update
        $dateclose = $_POST['dateclose'];
        $project_id = $_POST['project_id'];
        $cost = $_POST['cost'];
        $pay = $_POST['pay'];
        $emp_id = $_POST['emp_id'];
        $comment = $_POST['comment'];

        $spl = mysqli_query($conn, "UPDATE project_close SET project_id = '$project_id', cost = '$cost',pay = '$pay'
        ,emp_id = '$emp_id',comment = '$comment' Where headcode = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $sql = "DELETE FROM project_close WHERE headcore = $id";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Deletion was not successful.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Data was deleted successfully.'));
        }
        break;
}
