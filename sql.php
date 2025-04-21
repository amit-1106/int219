<!-- -- User tables -->

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "int219";

// Create connection without specifying database
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($dbname);


$sql = "CREATE TABLE IF NOT EXISTS user (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}


$sql = "CREATE TABLE IF NOT EXISTS `user_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255),
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `telephone` varchar(20),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}
// $sql = "CREATE TABLE IF NOT EXISTS `user_payment` (
//   `id` int NOT NULL AUTO_INCREMENT,
//   `user_id` int NOT NULL,
//   `payment_type` varchar(50) NOT NULL,
//   `provider` varchar(100) NOT NULL,
//   PRIMARY KEY (`id`),
//   FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
// )";

// if ($conn->query($sql) === FALSE) {
//     die("Error creating user table: " . $conn->error);
// }
//  -- Product tables 
// $sql = "CREATE TABLE IF NOT EXISTS `product_category` (
//   `id` int NOT NULL AUTO_INCREMENT,
//   `name` varchar(255) NOT NULL,
//   `desc` text,
//   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//   `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//   PRIMARY KEY (`id`)
// )";

// if ($conn->query($sql) === FALSE) {
//     die("Error creating user table: " . $conn->error);
// }

// $sql = "CREATE TABLE IF NOT EXISTS `product_inventory` (
//   `id` int NOT NULL AUTO_INCREMENT,
//   `quantity` int NOT NULL,
//   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//   `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//   `deleted_at` timestamp NULL DEFAULT NULL,
//   PRIMARY KEY (`id`)
// )";
// if ($conn->query($sql) === FALSE) {
//     die("Error creating user table: " . $conn->error);
// }


$sql = "CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text,
  -- `SKU` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
  -- FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`),
  -- FOREIGN KEY (`inventory_id`) REFERENCES `product_inventory` (`id`)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_id` int,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `order_details` (`id`),
  FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS `payment_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `amount` int NOT NULL,
  `provider` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `order_details` (`id`)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}

// <!-- -- Add missing foreign key constraints -->
$sql = "ALTER TABLE `order_details` ADD FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`id`)";

$conn->query($sql);
if ($conn->error) {
    die("Error adding foreign key: " . $conn->error);
}

echo "Database and tables created successfully";
$conn->close();
?>