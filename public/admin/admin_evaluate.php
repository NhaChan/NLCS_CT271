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

$show_user = $pdo->prepare("SELECT * FROM `user` , `evaluate` WHERE user.id=evaluate.user_id and role=0");
$show_user->execute();

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_message = $pdo->prepare("DELETE FROM `evaluate` WHERE id = ?");
    $delete_message->execute([$delete_id]);

    echo "<script> location.replace('admin_evaluate.php');
        alert('Xóa bình luận thành công!'); </script>";
    $_SESSION['message'] = "Đã xóa đánh giá!";
}
?>



<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý Đánh giá</h1>
    <?php if (isset($_SESSION['message'])) :  ?>
        <div class="text-success">
            <b><?= $_SESSION['message'] ?></b>
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
                            <th>Ảnh đại diện</th>
                            <th>Mã người dùng</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên người đánh giá</th>
                            <th>Đánh giá</th>
                            <th></th>

                        </tr>
                    </thead>
                    <?php

                    if ($show_user->rowCount() > 0) {
                        while ($fetch_user = $show_user->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td><?= '<img src="../admin/upload/user_profile/' . $fetch_user['image'] . '" width="100px;" height="100px"; alt="">' ?> </td>
                                    <td><?= $fetch_user['user_id']; ?></td>
                                    <td><?= $fetch_user['product_id']; ?></td>
                                    <td><?php echo htmlspecialchars($fetch_user['name']) ?></td>
                                    <td><?= htmlspecialchars($fetch_user['message']) ?></td>
                                    <td class="justify-content-center">
                                        <form class="form-inline ml-1" action="admin_evaluate.php?delete=<?= $fetch_user['id']; ?>" method="POST">
                                            <input type="hidden" name="id" value="">
                                            <button type="submit" class="btn btn-xs btn-danger" name="delete-message">
                                                <i alt="Delete" class="fa fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                    <?php
                        }
                    } else {
                        echo '<p class="empty text-danger">Chưa có phản hồi nào từ khách hàng!</p>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="delete-confirm" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Xác nhận</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">Do you want to delete this contact?</div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy</button>
            </div>
        </div>
    </div>
</div>


<?php
include './includes/scripts.php';
?>
<script>
    $(document).ready(function() {
        $('button[name="delete-message"]').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const nameTd = $(this).closest('tr').find('td:eq(-2)');
            if (nameTd.length > 0) {
                $('.modal-body').html(
                    `Bạn chắc chắn muốn xóa đánh giá "${nameTd.text()}"?`
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