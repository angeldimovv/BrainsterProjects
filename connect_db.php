<?php
// Credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "brainsterdb";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['send'])) {
  // Form fields
  $fullName = $_POST['fullName'];
  $companyName = $_POST['companyName'];
  $email = $_POST['email'];
  $phoneNumber = $_POST['phoneNumber'];
  $studentType = $_POST['studentType'];

  $sql = "INSERT INTO hiringcomapany_app (fullName,companyName,email,phoneNumber, studentType) VALUES ('$fullName','$companyName','$email','$phoneNumber', '$studentType')";
  
  if(mysqli_query($conn, $sql)){
      echo "Вашата форма е испратена. \n Нашиот тим ќе ве исконтактира во најкраток времески рок.";
      // echo "<a href="./index.html">Test</a>"
  } else {
      echo "Error" . $sql . "" . mysqli_error($conn);
  }
  mysqli_close($conn);
}
?> 