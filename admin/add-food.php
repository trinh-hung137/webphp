<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="heading">
        <h2>Thêm thực đơn</h2>              
    <br><br>
    <form action="" method="POST" enctype="multipart/form-data">   
        <table  style="text-align: center;" class="tb">
            <tr>
                <td>Tên thực đơn: </td>
                <td><input type="text" name="title" placeholder="Tên thực đơn"></td>                 
            </tr>
            <tr>
                <td>Mô tả : </td>
                <td><textarea name="description" cols="30" rows="5" placeholder="Mô tả thực đơn"> </textarea></td>                
            </tr>
            <tr>
                <td>Giá thực đơn: </td>
                <td><input type="number" name="price" placeholder="Giá thực đơn"></td>                 
            </tr>
            <tr>
                <td>Ảnh thực đơn: </td>
                <td><input type="file" name="image"></td> 
            </tr>
            <tr>
                <td>Danh mục: </td>
                <td>
                    <select name="category">
                        <?php
                            // tạo câu truy vấn để hiện dliệu danh mục từ csdl
                            $sql="SELECT * FROM tb_category";
                            // thực hiện truy vấn và lưu vào csdl
                            $res= mysqli_query($conn,$sql);

                            // đếm hàng kiểm tra xem dữ liệu bảng danh mục có không
                            $count = mysqli_num_rows($res);
                            if($count >0) //có danh mục
                            {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        // lấy dliệu bảng danh mục
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                            }
                            else 
                            {
                                ?>
                                    <option value="0">Không có danh mục</option>
                                <?php
                            }                              
                        ?>     
                    </select>
                </td> 
            </tr>
            
        </table>
    <div style="text-align: center;">
        <input type="submit" name="submit" value ="Thêm thực đơn" class="btn">
    </div>
    </form> 

    <?php
        // kiểm tra nút thêm thực đơn được click chưa
        if(isset($_POST['submit']))
        {
            //b1. Lấy giá trị từ form 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            
            // kiểm tra hình ảnh được chọn chưa 
            if(isset($_FILES['image']['name']))
            {
                // để tải h.ảnh cần tên h.ảnh, đường dẫn nguồn, đường dẫn đích
                $image_name = $_FILES['image']['name'];
                if($image_name != "")   // chỉ tải ảnh lên nếu ảnh được chọn
                {          
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
                    // tải ảnh lên
                    $upload= move_uploaded_file($source_path, $destination_path);
                    //ktra hình ảnh được tải lên hay chưa
                    //nếu chưa tải được tbáo lỗi + chuyển hướng đến trang add-category
                    if($upload==FALSE)
                    {
                        // nếu thông báo
                        $_SESSION['upload']="Không tải được hình ảnh";
                        // chuyển hướng trang
                        header('location:'.SITEURL.'admin/add-category.php'); 
                        // dừng quá trình để k tải lên được dliệu k bị chèn vào csdl
                        die();
                    }
                }
            }
            else
            {
                $image_name="";
            }

            // tạo câu truy vấn để chèn dliệu vào csdl
            $sql2="INSERT INTO tb_food SET
                title = '$title',
                description = '$description',
                price = $price ,
                image_name = '$image_name',
                category_id = $category
            ";

            // thực hiện truy vấn và lưu vào csdl
            $res2= mysqli_query($conn,$sql2);

            // kiểm tra câu truy vấn đã được thực thi hay chưa
            if($res2==TRUE)
            {
                // được thực thi và được thêm thực đơn
                $_SESSION['add']= "Thêm danh mục thành công";
                // chuyển hướng tới trang manage-food
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                // thêm thực đơn k thành công
                $_SESSION['add']= "Thêm danh mục không thành công";
                // giữ lại trang
                header('location:'.SITEURL.'admin/manage-food.php');
            } 
        }
    ?> 
    </div> 
</div>