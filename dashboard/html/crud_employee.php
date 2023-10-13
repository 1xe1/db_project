<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM employee WHERE emp_id ='$id' ");
    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM employee WHERE emp_id ='$id' ");
    $row = mysqli_fetch_array($result);
} else if ($case  == '4') {
    $header = 'โปรไฟล์';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM employee WHERE emp_id ='$id' ");
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
                            <li class="breadcrumb-item active"><a href="employee.php" class="text-decolation">ระบบพนักงาน</a>
                            </li>
                            <!-- <li class="breadcrumb-item active"><a href="magUsers.php" class="text-decolation">Manage
                                    User</a></li> -->
                            <li class="breadcrumb-item"><?php echo $header; ?> พนักงาน</li>
                        </ol>
                    </div>
                    <!-- /.content-header -->
                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3><?php echo $header; ?> พนักงาน</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formAccountSettings" action="../../API/api_employee.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                        <div class="row">
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_firstname" class="form-label">ชื่อ</label>
                                                <input type="text" class="form-control" name="emp_firstname" id="emp_firstname" placeholder="ชื่อ" value="<?php echo ($case == 1) ? '' : $row['emp_firstname'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_lastname" class="form-label">นามสกุล</label>
                                                <input type="text" class="form-control" name="emp_lastname" id="emp_lastname" placeholder="นามสกุล" value="<?php echo ($case == 1) ? '' : $row['emp_lastname'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_address" class="form-label">ที่อยู่</label>
                                                <input type="text" class="form-control" name="emp_address" id="emp_address" placeholder="ที่อยู่" value="<?php echo ($case == 1) ? '' : $row['emp_address'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_subdis" class="form-label">ตำบล</label>
                                                <input type="text" class="form-control" name="emp_subdis" id="emp_subdis" placeholder="ตำบล" value="<?php echo ($case == 1) ? '' : $row['emp_subdis'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_district" class="form-label">อำเภอ</label>
                                                <input type="text" class="form-control" name="emp_district" id="emp_district" placeholder="อำเภอ" value="<?php echo ($case == 1) ? '' : $row['emp_district'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_province" class="form-label">จังหวัด</label>
                                                <input type="text" class="form-control" name="emp_province" id="emp_province" placeholder="จังหวัด" value="<?php echo ($case == 1) ? '' : $row['emp_province'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_postcode" class="form-label">ไปรษณีย์</label>
                                                <input type="text" class="form-control" name="emp_postcode" id="emp_postcode" placeholder="ไปรษณีย์" value="<?php echo ($case == 1) ? '' : $row['emp_postcode'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_phone" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control" name="emp_phone" id="emp_phone" placeholder="เบอร์โทรศัพท์" value="<?php echo ($case == 1) ? '' : $row['emp_phone'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_email" class="form-label">อีเมล</label>
                                                <input type="email" class="form-control" name="emp_email" id="emp_email" placeholder="อีเมล" value="<?php echo ($case == 1) ? '' : $row['emp_email'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_startworking" class="form-label">วันที่เริ่มงาน</label>
                                                <input type="date" class="form-control" name="emp_startworking" id="emp_startworking" placeholder="วันที่เริ่มงาน" value="<?php echo ($case == 1) ? '' : $row['emp_startworking'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_password" class="form-label">รหัสผ่าน</label>
                                                <input type="text" class="form-control" name="emp_password" id="emp_password" placeholder="รหัสผ่าน" value="<?php echo ($case == 1) ? '' : $row['emp_password'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="emp_department" class="form-label">แผนก</label>
                                                <input type="text" class="form-control" name="emp_department" id="emp_department" placeholder="แผนก" value="<?php echo ($case == 1) ? '' : $row['emp_department'] ?>"  <?php echo ($case == '3' || $case == 4) ? 'readonly' : 'required' ?>>
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
                                            <a href="employee.php" class="btn btn-secondary ms-3">ยกเลิก</a>
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
                                            window.location.href = "employee.php";
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