<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
    // $result = mysqli_query($conn, "SELECT *,if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM customer");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT *,if(project_status = 0 ,'ยกเลิก',if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM project JOIN customer USING(cus_id) JOIN employee USING(emp_id) WHERE project_id ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");

    if (!$result) {
        die("Database query error: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * ,if(project_status = 0 ,'ยกเลิก',if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM project JOIN customer USING(cus_id) JOIN employee USING(emp_id)  WHERE project_id ='$id' ");
    $row = mysqli_fetch_array($result);
} else if ($case  == '4') {
    $header = 'ข้อมูล';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT *,if(project_status = 0 ,'ยกเลิก',if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM project JOIN customer USING(cus_id) JOIN employee USING(emp_id) WHERE project_id ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");

    if (!$result) {
        die("Database query error: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result);
}

?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Menu -->
        <?php include("sidebar.php"); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php include("topbar.php"); ?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="project.php" class="text-decolation">ระบบโครงการ</a>
                            </li>
                            <!-- <li class="breadcrumb-item active"><a href="magUsers.php" class="text-decolation">Manage
                                    User</a></li> -->
                            <li class="breadcrumb-item"><?php echo $header; ?> โครงการ</li>
                        </ol>
                    </div>
                    <!-- /.content-header -->
                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3><?php echo $header; ?> โครงการ</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formAccountSettings" action="../../API/api_project.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                        <div class="row">
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="project_name" class="form-label">ชื่อโครงการ</label>
                                                <input type="text" class="form-control" name="project_name" id="project_name" placeholder="ชื่อ" value="<?php echo ($case == 1) ? '' : $row['project_name'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?> <?php echo ($case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_id" class="form-label">ลูกค้า</label>
                                                <select class="form-select" aria-label="Default select example" name="cus_id" id="cus_id" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                    <option selected disabled>เลือกลูกค้า </option>
                                                    <?php
                                                    foreach ($result_ as $rowselect) {
                                                        $isSelected = ($rowselect['cus_id'] == $row['cus_id']) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?php echo $rowselect['cus_id']; ?>" <?php echo $isSelected; ?>>
                                                            <?php echo $rowselect['cus_firstname'], ' ', $rowselect['cus_lastname']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="project_start" class="form-label">วันที่เริ่มโครงการ</label>
                                                <input type="date" class="form-control" name="project_start" id="project_start" placeholder="ที่อยู่" value="<?php echo ($case == 1) ? '' : $row['project_start'] ?>"  <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="project_end" class="form-label">วันที่สิ้นสุดโครงการ</label>
                                                <input type="date" class="form-control" name="project_end" id="project_end" placeholder="ตำบล" value="<?php echo ($case == 1) ? '' : $row['project_end'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="project_valueprice" class="form-label">มูลค่าโครงการ</label>
                                                <input type="text" class="form-control" name="project_valueprice" id="project_valueprice" placeholder="อำเภอ" value="<?php echo ($case == 1) ? '' : $row['project_valueprice'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="cus_id" class="form-label">ผู้ดูแลโครงการ</label>
                                                <select class="form-select" aria-label="Default select example" name="emp_id" id="emp_id" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                    <option selected disabled>เลือกพนักงาน </option>
                                                    <?php
                                                    foreach ($result_emp as $rowselect) {
                                                        $isSelected = ($rowselect['emp_id'] == $row['emp_id']) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?php echo $rowselect['emp_id']; ?>" <?php echo $isSelected; ?>>
                                                            <?php echo $rowselect['emp_firstname'], ' ', $rowselect['emp_lastname']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="" class="form-label">สถานะโครงการ</label>
                                                <select class="form-select" aria-label="Default select example" name="project_status" id="project_status" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                    <option selected disabled><?php echo ($case == 1) ? 'เลือกสถานะ' : $row['status'] ?></option>
                                                    <option value="0">ยกเลิก</option>
                                                    <option value="1">อยู่ระหว่างดำเนินการ</option>
                                                    <option value="2">ปิดโครงการ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <?php
                                            echo ($case == '1') ?
                                                '<button type="submit" name="submit_frm" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                    '<button type="submit" name="submit_frm" class="btn btn-warning">แก้ไข</button>' : (($case == '3') ?
                                                        '<button type="submit" name="submit_frm" class="btn btn-danger">ลบ</button>' : (($case == '4') ?
                                                            '' : '')))
                                            ?>
                                            <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                            <a href="project.php" class="btn btn-secondary ms-3">ยกเลิก</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Revenue -->
                    </div>
                </div>
                <!-- / Content -->

                <script>
                    $(document).ready(function() {
                        $("#formAccountSettings").submit(function(e) {
                            e.preventDefault();

                            let formUrl = $(this).attr("action");
                            let reqMethod = $(this).attr("method");
                            let formData = $(this).serialize();

                            $.ajax({
                                url: formUrl,
                                type: reqMethod,
                                data: formData,
                                success: function(data) {
                                    // console.log("Success", data);
                                    let result = JSON.parse(data);

                                    if (result.status == "success") {
                                        // console.log("Success", result);
                                        Swal.fire({
                                            icon: result.status,
                                            title: result.title,
                                            text: result.message,
                                            showConfirmButton: false,
                                            timer: 2500
                                        }).then(function() {
                                            window.location.href = "project.php";
                                        });
                                    } else {
                                        Swal.fire(result.title, result.message, result
                                            .status)
                                    }
                                }
                            })
                        })
                    })
                </script>

                <!-- Footer -->
                <?php include("footer.php"); ?>
                <!-- / Footer -->