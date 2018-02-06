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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>671 Computer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script>
          function productSearch(str, val) {
              if (val == null) {
                val= -1;
              } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("productList").innerHTML = this.responseText;
                    } else {
                       console.log("Error", this.statusText);
                    }
                };
                xmlhttp.open("GET","search.php?t=1&v="+val+"&a="+str,true);
                xmlhttp.send();
              //   $.ajax({
              //     type: "GET",
              //     url: "search.php?q"+val,
              //     //data:"addr_id="+selected+"&funId=9",
              //     success: function () {
              //     alert("success"); //<-- to display, parameter values, which was passed for this request
              //     }
              // });
              }
          };
          function searchBytype(str1, str2) {
              if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
              } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("productList").innerHTML = this.responseText;
                  } else {
                     console.log("Error", this.statusText);
                  }
              };
              xmlhttp.open("GET","search.php?t=0&v="+str2+"&a=Model",true);
              xmlhttp.send();
          };
        </script>
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
        <li class="active"><a href="homepage.php">Home </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Product <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a onclick="searchBytype('Model','Tablet')">Tablet</a></li>
            <li><a onclick="searchBytype('Model','Hybrid')">Hybrid</a></li>
            <li><a onclick="searchBytype('Model','Laptop')">Laptop</a></li>
          </ul>
        </li>
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

<div class="container-fluid" style="margin-right: 3%;margin-top:50px; margin-bottom:80px;">
<div class="row ">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <h3 style="display:block; margin-top: 40px ">Specific Search</h3>
              <label style="display:block; margin-top: 30px">Search by Price</label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" class="form-control" placeholder="Max Price" id="maxprice">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onclick="productSearch('Base_price',document.getElementById('maxprice').value)">Go</button>
                </span>
              </div>
              <label style="display:block; margin-top: 30px">Search by Weight</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Weight" id="weight">
                <span class="input-group-addon">lbs</span>
                <span class="input-group-btn">
                    <button class="btn btn-primary " type="button" onclick="productSearch('weight',document.getElementById('weight').value)">Go</button>
                </span>
              </div>
              <label style="display:block; margin-top: 30px">Search by Size</label>
              <div class="input-group" style="margin-bottom: 30px;">
                <input type="text" class="form-control" placeholder="Size" id="size">
                <span class="input-group-addon">inch</span>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onclick="productSearch('size',document.getElementById('size').value)">Go</button>
                </span>
              </div>
            </li>
          </ul>
        </nav>

<!--  The details of products begins -->
<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt3 row text-center">
<div id="productList">
<!-- Default -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "StoreProject";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    	die("Connection failed: ". $conn->connect_error);
    }

    $sql =  "select * from product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4">
          <div class="thumbnail">
           <a href = ""></a>
            <img src="img/' . $row["Model"]. '.jpg">
            <div class="caption">
              <h3>' . $row["Product_Name"]. ' </h3>
              <p class="Discription">
                ' . $row["Description"]. '
              </p>
              <p><a href="details.php?id=' . $row["Product_ID"]. '" class="btn btn-primary" role="button">Detail</a></p>
            </div>
          </div>
        </div>';
      }
    }
    echo '</div>';
    $conn->close();
?>
<!-- End of productList -->
</div>
<!-- End of row -->
</div>
<!-- End of container-fluid -->
</div>



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
