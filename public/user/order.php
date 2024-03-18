<?php include '../../partials/heading.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['0']) && !empty($_POST['price0']) && !empty($_POST['quanlity0']) && !empty($_POST['pname0']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['paid'])) {
        require_once __DIR__ . '/../../partials/connect.php';

        if (!$pdo) {
            die('Không thể kết nối đến cơ sở dữ liệu');
        }

        //product_detail
        $pid = $_SESSION['id'];
        $i = 0;
        while (isset($_POST[$i])) {
            $pdids[$i] = $_POST[$i];
            $prices[$i] = $_POST['price' . $i];
            $quanlities[$i] = $_POST['quanlity' . $i];
            $pname[$i] = $_POST['pname' . $i]; //
            $i++;
        }

        //order
        $datetime = date('Y-m-d H:i:s');
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $paid = $_POST['paid'];
        $status = 1;

        $query1 = 'INSERT INTO orders (uid, address, phone, paid, status, date) VALUES (?,?,?,?,?,?)';
        $query2 = 'INSERT INTO product_detail (oid, pid, pdid, price, quanlity, pname) VALUES (?,?,?,?,?,?)'; //

        try {
            $stm_order = $pdo->prepare($query1);
            $stm_order->execute([$pid, $address, $phone, $paid, $status, $datetime]);
            $stm_oid = $pdo->prepare("  SELECT * FROM orders WHERE uid = ?");
            $stm_oid->execute([$pid]);
            $oid = $stm_oid->fetchAll();
            $length = count($pdids);
            $stm_pd = $pdo->prepare($query2);
            for ($i = 0; $i < $length; $i++) {
                $stm_pd->execute([$oid[count($oid) - 1]['id'], $pid, $pdids[$i], $prices[$i], $quanlities[$i], $pname[$i]]); //
            }



            if ($stm_pd && $stm_pd->rowCount() == 1 && $stm_order && $stm_order->rowCount() == 1) {
                echo '<script>alert("Đặt hàng thành công!"); </script>';
                header('Location: order_status.php');
            } else {
                echo '<script>alert("Không hợp lệ"); </script>';
            }
        } catch (PDOException $e) {
            echo '<script>alert("Đã xảy ra lỗi: ' . $e->getMessage() . '"); </script>';
        }
    }
}


?>

<body style="background-color: #e1dede">
    <div class="form p-4 w-75">
        <div class="container">
            <h2 class="text-center">
                THÔNG TIN ĐƠN ĐẶT HÀNG
            </h2>
            <form class="border border-3 border-primary p-4 rounded" id="signupForm" action="order.php" method="POST">
                <div class="d-flex gap-5 mt-4">
                    <div class="form-group">
                        <label for="name"><b>Tên người đặt hàng</b></label>
                        <input type="text" for="name" class="form-control" name="name" id="name" readonly value="<?= $_SESSION['HoTen'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone"><b>Số điện thoại</b></label>
                        <input type="text" for="phone" class="form-control" name="phone" id="phone" required>
                    </div>
                </div>

                <div class="form-group mt-4 mb-4 border-bottom pb-4 border-primary">
                    <label for="address"><b>Địa chỉ giao hàng</b></label>
                    <input type="text" for="address" class="form-control" name="address" id="address" required>
                </div>

                <div class="form-group mt-4 mb-4">
                    <b>Thông tin sản phẩm</b>
                    <div class="row" id="products"></div>
                </div>
                <div class="form-group mt-4 mb-4 border-top pb-4 border-primary">
                    <label for="paid"><b>Phương thức thanh toán</b></label>
                    <input type="text" for="paid" class="form-control" name="paid" readonly id="paid" value="Tiền mặt">
                </div>
                <div class="form-group mt-4 mb-4" id="total"></div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-4 col-12"></div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <a href="cart.php" class="text-decoration-none d-flex justify-content-end">
                            <button type="button" class="btn btn-danger form-control btn-fb">HỦY</button></a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <a href="#" class="text-decoration-none d-flex justify-content-end">
                            <button type="submit" class="btn btn-success form-control btn-fb" onclick="orderedFunc()">ĐẶT HÀNG</button>
                        </a>
                    </div>

            </form>

        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
        const name = `<?= $_SESSION['id']; ?>`;
        const product = JSON.parse(localStorage.getItem(name));
        const order = JSON.parse(localStorage.getItem(`order${name}`));
        // console.log(order);
        const pd = document.getElementById('products');
        var total = 0;

        const delFunc = (pid, price) => {
            // console.log(pid, price);
            product.forEach((e, i) => {
                if (e.pid == pid && e.price == price) {
                    let spliced = product.splice(i, 1);
                    localStorage.setItem(name, JSON.stringify(product));
                    document.location.reload();
                }
            })
        }


        if (order && order.length > 0) {
            order.forEach((e, i) => {
                delFunc(e.pid, e.price);

                total += e.price * e.quanlity;
                const div = document.createElement('div');

                div.setAttribute('class', 'd-flex flex-row');
                div.setAttribute('name', `pd${e.pid}`);

                div.innerHTML = `<img src='../admin/upload/product_detail/${e.img}' alt="pd" class="w-25">
                        <input hidden type="text" class="form-control" name="${i}"  value='${e.pid}'>
                        <div class="col-6 mx-1 mt-4">
                        <label for="name${i}">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name${i}" readonly name="pname${i}" value='${e.pname}'>
                        </div>
                        <div class="col-1 mx-1 mt-4">
                        <label for="quanlity${i}">Số lượng</label>
                        <input type="text" class="form-control" id="quanlity${i}" readonly name="quanlity${i}" value=${e.quanlity}>
                        </div>
                        <div class="col-2 mt-4">
                        <label for="price${i}">Giá</label>
                        <input type="text" class="form-control" id="price${i}" readonly name="price${i}" value=${e.price}>
                        </div>`;
                pd.append(div);
            })
        }

        document.getElementById('total').innerHTML = `<label for="total"><b>Thanh toán</b></label>
                    <input type="total" for="total" class="form-control" readonly name="total" value='${total}'>`;

        const orderedFunc = () => {
            localStorage.removeItem(`order${name}`);
        }
    </script>
</body>

</html>