<?php include '../../partials/heading.php';
include '../../partials/connect.php';

if (isset($_SESSION['id'])) {
    //get order info
    $stmt_order = $pdo->prepare('SELECT orders.id, uid, address, phone, paid, status, status_code, date FROM orders RIGHT JOIN `status` ON orders.status=status.id WHERE uid = ?');
    $stmt_order->execute([$_SESSION['id']]);
    $order = $stmt_order->fetchAll();

    //get image of product
    $stmt_images = $pdo->prepare('SELECT * FROM product_images WHERE product_id = ?');
} else {
    echo "<script>alert('Bạn chưa đăng nhập!')</script>";
}

if (isset($_GET['update'])) {
    $delete_id = $_GET['update'];
    $delete_order = $pdo->prepare("UPDATE `orders` SET status = 5 WHERE id =?");
    $delete_order->execute([$delete_id]);
    echo "<script> location.replace('order_status.php'); 
    alert('Bạn đã hủy đơn hàng thành công!');</script>";
}

// if (isset($_GET['delete'])) {
//     $delete_id = $_GET['delete'];
//     $delete_order = $pdo->prepare("DELETE FROM `product_detail` WHERE oid=?");
//     $delete_order->execute([$delete_id]);

//     $delete_user = $pdo->prepare("DELETE FROM `orders` WHERE id = ?");
//     $delete_user->execute([$delete_id]);

//     if($delete_order && $delete_order->rowCount() == 1 && $delete_user && $delete_user->rowCount() == 1) {
//         echo "<script>
//                 alert('Xóa hàng thành công!')
//                 document.location.reload();
//             </script>";
//     }
// }
?>

<body style="background-color: #e1dede">
<a href="index.php"><i class="ms-5 fa-solid fa-backward text-primary"></i></a>
<?php if (isset($_SESSION['message'])) :  ?>
        <div class="text-success mt-3">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>
    <?php foreach ($order as $orders) :
        $status = $orders['status_code'];
        $total = 0;

        //get product detail info
        $stmt_pd = $pdo->prepare('SELECT * FROM product_detail WHERE oid = ? AND pid = ?');
        $stmt_pd->execute([$orders['id'], $_SESSION['id']]);
        $pds = $stmt_pd->fetchAll();
        //var_dump($orders)
    ?>  
        <?php if(count($order) > 0) {?>
        <div id="orders" class="form p-4 w-75">
            <!-- <p>Đơn hàng <?= $orders['id']; ?></p> -->
            <div class="container">
                <h2 class="text-center">
                    TRẠNG THÁI ĐƠN ĐẶT HÀNG
                </h2>
                <div class="border border-3 border-success p-4 rounded" id="signupForm">
                    <div class="d-flex gap-5 mt-4">
                        <div class="form-group">
                            <label for="name"><b>Tên người đặt hàng</b></label>
                            <input type="text" for="name" class="form-control" name="name" id="name" readonly value="<?= $_SESSION['HoTen'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><b>Số điện thoại</b></label>
                            <input type="text" for="phone" class="form-control" name="phone" id="phone" readonly value="<?= $orders['phone'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><b>Trạng thái đơn hàng</b></label>
                            <input type="text" for="status" class="form-control bg-warning" name="status" id="status" readonly value="<?= $status ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-5 mt-4 border-bottom pb-4 border-primary">
                        <div class="form-group mt-4 pb-4 ">
                            <label for="address"><b>Ngày đặt hàng</b></label>
                            <input type="text" for="address" class="form-control text-success" name="address" id="address" readonly value="<?= $orders['date'] ?>">
                        </div>
                        <div class="form-group mt-4 pb-4">
                            <label for="address"><b>Địa chỉ giao hàng</b></label>
                            <input type="text" for="address" class="form-control" name="address" id="address" readonly value="<?= $orders['address'] ?>">
                        </div>
                    </div>

                    <div class="form-group mt-4 mb-4">
                        <div class="mb-4"><b >Thông tin sản phẩm</b></div>
                        
                        
                        <?php foreach ($pds as $pd) :
                            $stmt_images->execute([$pd['pdid']]);
                            $images = $stmt_images->fetchAll();
                            $total +=  $pd['price'] * $pd['quanlity'] ?>
                            <div class="row d-flex">
                                <div class="col-2">
                                    <img src='../admin/upload/product_detail/<?= $images[0]['images'] ?>' alt="pd" class=" mb-3 w-75">
                                </div>
                                <div class="col-6 mt-4">
                                    <input type="text" for="pname" class="form-control" name="pname" readonly value="<?= $pd['pname'] ?>">
                                </div>
                                <div class="col-2 mt-4">
                                    <input type="text" for="quanlity" class="form-control" name="quanlity" readonly value="Số lượng: <?= $pd['quanlity'] ?>">
                                </div>
                                <div class="col-2 mt-4">
                                    <input type="text" for="price" class="form-control" name="price" readonly value="Giá: <?= $pd['price'] ?>">
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="form-group mt-4 border-top pb-4 border-primary d-flex">
                        <input type="text" for="paid" class="form-control" name="paid" id="paid" readonly value="Phương thức thanh toán: <?= $orders['paid'] ?>">
                        <input type="text" for="total" class="form-control bg-light" name="total" id="total" readonly value="Tổng số tiền thanh toán: <?= $total  ?>">
                    </div>
                    <form class="form-inline ml-1 text-end" action="order_status.php?update=<?= $orders['id']; ?>" method="POST">
                    <?php if($orders['status'] == 1 || $orders['status'] == 2 ) : ?>
                        <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                            Hủy đơn hàng
                        </button>
                        <?php endif ?>
                    </form>

                    <!-- <form class="form-inline ml-1 text-end" action="order_status.php?delete=<?= $orders['id']; ?>" method="POST">
                        <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                            Xóa đơn hàng
                        </button>
                    </form> -->
                </div>
            </div>
            <?php }?>
        </div>
    <?php endforeach ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
    </script>

</body>

</html>