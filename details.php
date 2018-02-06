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
        <style media="screen">
        .jumbotron p {
            display: inline-block;
          }
        </style>
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
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown active">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" id="cName">User: <?php echo $customerName;?><span class="caret"></span></a>
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

<?php
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "StoreProject";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
  	die("Connection failed: ". $conn->connect_error);
  }

  $productId = intval($_GET['id']);
  $sql = "select * from product where Product_ID = '" . $productId . "'";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="container" style="margin-bottom:80px">
        <div class="jumbotron">
            <h1 id="pName">' . $row["Product_Name"]. '</h1>
            <p id="description" class="lead" style="display:inherit;">' . $row["Description"]. '</p>
            <h4 class="pull-right" style="text-align: right;">Price: $<span id="price" data-value="' . $row["Base_Price"]. '">' . $row["Base_Price"]. '</span></h4>

            <p><a class="btn btn-lg btn-primary" onclick="orderBuy()" role="button" >Buy today</a></p>
            <p><a class="btn btn-lg btn-success" onclick="orderCart()" role="button" >Add to Cart</a></p>
            <p><a class="btn btn-lg btn-danger" onclick="orderWishlist()" role="button"" ><span class="glyphicon glyphicon-heart"></span>Add to wishlist</a></p>


        </div>
        <div class="row marketing">
          <div class="col-lg-6">
            <h4>Processor Name and more options</h4>
            <select id="processor" class="form-control" onchange="showPrice(this.value)">
              <option value="0.00" data-value="' . $row[Base_Processor]. '">Base processor: ' . $row[Base_Processor]. '</option>
              <option value="200.00" data-value="Intel Core i5">Upgrade option1: Intel Core i5 + $200.00</option>
              <option value="500.00" data-value="Intel i7">Upgrade option2: Intel Core i7 + $500.00</option>
            </select>

            <h4>Operating System and more options</h4>
            <select id="os" class="form-control" onchange="showPrice(this.value)">
              <option value="0.00" data-value="' . $row[Base_OS]. '">Base Operating System: ' . $row[Base_OS]. '</option>
              <option value="200.00" data-value="Windows10 Home">Upgrade option1: Windows10 Home + $200.00</option>
              <option value="400.00"data-value="Windows10 Pro">Upgrade option2: Windows10 Pro + $400.00</option>
            </select>

            <h4>Base Memory and more options</h4>
            <select id="memory" class="form-control" onchange="showPrice(this.value)">
              <option value="0.00" data-value="' . $row[Base_Memory]. '">Base Memory: ' . $row[Base_Memory]. '</option>
              <option value="79.00" data-value="12 GB">Upgrade option1: 12 GB+ $79.00</option>
              <option value="159.00" data-value="16 GB">Upgrade option2: 16 GB + $159.00</option>
            </select>
          </div>

          <div class="col-lg-6">
            <h4>Base disk capacity and more options</h4>
            <select id="disk" class="form-control" onchange="showPrice(this.value)">
              <option value="0" data-value="' . $row[Base_Disk]. '">Base disk: ' . $row[Base_Disk]. '</option>
              <option value="149.00" data-value="500 GB HHD">Upgrade option1: 500 GB HHD+ $149.00</option>
              <option value="299.00" data-value="1 TB HHD">Upgrade option2: 1 TB HHD + $299.00</option>
            </select>

            <h4>Weight</h4>
            <select id="weight" class="form-control">
              <option value="0" data-value="' . $row[weight]. '">Base Weight: ' . $row[weight]. '  lbs</option>
            </select>

            <h4>Size</h4>
            <select id="size" class="form-control">
              <option value="0" data-value="' . $row[size]. '">Base Size: ' . $row[size]. '  inch</option>
            </select>
          </div>
        </div>

      </div>';
    }
  } else {
    echo "Error, page not found!";
  }
  $conn->close();
?>

<!-- footer -->
<footer class="navbar navbar-inverse navbar-fixed-bottom" style="padding:0 0 0 0;margin-bottom: 0">
        <div class="container-fluid">
            <p style="margin: auto; margin-top:15px; text-align:center; color:#FFF;">This website services as the project of CSC 671.</p>
        </div>
</footer>
<script type="text/javascript">
function showPrice(str) {
  var basePrice = $('#price').data('value');
  var osprice = $("#os option:selected").val();
  var processorprice = $("#processor option:selected").val();
  var diskprice = $("#disk option:selected").val();
  var memoryprice = $("#memory option:selected").val();
  var price = parseFloat(basePrice) + parseFloat(processorprice) + parseFloat(diskprice) + parseFloat(memoryprice) + parseFloat(osprice);
  document.getElementById("price").innerHTML = price;
};
function orderCart() {
  var os = $("#os option:selected").data("value");
  var processor = $("#processor option:selected").data("value");
  var disk= $("#disk option:selected").data("value");
  var memory = $("#memory option:selected").data("value");
  var basePrice = $("#price").text();
  var sendInfo = {
    action: "addtocart",
    OS: os,
    Processor: processor,
    Disk: disk,
    Memory: memory,
    Price: basePrice,
    ProductID: <?php echo $productId ?>
  };
  $.ajax({
           type: 'POST',
           url: '/csc671/addorder.php',
          // dataType: "json",
           success: function (msg) {
            // alert(msg);
             window.location.href = 'order.php?t=Cart'
           },
           error: function (err) {
             alert(err.responseText);},
           data: sendInfo
       });
};
function orderBuy() {
  var os = $("#os option:selected").data("value");
  var processor = $("#processor option:selected").data("value");
  var disk= $("#disk option:selected").data("value");
  var memory = $("#memory option:selected").data("value");
  var basePrice = $("#price").text();
  var sendInfo = {
    action: "Buy",
    OS: os,
    Processor: processor,
    Disk: disk,
    Memory: memory,
    Price: basePrice,
    ProductID: <?php echo $productId ?>
  };
  $.ajax({
           type: 'POST',
           url: '/csc671/addorder.php',
          // dataType: "json",
           success: function (msg) {
          //   alert(msg);
             window.location.href = 'order.php?t=Buy'},
           error: function (err) {
             alert(err.responseText);},
           data: sendInfo
       });
};
function orderWishlist() {
  var os = $("#os option:selected").data("value");
  var processor = $("#processor option:selected").data("value");
  var disk= $("#disk option:selected").data("value");
  var memory = $("#memory option:selected").data("value");
  var basePrice = $("#price").text();
  var sendInfo = {
    action: "addtowishlist",
    OS: os,
    Processor: processor,
    Disk: disk,
    Memory: memory,
    Price: basePrice,
    ProductID: <?php echo $productId ?>
  };
  $.ajax({
           type: 'POST',
           url: '/csc671/addorder.php',
          // dataType: "json",
           success: function (msg) {
            // alert(msg);
             window.location.href = 'order.php?t=Wishlist'},
           error: function (err) {
             alert(err.responseText);},
           data: sendInfo
       });
};
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
