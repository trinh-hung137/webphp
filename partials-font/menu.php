<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodOrder</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<!-- header section starts      -->

<header>

    <a href="#" class="logo"><i class="fas fa-utensils"></i>FoodOrder</a>

    <nav class="navbar">
        <a href="<?php echo SITEURL; ?>">Trang Chủ</a>
        <a href="<?php echo SITEURL; ?>categories.php">Danh Mục</a>
        <a href="<?php echo SITEURL; ?>foods.php">Thực Đơn</a>       
        <a href="<?php echo SITEURL; ?>about.php">Cửa Hàng</a>       
    </nav>
    <div style="text-align: right;">
    <form  action="<?php echo SITEURL; ?>food-search.php" method="POST" >
        <input type="search" name="search" placeholder="Nhập món ăn hoặc mô tả" required >
        <input type="submit" name="submit" value="Tìm" class="btn">
    </form>
    </div> 
</header>

<!-- header section ends-->


