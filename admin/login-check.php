<?php
    if(!isset($_SESSION['user']))
    {
        // người dùng chưa đăng nhập
        // chuyển hướng sang trang login với thông báo
        $_SESSION['no-login-message']="Đăng nhập để truy cập bảng quản trị";
        // đến trang login
        header('location:'.SITEURL.'admin/login.php');
    }  
?>