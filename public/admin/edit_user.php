<?php

include '../../partials/connect.php';

session_start();

include '../../partials/header.php';
include './includes/header.php';



if (isset($_POST['update_user'])) {

    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $update_user = $pdo->prepare("UPDATE `user` SET name = ?, phone = ?, address = ?, email = ?  WHERE id = ?");
    $update_user->execute([$name, $phone, $address, $email, $user_id]);

    // Xử lý hình ảnh
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $old_image = $_POST['old_img'];

    echo $file_name;
    if (!empty($file_name)) {

        $update_image = $pdo->prepare("UPDATE `user` SET image = ? WHERE id = ?");
        $update_image->execute([$file_name, $user_id]);

        if ($update_image) {
            move_uploaded_file($file['tmp_name'], '../admin/upload/user_profile/' . $file_name);
            unlink('../admin/upload/user_profile/' . $old_image);
            // $message[] = 'image updated successfully!';
        }
    }
    // Thông báo cho người dùng
    $_SESSION['message'] = 'Thông tin khách hàng đã được cập nhật!';
    header('Location: admin_user.php');
}

?>

<body style="background-color: #e1dede">
    <div class="form p-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <?php
                $update_id = $_GET['update_user'];
                $select_user = $pdo->prepare("SELECT * FROM `user` WHERE id = ?");
                $select_user->execute([$update_id]);
                if ($select_user->rowCount() > 0) {
                    while ($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form id="signupForm" action="edit_user.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <h1 class="text-center">Sửa thông tin</h1>
                                <hr>
                            </div>
                            <input type="hidden" name="id" value="<?= $fetch_user['id']; ?>">
                            <div  class="text-center">
                                <input type="hidden" name="old_img" value="<?= $fetch_user['image']; ?>">
                                
                                <img src="../admin/upload/user_profile/<?= $fetch_user['image']; ?>" width="150px" height="150px" alt="">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="text" name="name" class="form-control" placeholder="enter product name" required class="box" value="<?= $fetch_user['name']; ?>">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="text" name="address" class="form-control" placeholder="enter product address" required class="box" value="<?= $fetch_user['address']; ?>">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="text" name="phone" class="form-control" placeholder="enter product phone" required class="box" value="<?= $fetch_user['phone']; ?>">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="email" name="email" class="form-control" placeholder="enter product email" required class="box" value="<?= $fetch_user['email']; ?>">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-4 col-12"></div>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <a href="admin_user.php" class="text-decoration-none d-flex justify-content-end">
                                        <button type="button" class="btn btn-light form-control btn-fb">Đóng</button></a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <a href="admin_user.php" class="text-decoration-none d-flex justify-content-end">
                                        <button name="update_user" type="submit" value="update" class="btn btn-primary form-control btn-fb">Cập nhật</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo '<p class="empty">Không có người dùng nào.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    </div>