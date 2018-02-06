<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>671 Computer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
    .input-style {
        display: inline-block;
        width: auto;
    }
</style>

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
                <div class="navbar-header"> <a class="navbar-brand" href="#">CSC671 Computer</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"></button> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="admin.php">Adminstration </a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adminstration <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php">Log out</a></li>
                            </ul>
                        </li>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container" style="margin-right: 3%;margin-top:50px; margin-botton: 70px">
            <div class="col-sm-2">
                <nav class="nav-sidebar">
                    <ul class="nav tabs" id="myTab">
                        <div>
                            <h2 class="add">Options</h2> </div>
                        <li class="active"><a href="#Overview" data-toggle="tab">Overview</a></li>
                        <li class=""><a href="#Product" data-toggle="tab">Product</a></li>
                        <li class=""><a href="#Config" data-toggle="tab">Config</a></li>
                        <li class=""><a href="#Update" data-toggle="tab">Update</a></li>
                        <li class=""><a href="#Process" data-toggle="tab">Process</a></li>
                    </ul>
                </nav>
            </div>
            <!-- tab content -->
            <div class="tab-content">
                <div class="tab-pane active text-style" id="Overview">
                    <h1>Welcome!</h1>
                    <div class="row" style="margin-bottom: 90px">
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div id="dataTables-example_filter" class="dataTables_filter">
                                                    <form role="form" method="post">
                                                        <label>Search:
                                                            <br>
                                                            <input type="text" name="Starting_Date" id="Starting_Date" class="form-control input-sm" placeholder="YYYY-MM-DD" aria-controls="dataTables-example">
                                                            <input type="text" name="End_Date" id="End_Date" class="form-control input-sm" placeholder="YYYY-MM-DD" aria-controls="dataTables-example">
                                                            <input type="submit" name="Search" class="btn btn-primary" value="Search"> </label>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                   <div class="table-responsive">
                                                    <table width="100%" class="table" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>Order ID</th>
                                                                <th>Customer ID</th>
                                                                <th>Product ID</th>
                                                                <th>Order Date</th>
                                                                <th>Final Price</th>
                                                                <th>Order Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = "select * from orders where Order_Status = 'Shipped'";
                                                            $result1 = $conn->query($sql1);
                                                            while ($row = $result1->fetch_assoc()) {
                                                            echo
                                                            "<tr><td>"  . $row["Order_ID"]. 
                                                            "</td><td>" . $row["Customer_ID"]. 
                                                            "</td><td>" . $row["Product_ID"].
                                                            "</td><td>" . $row["Order_Date"]. 
                                                            "</td><td>" . $row["Final_Price"].
                                                            "</td><td>" . $row["Order_Status"].
                                                            "</td></tr>";
                                                            }
                                        
                                                                    if($_POST["Search"])
                                                                    {
                                                    
                                                                    $Starting_Date=$_POST['Starting_Date'];
                                                                    $End_Date=$_POST['End_Date'];
                                                                    $sql2 = "select * from orders 
                                                                            where Order_Date between '$Starting_Date' and '$End_Date' AND Order_Status = 'Shipped'
                                                                            order by Order_Date desc";
                                                                            $result2 = $conn->query($sql2);
                                                                            ob_end_clean();
                                                                        while ($row = $result2->fetch_assoc()) {
                                                                        echo 
                                                                        "<tr><td>"  . $row["Order_ID"]. 
                                                                        "</td><td>" . $row["Customer_ID"]. 
                                                                        "</td><td>" . $row["Product_ID"].
                                                                        "</td><td>" . $row["Order_Date"]. 
                                                                        "</td><td>" . $row["Final_Price"].
                                                                        "</td><td>" . $row["Order_Status"].
                                                                        "</td></tr>";
                                                                        }
                                                                            $sql3 = "select SUM(Final_Price) total_selling_price 
                                                                            from orders 
                                                                            where Order_Date between '$Starting_Date' and '$End_Date' AND Order_Status = 'Shipped'
                                                                            order by total_selling_price desc";
                                                                            $result3 = $conn->query($sql3);
                                                                            while ($row = $result3->fetch_assoc()) {
                                                                            echo "<tr><td> <h4>Total Price</h4>
                                                                                </td><td>  
                                                                                </td><td> 
                                                                                </td><td>  
                                                                                </td><td> 
                                                                                </td><td>" . $row[total_selling_price].
                                                                            "</td></tr>";
                                                                            }
                                                                      
                                                                    
                                                                    
                                                                    }
                                            
                                                                       
 
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.table-responsive -->
                        <!-- /.panel-body -->
                        <hr> </div>
                </div>
                <div class="tab-pane text-style" id="Product">
                    <div class="col-lg-8" style="margin-bottom: 90px">
                        <h2>Product</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Product Name</th>
                                        <th>Base Price</th>
                                        <th>Size</th>
                                        <th>weight</th>
                                        <th>Inventory</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "select * from product";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        echo
                                        "<tr><td>"  . $row["Model"]. 
                                        "</td><td>" . $row["Product_Name"]. 
                                        "</td><td>" . $row["Base_Price"].
                                        "</td><td>" . $row["size"]. 
                                        "</td><td>" . $row["weight"]. 
                                        "</td><td>" . $row["Inventory"].  
                                        "</td></tr>";
                                        
                                    }
                                         if($_POST["insertProduct"])
                                                {
                                                        $Model=$_POST['Model'];
                                                        $Product_Name=$_POST['Product_Name'];
                                                        $Base_Price=$_POST['Base_Price'];
                                                        $size=$_POST['size'];
                                                        $weight=$_POST['weight'];
                                                        $Inventory=$_POST['Inventory'];
                                                        $sql="INSERT INTO product (Model,Product_Name,Base_Price,size,weight,Inventory)
                                                                VALUES
                                                                ('$Model','$Product_Name','$Base_Price','$size','$weight','$Inventory')";
                                                        
                                                        if ($conn->query($sql) === TRUE) {
                                                                $sql = "select * from product";
                                                                $result = $conn->query($sql);
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo
                                                                        "<tr><td>"  . $row["Model"]. 
                                                                        "</td><td>" . $row["Product_Name"]. 
                                                                        "</td><td>" . $row["Base_Price"].
                                                                        "</td><td>" . $row["size"]. 
                                                                        "</td><td>" . $row["weight"]. 
                                                                        "</td><td>" . $row["Inventory"].
                                                                        "</td></tr>";
                                                                }
                                                                } else {
                                                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                                                }
                                                
                                        
                                                        
        
                                                        
                                                }
 
                                    ?>
                                </tbody>
                            </table>
                            <div>
                                <form role="form" method="post">
                                    <input type="text" name="Model" id="Model" class="form-control input-style" placeholder="Model">
                                    <input type="text" name="Product_Name" id="Product_Name" class="form-control input-style" placeholder="Product Name">
                                    <input type="number" name="Base_Price" id="Base_Price" class="form-control input-style" placeholder="Base Price">
                                    <input type="number" name="size" id="size" class="form-control input-style" placeholder="size">
                                    <input type="number" name="weight" id="weight" class="form-control input-style" placeholder="weight">
                                    <input type="number" name="Inventory" id="Inventory" class="form-control input-style" placeholder="Inventory">
                                    <input style="margin-top:30px;display:inherit;" type="submit" name="insertProduct" class="btn btn-primary" value="Add"> </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <hr> </div>
                <div class="tab-pane text-style" id="Config">
                    <div class="col-lg-10" style="margin-bottom: 90px">
                        <h2>Processor</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Processor_Type</th>
                                        <th>Processor_Upgrade_Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        $sql = "select * from processor";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        echo
                                        "<tr><td>" . $row["Processor_Type"]. 
                                        "</td><td>" . $row["Processor_Upgrade_Price"].
                                        "</td></tr>";
                                    }
                                        if($_POST["InsertProcessor"])
                                        {
                                                        $Processor_Type=$_POST['Processor_Type'];
                                                        $Processor_Upgrade_Price=$_POST['Processor_Upgrade_Price'];
                                                        $sql="INSERT INTO processor (Processor_Type,Processor_Upgrade_Price)
                                                        VALUES
                                                        ('$Processor_Type','$Processor_Upgrade_Price')";
        
                                                        if ($conn->query($sql) === TRUE) {
                                                                ob_end_clean();
                                                                $sql = "select * from processor";
                                                                $result = $conn->query($sql);
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo
                                                                    "<tr><td>"  . $row["Processor_Type"]. 
                                                                    "</td><td>" . $row["Processor_Upgrade_Price"].
                                                                    "</td></tr>";
                                                        }  
                                                        } else {
                                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                    }
                                              
 
                                    ?>
                                </tbody>
                            </table>
                            <div>
                                <form role="form" method="post">
                                    <input type="text" name="Processor_Type" id="Processor_Type" class="form-control input-style" placeholder="Processor Type">
                                    <input type="number" name="Processor_Upgrade_Price" id="Processor_Upgrade_Price" class="form-control input-style" placeholder="Processor Upgrade Price">
                                    <input style="margin-top:30px;display:inherit;" type="submit" name="InsertProcessor" class="btn btn-primary" value="Insert"> </form>
                            </div>
                        </div>
                        <h2>Disk</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Disk_Type</th>
                                        <th>Disk_Upgrade_Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    ob_start();
                                        $sql1 = "select * from disk";
                                        $result1 = $conn->query($sql1);
                                        while ($row = $result1->fetch_assoc()) {
                                        echo
                                        "<tr><td>" . $row["Disk_Type"]. 
                                        "</td><td>" . $row["Disk_Upgrade_Price"]. 
                                        "</td></tr>";
                                    }
                                    if($_POST["InsertDisk"])
                                                {
                                                     
                                                            
                                                        $Disk_Type=$_POST['Disk_Type'];
                                                        $Disk_Upgrade_Price=$_POST['Disk_Upgrade_Price'];
                                                        $sql="INSERT INTO disk (Disk_Type,Disk_Upgrade_Price)
                                                        VALUES
                                                        ('$Disk_Type','$Disk_Upgrade_Price')";
        
                                                        if ($conn->query($sql) === TRUE) {
                                                            
                                                            ob_end_clean();
                                                            $sql1 = "select * from disk";
                                                            $result1 = $conn->query($sql1);
                                                            while ($row = $result1->fetch_assoc()) {
                                                                echo
                                                                    "<tr><td>" . $row["Disk_Type"].
                                                                    "</td><td>" . $row["Disk_Upgrade_Price"].
                                                                    "</td></tr>";
                                                            }
                                                        } else {
                                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                                }
 
                                    ?>
                                </tbody>
                            </table>
                            <div>
                                <form role="form" method="post">
                                    <input type="text" name="Disk_Type" id="Disk_Type" class="form-control input-style" placeholder="Disk Type">
                                    <input type="number" name="Disk_Upgrade_Price" id="Disk_Upgrade_Price" class="form-control input-style" placeholder="Disk Upgrade Price">
                                    <input style="margin-top:30px;display:inherit;" type="submit" name="InsertDisk" class="btn btn-primary" value="Insert"> </form>
                            </div>
                        </div>
                        <h2>Memory</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Memory_Size</th>
                                        <th>Memory_Upgrade_Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            ob_start();
                                        $sql = "select * from memory";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        echo
                                        "<tr><td>" . $row["Memory_Size"]. 
                                        "</td><td>" . $row["Memory_Upgrade_Price"].
                                        "</td></tr>";
                                    }
                                    if($_POST["InsertMemory"])
                                                {
                                                        
                                                          
                                                        $Memory_Size=$_POST['Memory_Size'];
                                                        $Memory_Upgrade_Price=$_POST['Memory_Upgrade_Price'];
                                                        $sql="INSERT INTO memory (Memory_Size,Memory_Upgrade_Price)
                                                        VALUES
                                                        ('$Memory_Size','$Memory_Upgrade_Price')";
        
                                                        if ($conn->query($sql) === TRUE) {
                                                                ob_end_clean();
                                                               $sql = "select * from memory";
                                                                $result = $conn->query($sql);
                                                                while ($row = $result->fetch_assoc()) {
                                                                        echo
                                                                            "<tr><td>"  . $row["Memory_Size"]. 
                                                                            "</td><td>" . $row["Memory_Upgrade_Price"].
                                                                            "</td></tr>";
                                                        }
                                                        } else {
                                                                echo "Error: " . $sql1 . "<br>" . $conn->error;
                                                        }
                                                }
 
                                    ?>
                                </tbody>
                            </table>
                            <div>
                                <form role="form" method="post">
                                    <input type="text" name="Memory_Size" id="Memory_Size" class="form-control input-style" placeholder="Memory Size">
                                    <input type="number" name="Memory_Upgrade_Price" id="Memory_Upgrade_Price" class="form-control input-style" placeholder="Memory Upgrade Price">
                                    <input style="margin-top:30px;display:inherit;" type="submit" name="InsertMemory" class="btn btn-primary" value="Insert"> </form>
                            </div>
                        </div>
                    </div>
                    <hr> </div>
                <div class="tab-pane text-style" id="Update">
                    <div class="col-lg-15" style="margin-bottom: 90px">
                        <h2>Update</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Model</th>
                                        <th>Base Price</th>
                                        <th>Inventory</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                        ob_start();
                                        $sql = "select * from product";
                                        $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo
                                            "<tr><td>"  . $row["Product_ID"]. 
                                            "</td><td>" . $row["Product_Name"]. 
                                            "</td><td>" . $row["Model"].
                                            "</td><td>" . $row["Base_Price"]. 
                                            "</td><td>" . $row["Inventory"].
                                            "</td></tr>";
                                    }
                                    if($_POST["UpdateProduct_Name"])
                                                {
                                                    
                                                        $Product_ID=$_POST['Product_ID'];
                                                        $Product_Name=$_POST['Product_Name'];
                                                        
                                                        $sql = "update product
                                                                set
                                                                Product_Name= '$Product_Name'
                                                                where 
                                                                Product_ID = ".$Product_ID."";
                                                                if ($conn->query($sql) === TRUE) {
                                                                     ob_end_clean();
                                                                     $sql = "select * from product";
                                                                     $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo
                                                                            "<tr><td>"  . $row["Product_ID"].
                                                                            "</td><td>" . $row["Product_Name"].
                                                                            "</td><td>" . $row["Model"].
                                                                            "</td><td>" . $row["Base_Price"]. 
                                                                            "</td><td>" . $row["Inventory"].
                                                                            "</td></tr>";
                                                                    
                                                                }
                                                              
                                                     }
                                                }else if($_POST["UpdateModel"])
                                                {
                                                    
                                                        $Product_ID=$_POST['Product_ID'];
                                                        $Model=$_POST['Model'];
                                                        
                                                        $sql2 = "update product
                                                                set
                                                                Model= '$Model'
                                                                where 
                                                                Product_ID = ".$Product_ID."";
                                                                if ($conn->query($sql2) === TRUE) {
                                                                     ob_end_clean();
                                                                     $sql = "select * from product";
                                                                     $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo
                                                                            "<tr><td>"  . $row["Product_ID"].
                                                                            "</td><td>" . $row["Product_Name"].
                                                                            "</td><td>" . $row["Model"].
                                                                            "</td><td>" . $row["Base_Price"]. 
                                                                            "</td><td>" . $row["Inventory"].
                                                                            "</td></tr>";
                                                                    
                                                                }
                                                              
                                                     }
                                                              
                                                }else if($_POST["UpdateBase_Price"])
                                                {
                                                    
                                                       $Product_ID=$_POST['Product_ID'];
                                                        $Base_Price=$_POST['Base_Price'];
                                                        
                                                        $sql2 = "update product
                                                                set
                                                                Base_Price= '$Base_Price'
                                                                where 
                                                                Product_ID = ".$Product_ID."";
                                                                if ($conn->query($sql2) === TRUE) {
                                                                     ob_end_clean();
                                                                     $sql = "select * from product";
                                                                     $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo
                                                                            "<tr><td>"  . $row["Product_ID"].
                                                                            "</td><td>" . $row["Product_Name"].
                                                                            "</td><td>" . $row["Model"].
                                                                            "</td><td>" . $row["Base_Price"]. 
                                                                            "</td><td>" . $row["Inventory"].
                                                                            "</td></tr>";
                                                                    
                                                                }
                                                              
                                                     }
                                                              
                                                }else if($_POST["UpdateInventory"])
                                                {
                                                    
                                                         $Product_ID=$_POST['Product_ID'];
                                                        $Inventory=$_POST['Inventory'];
                                                        
                                                        $sql2 = "update product
                                                                set
                                                                Inventory= '$Inventory'
                                                                where 
                                                                Product_ID = ".$Product_ID."";
                                                                if ($conn->query($sql2) === TRUE) {
                                                                     ob_end_clean();
                                                                     $sql = "select * from product";
                                                                     $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo
                                                                            "<tr><td>"  . $row["Product_ID"].
                                                                            "</td><td>" . $row["Product_Name"].
                                                                            "</td><td>" . $row["Model"].
                                                                            "</td><td>" . $row["Base_Price"]. 
                                                                            "</td><td>" . $row["Inventory"].
                                                                            "</td></tr>";
                                                                    
                                                                }
                                                              
                                                     }
                                                              
                                                }
 
                                    ?>
                                        <form role="form" method="post">
                                            <tr>
                                                <td>
                                                    <input type="number" name="Product_ID" id="Product_ID" class="form-control" placeholder="Product_ID"> </td>
                                                <td>
                                                    <input type="text" name="Product_Name" id="Product_Name" class="form-control" placeholder="Product_Name"> </td>
                                                <td>
                                                    <input type="text" name="Model" id="Model" class="form-control" placeholder="Model"> </td>
                                                <td>
                                                    <input type="number" name="Base_Price" id="Base_Price" class="form-control" placeholder="Base_Price"> </td>
                                                <td>
                                                    <input type="number" name="Inventory" id="Inventory" class="form-control" placeholder="Inventory"> </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="submit" name="UpdateProduct_Name" class="btn btn-primary" value="Update"> </td>
                                                <td>
                                                    <input type="submit" name="UpdateModel" class="btn btn-primary" value="Update"> </td>
                                                <td>
                                                    <input type="submit" name="UpdateBase_Price" class="btn btn-primary" value="Update"> </td>
                                                <td>
                                                    <input type="submit" name="UpdateInventory" class="btn btn-primary" value="Update"> </td>
                                            </tr>
                                        </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr> </div>
                <div class="tab-pane text-style" id="Process">
                    <div class="col-lg-10" style="margin-bottom: 90px">
                        <h2>Orders</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer ID</th>
                                        <th>Product ID</th>
                                        <th>Order Date</th>
                                        <th>Final Price</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        ob_start();
                                        $sql1 = "select * from orders where Order_Status = 'Process'";
                                        $result1 = $conn->query($sql1);
                                    while ($row = $result1->fetch_assoc()) {
                                    echo
                                    "<tr><td>"  . $row["Order_ID"]. 
                                    "</td><td>" . $row["Customer_ID"]. 
                                    "</td><td>" . $row["Product_ID"].
                                    "</td><td>" . $row["Order_Date"]. 
                                    "</td><td>" . $row["Final_Price"].
                                    "</td><td>" . $row["Order_Status"].
                                    "</td></tr>";
                                    }
                                     if($_POST["ship"])
                                                {
                                                    
                                                        $Order_ID=$_POST['Order_ID'];
                                                        $sql2 = "update orders, product
                                                                set
                                                                product.Inventory=Inventory-1,orders.Order_Status = 'Shipped'
                                                                where 
                                                                Order_ID = ".$Order_ID." AND orders.Product_ID =product.Product_ID ";
                                                                if ($conn->query($sql2) === TRUE) {
                                                                    ob_end_clean();
                                                                     $sql1 = "select * from orders where Order_Status = 'Process'";
                                                                    $result1 = $conn->query($sql1);
                                                                    while ($row = $result1->fetch_assoc()) {
                                                                        echo
                                                                            "<tr><td>"  . $row["Order_ID"]. 
                                                                            "</td><td>" . $row["Customer_ID"]. 
                                                                            "</td><td>" . $row["Product_ID"].
                                                                            "</td><td>" . $row["Order_Date"]. 
                                                                            "</td><td>" . $row["Final_Price"].
                                                                            "</td><td>" . $row["Order_Status"].
                                                                            "</td></tr>";
                                                                    
                                                                }
                                                              
                                                                }
                                     }
 
                                    ?>
                                </tbody>
                            </table>
                            <div>
                                <form role="form" method="post">
                                    <input type="number" name="Order_ID" id="Order_ID" class="form-control input-style" placeholder="Order ID">
                                    <input style="margin-top:30px;display:inherit;" type="submit" name="ship" class="btn btn-primary" value="Ship"> </form>
                            </div>
                        </div>
                    </div>
                    <hr> </div>
            </div>
            <?php
$conn->close();
?>
        </div>
        <footer class="navbar navbar-inverse navbar-fixed-bottom" style="padding:0 0 0 0;margin-bottom: 0">
            <div class="container-fluid">
                <p style="margin: auto; margin-top:15px; text-align:center; color:#FFF;">This website services as the project of CSC 671.</p>
            </div>
        </footer>
</body>
<script>
   $(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});
</script>

</html>