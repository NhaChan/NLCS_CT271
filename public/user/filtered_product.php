<?php
include '../../partials/connect.php';
    $priceRange = isset($_GET['priceRange']) ? $_GET['priceRange'] : null;

    // Tách giá trị thành khoảng giá tối thiểu và tối đa
    $minPrice = null;
    $maxPrice = null;
    
    if ($priceRange) {
        list($minRange, $maxRange) = explode('-', $priceRange);
        $minPrice = intval($minRange);
        $maxPrice = $maxRange ? intval($maxRange) : null;
    }
    
    // Truy vấn dữ liệu với bộ lọc giá
    $sql = 'SELECT *, FORMAT(price, 0) as formatted_price FROM products';
    
    // Áp dụng bộ lọc nếu có giá trị
    if ($minPrice !== null && $maxPrice !== null) {
        $sql .= " WHERE price BETWEEN $minPrice AND $maxPrice";
    }
    
    $stmt = $pdo->query($sql);
    
    // Lưu kết quả lọc vào session để sử dụng trên trang kết quả
    session_start();
    $_SESSION['filteredProducts'] = $stmt->fetchAll();
    header('Location: result_page.php');
    exit();

?>