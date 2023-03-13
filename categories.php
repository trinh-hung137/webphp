<?php include('partials-font/menu.php'); ?>

<!-- food section starts  -->

<div style="margin: 70px;" class="food" id="food">

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

<!-- food section ends -->

<!-- footer section starts  -->

<?php include('partials-font/footer.php'); ?>

<!-- footer section ends -->


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>