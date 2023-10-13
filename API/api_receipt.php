<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $datesave = $_POST['datesave'];
        $receiptcode = $_POST['receiptcode'];
        $datereceipt = $_POST['datereceipt'];
        $project_id = $_POST['project_id'];
        $totalprice = $_POST['totalprice'];

        $maxID = mysqli_query($conn, "SELECT MAX(headcode) AS id FROM project_hd ORDER BY headcode");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }
        //multi insert detail
        if (!empty($_POST['s_id'])) {
            $s_ids = $_POST['s_id'];
            $qtys = $_POST['qty'];
            $s_prices = $_POST['s_price'];
            $totalprices = $_POST['totalprice'];
            for ($i = 0; $i < count($s_ids); $i++) {
                $s_id = $s_ids[$i];
                $qty = $qtys[$i];
                $s_price = $s_prices[$i];
                $totalprice = $totalprices[$i];
                // Sanitize the input (to prevent SQL injection)
                // $s_id = $conn->real_escape_string($s_id);
                // Perform the SQL insert
                // echo "s_id =" . $s_id ."<br>";
                // echo "qtys =" . $qtys ."<br>";
                // echo "s_price =" . $s_price ."<br>";
                // echo "totalprice =" . $totalprice ."<br>";
                $sql = "INSERT INTO project_desc (headcode, s_id, qty, s_price, totalprice) VALUES ('$id', '$s_id', '$qty', '$s_price', '$totalprice')";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }


        $spl = mysqli_query($conn, "INSERT INTO project_hd VALUES ('$id','$datesave','$receiptcode','$datereceipt','$project_id','$totalprice', 1 ,0)");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 2: //Update
        $datesave = $_POST['datesave'];
        $receiptcode = $_POST['receiptcode'];
        $datereceipt = $_POST['datereceipt'];
        $project_id = $_POST['project_id'];
        $totalprice = $_POST['totalprice'];

        $spl = mysqli_query($conn, "UPDATE project_hd SET datesave = '$datesave', receiptcode = '$receiptcode',datereceipt = '$datereceipt'
        ,project_id = '$project_id',totalprice = '$totalprice' Where project_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $sql = "DELETE FROM project_hd WHERE headcode = $id";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Deletion was not successful.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Data was deleted successfully.'));
        }
        break;
    case 4:
        $project_id = mysqli_real_escape_string($conn, $_GET['id']); // Correct the variable name to 'project_id'

        // SQL query to fetch project details
        $sql = "SELECT * FROM project JOIN customer USING(cus_id) WHERE project_id = '$project_id' AND project.void = 0";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $project_name = $row['project_name'];
            $cus_firstname = $row['cus_firstname'];
            $cus_lastname = $row['cus_lastname'];
            $project_valueprice = $row['project_valueprice'];
            $project_fullname = $cus_firstname . ' ' . $cus_lastname;

            // Create an array to hold project data and echo it as JSON
            $projectData = [
                'project_id' => $project_id,
                'project_name' => $project_name,

                'project_fullname' => $project_fullname,

                'project_valueprice' => $project_valueprice
            ];

            echo json_encode($projectData);
        } else {
            echo "ไม่สามารถดึงข้อมูลโครงการได้: " . mysqli_error($conn);
        }
}
