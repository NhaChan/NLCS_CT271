<?php

ob_start();
session_start();
include '../../partials/connect.php';
include '../../partials/header.php';
include './includes/header.php';
include './includes/navbar.php';

if (!isset($_SESSION['admin'])) {
    // echo '<script>alert("Chưa đăng nhập admin!")</script>';
    header('Location: /user/login.php');
    exit();
}
ob_end_flush();

$show_user = $pdo->prepare("SELECT * FROM `category`");
$show_user->execute();


if (isset($_POST['registerbtn'])) {

    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../admin/upload/icon/' . $image;

    $select_category = $pdo->prepare("SELECT * FROM `category` WHERE cname = ?");
    $select_category->execute([$name]);



    if ($select_category->rowCount() > 0) {
        $message[] = 'Tên danh mục đã tồn tại! Thử lại sau!';
    } else {

        $insert_category = $pdo->prepare("INSERT INTO `category`(cname, img) VALUES(?, ?)");
        $insert_category->execute([$name, $image]);

        if ($insert_category) {
            if ($image_size > 2000000) {
                $message[] = 'Kích thước ảnh quá lớn!';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Nhân viên mới đã được thêm!';
                header('Location: admin_staff.php');
            }
        }

        $message[] = 'Danh mục mới đã được thêm!';

        echo "<script> location.replace('admin_category.php');
        alert('Thêm danh mục sản phẩm thành công!'); </script>";
        // header('Location: admin_category.php');
    }
}

if (isset($message)) {
    foreach ($message as $msg) {
        echo '<p class="text-success">' . $msg . '</p>';
    }
}
if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_message = $pdo->prepare("DELETE FROM `category` WHERE id = ?");
    $delete_message->execute([$delete_id]);

    echo "<script> location.replace('admin_category.php');
        alert('Xóa danh mục thành công!'); </script>";
    $_SESSION['message'] = "Đã xóa danh mục!";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý danh mục sản phẩm</h1>
    <?php if (isset($_SESSION['message'])) :  ?>
        <div class="text-success">
            <b><?= $_SESSION['message'] ?></b>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>


    <!-- DataTales Example -->
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
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
                                            <td><?= $fetch_user['id'] ?></td>
                                            <td><?= $fetch_user['cname'] ?></td>
                                            <td><?= '<img src="../admin/upload/icon/' . $fetch_user['img'] . '" width="100px;" height="15px"; alt="">' ?> </td>
                                            <td class="justify-content-center">
                                                <a href="edit_category.php?update_category=<?= $fetch_user['id']; ?>" class="btn btn-xs btn-warning">
                                                    Edit</a>
                                            </td>
                                            <td class="justify-content-center">
                                                <form class="form-inline ml-1" action="admin_category.php?delete=<?= $fetch_user['id']; ?>" method="POST">
                                                    <input type="hidden" name="id" value="">
                                                    <button type="submit" class="btn btn-xs btn-danger" name="delete-category">
                                                        <i alt="Delete" class="fa fa-trash"></i>
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

        <div class="col-6">
            <div class="form p-4">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <form id="signupForm" action="admin_category.php" method="post" enctype="multipart/form-data">
                            <div>
                                <h3 class="text-center">Thêm danh mục</h3>
                                <hr>
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="text" for="name" required class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8 col-sm-8 col-12"></div>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <a href="admin_category.php" class="text-decoration-none d-flex justify-content-end">
                                        <button name="registerbtn" type="submit" class="btn btn-primary form-control btn-fb">Thêm</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
        $('button[name="delete-category"]').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const nameTd = $(this).closest('tr').find('td:eq(-4)');
            if (nameTd && nameTd.length > 0) {
                $('.modal-body').html(
                    `Bạn chắc chắn muốn xóa danh mục "${nameTd.text()}"?`
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