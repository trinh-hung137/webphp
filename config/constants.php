<?php 
    //start Session
    session_start();

    //tạo các biến có giá trị k đổi
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($result));//kết nối data
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($result)); // lựa chọn data


    
?>