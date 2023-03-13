<?php 
    include('partials-font/menu.php');
    // include('./config/constants.php'); 
?>
<?php
    
    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];
        //câu lệnh lấy thông tin chi tiết sản phẩm
        $sql= "SELECT * FROM tb_food WHERE id=$food_id";
        // thực hiện truy vấn
        $res = mysqli_query($conn, $sql);
        //đếm các dòng dliệu
        $count = mysqli_num_rows($res);
        //kiểm tra
        if($count==1) // có dliệu
        {
            //lấy dliệu
            $row= mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        //chuyen ve trang chu
        header('location:'.SITEURL);
    }
?>

<div class="main-content">
        <div>
            <h2>Giỏ hàng</h2>
            <br/><br/>       
        </div>
    <form action="" method= "POST">
        <table class="tb">
            <tr>
                <th>Tên</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>                
            </tr>
            <tr>
                <td><?php echo $title; ?></td>  
                <input type="hidden" name="food" value="<?php echo $title; ?>">                                   
                <td>
                    <?php
                        if($image_name != "")
                        {
                            // hiển thị ảnh  
                            ?>                          
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  width="100px">
                            <?php
                        }
                        else
                        {
                            // in ra dòng tbáo tên ảnh trống 
                            echo "Tên ảnh trống";
                        }
                    ?>
                </td>
                <td><input type="number" name="qty" value="1" require></td>
                <td><?php echo $price; ?></td>
                <input type="hidden" name="price" value="<?php echo $price; ?>">                           
            </tr>                                                                                                                       
        </table>        
    <!-- order section starts  -->
    <!-- <form action="" method= "POST"> -->
        `<div style="margin: 50px;" class="order form" id="order form">
            <div>
                <h2>Đơn đặt hàng</h2>
                <br/><br/>       
            </div>
                <div class="inputBox">
                    <div class="input">
                        <div>Họ và tên</div>
                        <input type="text" name = "full-name" placeholder="nhập họ và tên" require>
                    </div>
                    <div class="input">
                        <div>Số điện thoại</div>
                        <input type="text" name="contact" placeholder="nhập số điện thoại" require>
                    </div>
                </div>
                <div class="inputBox">
                    <div class="input">
                        <div>Email</div>
                        <input type="text" name="email" placeholder="nhập email" require>
                    </div>
                    <div class="input">
                        <div>Địa chỉ</div>
                        <input type="test" name="address" placeholder="nhập địa chỉ" require>
                    </div>
                </div>
                <input class ="btn" type="submit" name  ="submit" value="Đặt hàng">
            </div>
        </div>
   </form> 
</div>

<!-- order section ends -->

<!-- kiểm tra nút gửi có được ấn không -->
<?php
    if(isset($_POST['submit']))
    {
        //lấy dữ liệu từ form
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d h:i:s");
        $status = "Da dat";
        $customer_name= $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];

        //lưu vào data
        // tạo câu lệnh sql
        $sql2= "INSERT INTO tb_order SET
            food= '$food',
            price = $price,
            qty= $qty,
            total=$total,
            order_date= '$order_date',
            status = '$status',
            customer_name= '$customer_name',
            customer_contact= '$customer_contact',
            customer_email= '$customer_email',
            customer_address= '$customer_address'
        ";
        // thuực hiện câu lệnh
        $res2 = mysqli_query($conn, $sql2);
        // kiểm tra câu lệnh có thành công không
        if($res2== TRUE)
        {
            $_SESSION['order']= "Đặt hàng thành công";
            header('location: '.SITEURL);
        }
        else
        {
            $_SESSION['order']= "Đặt hàng không thành công";
            header('location:'.SITEURL);
        }

    }
    
?>