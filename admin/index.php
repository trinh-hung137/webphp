<?php include('partials/menu.php') ; ?>

        <!-- main content setion start -->
    <div class="main-content">
        <div class="heading">
            <h2>Quản lý</h2>
            <div class="col-4">
                <?php 
                    $sql1 = "SELECT SUM(total) AS Total FROM tb_order WHERE status='Da dat' or status='Da gui' or status='Dang giao'";
                    
                    $res1 = mysqli_query($conn, $sql1);
                   
                    $row1 = mysqli_fetch_assoc($res1);
                    
                    $toral_revenue = $row1['Total'];
                
                ?>
                <h1><?php echo $toral_revenue; ?>vnđ</h1>
                <br/>
                Doanh thu
            </div>
            <div class="col-4">
                <?php 
                    $sql = "SELECT * FROM tb_category";
                    //execute query
                    $res = mysqli_query($conn, $sql);
                    //count rows
                    $count = mysqli_num_rows($res);
                        
                ?>
                <h1><?php echo $count; ?></h1>
                <br/>
                Danh mục
            </div>
            <div class="col-4">
                <?php 
                    $sql2 = "SELECT * FROM tb_food";
                    //execute query
                    $res2 = mysqli_query($conn, $sql2);
                    //count rows
                    $count2 = mysqli_num_rows($res2);
                        
                ?>
                <h1><?php echo $count2; ?></h1>
                <br/>
                Thực đơn
            </div>
            <div class="col-4">
                <?php 
                    $sql3 = "SELECT * FROM tb_order";
                    //execute query
                    $res3 = mysqli_query($conn, $sql3);
                    //count rows
                    $count3 = mysqli_num_rows($res3);
                    
                ?>
                <h1><?php echo $count3; ?></h1>
                <br/>
                Đơn đặt hàng
            </div>
        </div>
        
    </div>
        
        <!-- main content setion ends -->

