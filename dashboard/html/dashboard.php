<?php
include("connect.php");
include("header.php");
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Menu -->
        <?php include("sidebar.php") ?>
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
                    </div>
                    <section class="content">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3 class="text-white " style="font-weight: 600;">
                                            <?php
                                            $result = mysqli_query($conn, 'SELECT count(cus_id) AS cus FROM customer WHERE void = 0');
                                            $row = mysqli_fetch_assoc($result);
                                            $sum = $row['cus'];
                                            echo $sum;
                                            ?>
                                        </h3>
                                    </div>
                                    <h5 class="text-white">จำนวนลูกค้า</h5>
                                    <div class="icon">
                                        <i class="fa-solid fa-address-card"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color:mediumpurple">
                                    <div class="inner">
                                        <h3 class="text-white " style="font-weight: 600;">
                                            <?php

                                            $sql = "SELECT count(emp_id) FROM employee where void =0";
                                            $query = $conn->query($sql);

                                            echo "$query->num_rows";
                                            ?></h3>

                                        <h5 class="text-white">จำนวนพนักงาน</h5>

                                    </div>
                                    <div class="icon">
                                        <i class="fa-duotone fa-user-tie"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 class="text-white " style="font-weight: 600;">
                                            <?php

                                            $sql = "SELECT count(project_id) FROM project WHERE void = 0";
                                            $query = $conn->query($sql);

                                            echo "$query->num_rows";
                                            ?></h3>

                                        <h5 class="text-white">จำนวนโครงการ</h5>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-list-check"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="text-white " style="font-weight: 600;">
                                            <?php
                                            $result = mysqli_query($conn, 'SELECT count(s_id) AS value_sum FROM stock WHERE void = 0');
                                            $row = mysqli_fetch_assoc($result);
                                            $sum = $row['value_sum'];
                                            echo $sum;
                                            ?></h3>

                                        <h5 class="text-white">จำนวนสินค้า</h5>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-sharp fa-solid fa-boxes-stacked"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->

                        <!-- 2nd row -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color:royalblue">
                                    <div class="inner">
                                        <h3 class="text-white " style="font-weight: 600;">
                                            <?php
                                            $sql = "SELECT * FROM `project_hd` JOIN project_desc USING(headcode) WHERE project_hd.void =0";
                                            $query = $conn->query($sql);

                                            echo "$query->num_rows";
                                            ?></h3>

                                        <h5 class="text-white">ใบเสร็จ</h5>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-receipt"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color:palevioletred">
                                    <div class="inner">
                                        <h3 class="text-white " style="font-weight: 600;">
                                            <?php
                                            $sql = "SELECT count(headcode) FROM project_close where void = 0";
                                            $query = $conn->query($sql);

                                            echo "$query->num_rows";
                                            ?></h3>

                                        <h5 class="text-white">จำนวนโครงการที่ปิด</h5>
                                    </div>

                                    <div class="icon">
                                        <i class="fa-solid fa-subtitles"></i>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </section>
                    <!-- /.content -->
                </div>
            </div>
        </div>
        <!-- / Content -->
        <!-- Footer -->
        <?php include("footer.php"); ?>
        <!-- / Footer -->