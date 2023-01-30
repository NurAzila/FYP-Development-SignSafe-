

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/img.png" type="image/ico" />

    <title> Signatory Information </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
<?php
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
      session_start();
    $_SESSION['last_id']=$id;
      // Validate the input and sanitize the input to prevent SQL injection
      #if (!is_numeric($id) || $id < 1) {
          #die("Invalid ID");
      #}

      $query = "SELECT id, document_title, name, position, date, time, email, notes FROM form_data WHERE id = $id";
        } else {
        die("No ID provided");
        }

$result = $mysqli->query($query);        
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $document_title = $row["document_title"];
        $name = $row["name"];
        $time = $row["time"];
        $position = $row["position"];
        $date = $row["date"];
        $email = $row["email"];
        $notes = $row["notes"];

            }

/*freeresultset*/
$result->free();
}

?>

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
                            <h3>Update Document</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>


            <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                    <div class="clearfix"></div>
                                <div class="x_content">
                                    <form action="update.php" method="post">
                                        <span class="section">Signature Information</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="document_title">Document Title<span class="required"> *</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="document_title" type="text" id="document_title" required="required" value="<?php echo $document_title; ?>" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Name<span class="required"> *</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="text" id="name" name="name" required="required" value="<?php echo $name; ?>"/></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="position">Position</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="text" id="position" name="position" placeholder="Optional" value="<?php echo $position; ?>"/></div>
                                        </div>                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="date">Date<span class="required"> *</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='date' type="date" id="date" name="date" required='required'value="<?php echo $date; ?>"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="time">Time<span class="required"> *</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='time' type="time" id="time" name="time" required='required' value="<?php echo $time; ?>"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="email">Email</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="email" id="email" placeholder="Optional" class='email' type="email" value="<?php echo $email; ?>" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align" for="notes">Notes</label>
                                            <div class="col-md-6 col-sm-6">
                                                <textarea id="notes" name='notes'><?php echo $notes; ?></textarea></div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' class="btn btn-primary">Submit</button>
                                                    <button type='reset' class="btn btn-success">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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