<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";
session_start();
$id=$_SESSION['last_id'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Insert data into the table
$document_title = $_POST["document_title"];
$name = $_POST["name"];
$position = $_POST["position"];
$date = $_POST["date"];
$time = $_POST["time"];
$email = $_POST["email"];
$notes = $_POST["notes"];
$unique_url = "value";

$sql = "UPDATE form_data SET document_title='$document_title', name='$name', position='$position', date='$date', time='$time', email='$email', notes='$notes', unique_url='$unique_url' WHERE id='$id' ";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "- Record Succesfully Updated!";
  

header("Location: show_data.php?id=$id");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>