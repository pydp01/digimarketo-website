<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conn";
// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch photos from database
$sql3 = "DELETE FROM other WHERE id=1";

if ($conn->query($sql3) === TRUE) {
    echo "Record deleted successfully";
} 
else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiMarketo</title>
</head>
<body>
</body>
</html>


<?php
// Close connection
$conn->close();
?>
