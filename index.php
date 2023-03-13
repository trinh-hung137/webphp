<!-- header section starts      -->
<?php include('partials-font/menu.php'); ?>

<!-- header section ends-->
<?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset ($_SESSION['order']);

    }
?>
<!-- home section starts  -->
<div style="margin: 50px;" class="home" id="home">

    <div class="swiper-container home-slider">

        <div class="swiper-wrapper wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Món đặc biệt</span>
                    <h3>Mỳ Ý</h3>
                    <p>Mì Ý là một trong những món ăn cực kỳ nổi tiếng, mang tính biểu tượng của nước Ý và mức độ phổ biến của món ăn này đã lan ra toàn thế giới.</p>
                   
                </div>
                <div class="image">
                    <img src="images/home-img-1.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Món đặc biệt</span>
                    <h3>Gà rán</h3>
                    <p>Những miếng thịt gà được lăn bột rồi chiên ngập dầu, miếng gà có một lớp vỏ ngoài giòn rụm, còn phần thịt bên trong vẫn mềm và mọng nước.</p>
                   
                </div>
                <div class="image">
                    <img src="images/home-img-2.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Món đặc biệt</span>
                    <h3>Pizza</h3>
                    <p>Được làm thủ công vỏ bánh ngon giòn xốp đặc trưng, vị dai nhẹ. Pizza luôn được chế biến từ những nguyên liệu tươi ngon đem đến cho khách hàng một bữa ăn chất lượng.</p>                   
                </div>
                <div class="image">
                    <img src="images/home-img-3.png" alt="">
                </div>
            </div>

        </div>


    </div>

</div>
<!-- home section ends -->

<!-- category section starts      -->
<div style="margin: 50px;" class="food" id="food">

    <h3 class="sub-heading">Danh Mục</h3>
    <h1 class="heading">Thực phẩm đa dạng</h1>

    <div class="box-container">

        <?php
            // tạo truy vấn lấy tất cả dliệu trong bảng phân loại
            $sql= "SELECT * FROM tb_category";
            // thực hiện truy vấn
            $res = mysqli_query($conn, $sql);
            //tạo biến đếm hàng
            $count = mysqli_num_rows($res);
            // kiểm tra dữ liệu có hay không
            if($count>0) // có dữ liệu
            {
                while($row= mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box">
                                <?php
                                    // kiểm tra tên ảnh có dliệu Không 
                                    if($image_name != "")
                                    {
                                        // hiển thị ảnh  
                                        ?>                          
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        // in ra dòng tbáo tên ảnh trống 
                                        echo "Tên ảnh trống";
                                    }       
                                ?>
                                <h3><?php echo $title; ?></h3>
                            </div>
                        </a>                                       
                     <?php
                }
            }
            else
            {
                echo "Danh mục trống";
            }
        ?>
    </div>

</div>
<!-- category section starts      -->

<!-- menu section starts  -->
<div style="margin: 50px;" class="menu" id="menu">

    <h3 class="sub-heading">Menu</h3>
    <h1 class="heading"> Thực đơn hôm nay </h1>

    <div class="box-container">
    <?php
            // tạo truy vấn lấy tất cả dliệu trong bảng phân loại
            $sql1= "SELECT * FROM tb_food";
            // thực hiện truy vấn
            $res1 = mysqli_query($conn, $sql1);
            //tạo biến đếm hàng
            $count1 = mysqli_num_rows($res1);
            // kiểm tra dữ liệu có hay không
            if($count1>0) // có dữ liệu
            {
                while($row= mysqli_fetch_assoc($res1))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description= $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>
                        <div class="box">
                            <div class="image">
                            <?php
                                if($image_name != "")
                                {
                                    // hiển thị ảnh  
                                    ?>                          
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="">
                                    <?php
                                }
                                else
                                {
                                    // in ra dòng tbáo tên ảnh trống 
                                    echo "Tên ảnh trống";
                                }
                            ?>
                            </div>
                            <div class="content">       
                                <h3><?php echo $title; ?></h3>
                                <textarea rows="3" style ="height: 100%; width: 100%;"><?php echo $description; ?></textarea>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn">Thêm giỏ hàng</a>
                                <span class="price"><?php echo $price; ?></span>
                            </div>
                        </div>                                                            
                     <?php
                }
            }
            else
            {
                echo "Danh mục trống";
            }
    ?>
    </div>

</div>
<!-- menu section ends -->

<!-- about section starts  -->
<section class="about" id="about">

    <h3 class="sub-heading"> Cửa Hàng </h3>
    <h1 class="heading"> Lựa chọn tuyệt vời? </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.png" alt="">
        </div>

        <div class="content">
            <h3>Thực phẩm đảm bảo chất lượng</h3>
            <p>Mục tiêu hướng đến của FoodOrder là cho phép người dùng đặt món mà họ muốn. Đặc biệt đa dạng đồ ăn trưa và đồ ăn nhẹ, mà các nhân viên văn phòng rất ưa thích.</p>
            <p>Ngoài ra, FoodOrder giúp bạn dễ dàng bắt được xu thế ăn uống thời đại 4.0. FoodOrder cũng giúp các bạn cập nhật những thực đơn đang được ưa chuộng, biết được giá thực phẩm công khai nhanh chóng, chính xác.</p>
            <p>Đặc biệt, đội ngũ nhân viên chuyên nghiệp phục vụ khách hàng nhiệt tình, tâm huyết, đội ngũ giao hàng hỗ trợ giao hàng đến tận nửa đêm, mọi lúc mọi nơi.</p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Miễn phí vận chuyển</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Dễ dàng thanh toán</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>Phục vụ 24/7</span>
                </div>
            </div>   
        </div>


    </div>

</section>
<!-- about section ends -->

<!-- footer section starts      -->
<?php include('partials-font/footer.php'); ?>
<!-- footer section ends-->