<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="heading">
            <h2>Cập nhật đơn hàng</h2>              
        <br><br>
        </div>
        <?php        
         // kiểm tra id có được đặt không
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                //b2 sửa dliệu trong database
                $sql = "SELECT * FROM tb_order WHERE id= $id ";    //taạo truy vấn
                //thực hiện truy vấn
                $res = mysqli_query($conn,$sql);

                //tạo biến đếm hàng, nếu biến đếm =1 -> có gtrị và ngược lại
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    //lấy toàn bộ dliệu trong 1 hàng 
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];                        
                    $total = $row['total'];
                    // $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address']; 
                }
                else
                { 
                    //trở lại trang quản lý
                    header('location:'.SITEURL.'admin/manage-order.php'); 
                }
            }
            else
            {
                //chuyển hướng đến trang manage-category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
        <br><br>
        <form action="" method="POST" >   
            <table class="tb">
                <tr>
                    <td>Tên thực đơn: </td>
                    <td><?php echo $food; ?></td> 
                </tr>
                <tr>
                    <td>Giá: </td>
                    <td><?php echo $price; ?></td> 
                </tr>
                <tr>
                    <td>Số lượng: </td>
                    <td><?php echo $qty; ?></td>
                </tr>
                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Da dat"){echo "selected";} ?> value="Da dat">Đã đặt</option>
                            <option <?php if($status=="Da gui"){echo "selected";} ?> value="Da gui">Đã gửi</option>
                            <option <?php if($status=="Dang giao"){echo "selected";} ?> value="Dang giao">Đang giao</option>   
                            <option <?php if($status=="Da huy"){echo "selected";} ?> value="Da huy">Đã hủy</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tên khách hàng: </td>
                    <td><?php echo $customer_name;?></td>
                </tr>
                <tr>
                    <td>Sđt khách hàng </td>
                    <td><?php echo $customer_contact;?></td>
                </tr>
                <tr>
                    <td>Email khách hàng: </td>
                    <td><?php echo $customer_email;?></td>
                </tr>
                <tr>
                    <td>Địa chỉ khách hàng: </td>
                    <td><?php echo $customer_address;?></td>
                </tr>        
            </table>
        <div style="text-align: center;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value ="Cập nhật" class="btn">
        </div>
        </form> 

        <?php
            if(isset($_POST['submit'])){
                $status = $_POST['status'];
         
                $sql2 = "UPDATE tb_order SET                   
                    status = '$status'
                    WHERE id = $id
                ";
              
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true){
                    //cập nhật thành công
                    $_SESSION['update'] = "Cập nhật thành công";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else{
                    //cập nhật lỗi
                    $_SESSION['update'] = "Cập nhật không thành công";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
</div>
