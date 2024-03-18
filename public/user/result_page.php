<?php

include '../../partials/heading.php';
require_once __DIR__ . '/../../partials/connect.php';

// Lấy kết quả lọc từ session
$filteredProducts = isset($_SESSION['filteredProducts']) ? $_SESSION['filteredProducts'] : null;

// Kiểm tra xem có kết quả lọc hay không
if ($filteredProducts) {

    ?>
     <div class="container mb-5">
    <h1 class="text-center text-success p-3">Kết quả tìm kiếm</h1>
     <div class="row card-body">
        <?php
    foreach ($filteredProducts as $row) {
?>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-5">
        <div class="item">
            <div class="category-icon">
                <div class="card p-2 detail-product frame-hv pointer border-1">
                    <li>
                        <a href="product_detail.php?id= <?php echo $row['id'] ?>">
                            <img src="../admin/upload/top10laptop/<?php echo $row['image'] ?>" class="card-img-top img-hv" alt="...">
                        </a>
                    </li>
                    <li class="advertise">
                        <img style="width: 20px; height: 20px;" src="../image/title.png" alt="">
                        <p>HSSV Giảm 500k</p>
                    </li>
                    <li>
                        <button type="button" class="btn btn-light">8 GB</button>
                        <button type="button" class="btn btn-light">SSD512 GB</button>
                    </li>
                    <li><?php echo $row['name'] ?></li>
                    <li><a href=""><?php echo $row['price'] ?></a><sup>đ </sup><span><?php echo "-" .  $row['discount'] ?>%</span></li>
                    <?php
                       $current_price = $row['price'] - ($row['price'] * $row['discount'] / 100);
                       ?>
                    <li><?php echo number_format($current_price, 0, ',', '.') ?><sup>đ</sup></li>
                    <li>Quà: <b>400.000</b><sup>đ</sup></li>
                    <div class="card-footer text-center bg-warning-subtle border-0 text-warning ">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php
    }
} else {
    ?>
    <h1 class="text-center text-danger p-3">Không tìm thấy sản phẩm nào</h1>
<?php
}
// Xóa kết quả lọc từ session để tránh hiển thị trang này mỗi khi truy cập
unset($_SESSION['filteredProducts']);
?>
     </div>
     </div>