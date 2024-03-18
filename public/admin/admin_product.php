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



$show_product = $pdo->query('SELECT * FROM products');
$show_product->execute();
if (isset($_POST['delete-product'])) {
    $product_id = $_POST['product_id'];

    $select_images = $pdo->prepare("SELECT * FROM products , product_images WHERE products.id = product_images.product_id 
    AND products.id = ?");

    $select_images->execute([$product_id]);
    $images = $select_images->fetchAll(PDO::FETCH_ASSOC);

    foreach ($images as $image) {
        $detail_image_path = '../admin/upload/product_detail/' . $image['images'];
        $product_image_path = '../admin/upload/top10laptop/' . $image['image'];


        if (file_exists($product_image_path)) {
            unlink($product_image_path);
        }

        if (file_exists($detail_image_path)) {
            unlink($detail_image_path);
        }
    }


    // Delete associated images from the product_images table
    $delete_product_images = $pdo->prepare("DELETE FROM product_images WHERE product_id = ?");
    $delete_product_images->execute([$product_id]);

    // Delete the product from the products table
    $delete_product = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $delete_product->execute([$product_id]);

    echo "<script> location.replace('admin_product.php');
        alert('Xóa sản phẩm thành công!'); </script>";
    $_SESSION['message'] = 'Sản phẩm đã được xóa';
}
?>



<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý sản phẩm</h1>
    <?php if (isset($_SESSION['message'])):  ?>
        <div class="text-success mt-3">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>

    <!-- Button trigger modal -->
    <a href="add_product.php"><button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addadminprofile">
            + Thêm sản phẩm
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
                            <th>Tên sản phẩm</th>
                            <th>Mô Tả</th>
                            <th>Giá</th>
                            <th>Giảm Giá</th>
                            <th>Danh mục</th>
                            <th>Hình ảnh</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    if ($show_product->rowCount() > 0) {
                        while ($fetch_product = $show_product->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $htmlspecialchars($fetch_product['name']) ?></td>
                                    <td><?= $htmlspecialchars($fetch_product['describe']) ?></td>
                                    <td><?= $fetch_product['price'] ?></td>
                                    <td><?= $fetch_product['discount'] ?></td>
                                    <td><?= $fetch_product['category_id'] ?></td>
                                    <td><?= '<img src="../admin/upload/top10laptop/' . $fetch_product['image'] . '" width="150px;" height="100px"; alt="">' ?> </td>
                                    <td class="justify-content-center">
                                        <a href="edit_product.php?update_product=<?= $fetch_product['id']; ?>" class="btn btn-xs btn-warning">
                                            Edit</a>
                                    </td>

                                    <td class="justify-content-center">
                                        <form class="form-inline ml-1" action="admin_product.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                                            <button type="submit" class="btn btn-xs btn-danger" name="delete-product">
                                                <i alt="Delete" class="fa fa-trash"></i>
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
                <h4 class="modal-title">Xác nhận xóa</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">Bạn có chắc chắn muốn xóa dòng này?</div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->


<?php
include './includes/scripts.php';
?>
<!-- <script>
        $(document).ready(function() {
            $('button[name="delete-product"]').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td:first');
                if ( nameTd && nameTd.length > 0) {
                    $('.modal-body').html(
                        `Bạn có chắc chắn muốn xóa "${nameTd.text()}"?`
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
    </script> -->