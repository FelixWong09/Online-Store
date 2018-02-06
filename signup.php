<!DOCTYPE html>
<html>
<?php
    session_start();
    ?>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-inverse">

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">CSC671 Computer</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"></button>
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </div>
        </nav>
        <div >
            <div class="jumbotron" style="margin-bottom:70px">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <form role="form" method="post">

                            <legend class="text-center">Register</legend>

                            <fieldset>

                                <div class="form-group col-md-12">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" name="Name" id="Name" placeholder="Name">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Shipping_Address">Shipping Address</label>
                                    <input type="text" class="form-control" name="Shipping_Address" id="Shipping_Address" placeholder="Shipping Address">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Billing_Address">Billing Address</label>
                                    <input type="text" class="form-control" name="Billing_Address" id="Billing_Address" placeholder="Billing Address">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Credit_Card_No">Credit Card Number</label>
                                    <input type="number" class="form-control" name="Credit_Card_No" id="Credit_Card_No" placeholder="Credit Card Number">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Exp_Date">Expiration Date</label>
                                    <input type="text" class="form-control" name="Exp_Date" id="Exp_Date" placeholder="Expiration Date">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="found_site">How did you find out about the site?</label>
                                    <select class="form-control" name="" id="found_site">
                                <option>Company</option>
                                <option>Friend</option>
                                <option>Colleague</option>
                                <option>Advertisement</option>
                                <option>Google Search</option>
                                <option>Online Article</option>
                                <option value="other" >Other</option>
                            </select>
                                </div>

                                <div class="form-group col-md-12 hidden">
                                    <label for="specify">Please Specify</label>
                                    <textarea class="form-control" id="specify" name=""></textarea>
                                </div>

                            </fieldset>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                    <input type="checkbox" value="" id="">
                                    I accept the <a href="#">terms and conditions</a>.
                                </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-5">
                                    <input type="submit" name="go" class="btn btn-primary btn-lg" value="Sign Up">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        <footer class="navbar navbar-inverse navbar-fixed-bottom" style="padding:0 0 0 0;margin-bottom: 0">
        <div class="container-fluid">
            <p style="margin: auto; margin-top:15px; text-align:center; color:#FFF;">This website services as the project of CSC 671.</p>
        </div>
    </footer>
  


   <?php
    if($_POST["go"])
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "StoreProject";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
	       die("Connection failed: ". $conn->connect_error);
        }
        
        //$Customer_ID=$_POST['Customer_ID'];
        
        $Name=$_POST['Name'];
        $Shipping_Address=$_POST['Shipping_Address'];
        $Billing_Address=$_POST['Billing_Address'];
        $Credit_Card_No=$_POST['Credit_Card_No'];
        $Exp_Date=$_POST['Exp_Date'];
        $sql="INSERT INTO customer (Customer_ID,Name,Shipping_Address,Billing_Address,Credit_Card_No,Exp_Date)
        VALUES
        (NULL,'$Name','$Shipping_Address','$Billing_Address','$Credit_Card_No','$Exp_Date')";
        //echo "'$Credit_Card_No'";
        $sql1 = "select Customer_ID from customer where Credit_Card_No = $Credit_Card_No";
        echo $sql1;
        $result1 = $conn->query($sql1);
        //$res = $result1->fetch_array();
        //echo $res['Customer_ID'];
        
        while ($row = $result1->fetch_assoc()) {
            $_SESSION['variable_name'] = $row["Customer_ID"];
                                        echo $row["Customer_ID"];
                                    }
        if ($conn->query($sql) === TRUE) {
            //echo $result1;
             $url = 'index.php';
              echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
        
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        
        
        echo "<a href='page2.php?var=data>Click here to go to the home page";
        

     $conn->close();
        }

    ?>






    </body>

</html>
