<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$last_id=$_SESSION['last_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upload";

if(isset($_FILES['document'])){
  $errors= array();
  for($i=0;$i<count($_FILES['document']['name']);$i++)
  {
    $file_name = $_FILES['document']['name'][$i];
    $file_size = $_FILES['document']['size'][$i];
    $file_tmp = $_FILES['document']['tmp_name'][$i];
    $file_type = $_FILES['document']['type'][$i];
    $file_ext=strtolower(end(explode('.',$_FILES['document']['name'][$i])));
    $expensions= array("pdf","doc","docx","jpg","jpeg","png");
    if(in_array($file_ext,$expensions)=== false){
      $errors[]="Extension not allowed, please choose a PDF or Word or Image file only.";
    }
    if(empty($errors)==true) {
      move_uploaded_file($file_tmp,"uploads/".$file_name);
      // Insert information into the 'uploads' table
      $path = "uploads/".$file_name;
      $sql = "INSERT INTO uploads VALUES (NULL,'$file_name', '$path', '$file_type', $file_size, NOW(),'$last_id')";
      // Connect to your database and execute the query

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
      if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    header('location: index.php');
      } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

mysqli_close($conn);
    }else{
      print_r($errors);
    }
  }
}

?>