<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $s_name = $_POST['s_name'];
        $s_unit = $_POST['s_unit'];
        $s_price = $_POST['s_price'];

        $maxID = mysqli_query($conn, "SELECT MAX(s_id) AS id FROM stock ORDER BY s_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO stock VALUES ('$id','$s_name','$s_unit','$s_price',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 2: //Update
        $s_name = $_POST['s_name'];
        $s_unit = $_POST['s_unit'];
        $s_price = $_POST['s_price'];

        $spl = mysqli_query($conn, "UPDATE stock SET s_name = '$s_name', s_unit = '$s_unit',s_price = '$s_price' Where s_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $sql = "DELETE FROM stock WHERE s_id = $id";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Deletion was not successful.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Data was deleted successfully.'));
        }

        break;
}
