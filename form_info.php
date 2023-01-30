<?php
require 'C:/Users/Nur Azila/Desktop/Sem 7 (2022)/FYP Development (SignSafe)/production/phpqrcode-master/phpqrcode.php'; //include the QRcode library

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";

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

$sql = "INSERT INTO form_data VALUES (NULL,'$document_title', '$name', '$position', '$date', '$time', '$email', '$notes', '$unique_url')";

if (mysqli_query($conn, $sql)) {
    session_start();
    $last_id = $conn->insert_id;

$_SESSION['last_id'] = $last_id;

header("Location: form_upload.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>