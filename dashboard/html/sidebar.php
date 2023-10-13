<?php
// Assuming $currentPage holds the name of the current page
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">อนันต์ นามวงค์</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?php echo ($currentPage == 'dashboard.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="dashboard.php" class="menu-link">
                <i class="menu-icon fa-light fa-scale-balanced"></i>
                <div data-i18n="Authentications">แผงควบคุม</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($currentPage == 'product.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="product.php" class="menu-link">
            <i class="menu-icon fa-light fa-box-taped"></i>
                <div data-i18n="Authentications">ข้อมูลสินค้า</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($currentPage == 'project.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="project.php" class="menu-link">
                <i class="menu-icon fa-light fa-file-invoice"></i>
                <div data-i18n="Authentications">ข้อมูลโครงการ</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($currentPage == 'receipt.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="receipt.php" class="menu-link">
                <i class="menu-icon fa-light fa-comment-dollar"></i>
                <div data-i18n="Authentications">ข้อมูลค่าใช้จ่ายโครงการ</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($currentPage == 'close_project.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="close_project.php" class="menu-link">
                <i class="menu-icon fa-light fa-stamp"></i>
                <div data-i18n="Authentications">บันทึกปิดโครงการ</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($currentPage == 'employee.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="employee.php" class="menu-link">
                
                <i class="menu-icon fa-light fa-cash-register"></i>
                <div data-i18n="Authentications">ข้อมูลพนักงาน</div>
            </a>
        <li class="menu-item <?php echo ($currentPage == 'customer.php' || $currentPage == '') ? "active" : ""; ?>">
            <a href="customer.php" class="menu-link">
                <i class="menu-icon fa-light fa-user"></i>
                <div data-i18n="Authentications">ข้อมูลลูกค้า</div>
            </a>
        </li>
    </ul>
</aside>