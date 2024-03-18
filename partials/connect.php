<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=ct271', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Không thể kết nối đến CSDL'.$e->getMessage();
}
