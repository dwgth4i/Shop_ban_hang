<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$database = "shopbanhang";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} // die và exit đều là dừng script nhưng chỉ dùng die khi có lỗi phải dừng chương trình,
  // exit dùng lúc nào cũng được
echo "<pre>";

?>
