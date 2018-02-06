<!DOCTYPE html>
<html>
<?php

if(isset($_COOKIE["customerName"])) {
    $customerName = $_COOKIE["customerName"];
    //echo $customerName;
}
?>

    <head>
        <meta charset="utf-8">
        <title>671 Computer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "StoreProject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: ". $conn->connect_error);
}

?>

            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="homepage.php">Home </a><span class="sr-only">(current)</span></li>
                            <li class="active"><a href="#">Check Out</a></li>
                        </ul>
                        <form class="navbar-form navbar-right">
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
                        </form>
                    </div>
                </div>
            </nav>

            <div class="container-fluid" style="margin-right: 3%;margin-top:50px;">
                <div class="row ">
                    

                    <div class="container" style="margin-bottom:70px">
                        <div class="jumbotron">
                            <!--<div class="row">

                                <div class="col-md-8 col-md-offset-2"-->
                                    <form role="form" method="post">


                                        <h1>Order Summary</h1>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Shipping Address</th>
                                                        <th>Credit Card Number</th>
                                                        <th>Expiration Date</th>
                                                        <th>Billing Address</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                              
                                       
                                        $sql2 = "select SUM(o.Final_Price) as Total_Price from orders o, product p, customer c where c.Name = '$customerName' and Order_Status = 'Check Out' and o.Product_ID = p.Product_ID and c.Customer_ID = o.Customer_ID";
                                        $sql1 = "SELECT * FROM customer WHERE Name = '$customerName'";
                                        $result1 = $conn->query($sql1);
                                        while ($row = $result1->fetch_assoc()) {
                                         
                                              
                                        echo
                                        "<tr><td>"  . $row["Name"]. 
                                        "</td><td>" . $row["Shipping_Address"].
                                            "</td><td>" . $row["Credit_Card_No"].
                                            "</td><td>" . $row["Exp_Date"].
                                            "</td><td>" . $row["Billing_Address"].
                                            "</td></tr>";
                                    }
                                        $result2 = $conn->query($sql2);
                                             while ($row = $result2->fetch_assoc()) {
                                         
                                              
                                        echo
                                        "<tr><td>Total_Price</td><td>"  . $row["Total_Price"]. 
                                            "</td></tr>";
                                             }
                                   
                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="submit" name="go" class="btn btn-primary" value="Process Order">
                                                <!---decrement inventory in product page
                                        popup success window
                                        change status to process-->
                                            </div>
                                        </div>


                            </form>
                                </div>

                            </div>
                        </div>

                    </div>
                



            <?php
        if($_POST["go"])
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "StoreProject";
        $conn = new mysqli($servername, $username, $password, $dbname);

       
         $sql1 = "UPDATE product p, orders o, customer c SET o.Order_Status = 'Wishlist' WHERE c.Name = '$customerName' and o.Customer_ID = c.Customer_ID and o.Order_Status = 'Check Out' and o.Product_ID = p.Product_ID and p.inventory = 0";
         $sql2 = "UPDATE product p, orders o, customer c SET o.Order_Status = 'Process' WHERE c.Name = '$customerName' and o.Customer_ID = c.Customer_ID and o.Order_Status = 'Check Out' and o.Product_ID = p.Product_ID and p.inventory > 0";
            
            $query1 = mysqli_query($conn, $sql1);
            if (mysqli_affected_rows($conn) > 1)
            {
                $message = "SOME BUT NOT ALL OF YOUR ITEMS ARE OUT OF STOCK. THEY HAVE BEEN ADDED TO YOUR WISHLIST FOR FUTURE REFERENCE";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            
            $query2 = mysqli_query($conn, $sql2);
            if (mysqli_affected_rows($conn) < 1)
            {
                   $message = "ERROR PROCESSING ORDER, ONE OF THESE ITEMS ARE OUT OF STOCK";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }else{
                    $message = "ORDER PROCESSED SUCCESSFULLY";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    $url = 'homepage.php';
                    echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
                }
            }
        //}
            
             
            
   ?>




                <?php
$conn->close();
?>

<footer class="navbar navbar-inverse navbar-fixed-bottom" style="padding:0 0 0 0;margin-bottom: 0">
        <div class="container-fluid">
            <p style="margin: auto; margin-top:15px; text-align:center; color:#FFF;">This website services as the project of CSC 671.</p>
        </div>
</footer>


    </body>

</html>
