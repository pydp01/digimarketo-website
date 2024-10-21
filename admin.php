<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload</title>
<link rel="icon" type="image/x-icon" href="img\logo.png">
<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include "header.php";
    ?>
<br><br>
<h1 class="n1">Laptop Details filled here</h1>
<br>
<h2>Upload Photo</h2>
<form action="admin.php" method="post" enctype="multipart/form-data">
    <label for="comment">Title</label><br>
    <textarea id="comment" name="comment" rows="2" cols="20"></textarea>
    <br><br>
    <input type="file" name="photo" accept="image/*" required>
    <input type="file" name="photo1" accept="image/*" required>
    <input type="file" name="photo2" accept="image/*" required>
    <br>
    <br>
    <button type="submit" name="submit">Upload</button>
</form>
<a href="delete.php"><button type="delete">Delete Recent Data</button></a>
<br>
<hr>


<h1 class="n1">PC Details filled here</h1>
<br>
<h2>Upload Photo</h2>
<form action="admin.php" method="post" enctype="multipart/form-data">
    <label for="comment">Title</label><br>
    <textarea id="comment" name="pc" rows="2" cols="20"></textarea>
    <br><br>
    <input type="file" name="pc1" accept="image/*" required>
    <input type="file" name="pc2" accept="image/*" required>
    <input type="file" name="pc3" accept="image/*" required>
    <br>
    <br>
    <button type="submit" name="submit1">Upload</button>
</form>
<a href="delete1.php"><button type="delete">Delete Recent Data</button></a>
<br>
<hr>

<h1 class="n1">Other Hardware Details filled here</h1>
<br>
<h2>Upload Photo</h2>
<form action="admin.php" method="post" enctype="multipart/form-data">
    <label for="comment">Title</label><br>
    <textarea id="comment" name="other" rows="2" cols="20"></textarea>
    <br><br>
    <input type="file" name="other1" accept="image/*" required>
    <input type="file" name="other2" accept="image/*" required>
    <input type="file" name="other3" accept="image/*" required>
    <br>
    <br>
    <button type="submit" name="submit2">Upload</button>
</form>
<a href="delete2.php"><button type="delete">Delete Recent Data</button></a>
<br>
<hr>
<a href="signin.php" id="admin">Create Another Admin</a>
<br><br>
<hr>
<?php
    include "footer.php";
?>
</body>
</html>




<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $targetDir = "";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $targetFile1 = $targetDir . basename($_FILES["photo1"]["name"]);
    $targetFile2 = $targetDir . basename($_FILES["photo2"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($targetFile1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($targetFile2,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    $check1 = getimagesize($_FILES["photo1"]["tmp_name"]);
    $check2 = getimagesize($_FILES["photo2"]["tmp_name"]);
    if($check !== false AND $check1 !== false AND $check2 !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check file size (max 5MB)
    if ($_FILES["photo"]["size"] > 5000000 AND $_FILES["photo1"]["size"] > 5000000 AND $_FILES["photo2"]["size"] > 5000000 ) {
        echo "Sorry, your Photo Size is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your Photo was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile) AND move_uploaded_file($_FILES["photo1"]["tmp_name"], $targetFile1) AND move_uploaded_file($_FILES["photo2"]["tmp_name"], $targetFile2)) {
            echo "The Photo ". htmlspecialchars( basename( $_FILES["photo"]["name"])). basename( $_FILES["photo1"]["name"]).  basename( $_FILES["photo2"]["name"])." has been uploaded.";

            // Insert photo information into database
            $photoName = $_FILES["photo"]["name"];
            $photoName1 = $_FILES["photo1"]["name"];
            $photoName2 = $_FILES["photo2"]["name"];
            $photoPath = $targetFile;
            $comment = $_POST["comment"];
            $sql = "INSERT INTO laptop (title,img1, img2, img3) VALUES ('$comment','$photoName','$photoName1','$photoName2')";      
            if ($conn->query($sql) == TRUE) {
                echo "You can check your photo.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an problem uploading your photo.";
        }
    }
}



// Check if the form is submitted
if (isset($_POST["submit1"])) {
    $targetDir = "";
    $targetFile = $targetDir . basename($_FILES["pc1"]["name"]);
    $targetFile1 = $targetDir . basename($_FILES["pc2"]["name"]);
    $targetFile2 = $targetDir . basename($_FILES["pc3"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($targetFile1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($targetFile2,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["pc1"]["tmp_name"]);
    $check1 = getimagesize($_FILES["pc2"]["tmp_name"]);
    $check2 = getimagesize($_FILES["pc3"]["tmp_name"]);
    if($check !== false AND $check1 !== false AND $check2 !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check file size (max 5MB)
    if ($_FILES["pc1"]["size"] > 5000000 AND $_FILES["pc2"]["size"] > 5000000 AND $_FILES["pc3"]["size"] > 5000000 ) {
        echo "Sorry, your Photo Size is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your Photo was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["pc1"]["tmp_name"], $targetFile) AND move_uploaded_file($_FILES["pc2"]["tmp_name"], $targetFile1) AND move_uploaded_file($_FILES["pc3"]["tmp_name"], $targetFile2)) {
            echo "The Photo ". htmlspecialchars( basename( $_FILES["pc1"]["name"])). basename( $_FILES["pc2"]["name"]).  basename( $_FILES["pc3"]["name"])." has been uploaded.";

            // Insert photo information into database
            $photoName = $_FILES["pc1"]["name"];
            $photoName1 = $_FILES["pc2"]["name"];
            $photoName2 = $_FILES["pc3"]["name"];
            $photoPath = $targetFile;
            $comment = $_POST["pc"];
            $sql = "INSERT INTO pc (title,img1, img2, img3) VALUES ('$comment','$photoName','$photoName1','$photoName2')";      
            if ($conn->query($sql) == TRUE) {
                echo "You can check your photo.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an problem uploading your photo.";
        }
    }
}



// Check if the form is submitted
if (isset($_POST["submit2"])) {
    $targetDir = "";
    $targetFile = $targetDir . basename($_FILES["other1"]["name"]);
    $targetFile1 = $targetDir . basename($_FILES["other2"]["name"]);
    $targetFile2 = $targetDir . basename($_FILES["other3"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($targetFile1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($targetFile2,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["other1"]["tmp_name"]);
    $check1 = getimagesize($_FILES["other2"]["tmp_name"]);
    $check2 = getimagesize($_FILES["other3"]["tmp_name"]);
    if($check !== false AND $check1 !== false AND $check2 !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check file size (max 5MB)
    if ($_FILES["other1"]["size"] > 5000000 AND $_FILES["other2"]["size"] > 5000000 AND $_FILES["other3"]["size"] > 5000000 ) {
        echo "Sorry, your Photo Size is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your Photo was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["other1"]["tmp_name"], $targetFile) AND move_uploaded_file($_FILES["other2"]["tmp_name"], $targetFile1) AND move_uploaded_file($_FILES["other3"]["tmp_name"], $targetFile2)) {
            // echo "The Photo ". htmlspecialchars( basename( $_FILES["other1"]["name"])). basename( $_FILES["other2"]["name"]).  basename( $_FILES["other3"]["name"])." has been uploaded.";

            // Insert photo information into database
            $photoName = $_FILES["other1"]["name"];
            $photoName1 = $_FILES["other2"]["name"];
            $photoName2 = $_FILES["other3"]["name"];
            $photoPath = $targetFile;
            $comment = $_POST["other"];
            $sql = "INSERT INTO other (title,img1, img2, img3) VALUES ('$comment','$photoName','$photoName1','$photoName2')";      
            if ($conn->query($sql) == TRUE) {
                echo "You can check your photo.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an problem uploading your photo.";
        }
    }
}
// Close connection
$conn->close();
?>

