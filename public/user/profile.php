<?php include '../../partials/heading.php';
?>
<?php if (isset($_SESSION['message'])) :  ?>
    <div class="text-success text-center fs-5">
        <b><?= $_SESSION['message'] ?></b>
    </div>
    <?php unset($_SESSION['message']) ?>
<?php endif; ?>

<?php
include '../../partials/connect.php';

// Hiển thị Thông tin user
$user_id = $_SESSION['id'];
$show_user = $pdo->prepare("SELECT * FROM `user` WHERE role=0 and id = $user_id ");
$show_user->execute();

// delete user
if (isset($_POST['delete'])) {
    $delete_id = $_SESSION['id'];

    $select_delete_image = $pdo->prepare("SELECT image FROM `user` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);

    $delete_mess = $pdo->prepare("DELETE FROM `evaluate` where user_id = ?");
    $delete_mess->execute([$delete_id]);

    $stm = $pdo->prepare("SELECT id FROM `orders` WHERE uid = ?");
    $stm->execute([$delete_id]);
    $id_order = $stm->fetchALL();

    $delete_pd = $pdo->prepare("DELETE FROM `product_detail` WHERE oid=?");
    $delete_order = $pdo->prepare("DELETE FROM `orders` WHERE id = ?");

    foreach ($id_order as $fetch_order) {
        $delete_pd->execute([$fetch_order['id']]);
        $delete_order->execute([$fetch_order['id']]);
    }


    // if (isset($fetch_delete_image['image'])) {
    //     unlink('../admin/upload/user_profile/' . $fetch_delete_image['image']);
    // }
    $delete_user = $pdo->prepare("DELETE FROM `user` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    if($delete_user && $delete_user->rowCount() == 1) {
        // echo "<script>alert('Xóa tài khoản thành công!')</script>";
        header('Location: index.php');
    }
    
}
?>


<body style="background-color: #e1dede">
    <div class="form p-2 w-50">
        <div class="container">
            <h2 class="text-center">
                THÔNG TIN CỦA BẠN
            </h2>

            <?php
            if ($show_user->rowCount() > 0) {
                while ($fetch_user = $show_user->fetch(PDO::FETCH_ASSOC)) {
            ?>


                    <div class="border border-3 border-primary p-4 rounded" id="signupForm" action="order.php" method="POST">
                        <div>
                            <img src="../admin/upload/user_profile/<?= $fetch_user['image']; ?>" width="100px" height="100px" alt="">
                        </div>

                        <div class="d-flex gap-5 mt-4">
                            <div class="form-group">
                                <label for="name"><b>Tên của bạn</b></label>
                                <input type="text" for="name" class="form-control" name="name" id="name" readonly value="<?= $fetch_user['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone"><b>Số điện thoại</b></label>
                                <input type="text" for="phone" class="form-control" name="phone" id="phone" readonly value="<?= $fetch_user['phone']; ?>">
                            </div>
                        </div>

                        <div class="form-group mt-4 mb-4 border-bottom pb-4 border-primary">
                            <label for="address"><b>Địa chỉ</b></label>
                            <input type="text" for="address" class="form-control" name="address" id="address" readonly value="<?= $fetch_user['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><b>Email của bạn</b></label>
                            <input type="email" for="mail" class="form-control" name="mail" id="mail" readonly value="<?= $fetch_user['email']; ?>">
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="col-md-6 col-sm-4 col-12">
                                <form class="form-inline ml-1" action="" method="POST">
                                    <input type="hidden" name="id" value="">
                                    <button type="submit" class="btn btn-xs btn-danger" name="delete">
                                        Xóa tài khoản
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-3 col-sm-4 col-12">
                                <a href="index.php" class="text-decoration-none d-flex justify-content-end">
                                    <button type="button" class="btn btn-light form-control btn-fb">TRỞ LẠI</button></a>
                            </div>
                            <div class="col-md-3 col-sm-4 col-12">
                                <a href="edit_profile.php" class="text-decoration-none d-flex justify-content-end">
                                    <button type="button" class="btn btn-success form-control btn-fb">Sửa</button></a>
                            </div>

                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Bạn chưa đăng nhập!</p>';
            }
            ?>
        </div>
    </div>
    </div>
</body>

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