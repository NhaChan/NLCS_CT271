<?php

include '../../partials/connect.php';

session_start();

include '../../partials/header.php';
include './includes/header.php';



if (isset($_POST['update_category'])) {

    $category_id = $_POST['id'];
    $name = $_POST['name'];

    $update_category = $pdo->prepare("UPDATE `category` SET cname = ? WHERE id = ?");
    $update_category->execute([$name, $category_id]);

    // Xử lý hình ảnh
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $old_image = $_POST['old_img'];

    echo $file_name;
    if (!empty($file_name)) {

        $update_image = $pdo->prepare("UPDATE `category` SET img = ? WHERE id = ?");
        $update_image->execute([$file_name, $category_id]);

        if ($update_image) {
            move_uploaded_file($file['tmp_name'], '../admin/upload/icon/' . $file_name);
            // unlink('../admin/upload/user_profile/' . $old_image);
            // $message[] = 'image updated successfully!';
        }
    }

    // Thông báo cho người dùng
    $_SESSION['message'] = 'Danh mục sản phẩm đã được cập nhật!';
    header('Location: admin_category.php');
}

?>

<body style="background-color: #e1dede">
    <div class="form p-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <?php
                $update_id = $_GET['update_category'];
                $select_category = $pdo->prepare("SELECT * FROM `category` WHERE id = ?");
                $select_category->execute([$update_id]);
                if ($select_category->rowCount() > 0) {
                    while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form id="signupForm" action="edit_category.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <h1 class="text-center">Sửa thông tin</h1>
                                <hr>
                            </div>
                            <input type="hidden" name="id" value="<?= $fetch_category['id']; ?>">

                            <div class="text-center">
                                <input type="hidden" name="old_img" value="<?= $fetch_category['img']; ?>">
                                <img src="../admin/upload/icon/<?= $fetch_category['img']; ?>" width="300px" height="50px" alt="">
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                            </div>

                            <div class="form-group mt-4 mb-4">
                                <input type="text" name="name" class="form-control" placeholder="enter product name" required class="box" value="<?= $fetch_category['cname']; ?>">
                            </div>

            </div>
            <div class="row mb-3">
                <div class="col-md-4 col-sm-4 col-12"></div>
                <div class="col-md-4 col-sm-4 col-12">
                    <a href="admin_category.php" class="text-decoration-none d-flex justify-content-end">
                        <button type="button" class="btn btn-light form-control btn-fb">Đóng</button></a>
                </div>
                <div class="col-md-4 col-sm-4 col-12">
                    <a href="admin_category.php" class="text-decoration-none d-flex justify-content-end">
                        <button name="update_category" type="submit" value="update" class="btn btn-primary form-control btn-fb">Cập nhật</button>
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