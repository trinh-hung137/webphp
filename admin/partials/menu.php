<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>

<html>
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <!-- header section starts      -->
    <div class="menu">      
        <nav class="wrapper">
            <a href="index.php">Trang chủ</a>
            <a href="manage-category.php">Danh mục</a>       
            <a href="manage-food.php">Thực đơn</a>
            <a href="manage-order.php">Đơn hàng</a>   
            <a href="logout.php">Đăng xuất</a>
        </nav>
    </div>
    <!-- header section ends      -->