<?php

include '../../partials/connect.php';

session_start();

include '../../partials/header.php';
include './includes/header.php';
// include './includes/navbar.php';




// $admin_id = $_SESSION['admin_id'];

// if(!isset($admin_id)){
//    header('location:login.php');
// };

if (isset($_POST['update_product'])) {
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $description = $_POST['describe'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $discount = $_POST['discount'];
    $discount = filter_var($discount, FILTER_SANITIZE_STRING);
    $category_id = $_POST['category_id'];

    // Cập nhật thông tin trong cơ sở dữ liệu
    $update_product = $pdo->prepare("UPDATE `products` SET name = ?, `describe` = ?, price = ?, discount = ?, category_id=? WHERE id = ?");
    $update_product->execute([$name, $description, $price, $discount, $category_id, $product_id]);

    // Thông báo cho người dùng
    header('Location:admin_product.php');
    $_SESSION['message'] = 'Thông tin sản phẩm đã được cập nhật!';



    // Xử lý hình ảnh chính
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $old_image = $_POST['old_img'];

    if (!empty($file_name)) {

        $update_image = $pdo->prepare("UPDATE `products` SET image = ? WHERE id = ?");
        $update_image->execute([$file_name, $product_id]);

        if ($update_image) {
            move_uploaded_file($file['tmp_name'], '../admin/upload/top10laptop/' . $file_name);
            unlink('../admin/upload/product_detail/' . $old_image);
            // $message[] = 'image updated successfully!';
        }
    }

    // Xử lý hình ảnh phụ
    $files = $_FILES['images'];
    $file_names = $files['name'];



    $image_paths = []; // mảng để lưu đường dẫn file

    foreach ($file_names as $key => $value) {
        if ($files['type'][$key] == 'image/jpeg' || $files['type'][$key] == 'image/jpg' || $files['type'][$key] == 'image/png') {
            $image_path = '../admin/upload/product_detail/' . $value;
            move_uploaded_file($files['tmp_name'][$key], $image_path);
            $image_paths[] = $value; // lưu đường dẫn file
        }
    }

    // Xóa tất cả ảnh mô tả cũ liên quan đến sản phẩm
    if ($image_paths != null) {
        $delete_old_images = $pdo->prepare("DELETE FROM `product_images` WHERE product_id = ?");
        $delete_old_images->execute([$product_id]);

        // Cập nhật đường dẫn của các hình ảnh mới trong cơ sở dữ liệu
        foreach ($image_paths as $path) {
            $insert_image = $pdo->prepare("INSERT INTO `product_images` (product_id, images) VALUES (?, ?)");
            $insert_image->execute([$product_id, $path]);
        }
    }
}

?>

<body style="background-color: #e1dede">
    <div class="form p-2 w-50">
        <div class="container">
            <div class="row d-flex align-items-center">
                <?php
                $update_id = $_GET['update_product'];
                $select_product = $pdo->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_product->execute([$update_id]);


                if ($select_product->rowCount() > 0) {
                    while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form id="signupForm" action="edit_product.php" role="form" method="post" enctype="multipart/form-data">
                            <div>
                                <h1 class="text-center">Sửa sản phẩm</h1>
                                <hr>
                            </div>

                            <div class="row featurette">
                                <div class="col-md-7 order-md-2">
                                    <input type="hidden" name="id" value="<?php echo $fetch_product['id']; ?>">
                                    <div class="form-group mb-4">
                                        <label for=""><b>Tên sản phẩm</b></label>
                                        <input type="text" for="name" class="form-control" id="name" name="name" value="<?php echo $fetch_product['name'] ?>">
                                    </div>
                                    <div class="form-group mt-4 mb-4">
                                        <label for=""><b>Mô tả</b></label>
                                        <textarea type="text" rows="3" for="describe" required class="form-control" name="describe" id="describe" value="<?php echo $fetch_product['describe'] ?>" placeholder="Nhập mô tả "><?php echo $fetch_product['describe'] ?></textarea>
                                    </div>
                                    <div class="form-group mt-4 mb-4">
                                        <label for=""><b>Giá</b></label>
                                        <input type="text" for="price" required class="form-control" name="price" id="price" value="<?php echo $fetch_product['price'] ?>" placeholder="Nhập giá sản phẩm ">
                                    </div>
                                    <div class="form-group mt-4 mb-4">
                                        <label for=""><b>Giảm giá</b></label>
                                        <input type="text" for="discount" required class="form-control" name="discount" id="discount" value="<?php echo $fetch_product['discount'] ?>" placeholder="Nhập giảm giá ">
                                    </div>

                                    <!-- category -->
                                    <?php
                                    $category = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <select name="category_id" class="form-control" required>

                                            <option value="" disabled>Chọn danh mục</option>
                                            <?php
                                            $selected_category = $fetch_product['category_id']; // Lấy danh mục hiện tại của sản phẩm
                                            foreach ($category as $cat) {
                                                $selected = ($cat['id'] == $selected_category) ? 'selected' : ''; // Kiểm tra xem danh mục có phải là danh mục hiện tại không
                                                echo "<option value='{$cat['id']}' $selected>{$cat['cname']}</option>";
                                            }
                                            ?>


                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-5 order-md-1">

                                    <div class=" row form-group mb-4">
                                        <label for=""><b>Ảnh sản phẩm</b></label>
                                        <input type="hidden" name='old_img' value="<?php echo $fetch_product['image'] ?>">
                                        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                                        <img src="../admin/upload/top10laptop/<?= $fetch_product['image']  ?>" max-height="100px" alt="">
                                    </div>
                                    <div class="form-group mt-4 mb-4">
                                        <label for=""><b>Ảnh Mô tả</b></label>
                                        <input type="file" name="images[]" multiple="multiple" class="box" accept="image/jpg, image/jpeg, image/png">
                                        <?php
                                        $product_id = $fetch_product['id'];
                                        $stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ?");
                                        $stmt->execute([$product_id]);
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $image_path = '../admin/upload/product_detail/' . $row['images'];
                                            echo '<img src="' . $image_path . '" width="130px;" height="100px;"  alt="">';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-4 col-12"></div>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <a href="admin_product.php" class="text-decoration-none d-flex justify-content-end">
                                        <button type="button" class="btn btn-light form-control btn-fb">Đóng</button></a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <a href="admin_product.php" class="text-decoration-none d-flex justify-content-end">
                                        <button name="update_product" type="submit" class="btn btn-primary form-control btn-fb">Sửa</button>
                                    </a>
                                </div>
                            </div>
                        </form>
            </div>

    <?php
                    }
                }
    ?>
        </div>
    </div>
    </div>


    <?php
    // include './includes/scripts.php';
    // include './includes/footer.php';
    ?>