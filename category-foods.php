<?php include('partials-font/menu.php'); ?>

<?php
    // kiểm tra id danh mục khi clich có chuyển sang không
    if(isset($_GET['category_id']))
    {
        // id được chuyển và tạo biến lưu
        $category_id = $_GET['category_id'];      
    }
    else
    {
        //chuyển về trang chủ
        header('location:'.SITEURL); 
    }
?>
<!-- menu section starts  -->

<div style="margin: 70px;" class="menu" id="menu">

    <h3 class="sub-heading">Menu</h3>
    <h1 class="heading"> Thực đơn theo danh mục </h1>

    <div class="box-container">
        <?php
            // tạo truy vấn lấy tất cả dliệu trong bảng phân loại
            $sql1= "SELECT * FROM tb_food WHERE category_id = $category_id";
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
                echo "Thực đơn trống";
            }
        ?>
    </div>

</div>

<!-- menu section ends -->



<!-- footer section starts  -->

<?php include('partials-font/footer.php'); ?>

<!-- footer section ends -->


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>