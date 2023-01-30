<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/img.png" type="image/ico" />
<?php

 session_start();
 echo $_SESSION['status'];
 error_reporting(E_ERROR | E_PARSE);

?>
    <title> Signatory Information  </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-qrcode"></i> <span> SignSafe </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/image.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2> Nur Azila </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Sign <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="form_validation.php">Create Document</a></li>
                      <li><a href="form_upload.php">Upload Document</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="images/img.png" alt="">Nur Azila
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="user.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Generate QR Code</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Signatory Information <?php echo $_SESSION['status']; session_destroy(); ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="container">
      <?php
        // Connect to the database
        $username = "root";
    $password = "";
    $database = "info";
    $mysqli = new mysqli("localhost", $username, $password, $database);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

      if (isset($_GET['id'])) {
        // Retrieve the ID from the GET parameter
      $id = $_GET['id'];
      // Validate the input and sanitize the input to prevent SQL injection
      #if (!is_numeric($id) || $id < 1) {
          #die("Invalid ID");
      #}

      $query = "SELECT id, document_title, name, position, date, time, email, notes FROM form_data WHERE id = $id";
        } else {
        die("No ID provided");
        }

        // SQL query to retrieve data
        #$sql = "SELECT id, firstname, lastname FROM MyGuests";
        $result = $mysqli->query($query);

        // Loop through the data and add a row for each record
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='guest-card'>";
              echo "<div class='guest-card-header'>";
              echo "</div>";
              echo "<div class='guest-card-body'>";
              echo "<p><b>Document Title:</b> " . $row["document_title"] . "</p>";
              echo "<p><b>Name:</b> " . $row["name"] . "</p>";
              echo "<p><b>Position:</b> " . $row["position"] . "</p>";
              echo "<p><b>Date:</b> " . $row["date"] . "</p>";
              echo "<p><b>Time:</b> " . $row["time"] . "</p>";
              echo "<p><b>Email:</b> " . $row["email"] . "</p>";
              echo "<p><b>Notes:</b> " . $row["notes"] . "</p>";
              echo "</div>";
              echo "</div>";
          }
      } else {
            echo "0 results";
        }
        // Close the database connection
        $mysqli->close();
      ?>

      <?php
require_once "phpqrcode/qrlib.php";

$path = "images/qrcode/";
$file = $path . uniqid() . ".png";

$text = "http://127.0.0.1:8080/edsa-FYP/production/show_data.php?id=$id";

QRcode::png($text, $file, 'L', 10, 2);

print "<center><img src=\"{$file}\">";
print "<a href=\"{$file}\" download>";
print "<img src=\"download.png\" width=\"75\" height=\"75\"></center>";

// Create connection
 // Connect to the database
    $username = "root";
    $password = "";
    $database = "upload";
    $mysqli = new mysqli("localhost", $username, $password, $database);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

$query = "SELECT name , path FROM uploads WHERE form_data_id = $id";
$result = $mysqli->query($query);
// Check connection
if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              
              $documentpath = $row["path"] ;
              $documentname = $row["name"] ;
        
          }
      } else {
            echo "0 results";
        }
        // Close the database connection
        $mysqli->close();
        $str="http://127.0.0.1:8080/edsa-FYP/production/".$documentpath;
?>
                    <br />
<a href="<?php echo $str; ?>" target="_blank">Click here to open file: <?php echo $documentname; ?></a>


                    <br />
                    <br />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Dropzone.js -->
    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

</body>
</html>