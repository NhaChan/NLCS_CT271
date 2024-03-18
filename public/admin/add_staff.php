<?php

include '../../partials/connect.php';

session_start();

include '../../partials/header.php';
include './includes/header.php';



if (isset($_POST['registerbtn'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = $_POST['confirm_password'];
    $role = isset($_POST['role']) ? $_POST['role'] : 0; // Thêm dòng này để lấy giá trị của role hoặc mặc định là 0

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../admin/upload/user_profile/' . $image;


    $select_user = $pdo->prepare("SELECT * FROM `user` WHERE email = ?");
    $select_user->execute([$email]);

    if ($select_user->rowCount() > 0) {
        $message[] = 'Email nhân viên đã tồn tại! Thử lại sau!';
    } else {

    $insert_user = $pdo->prepare("INSERT INTO `user`(name, phone, address, email, password, role, image) VALUES(?,?,?,?,?,?,?)");
    $insert_user->execute([$name, $phone, $address, $email, $password, $role, $image]);

    if ($insert_user) {
        if ($image_size > 2000000) {
            $message[] = 'Kích thước ảnh quá lớn!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Nhân viên mới đã được thêm!';
            header('Location: admin_staff.php');
        }
    }
    }
};

if (isset($message)) {
    foreach ($message as $msg) {
        echo '<p class="text-success">' . $msg . '</p>';
    }
}

?>

<body style="background-color: #e1dede">
    <div class="form p-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <form id="signupForm" action="add_staff.php" method="post" enctype="multipart/form-data">
                    <div>
                        <h1 class="text-center">Thêm nhân viên</h1>
                        <hr>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="text" for="name" required class="form-control" name="name" id="name" placeholder="Nhập họ tên ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="text" for="address"  class="form-control" name="address" id="address" placeholder="Nhập vào địa chỉ ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="text" for="phone"  class="form-control" name="phone" id="phone" placeholder="Nhập vào số diện thoại ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="email" for="email" required class="form-control" name="email" id="email" placeholder="Nhập vào Email ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="password" for="password" required class="form-control" name="password" id="password" placeholder="Nhập vào mật khẩu ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="password" for="confirm_password" required class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="text" for="role" required class="form-control" name="role" id="role" placeholder="Nhập vào chức vụ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 col-sm-4 col-12"></div>
                        <div class="col-md-4 col-sm-4 col-12">
                            <a href="admin_staff.php" class="text-decoration-none d-flex justify-content-end">
                                <button type="button" class="btn btn-light form-control btn-fb">Đóng</button></a>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                            <a href="admin_staff.php" class="text-decoration-none d-flex justify-content-end">
                                <button name="registerbtn" type="submit" class="btn btn-primary form-control btn-fb">Thêm</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    <?php
    // include './includes/scripts.php';
    // include './includes/footer.php';
    ?>