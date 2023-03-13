<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="heading">
            <h2>Thêm danh mục</h2>              
        <br><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">   
            <table  style="text-align: center;" class="tb">
                <tr>
                    <td>Tên danh mục:</td>
                    <td>
                        <input type="text" name="title" placeholder="Nhập tên loại">
                    </td> 
                </tr>
                <tr>
                    <td>Hình ảnh:</td>
                    <td>
                        <input type="file" name="image">
                    </td> 
                </tr>
                
            </table>
        <div style="text-align: center;">
            <input type="submit" name="submit" value ="Thêm danh mục" class="btn">
        </div>
        </form> 

        <?php
            // kiểm tra nút thêm loại được click chưa
            if(isset($_POST['submit']))
            {
                //b1. Lấy giá trị từ form 
                $title = $_POST['title']; 
                
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
                $sql="INSERT INTO tb_category SET
                    title = '$title',
                    image_name = '$image_name'
                ";

                // thực hiện truy vấn và lưu vào csdl
                $res= mysqli_query($conn,$sql);

                // kiểm tra câu truy vấn đã được thực thi hay chưa
                if($res==TRUE)
                {
                    // được thực thi và được thêm loại
                    $_SESSION['add']= "Thêm danh mục thành công";
                    // chuyển hướng tới trang manage-category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // thêm danh mục k thành công
                    $_SESSION['add']= "Thêm danh mục không thành công";
                    // giữ lại trang
                    header('location:'.SITEURL.'admin/add-category.php');
                } 
            }
        ?> 
    </div> 
</div>