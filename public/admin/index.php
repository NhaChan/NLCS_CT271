<?php
ob_start();
session_start();
include '../../partials/connect.php';
include './includes/header.php';
include './includes/navbar.php';

if (!isset($_SESSION['admin'])) {
    // echo '<script>alert("Chưa đăng nhập admin!")</script>';
    header('Location: /user/login.php');
    exit();
}
ob_end_flush();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Số lượng người dùng<i class="fas fa-fw fa-table"></i>
                            </div>
                            <?php
                            $select_user = $pdo->prepare("SELECT * FROM `user` WHERE role = ?");
                            $select_user->execute(['0']);
                            $number_of_user = $select_user->rowCount();
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h3><i class="fas fa-fw fa-user mx-3"></i></i><?= $number_of_user; ?></h3>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng sản phẩm<i class="fas fa-fw fa-table"></i>
                            </div>
                            <?php
                            $select_product = $pdo->prepare("SELECT * FROM `products`");
                            $select_product->execute();
                            $number_of_product = $select_product->rowCount();
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h3><i class="fas fa-fw fa-laptop mx-3"></i><?= $number_of_product; ?></h3>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng<i class="fas fa-fw fa-table"></i>
                            </div>
                            <?php
                            $select_order = $pdo->prepare("SELECT * FROM `orders`");
                            $select_order->execute();
                            $number_of_order = $select_order->rowCount();
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h3><i class="fas fa-fw fa-table mx-3 "></i><?= $number_of_order; ?></h3>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Thống kê doanh thu</div>
                            <?php
                            $select_order = $pdo->prepare("SELECT SUM(price * quanlity) as total_price 
                                                                FROM `product_detail`, `orders` 
                                                                WHERE product_detail.oid=orders.id AND status = 4");
                            $select_order->execute();
                            $result = $select_order->fetch();

                            // Định dạng giá tiền
                            $formatted_total_price = number_format($result['total_price'], 0, ',', '.');
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <i class="fas fa-fw fa-dollar-sign mx-3 "></i><?= $formatted_total_price ?> đ
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<?php
include './includes/scripts.php';
include './includes/footer.php';
?>