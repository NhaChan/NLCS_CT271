<?php
// Bắt đầu session
session_start();

// Hủy session và đăng xuất người dùng
session_destroy();

// Chuyển hướng đến trang đăng nhập
header('Location: login.php');
exit();
?>

