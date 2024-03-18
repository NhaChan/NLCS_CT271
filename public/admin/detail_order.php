<?php

session_start();
include '../../partials/connect.php';
include './includes/header.php';
include './includes/navbar.php';

// Check if the order ID is set in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $stm_order_detail = $pdo->prepare("SELECT * FROM `orders` WHERE id = ?");
    $stm_order_detail->execute([$order_id]);
    $order_detail = $stm_order_detail->fetch(PDO::FETCH_ASSOC);

    // Fetch product details for the order
    $stm_product_detail = $pdo->prepare("SELECT * FROM `product_detail` WHERE oid = ?");
    $stm_product_detail->execute([$order_id]);
    $product_details = $stm_product_detail->fetchAll(PDO::FETCH_ASSOC);

    $stm_names = $pdo->prepare("SELECT user.name FROM `user`, `orders` WHERE user.id=orders.uid AND orders.id = ?");
    $stm_names->execute([$order_id]);
    $stm_name = $stm_names->fetch();


    // Calculate total price
    $total_price = 0;
    foreach ($product_details as $product) {
        $total_price += $product['price'] * $product['quanlity'];
    }
} else {
    // Redirect to the orders page if the order ID is not set
    header('Location: admin_order.php');
    exit();
}

?>

<div class="container-fluid">
    <h1 class=" mb-2 text-gray-800 text-center">Chi tiết đơn hàng</h1>

    <div class="m-4">
        <h4>Thông tin đơn hàng</h4>
        <p>Mã đơn hàng: <?= $order_detail['id'] ?></p>
        <p>Mã số khách hàng: <?= $order_detail['uid'] ?></p>
        <p>Tên người nhận hàng: <?= $stm_name['name'] ?></p>
        <p>Điện thoại: <?= htmlspecialchars($order_detail['phone']) ?></p>
        <p>Địa chỉ giao hàng: <?= htmlspecialchars($order_detail['address']) ?></p>
        <p>Thanh toán: <?= $order_detail['paid'] ?></p>
        <p>Ngày đặt hàng: <?= $order_detail['date'] ?></p>

        <h4>Chi tiết sản phẩm</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product_details as $product): ?>
                    <tr>
                        <td><?= $product['pname'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['quanlity'] ?></td>
                        <td><?= $product['price'] * $product['quanlity'] ?></td>
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
            <h5 class="text-danger"><b>Tổng tiền: <?= $total_price ?></b></h5>
        </div>
        </div>
        
    </div>
</div>

