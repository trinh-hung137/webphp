<?php
session_start();
$user= $_SESSION["username"];
$productId=$_GET["product"];
$price=0;
// $totalprice=0
$quantity=1;
$product="";
$product_img="";
// connect database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop-order";
$id=1;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM tbl_food WHERE id= $productId";
$result = $conn->query($sql);
$id=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $price=$row["price"];
        $product=$row["title"];
        $product_img=$row["image_name"];
    }
} 
$sql = "SELECT * FROM tbl_drink WHERE id= $productId";
$result = $conn->query($sql);
$id=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $price=$row["price"];
        $product=$row["title"];
        $product_img=$row["image_name"];
    }
} 
$sql = "SELECT id, product, quantity FROM tbl_order";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $id=$row["id"];
        if($product==$row["product"]){
           
            $quantity=$row["quantity"]+1;
            // $subtotal=$_SESSION['cart'][$row['id_product']]['quantity']*$row['price']; 
            $sql="UPDATE tbl_order SET quantity=$quantity WHERE product='$product'";
            $result = $conn->query($sql);
            header("Location: index.php");
        }
        
    }
} 

$sql="INSERT INTO tbl_order(id, product, price, quantity,product_image, customer_name) VALUES ($id+1,'$product',$price,$quantity, '$product_img','$user')";
echo $product;
echo $user;
$result = $conn->query($sql);
header("Location: index.php");
?>