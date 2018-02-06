<!DOCTYPE html>
<html>
<?php
$type = strval($_GET['t']);
if(isset($_COOKIE["customerName"])) {
    $customerName = $_COOKIE["customerName"];
    //echo $customerName;
}
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>671 Computer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">CSC671 Computer</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
     </div>
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
         <li ><a href="homepage.php">Home </a></li>
         <li class="active"><a href="#"><?php echo $type;?> </a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
         <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" id="cName">User: <?php echo $customerName;?><span class="caret"></span></a>
           <ul class="dropdown-menu">
             <li><a href="order.php?t=Cart">Cart</a></li>
             <li><a href="order.php?t=Wishlist">Wishlist</a></li>
             <li><a href="order.php?t=Order History">Order History</a></li>
             <li role="separator" class="divider"></li>
             <li><a href="index.php" style="font-weight:800;">Logout</a></li>
           </ul>
         </li>
       </ul>
     </div>
 </div>
 </nav>

 <div class="container" style="margin-top: 70px">
   <div class="jumbotron">
         <h1><?php echo $type; ?> Overview</h1>
           <?php
             $servername = "localhost";
             $username = "root";
             $password = "root";
             $dbname = "StoreProject";
             $conn = new mysqli($servername, $username, $password, $dbname);

             if ($type == "Order History") {
               $sql = "SELECT Order_Status, Order_Date, Final_Price, Memory, Disk, OS, Processor, Product_Name
               FROM orders natural join product natural join customer where Name='$customerName' and (Order_Status='Shipped' or Order_Status='Process' or Order_Status='Check Out')";
             } else {
               $sql = "SELECT Order_Status, Order_Date, Final_Price, Memory, Disk, OS, Processor, Product_Name
               FROM orders natural join product natural join customer where Order_Status='$type' and Name='$customerName'";
             }
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
             	echo "<div class='table-responsive'><table class='table'><thead><tr><th>Order Date</th><th>Product_Name</th><th>OS</th><th>Processor</th><th>Memory</th>
              <th>Disk</th><th>Final Price</th><th>Order Status</th></tr></thead><tbody>";
             	while ($row = $result->fetch_assoc()) {
             		echo "<tr><td>" . $row["Order_Date"]. "</td><td>" . $row["Product_Name"].
                 "</td><td>" . $row["OS"]. "</td><td>" . $row["Processor"].
                  "</td><td>" . $row["Memory"]. "</td><td>" . $row["Disk"].
                   "</td><td>" . $row["Final_Price"]. "</td><td>" . $row["Order_Status"].
             		"</td></tr>";
             	}
             	echo "<tbody></table></div>";
             } else {
             	echo "0 results";
             }

             $conn->close();

           ?>
           <form method="POST">
                   <input type="submit" name="checkout" id="checkout" class="btn btn-lg btn-primary" value="Check Out &raquo;">
           </form>
           <!-- <a class="btn btn-lg btn-primary" href="checkout.php" role="button" type="submit" name="checkout">Check Out &raquo;</a> -->

   </div>
 </div>

<?php
    if(isset($_POST['checkout']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "StoreProject";
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "UPDATE orders SET Order_Status = 'Check Out' WHERE Order_Status = '$type'";

        if ($conn->query($sql) === TRUE) {
          $url='checkout.php';
          echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }
 ?>

<!-- footer -->
<footer class="navbar navbar-inverse navbar-fixed-bottom" style="padding:0 0 0 0;margin-bottom: 0">
        <div class="container-fluid">
            <p style="margin: auto; margin-top:15px; text-align:center; color:#FFF;">This website services as the project of CSC 671.</p>
        </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
