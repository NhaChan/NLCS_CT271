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



// $stmt = $pdo->query('SELECT * FROM user WHERE role=0');
$show_user = $pdo->prepare("SELECT * FROM `user` WHERE role=1");
$show_user->execute();

if (isset($_GET['delete'])) {


    $delete_id = $_GET['delete'];
    $select_delete_image = $pdo->prepare("SELECT image FROM `user` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);

    $delete_user = $pdo->prepare("DELETE FROM `user` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    
    echo "<script> location.replace('admin_staff.php');
    alert('Xóa nhân viên thành công!');</script>";
    $_SESSION['message'] = "Đã xóa nhân viên!";
}
?>



<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý nhân viên</h1>
    <?php if (isset($_SESSION['message'])) :  ?>
        <div class="text-success">
            <b><?= $_SESSION['message'] ?></b>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>
    <!-- Button trigger modal -->
    <a href="add_staff.php"><button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addadminprofile">
            + Thêm nhân viên
        </button></a>

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
                            <th>Tên</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Hình ảnh</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php


                    if ($show_user->rowCount() > 0) {
                        while ($fetch_user = $show_user->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $htmlspecialchars($fetch_user['name']) ?></td>
                                    <td><?= $htmlspecialchars($fetch_user['phone']) ?></td>
                                    <td><?= $htmlspecialchars($fetch_user['address']) ?></td>
                                    <td><?= $htmlspecialchars($fetch_user['email']) ?></td>
                                    <td><?= '<img src="../admin/upload/user_profile/' . $fetch_user['image'] . '" width="100px;" height="100px"; alt="">' ?> </td>
                                    <td class="justify-content-center">
                                        <a href="edit_staff.php?update_user=<?= $fetch_user['id']; ?>" class="btn btn-xs btn-warning">
                                            <i alt="Edit" class="fa fa-pencil"></i>Edit
                                        </a>
                                    </td>
                                    <td class="justify-content-center">
                                        <form class="form-inline ml-1" action="admin_staff.php?delete=<?= $fetch_user['id']; ?>" method="POST">
                                            <input type="hidden" name="id" value="">
                                            <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                                                <i alt="Delete" class="fa fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">now user added yet!</p>';
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
        $('button[name="delete-contact"]').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const nameTd = $(this).closest('tr').find('td:first');
            if (nameTd && nameTd.length > 0) {
                $('.modal-body').html(
                    `Bạn chắc chắn muốn xóa nhân viên "${nameTd.text()}"?`
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