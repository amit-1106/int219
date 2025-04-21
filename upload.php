<?php
session_start();
$servername = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$database = "login_register";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: marketlogin.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // User ID from session
    $product_name = trim($_POST['product_name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $description = trim($_POST['description']);

    // File Upload Handling
    $target_dir = "uploads/";
    $image_name = basename($_FILES["product_image"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = array("jpg", "jpeg", "png", "gif");

    // Validate file type
    if (!in_array($imageFileType, $allowed_types)) {
        header("Location: sell.php?error=Invalid file type. Only JPG, JPEG, PNG & GIF are allowed.");
        exit();
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        // Insert into database
        $query = "INSERT INTO sell (user_id, product_name, price, quantity, description, product_image) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isdiss", $user_id, $product_name, $price, $quantity, $description, $target_file);

        if ($stmt->execute()) {
            header("Location: sell.php?success=1");
        } else {
            header("Location: sell.php?error=Database error. Try again.");
        }
        $stmt->close();
    } else {
        header("Location: sell.php?error=Error uploading image.");
    }
}
?>
