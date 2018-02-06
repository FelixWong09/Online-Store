<?php
if(isset($_COOKIE["customerName"])) {
    $customerName = $_COOKIE["customerName"];
    //echo $customerName;
}
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "StoreProject";
$conn = new mysqli($servername, $username, $password, $dbname);

$OS = $_POST['OS'];
$Disk = $_POST['Disk'];
$Memory = $_POST['Memory'];
$Processor = $_POST['Processor'];
$Price = $_POST['Price'];
$PID = $_POST['ProductID'];

$sqlCID = "SELECT Customer_ID from customer where Name = '$customerName'";
$result = $conn->query($sqlCID);
$row = $result->fetch_assoc();
$CID = $row["Customer_ID"];

if($_POST['action'] == "addtocart") {
  $Type="Cart";
  $sql="INSERT INTO orders (Order_ID,Order_Status,Order_Date,Product_ID,Customer_ID,Final_Price,Memory,Disk,OS,Processor)
  VALUES
  (NULL,'" . $Type. "','". date("Y-m-d") ."'," . $PID. "," . $CID. "," . $Price. ",'" . $Memory. "','" . $Disk. "','" . $OS. "','" . $Processor. "')";
} elseif ($_POST['action'] == "Buy") {
  $Type="Buy";
  $sql="INSERT INTO orders (Order_ID,Order_Status,Order_Date,Product_ID,Customer_ID,Final_Price,Memory,Disk,OS,Processor)
  VALUES
  (NULL,'" . $Type. "','". date("Y-m-d") ."'," . $PID. "," . $CID. "," . $Price. ",'" . $Memory. "','" . $Disk. "','" . $OS. "','" . $Processor. "')";
} elseif ($_POST['action'] == "addtowishlist") {
  $Type="Wishlist";
  $sql="INSERT INTO orders (Order_ID,Order_Status,Order_Date,Product_ID,Customer_ID,Final_Price,Memory,Disk,OS,Processor)
  VALUES
  (NULL,'" . $Type. "','". date("Y-m-d") ."'," . $PID. "," . $CID. "," . $Price. ",'" . $Memory. "','" . $Disk. "','" . $OS. "','" . $Processor. "')";
}
if ($conn->query($sql) === TRUE) {
  
} else {
    echo "Error!";
}
$conn->close();
?>
