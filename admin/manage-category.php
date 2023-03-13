<?php include('partials/menu.php') ; ?>

<!-- main content setion start -->
    <div class="main-content">
        <div class="heading">
            <h2>Quản lý danh mục</h2>
            <br/><br/>
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['no_category_found'])){
                    echo $_SESSION['no_category_found'];
                    unset($_SESSION['no_category_found']);
                }
            
            ?> 
            <br/><br/>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn">Thêm danh mục</a>           
        </div>
        <table class="tb">
                <tr>
                    <th>Mã</th>
                    <th>Tên loại</th>
                    <th>Hình ảnh</th>
                    <th>Thao tác</th>
                </tr>

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
                            <!-- ngắt php để thêm mã html vào giữa -->
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                    // kiểm tra tên ảnh có dliệu Không 
                                    if($image_name != "")
                                    {
                                        // hiển thị ảnh
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                        <?php
                                    }
                                    else
                                    {
                                        // in ra dòng tbáo tên ảnh trống 
                                        echo "tên ảnh trống";
                                    }
                                    ?>
                                </td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn">Cập nhật</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ; ?>" class="btn">Xóa</a>                                        
                                </td>
                                
                            </tr>
                            
                            <?php
                        }
                    }
                    else    // không có dliệu trong bảng
                    {
                        ?>
                            <tr>
                                <td colspan="6">Không có loại hàng</td>
                            </tr>
                        <?php
                    }
                ?>
                
            </table>        
    </div>        
<!-- main content setion ends -->