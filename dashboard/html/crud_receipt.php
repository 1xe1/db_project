<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'บันทึกค่าใช้จ่ายโครงการ';
    $id = '';
    $result_ = mysqli_query($conn, "SELECT * FROM project WHERE void = 0");
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_hd WHERE headcode ='$id' ");
    $row = mysqli_fetch_array($result);
} else if ($case  == '4') {
    $header = 'บันทึกค่าใช้จ่ายโครงการ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_hd WHERE headcode ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM project JOIN customer USING(cus_id) WHERE project_id AND project.void = 0");
    $result_hd = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project USING(project_id) JOIN customer USING(cus_id) WHERE project_hd.void = 0");
    $result_value = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project_desc USING(headcode) WHERE project_hd.void =0");
    $row = mysqli_fetch_array($result);
    $row_ = mysqli_fetch_array($result_hd);
    $nn = mysqli_query($conn, "SELECT *,concat(SUBSTRING(datesave,9,2),SUBSTRING(datesave,6,2),headcode) as no_ FROM `project_hd`");
    $no = mysqli_fetch_array($nn);
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
                            <li class="breadcrumb-item active"><a href="receipt.php" class="text-decolation">
                            ค่าใช้จ่ายโครงงาน</a>
                            </li>
                            <!-- <li class="breadcrumb-item active"><a href="magUsers.php" class="text-decolation">Manage
                                    User</a></li> -->
                            <li class="breadcrumb-item"><?php echo $header; ?></li>
                        </ol>
                    </div>
                    <!-- /.content-header -->
                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card mb-3">
                                <div class="text-end mt-3 me-3">NO.
                                    <?php echo ($case == 4) ? $no['no_'] : '' ?>
                                </div>
                                <div class="card-header text-center">
                                    <h3><?php echo $header; ?></h3>
                                </div>

                                <div class="card-body">
                                    <form id="formAccountSettings" action="../../API/api_receipt.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                        <div class="row">
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="datesave" class="form-label">วันที่บันทึก</label>
                                                <input type="date" class="form-control" name="datesave" id="datesave" value="<?php echo ($case == 1) ? '' : $row['datesave'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="receiptcode" class="form-label">เลขที่ใบเสร็จ</label>
                                                <input type="text" class="form-control" name="receiptcode" id="receiptcode" placeholder="เลขที่ใบเสร็จ" value="<?php echo ($case == 1) ? '' : $row['receiptcode'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="datereceipt" class="form-label">วันที่ใบเสร็จ</label>
                                                <input type="date" class="form-control" name="datereceipt" id="datereceipt" placeholder="วันที่ใบเสร็จ" value="<?php echo ($case == 1) ? '' : $row['datereceipt'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="project_id" class="form-label">รหัสโครงการ</label>
                                                <input type="text" class="form-control" id="project_id_display" placeholder="ชื่อโครงการ" readonly value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                                <!-- <div id="project_name_display"></div> -->
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="datereceipt" class="form-label">ชื่อโครงการ</label>
                                                <select class="form-select" aria-label="Default select example" name="project_id" id="project_id" value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                    <option selected disabled>ชื่อโครงการ</option>
                                                    <?php
                                                    foreach ($result_ as $rowselect) {
                                                        $isSelected = ($rowselect['project_id'] == $row['project_id']) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?php echo $rowselect['project_id']; ?>" <?php echo $isSelected; ?>>
                                                            <?php echo $rowselect['project_name']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="cus_id" class="form-label">ชื่อลูกค้า</label>
                                                <input type="text" class="form-control" name="cus_id" id="project_name_display" value="<?php echo ($case == '4') ?  $row_['cus_firstname'] . " " . $row_['cus_lastname']  : '' ?>" readonly>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="totalprice" class="form-label">มูลค่า</label>
                                                <input type="text" class="form-control" name="totalprice" id="project_price_display" value="<?php echo ($case == '4') ?  $row_['totalprice'] : '' ?>" readonly>
                                            </div>
                                        </div>

                                        <table class="table my-2">
                                            <thead>
                                                <tr>
                                                    <th>รหัสสินค้า</th>
                                                    <th>จำนวน</th>
                                                    <th>ราคา/หน่วย</th>
                                                    <th>จำนวนเงิน</th>
                                                    <?php echo ($case == 1) ? '<th><button type="button" class="btn btn-info" onclick="addInputFields()">เพิ่ม</button></th>' : ''; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($case == 1) {
                                                    echo '
                                                   ';
                                                } elseif ($case == 4) {
                                                    $sum = 0;

                                                    foreach ($result_value as $rowselect) {
                                                        $sum += $rowselect["totalprice"];
                                                ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["s_id"] ?>"></td>
                                                            <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["qty"] ?>"></td>
                                                            <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["s_price"] ?>"></td>
                                                            <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["totalprice"] ?>"></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th class="text-center">รวมมูลค่าสินค้า</th>
                                                        <th class="text-center" id="grandTotal"><?php echo ($case == 4) ? $sum : '' ?></th>
                                                    </tr>
                                                </thead>
                                            </tbody>
                                        </table>
                                        <div class="mt-2">
                                            <?php
                                            echo ($case == '1') ?
                                                '<button type="submit" name="submit_frm" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                    '<button type="submit" name="submit_frm" class="btn btn-warning">แก้ไข</button>' : (($case == '3') ?
                                                        '<button type="submit" name="submit_frm" class="btn btn-danger">ลบ</button>' : ''))
                                            ?>
                                            <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                            <a href="receipt.php" class="btn btn-secondary ms-3">ยกเลิก</a>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <!--/ Total Revenue -->
                        </div>
                    </div>
                    <!-- / Content -->

                    <script>
                        // เลือกรหัสโครงการ
                        var projectSelect = document.getElementById('project_id');
                        // ช่องแสดงชื่อโครงการ
                        var projectNameInput = document.getElementById('project_name_display');
                        var projectNameInputID = document.getElementById('project_id_display');
                        var projectNameInputprice = document.getElementById('project_price_display');

                        // ใช้ addEventListener เพื่อดักเหตุการณ์การเลือกรหัสโครงการ
                        projectSelect.addEventListener('change', function() {
                            // หาค่าที่ถูกเลือก
                            var selectedOption = projectSelect.options[projectSelect.selectedIndex];
                            var selectedProjectID = selectedOption.value; // รหัสโครงการที่ถูกเลือก

                            // ส่งคำขอ AJAX ไปยังเซิร์ฟเวอร์เพื่อดึงชื่อโครงการ
                            $.ajax({
                                url: '../../API/api_receipt.php?xCase=4&id=' + selectedProjectID,
                                type: 'GET',
                                success: function(data) {
                                    var projectData = JSON.parse(data);
                                    projectNameInputID.value = selectedOption.value;
                                    projectNameInput.value = projectData.project_fullname;
                                    projectNameInputprice.value = projectData.project_valueprice;
                                }
                            });

                        });

                        function updateRowResult(row) {
                            const num1 = parseFloat(row.querySelector('.qty').value) || 0;
                            const num2 = parseFloat(row.querySelector('.s_price').value) || 0;
                            const result = num1 * num2;

                            row.querySelector('.totalprice').value = result;

                            // รวมค่า
                            calculateGrandTotal();
                        }

                        // รวมค่าทุกrow
                        function calculateGrandTotal() {
                            const totalpriceInputs = document.querySelectorAll('.totalprice');
                            let grandTotal = 0;

                            totalpriceInputs.forEach(input => {
                                const value = parseFloat(input.value) || 0;
                                grandTotal += value;
                            });

                            // ผลลัพ
                            document.getElementById('grandTotal').textContent = grandTotal;
                        }

                        // เพิ่มrow tableใหม่
                        function addInputFields() {
                            const table = document.querySelector('table');

                            // เช็คให้สร้างtbodyแค่ตัวเดียว
                            let tbody = table.querySelector('tbody');
                            if (!tbody) {
                                tbody = document.createElement('tbody');
                                table.appendChild(tbody);
                            }

                            const newRow = document.createElement('tr');

                            const fieldNames = ['s_id', 'qty', 's_price', 'totalprice'];
                            const field_holder = ['รหัสสินค้า', 'จำนวน', 'ราคา/หน่วย', 'จำนวนเงิน'];

                            for (let i = 0; i < fieldNames.length; i++) {
                                const newCell = document.createElement('td');
                                const newInput = document.createElement('input');
                                newInput.type = 'text';
                                newInput.name = `${fieldNames[i]}[]`;
                                newInput.className = `form-control ${fieldNames[i]}`;
                                newInput.placeholder = `${field_holder[i]}`;
                                if (fieldNames[i] === 'totalprice') {
                                    newInput.readOnly = true;
                                }
                                newCell.appendChild(newInput);
                                newRow.appendChild(newCell);

                                // คูณค่า ในrow tableใหม่
                                if (fieldNames[i] === 'qty' || fieldNames[i] === 's_price') {
                                    newInput.addEventListener('input', function() {
                                        updateRowResult(newRow);
                                    });
                                }
                            }

                            tbody.appendChild(newRow);
                        }
                    </script>

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
                                                window.location.href = "receipt.php";
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