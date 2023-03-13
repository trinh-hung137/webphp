<?php
    include('../config/constants.php');
    // kiểm tra id và image_name có được đặt không
    if(isset($_GET['id']) AND isset($_GET['image_name']) )
    {
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];

         //b1 xóa hình ảnh
         if($image_name != "")
         {
             // hình ảnh có sẵn --> tiến hành xóa
             $path = "../images/category/".$image_name;
             //xoas
             $remove = unlink($path);
             //nếu remove trả về TRUE --> xóa tcông, nếu trả về False --> tbáo và chuyển hướng về quản lý thực đơn và dừng
             if($remove == FALSE)
             {
                $_SESSION['remove']= "Xoá ảnh không thành công";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
             }
         }
    //b2 xóa dliệu trong database
         $sql = "DELETE FROM tb_food WHERE id= $id";    //tạo truy vấn
         //thực hiện truy vấn
         $res = mysqli_query($conn,$sql);
         // kiểm tra câu truy vấn đã được thực thi hay chưa
         if($res==TRUE)
         {
             // được thực thi và được xóa thực đơn
             $_SESSION['delete']= "Xóa thực đơn thành công";
             // chuyển hướng tới trang quản lý thực đơn
             header('location:'.SITEURL.'admin/manage-food.php');
         }
         else
         {
             // xóa thực đơn k thành công
             $_SESSION['delete']= "Xóa thực đơn không thành công";
             // giữ lại trang
             header('location:'.SITEURL.'admin/delete-food.php');
         } 
    }
    else
    {
        //chuyển hướng đến trang quản lý thực đơn
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>