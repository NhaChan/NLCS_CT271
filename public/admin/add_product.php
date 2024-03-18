<?php

include '../../partials/connect.php';

session_start();

include '../../partials/header.php';
include './includes/header.php';


if (isset($_POST['registerbtn'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $description = $_POST['describe'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $discount = $_POST['discount'];
    $discount = filter_var($discount, FILTER_SANITIZE_STRING);
    $category_id = $_POST['category_id'];


    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];

        if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
            move_uploaded_file($file['tmp_name'], '../admin/upload/top10laptop/' . $file_name);
        } else {
            echo "Không đúng định dạng";
            $file_name = '';
        }
    }
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];
        $file_names = $files['name'];

        $image_paths = []; // array to store file paths

        foreach ($file_names as $key => $value) {
            if ($files['type'][$key] == 'image/jpeg' || $files['type'][$key] == 'image/jpg' || $files['type'][$key] == 'image/png') {
                $image_path = '../admin/upload/product_detail/' . $value;
                move_uploaded_file($files['tmp_name'][$key], $image_path);
                $image_paths[] = $value; // store the file path
            } else {
                echo "Không đúng định dạng";
                $file_names[$key] = '';
            }
        }
    }


    $select_product = $pdo->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_product->execute([$name]);

    if ($select_product->rowCount() > 0) {
        $message[] = 'Tên sản phẩm đã tồn tại!';
    } else {
        $select_category = $pdo->prepare("SELECT * FROM `category` WHERE id = ?");
        $select_category->execute([$category_id]);

        if ($select_category->rowCount() > 0) {
            $insert_product = $pdo->prepare("INSERT INTO `products`(name, `describe`, price, discount, category_id, image) VALUES(?,?,?,?,?,?)");
            $insert_product->execute([$name, $description, $price, $discount, $category_id, $file_name]);

            if ($insert_product) {
                $product_id = $pdo->lastInsertId();

                // Insert main product image path into the products table
                $update_product_image = $pdo->prepare("UPDATE `products` SET image = ? WHERE id = ?");
                $update_product_image->execute([$file_name, $product_id]);

                // Insert other images into the product_images table
                foreach ($image_paths as $path) {
                    $insert_image = $pdo->prepare("INSERT INTO `product_images` (product_id, images) VALUES (?, ?)");
                    $insert_image->execute([$product_id, $path]);
                }
                // echo '<script>alert("Thêm sản phẩm thành công"); </script>';
                // header('Location: admin_product.php');
                $_SESSION['message'] = 'Sản phẩm mới đã được thêm!';
                header('Location:admin_product.php');
            }
        }
    }
}

?>

<body style="background-color: #e1dede">
    <div class="form p-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <form id="signupForm" action="add_product.php" method="post" enctype="multipart/form-data">
                    <div>
                        <h2 class="text-center">Thêm sản phẩm</h2>
                        <hr>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for=""><b>Tên sản phẩm</b></label>
                        <input type="text" for="name" required class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for=""><b>Mô tả</b></label>
                        <textarea type="text" for="describe" required class="form-control" name="describe" id="describe" placeholder="Nhập mô tả "></textarea>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for=""><b>Giá</b></label>
                        <input type="text" for="price" required class="form-control" name="price" id="price" placeholder="Nhập giá sản phẩm ">
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for=""><b>Giảm giá</b></label>
                        <input type="text" for="discount" required class="form-control" name="discount" id="discount" placeholder="Nhập giảm giá ">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Danh mục</b></label>

                        <div class="form-group">
                            <select name="category_id" class="form-control" required>
                                <option value="" selected disabled>Select category</option>
                                <?php
                                $category = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($category as $categorys) {
                                    echo "<option value='{$categorys['id']}'>{$categorys['cname']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group mt-4 mb-4">
                            <label for=""><b>Ảnh sản phẩm</b></label>
                            <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <label for=""><b>Ảnh Mô tả</b></label>
                            <input type="file" name="images[]" multiple="multiple" required class="box" accept="image/jpg, image/jpeg, image/png">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 col-sm-4 col-12"></div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <a href="admin_product.php" class="text-decoration-none d-flex justify-content-end">
                                    <button type="button" class="btn btn-light form-control btn-fb">Đóng</button></a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <a href="admin_product.php" class="text-decoration-none d-flex justify-content-end">
                                    <button name="registerbtn" type="submit" class="btn btn-primary form-control btn-fb">Thêm</button>
                                </a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>