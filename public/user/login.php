<?php include '../../partials/header.php';

include '../../partials/connect.php';

if (isset($_POST['login'])) {


    $username = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE email='$username' AND password='$password'";
    $stm = $pdo->prepare($query);
    $stm->execute();

    $user = $stm->fetch();

    if ($user) {
        session_start();
        
        $_SESSION['avt'] = $user['image'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['email'] = $user['email'];

        if ($user['role'] == 1){
            $_SESSION['adid'] = $user['id'];
            $_SESSION['admin'] = $user['name'];
            header('Location: /admin/index.php');
        }
        else {
            $_SESSION['id'] = $user['id'];
            $_SESSION['HoTen'] = $user['name'];
            header('Location: index.php');
        }
    } else
        echo '<script>alert("Tài khoản không tồn tại"); </script>';
}

?>

<body style="background-color: #e1dede">
    <div class="form p-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-sm-6 col-xs-6 col-6 justify-content-start">
                    <a href="#" class="fs-4 text-black text-decoration-none"><b>Đăng nhập</b></a>
                </div>
                <div class="col-sm-6 col-xs-6 col-6 text-end justify-content-end ">
                    <a href="register.php" class="text-danger text-decoration-none">Đăng ký</a>
                </div>
            </div>
            <form id="signupForm" action="login.php" method="POST">
                <div class="form-group mt-4 mb-4">
                    <input type="email" for="email" class="form-control" name="email" id="email" placeholder="Nhập vào Email của bạn">
                </div>
                <div class="form-group mb-4">
                    <input type="password" for="password" class="form-control" required type="password" name="password" placeholder="Nhập vào mật khẩu của bạn">
                </div>

                <div class="row mb-4">
                    <div class="col-sm-8 col-xs-8 col-12">
                        <a href="#" class="text-danger text-decoration-none d-flex justify-content-end">Quên mật khẩu</a>
                    </div>
                    <div class="col-sm-4 col-xs-4 col-12">
                        <a href="#" class="text-decoration-none text-black-50 d-flex justify-content-end">Cần trợ giúp?</a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-4 col-12"></div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <a href="index.php" class="text-decoration-none d-flex justify-content-end">
                            <button type="button" class="btn btn-light form-control btn-fb">TRỞ LẠI</button></a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <a href="#" class="text-decoration-none d-flex justify-content-end">
                            <button name="login" type="submit" class="btn btn-danger form-control btn-fb">ĐĂNG NHẬP</button>
                        </a>
                    </div>
                </div>
            </form>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"> </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#signupForm').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    agree: 'required',
                },
                messages: {
                    password: {
                        required: 'Bạn chưa nhập mật khẩu',
                        minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
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