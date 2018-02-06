<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "StoreProject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: ". $conn->connect_error);
}

$attr = strval($_GET['a']);
$type = intval($_GET['t']);
//echo $type;
if ($type == 1) {
  $value = intval($_GET['v']);
  $sql = "select * from product where " . $attr. "< " . $value;
} else {
  $value = strval($_GET['v']);
  $sql = "select * from product where " . $attr. "= '" . $value . "'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo '<div class="col-md-4">
      <div class="thumbnail">
       <a href = ""></a>
        <img src="img/' . $row["Model"]. '.jpg">
        <div class="caption">
          <h3>' . $row["Product_Name"]. ' </h3>
          <p class="Description">
            ' . $row["Description"]. '
          </p>
          <p><a href="details.php?id=' . $row["Product_ID"]. '" class="btn btn-primary" role="button">Detail</a></p>
        </div>
      </div>
    </div>';
  }
}
$conn->close();
?>
