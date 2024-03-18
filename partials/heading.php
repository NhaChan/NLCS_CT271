<?php

session_start();
include 'header.php';
require_once __DIR__ . '/connect.php';

if (isset($_SESSION['id'])) {
    $stm = $pdo->prepare("SELECT * FROM `user` WHERE id=?");
    $stm->execute([$_SESSION['id']]);
    if ($stm->rowCount() == 0) {
        session_destroy();

        // Chuyển hướng đến trang đăng nhập
        header('Location: index.php');
        exit();
    }
}

?>

<div class="mb-2" style="background-color:#2b5875;">
    <div class="container-fluid">
        <div class="row navbar-header">
            <div class="col-md-4 col-4 d-flex justify-content-center">
                <a href="../../user/index.php"><img src="../image/logolapstore.png" style="width:150px; height:150px" alt="logo"></a>
            </div>
            <div class="col-md-4 col-4 d-flex align-self-center">
                <div class="input-group">
                    <form action="search.php" method="GET" class="input-group ">
                        <input type="text" name="keywords" class="form-control" placeholder="Từ khóa tìm kiếm" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button style="background-color: #2b5875;" class="input-group-text rounded-0" id="basic-addon2" type="submit">
                                <i class="fs-4 fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-4 d-flex justify-content-center align-self-center">
                <div class="d-flex align-items-center">
                    <!-- && isset($_SESSION['role']) && $_SESSION['role'] != 1 -->
                    <?php

                    $htmlspecialchars = 'htmlspecialchars';
                    if (isset($_SESSION['HoTen'])) {
                        echo "<div class='dropdown'>
                                <a class='btn text-white' href='#' role='button' data-bs-toggle='dropdown'>
                                    <i class='fa-solid fa-user'></i><span> {$htmlspecialchars($_SESSION['HoTen'])} </span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item' href='profile.php'>Thông tin</a></li>
                                    <li><a class='dropdown-item' href='order_status.php'>Đơn hàng của bạn</a></li>
                                    <li><a id='logout' class='dropdown-item' href='logout.php'>Đăng xuất</a></li>
                                </ul>
                                </div>";


                        // echo '<a href="logout.php">' . $_SESSION["HoTen"] . '</a>';
                    } else {
                        // Nếu chưa đăng nhập, hiển thị chữ Đăng nhập và liên kết đến trang đăng nhập
                        echo "<a class='text-white' href='login.php'>Đăng nhập</a>";
                    }
                    ?>

                    <a class="fa-2x mx-4" href="cart.php"><i id="countPD" class="fa-solid fa-cart-shopping text-white">

                        </i>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const uid = `<?= $_SESSION['id']; ?>`;
    const products = JSON.parse(localStorage.getItem(uid));
    var count = 0;
    if (products && products.length > 0) {
        count = products.length;
    }
    if (count > 0) {
        document.getElementById('countPD').innerHTML =
            `<span  class="position-absolute right-10 top-10 fs-6 translate-middle badge rounded-pill bg-danger">
            ${count}    
            <span class="visually-hidden">unread messages</span>
        </span>`
    }
</script>