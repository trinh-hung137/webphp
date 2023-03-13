<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="heading">
            <h2>Cập nhật danh mục</h2>              
        <br><br>

        <?php        
         // kiểm tra id có được đặt không
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                //b2 sửa dliệu trong database
                $sql = "SELECT * FROM tb_category WHERE id= $id ";    //taạo truy vấn
                //thực hiện truy vấn
                $res = mysqli_query($conn,$sql);

                //tạo biến đếm hàng, nếu biến đếm =1 -> có gtrị và ngược lại
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //lấy toàn bộ dliệu trong 1 hàng 
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];  
                    $current_image = $row['image_name'];  
                }
                else
                { 
                    //in tbáo trở lại trang quản lý
                    $_SESSION['no_category_found'] = "Khong tim thấy danh mục";
                    header('location:'.SITEURL.'admin/manage-category.php'); 
                }
                          
                
            }
            else
            {
                //chuyển hướng đến trang manage-category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">   
            <table  style="text-align: center;" class="tb">
                <tr>
                    <td>Tên danh mục:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td> 
                </tr>
                <tr>
                    <td>Ảnh danh mục hiện tại: </td>
                    <td>
                        <?php 
                            if($current_image != ""){
                                //hiển thị ảnh nếu có
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else{
                                //đưa ra tnhắn nếu không
                                echo "Ảnh trống";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Ảnh danh mục mới:</td>
                    <td>
                        <input type="file" name="image">
                    </td> 
                </tr>
                
            </table>
        <div style="text-align: center;">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value ="Cập nhật" class="btn">
        </div>
        </form> 

        <?php
            // kiểm tra nút cập nhật loại được click chưa
            if(isset($_POST['submit']))
            {
                //b1. Lấy giá trị từ form            
                $title = $_POST['title'];
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                
                // kiểm tra hình ảnh được chọn chưa 
                if(isset($_FILES['image']['name']))
                {
                    //A. Tải hình ảnh mới lên
                    // để tải h.ảnh cần tên h.ảnh, đường dẫn nguồn, đường dẫn đích
                    $image_name = $_FILES['image']['name'];
                    if($image_name != "") //ảnh có sẵn
                    {
                        //tải ảnh mới 
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
                            header('location:'.SITEURL.'admin/manage-category.php'); 
                            // dừng quá trình để k tải lên được dliệu k bị chèn vào csdl
                            die();
                        }
                        
                        //xóa hình ảnh cũ
                        if($current_image !="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path); 
                        } 
                    }
                    else
                    {
                        $image_name= $current_image; 
                    }
                }
                else
                {
                    $image_name= $current_image; 
                }

                // tạo câu truy vấn để chèn dliệu vào csdl
                $sql2="UPDATE tb_category SET
                    title = '$title',
                    image_name = '$image_name'
                    WHERE id = $id  ";

                // thực hiện truy vấn và lưu vào csdl
                $res2= mysqli_query($conn,$sql2);

                // kiểm tra câu truy vấn đã được thực thi hay chưa
                if($res2==TRUE)
                {
                    // được thực thi và được cập nhật loại
                    $_SESSION['update']= "Cập nhật danh mục thành công";
                    // chuyển hướng tới trang manage-category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // cập nhật danh mục k thành công
                    $_SESSION['update']= "Thêm danh mục không thành công";
                    // giữ lại trang
                    header('location:'.SITEURL.'admin/manage-category.php');
                } 
            }
        ?> 
    </div> 
</div>