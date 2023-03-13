<?php include('partials/menu.php') ; ?>

<!-- main content setion start -->
    <div class="main-content">
        <div class="heading">
            <h2>Quản lý đơn đặt hàng</h2>
            <br/><br/>
            <div style="text-align: center;">
                <form  action="<?php echo SITEURL; ?>/admin/customer-search.php" method="POST" >
                    <input type="search" name="search" placeholder="Nhập tên khách hàng" required >
                    <input type="submit" name="submit" value="Tìm" class="btn">
                </form>
            </div> 
            <br/><br/>
            <?php 
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?> 
            <br/><br/>
        </div>
        <table class="tb">
                <tr>
                    <th>Mã</th>
                    <th>Thực đơn</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tiền thanh toán</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tên khách hàng</th>
                    <th>Sđt</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                </tr>

                <?php
                    // tạo truy vấn lấy tất cả dliệu trong bảng đơn đặt hàng
                    $sql= "SELECT * FROM tb_order";
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
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status= $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            ?> 
                            <!-- ngắt php để thêm mã html vào giữa -->
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td>
                                    <?php 
                                        //Order On Delivery Deliverd Cancelled
                                        if($status=="Da dat"){
                                            echo "<label>Đã đặt</label>";
                                        }
                                        elseif($status=="Dang giao"){
                                            echo "<label style='color: orange'>Đang giao</label>";
                                        }
                                        elseif($status=="Da gui"){
                                            echo "<label style='color: green'>Đã gửi</label>";
                                        }
                                        elseif($status=="Da huy"){
                                            echo "<label style='color: red'>Đã hủy</label>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td> 
                                <td>                        
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn">Cập nhật</a>                                     
                                </td>
                                
                            </tr>
                            
                            <?php
                        }
                    }
                    else    // không có dliệu trong bảng
                    {
                        ?>
                            <tr>
                                <td colspan="6">Không có đơn đặt hàng</td>
                            </tr>
                        <?php
                    }
                ?>
                
            </table>        
    </div>        
<!-- main content setion ends -->