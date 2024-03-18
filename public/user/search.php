 <?php
    include '../../partials/heading.php';

    require_once __DIR__ . '/../../partials/connect.php';
    // Retrieve search keywords from the form
    $keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :keywords");
    $stmt->bindValue(':keywords', '%' . $keywords . '%');
    $stmt->execute();
    ?>

 <div class="container mb-5">
    <h1 class="text-center text-success p-3">Kết quả tìm kiếm</h1>
     <div class="row card-body">

         <?php
            while ($row = $stmt->fetch()) {
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
            ?>


     </div>
 </div>

 <?php include '../../partials/footer.php' ?>