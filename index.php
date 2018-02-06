<html>
<head>
    <meta charset="utf-8">
    <title>671 Computer</title>
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

      <form class="navbar-form navbar-right">
        <a class="btn btn-default navbar-btn-right"   href="signup.php" role="button">Sign up</a>
      </form>
    </div>
    </nav>
    <div class="col-md-7 col-md-offset-2">
        <div class="col-md-6 col-md-offset-3 panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#Adminstration" aria-controls="Adminstration" role="tab" data-toggle="tab">Adminstration Login</a></li>

                <li role="presentation"><a href="#Customer" aria-controls="Customer" role="tab" data-toggle="tab">Customer Login</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Adminstration">
                <form role="form" method="post">
                    <div class="form-group">
                        <br>
                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Name" value="">
                        <br>
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="login-submit-adm" id="login-submit" tabindex="4" class="form-control btn btn-primary" value="Log In">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="Customer">
                <form role="form" method="post">
                    <div class="form-group">
                        <br>
                        <input type="text" name="Name" id="Name" tabindex="1" class="form-control" placeholder="username">
                        <br>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="login-submit-customer" id="login-submit" tabindex="4" class="form-control btn btn-primary" value="Sign In">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <footer class="navbar navbar-inverse navbar-fixed-bottom" style="padding:0 0 0 0;margin-bottom: 0">
        <div class="container-fluid">
            <p style="margin: auto; margin-top:15px; text-align:center; color:#FFF;">This website services as the project of CSC 671.</p>
        </div>
    </footer>

<?php
    if($_POST["login-submit-adm"])
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "StoreProject";
        $conn = new mysqli($servername, $username, $password, $dbname);

        $username1=$_POST['username'];
        $password1=$_POST['password'];
         $query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username1' AND
         password = '$password1'");

           if(mysqli_num_rows($query) > 0){
               $url = 'admin.php';
              echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';

        }else{
    // do something
            if (!mysqli_query($con,$query))
            {
                    //die('Error: ' . mysqli_error($con));
                $message = "WRONG";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }

    }

   if($_POST["login-submit-customer"])
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "StoreProject";
        $Name=$_POST['Name'];
        $cookie_customer = $_POST['Name'];//set cookie for customer
        setcookie("customerName", $cookie_customer, time() + (86400 * 30), "/"); // 86400 = 1 day

        $conn = new mysqli($servername, $username, $password, $dbname);

        $query = mysqli_query($conn, "SELECT * FROM customer WHERE Name = '$Name'");

        if(mysqli_num_rows($query) > 0){

            $url = 'homepage.php';
              echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
        }else{
    // do something
            if (!mysqli_query($con,$query))
            {
                   $message = "WRONG";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }


    }

       $conn->close();
  ?>
</body>

</html>
