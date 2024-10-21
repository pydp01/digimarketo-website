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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DigiMarketo</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<br>

<div class="gallery">
    <?php
    // Fetch photos from database
    $sql = "SELECT * FROM laptop";
    $result = $conn->query($sql);
    // Display photos
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div>';
            echo "<p><strong>" . $row["title"] . "</strong></p>";
            echo '<img src="' .$row["img1"]. '" alt="' . $row["img2"]. '" alt="' . $row["img3"] . '">';
            echo '<img src="' .$row["img2"]. '" alt="' . '">';
            echo '<img src="'.$row["img3"] . '"alt="image"">';
            echo '</div>';
        }
    } else {
        echo "No photos found.";
    }
    ?>
</div>


<br>
<div class="gallery">
    <?php
    // Fetch photos from database
    $sql = "SELECT * FROM pc";
    $result = $conn->query($sql);
    // Display photos
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div>';
            echo "<p><strong>" . $row["title"] . "</strong></p>";
            echo '<img src="' .$row["img1"]. '" alt="' . $row["img2"]. '" alt="' . $row["img3"] . '">';
            echo '<img src="' .$row["img2"]. '" alt="' . '">';
            echo '<img src="'.$row["img3"] . '"alt="image"">';
            echo '</div>';
        }
    } else {
        echo "No photos found.";
    }
    ?>
</div>


<br>
<div class="gallery">
    <?php
    // Fetch photos from database
    $sql = "SELECT * FROM other";
    $result = $conn->query($sql);
    // Display photos
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div>';
            echo "<p><strong>" . $row["title"] . "</strong></p>";
            echo '<img src="' .$row["img1"]. '" alt="' . $row["img2"]. '" alt="' . $row["img3"] . '">';
            echo '<img src="' .$row["img2"]. '" alt="' . '">';
            echo '<img src="'.$row["img3"] . '"alt="image"">';
            echo '</div>';
        }
    } else {
        echo "No photos found.";
    }
    ?>
</div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
