<body>
    <!-- header #2b80dd -->
    <?php
    include '../../partials/heading.php';
    ?>
    <!-- end-header -->

    <!-- menu -->
    <div class="container">
        <!-- Lọc sản phẩm theo giá -->
        <div class=" row">
            <div class="col-md-10"></div>
            <div class="col-md-2 d-flex justify-content-end align-items-center">
                <form method="get" action="filtered_product.php" class="w-100">
                    <div class="d-flex ">
                        <select class="form-select form-select-sm" name="priceRange" id="priceRange" aria-label="Large select example">
                            <option value="10000000-15000000">10.000.000đ - 15.000.000đ</option>
                            <option value="15000000-20000000">15.000.000đ - 20.000.000đ</option>
                            <option value="20000000-50000000">Trên 20.000.000đ</option>
                        </select>

                        <button type="submit" style="background-color: #2b5875;" class=" mx-1 btns text-white rounded border-0"><i class="fa-solid fa-filter"></i></button>
                    </div>
                </form>
            </div>


        </div>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                <div class="list-group ">
                    <a style="background-color: #2b5875;" href="#" class="list-group-item list-group-item-action active p-4" aria-current="true">
                        <i class="fa fa-bars fs-2" aria-hidden="true"> </i>  <b class="fs-5">Danh mục sản phẩm</b>
                    </a>

                    <?php
                    $show_user = $pdo->prepare("SELECT * FROM `category`");
                    $show_user->execute();
                    if ($show_user->rowCount() > 0) {
                        while ($fetch_user = $show_user->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                            <a href="#scrollspyHeading1" class="list-group-item list-group-item-action fs-5"><?= $fetch_user['cname']; ?></a>
                    <?php
                        }
                    }
                    ?>

                    <!-- <a href="#scrollspyHeading1" class="list-group-item list-group-item-action fs-5">Bán chạy</a>
                    <a href="#scrollspyHeading2" class="list-group-item list-group-item-action  fs-5">Cao cấp - Sang trọng</a>
                    <a href="#scrollspyHeading3" class="list-group-item list-group-item-action fs-5">Học tập - Văn phòng</a>
                    <a href="#scrollspyHeading4" class="list-group-item list-group-item-action fs-5">Đồ họa - Kỹ thuật</a>
                    <a href="#scrollspyHeading5" class="list-group-item list-group-item-action fs-5">Gaming</a> -->
                </div>
            </div>
            <!--End-menu -->
            <!-- advertise -->
            <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../image/advertisement/img1.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/advertisement/img2.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/advertisement/img3.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/advertisement/img4.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/advertisement/img5.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/advertisement/img6.jpg" class="d-block w-100" alt="">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- advertise_end -->
        <!-- label -->
        <div class="cate-list my-3">
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="category-icon">
                                <img src="../image/logo/1.png" alt="" class="img-fluid img_size ">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/2.png" alt="" class="img-fluid img_size">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/3.png" alt="" class="img-fluid img_size ">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/4.png" alt="" class="img-fluid img_size">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/5.png" alt="" class="img-fluid img_size">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/6.png" alt="" class="img-fluid img_size">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/7.png" alt="" class="img-fluid img_size">
                            </div>
                        </div>
                        <div class="item ">
                            <div class="category-icon">
                                <img src="../image/logo/8.png" alt="" class="img-fluid img_size">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-label -->
        <!-- product -->

        <?php
        require_once __DIR__ . '/../../partials/connect.php';
        // Truy vấn dữ liệu
        $stmt = $pdo->query('SELECT *, FORMAT(price, 0) as formatted_price FROM products WHERE category_id = 1');
        $imgstm = $pdo->prepare('SELECT img FROM `category` WHERE id=1');
        $imgstm->execute();
        $img = $imgstm->fetch();
        ?>
        <!-- top10 -->
        <div class="card border-0 mt-5 " id="scrollspyHeading1">
            <img src="../admin/upload/icon/<?php echo $img['img'] ?>" alt="">
            <div class="card-body " style="background-color: #216fa4;">
                <div class="cate-list my-3">
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme">
                                <?php
                                while ($row = $stmt->fetch()) {
                                ?>
                                    <div class="item">
                                        <div class="category-icon">
                                            <div class="card border-0 p-2 detail-product frame-hv">
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
                                                <li><a href=""><?php echo $row['formatted_price'] ?></a><sup>đ </sup><span><?php echo "-" .  $row['discount'] ?>%</span></li>
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
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- top10-end -->
        <!-- Cao cấp - Sang trọng -->
        <?php
        // include '../partials/connect.php';
        // Truy vấn dữ liệu
        $stmt = $pdo->query('SELECT *, FORMAT(price, 0) as formatted_price FROM products WHERE category_id = 2');
        $imgstm = $pdo->prepare('SELECT img FROM `category` WHERE id=2');
        $imgstm->execute();
        $img = $imgstm->fetch();
        ?>
        <div class="card border-0  mt-5" id="scrollspyHeading2">
            <img src="../admin/upload/icon/<?php echo $img['img'] ?>" alt="">
            <div class="card-body bg-light">
                <div class="cate-list my-3">
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme">
                                <?php
                                while ($row = $stmt->fetch()) {
                                ?>
                                    <div class="item">
                                        <div class="category-icon">
                                            <div class="card border-0 p-2 detail-product frame-hv">
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
                                                <li><a href=""><?php echo $row['formatted_price'] ?></a><sup>đ </sup><span><?php echo "-" .  $row['discount'] ?>%</span></li>
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
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Cao cấp-end -->
        <!--văn phòng -->
        <?php
        // Truy vấn dữ liệu
        $stmt = $pdo->query('SELECT *, FORMAT(price, 0) as formatted_price FROM products WHERE category_id = 3');
        $imgstm = $pdo->prepare('SELECT img FROM `category` WHERE id=3');
        $imgstm->execute();
        $img = $imgstm->fetch();
        ?>
        <div class="card border-0  mt-5" id="scrollspyHeading3">
            <img src="../admin/upload/icon/<?php echo $img['img'] ?>" alt="">
            <div class="card-body bg-light">
                <div class="cate-list my-3">
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme">
                                <?php
                                while ($row = $stmt->fetch()) {
                                ?>
                                    <div class="item">
                                        <div class="category-icon">
                                            <div class="card border-0 p-2 detail-product frame-hv">
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
                                                <li><a href=""><?php echo $row['formatted_price'] ?></a><sup>đ </sup><span><?php echo "-" .  $row['discount'] ?>%</span></li>
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
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end_Sinhviên -->
            <!-- Đồ họa - Kỹ thuật -->
            <?php
            // Truy vấn dữ liệu
            $stmt = $pdo->query('SELECT *, FORMAT(price, 0) as formatted_price FROM products WHERE category_id = 4');
            $imgstm = $pdo->prepare('SELECT img FROM `category` WHERE id=4');
            $imgstm->execute();
            $img = $imgstm->fetch();
            ?>
            <div class="card border-0  mt-5" id="scrollspyHeading4">
                <img src="../admin/upload/icon/<?php echo $img['img'] ?>" alt="">
                <div class="card-body bg-light">
                    <div class="cate-list my-3">
                        <div class="row">
                            <div class="large-12 columns">
                                <div class="owl-carousel owl-theme">
                                    <?php
                                    while ($row = $stmt->fetch()) {
                                    ?>
                                        <div class="item">
                                            <div class="category-icon">
                                                <div class="card border-0 p-2 detail-product frame-hv">
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
                                                    <li><a href=""><?php echo $row['formatted_price'] ?></a><sup>đ </sup><span><?php echo "-" .  $row['discount'] ?>%</span></li>
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
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- End-Đồ họa - Kỹ thuật -->
            <!-- Gaming -->
            <?php
            // Truy vấn dữ liệu
            $stmt = $pdo->query('SELECT *, FORMAT(price, 0) as formatted_price FROM products WHERE category_id = 5');
            $imgstm = $pdo->prepare('SELECT img FROM `category` WHERE id=5');
            $imgstm->execute();
            $img = $imgstm->fetch();
            ?>
            <div class="card border-0 mt-5" id="scrollspyHeading5">
                <img src="../admin/upload/icon/<?php echo $img['img'] ?>" alt="">
                <div class="card-body bg-light">
                    <div class="cate-list my-3">
                        <div class="row">
                            <div class="large-12 columns">
                                <div class="owl-carousel owl-theme">
                                    <?php
                                    while ($row = $stmt->fetch()) {
                                    ?>
                                        <div class="item">
                                            <div class="category-icon">
                                                <div class="card border-0 p-2 detail-product frame-hv">
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
                                                    <li><a href=""><?php echo $row['formatted_price'] ?></a><sup>đ </sup><span><?php echo "-" .  $row['discount'] ?>%</span></li>
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
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End-Gaming -->

            <!-- product_end -->

        </div>
    </div>

    <?php include '../../partials/footer.php' ?>