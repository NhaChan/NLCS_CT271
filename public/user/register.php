<?php include '../../partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        require_once __DIR__ . '/../../partials/connect.php';

        if (!$pdo) {
            die('Không thể kết nối đến cơ sở dữ liệu');
        }
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $query = 'INSERT INTO user (name, address, phone, email, password) VALUES (?,?,?,?,?)';

        try {
            $stm = $pdo->prepare($query);
            $stm->execute([$name, $address, $phone, $email, $password]);

            if ($stm && $stm->rowCount() == 1) {
                echo '<script>alert("Đăng ký thành công!"); </script>';
                header('Location: login.php');
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
    <div class="form p-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-sm-6 col-xs-6 col-6 justify-content-start">
                    <a href="#" class="fs-4 text-black text-decoration-none"><b>Đăng ký </b></a>
                </div>
                <div class="col-sm-6 col-xs-6 col-6 text-end justify-content-end ">
                    <a href="login.php" class="text-danger text-decoration-none">Đăng nhập</a>
                </div>
            </div>

            <form id="signupForm" action="register.php" method="POST">
                <div class="form-group mt-4 mb-4">
                    <input type="text" for="name" class="form-control" name="name" id="name" placeholder="Nhập họ tên của bạn">
                </div>
                <div class="form-group mt-4 mb-4">
                    <input type="text" for="address" class="form-control" name="address" id="address" placeholder="Nhập vào địa chỉ của bạn">
                </div>
                <div class="form-group mt-4 mb-4">
                    <input type="text" for="phone" class="form-control" name="phone" id="phone" placeholder="Nhập vào số diện thoại của bạn">
                </div>
                <div class="form-group mt-4 mb-4">
                    <input type="email" for="email" class="form-control" name="email" id="email" placeholder="Nhập vào Email của bạn">
                </div>
                <div class="form-group mt-4 mb-4">
                    <input type="password" for="password" class="form-control" name="password" id="password" placeholder="Nhập vào mật khẩu của bạn">
                </div>
                <div class="form-group mt-4 mb-4">
                    <input type="password" for="confirm_password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu của bạn">
                </div>
                <div>
                    <p class="text-center" style="font-size: 0.8rem;">Bằng việc đăng kí, bạn đồng ý với quy định về
                        <a href="" class="text-danger text-decoration-none">Điều khoản dịch vụ </a>&
                        <a href="" class="text-danger text-decoration-none">Chính sách bảo mật</a>
                    </p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-4 col-12"></div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <a href="index.php" class="text-decoration-none d-flex justify-content-end">
                            <button type="button" class="btn btn-light form-control btn-fb">TRỞ LẠI</button></a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <a href="#" class="text-decoration-none d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger form-control btn-fb">ĐĂNG KÝ</button>
                        </a>
                    </div>
            </form>

        </div>
        <div class="row bg-light p-3">
            <div class="col-sm-6 col-xs-6 col-6">
                <a href="" class="btn btn-fb " style="background-color: #3A5A98;">
                    <i class="fab fa-facebook-square text-white fs-4"></i>
                    <span class="text-white ms-3">
                        Kết nối Facebook
                    </span>
                </a>
            </div>
            <div class="col-sm-6 col-xs-6 col-6">
                <a href="" class="btn btn-fb" style="background-color: #fff;">
                    <i class="fab fa-google fs-4"></i>
                    <span class="ms-3">
                        Kết nối Google
                    </span>
                </a>
            </div>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#signupForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    },
                    address: {
                        required: true,
                        minlength: 5
                    },
                    phone: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: '#password',
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    agree: 'required',
                },
                messages: {
                    name: {
                        required: 'Bạn chưa nhập vào tên đăng nhập',
                        minlength: 'Tên đăng nhập phải có ít nhất 5 ký tự',
                    },
                    address: {
                        required: 'Bạn chưa nhập địa chỉ',
                        minlength: 'Địa chỉ phải có ít nhất 5 ký tự',
                    },
                    phone: {
                        required: 'Bạn chưa nhập số điện thoại',
                    },
                    password: {
                        required: 'Bạn chưa nhập mật khẩu',
                        minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
                    },
                    confirm_password: {
                        required: 'Bạn chưa nhập mật khẩu',
                        minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
                        equalTo: 'Mật khải không trùng khớp với mật khẩu đã nhập',
                    },
                    email: 'Hộp thư điện tử không hợp lệ',
                    agree: 'Bạn phải đồng ý với các quy định của chúng tôi',
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.prop('type') === 'checkbox') {
                        error.insertAfter(element.siblings('label'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element)
                        .addClass('is-invalid')
                        .removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element)
                        .addClass('is-valid')
                        .removeClass('is-invalid');
                },
            });
        });
    </script>
</body>

</html>