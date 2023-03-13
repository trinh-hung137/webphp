<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="heading">Đăng nhập</h1>
        <br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br>
            <!-- form đăng nhập -->
        <form action="" method="POST">
            Tên đăng nhập: <br>
            <input type="text" name="username" placeholder="Nhập tên đăng nhập"> <br>
            <br>
            Mật khẩu: <br>
            <input type="password" name="password" placeholder="Nhập mật khẩu"> <br>
            <br>
            <input type="submit" name="submit" value="Đăng nhập" class="btn">
        </form>
            <!-- form đăng nhập -->
        </div>
    </body>
</html>

<?php
    //kiểm tra nút đăng nhập có được click
    if(isset($_POST['submit']))
    {
        //   b1. Lấy dliệu từ form đăng nhập
        $username = $_POST['username'];
        $password = $_POST['password'];

        //b2. tạo câu truy vấn
        $sql = "SELECT * FROM tb_admin WHERE username= '$username' AND password = '$password'";
        // b3. thực hiện truy vấn
        $res=mysqli_query($conn, $sql);

        //b4. kiểm tra tên và mkhẩu có khớp trong csdl không
        $count = mysqli_num_rows($res); // biến đếm gtrị hàng trong bảng trùng với dliệu nhập vào
        if($count==1) //dliệu khớp
        {
            // tkhoản quản trị tồn tại
            $_SESSION['login'] = "Đăng nhập thành công";
            $_SESSION['user'] = $username;
            // chuyển hướng trang chủ
            header("location:".SITEURL.'admin/index.php');
        }
        else //dliệu không khớp
        {
            // tkhoản quản trị k tồn tại
            $_SESSION['login'] = "Tên đăng nhập và mật khẩu không khớp";
            // chuyển hướng trang chủ
            header("location:".SITEURL.'admin/login.php');
        }
    }


?>
