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


$stm_order = $pdo->prepare("SELECT * FROM `orders`");
$stm_order->execute();
$order = $stm_order->fetchAll();

$stm_price = $pdo->prepare("SELECT * FROM `product_detail` WHERE oid=? ");

if (isset($_POST['update_order'])) {

    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    echo $update_payment;
    $update_orders = $pdo->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $update_orders->execute([$update_payment, $order_id]);

    echo "<script> location.replace('admin_order.php');
    alert('Cập nhật đơn hàng thành công!');</script>";
    $_SESSION['message'] = 'Đã cập nhật trạng thái đơn hàng';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $pdo->prepare("DELETE FROM `product_detail` WHERE oid=?");
    $delete_order->execute([$delete_id]);

    $delete_user = $pdo->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_user->execute([$delete_id]);

    echo "<script> location.replace('admin_order.php');
        alert('Xóa đơn đặt hàng thành công!'); </script>";
    $_SESSION['message'] = "Đã xóa đơn hàng thành công!";
}

?>



<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý đơn đặt hàng</h1>
    <!-- Button trigger modal -->
    <?php if (isset($_SESSION['message'])) :  ?>
        <div class="text-success mt-3">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>ID khách hàng</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Xem đơn hàng</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($stm_order->rowCount() > 0) {
                            foreach ($order as $fetch_order) {
                                $stm_price->execute([$fetch_order['id']]);
                                $price = $stm_price->fetchAll();

                                $total = 0;

                                foreach ($price as $fetch_price) {
                                    $total +=  $fetch_price['price'] * $fetch_price['quanlity'];
                                }
                        ?>
                                <tr>
                                    <td><?= $fetch_order['id'] ?></td>
                                    <td><?= $fetch_order['uid'] ?></td>
                                    <td><?= htmlspecialchars($fetch_order['phone']) ?></td>
                                    <td><?= htmlspecialchars($fetch_order['address']) ?></td>

                                    <td><?= $total ?></td>

                                    <td><?= $fetch_order['paid'] ?></td>
                                    <td><?= $fetch_order['date'] ?></td>

                                    <td class="text-center">
                                        <form action="" method="POST">
                                            <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                                            <!-- <select name="update_payment" class="drop-down "> -->
                                            <select name="update_payment" class="form-select" aria-label="Default select example">
                                                <!-- <option selected>Open this select menu</option> -->

                                                <?php
                                                $status = $pdo->prepare("SELECT * FROM `status`");
                                                $status->execute();
                                                $data = $status->fetchAll();
                                                foreach ($data as $status_value) {
                                                ?>
                                                    <option <?= ($fetch_order['status'] == $status_value['id']) ? "selected" : "" ?> value=<?= $status_value['id'] ?>><?= $status_value['status_code'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="flex-btn">
                                                <input type="submit" name="update_order" class="btn btn-xs btn-success m-2" value="Cập nhật">
                                            </div>
                                        </form>
                                    </td>
                                    <td><a href="detail_order.php?order_id=<?= $fetch_order['id']; ?>">Xem chi tiết</a></td>

                                    <!-- <a href="edit_staff.php?update_user=<?= $fetch_user['id']; ?>" class="btn btn-xs btn-warning">
                                            <i alt="Edit" class="fa fa-pencil"></i>Edit
                                        </a> -->

                                    <td class="justify-content-center">
                                        <form class="form-inline ml-1" action="admin_order.php?delete=<?= $fetch_order['id']; ?>" method="POST">
                                            <input type="hidden" name="uid" value="">
                                            <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                                                <i alt="Delete" class="fa fa-trash d-flex justify-content-center"></i>
                                            </button>
                                        </form>
                                    </td>



                                </tr>
                        <?php }
                        } else {
                            echo '<p class="empty text-danger">Chưa có đơn hàng nào</p>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="delete-confirm" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">Do you want to delete this contact?</div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>



<?php
include './includes/scripts.php';
?>
<script>
    $(document).ready(function() {
        $('button[name="delete-contact"]').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const nameTd = $(this).closest('tr').find('td:first');
            if (nameTd && nameTd.length > 0) {
                $('.modal-body').html(
                    `Do you want to delete "${nameTd.text()}"?`
                );
            }
            $('#delete-confirm').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .one('click', '#delete', function() {
                    form.trigger('submit');

                });
        });
    });
</script>