<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="edit_profile.css">
</head>
<body>
<?php include '../header.php'; ?>

<?php
if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Please login to access this page.');</script>";
    echo "<script>window.location.href = 'marketlogin.php';</script>";
    exit();
}
// Database connection - Updated with your database name
$db_host = "127.0.0.1";
$db_name = "int219";  // Your specific database name
$db_user = "root";
$db_pass = "";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get current user information from the 'user' table
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, first_name, last_name, email FROM user WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize variables
$message = "";
$errors = [];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($first_name)) {
        $errors[] = "First name is required";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if email is already in use by another user
    if (!empty($email) && $email !== $user['email']) {
        $stmt = $pdo->prepare("SELECT id FROM user WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user_id]);
        if ($stmt->rowCount() > 0) {
            $errors[] = "Email is already in use";
        }
    }

    // Password change (optional)
    if (!empty($new_password)) {
        // Verify current password
        $stmt = $pdo->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->execute([$user_id]);
        $current_hash = $stmt->fetchColumn();

        if (empty($current_password)) {
            $errors[] = "Current password is required to set a new password";
        } elseif (!password_verify($current_password, $current_hash)) {
            $errors[] = "Current password is incorrect";
        } elseif (empty($confirm_password)) {
            $errors[] = "Please confirm your new password";
        } elseif ($new_password !== $confirm_password) {
            $errors[] = "New passwords do not match";
        } elseif (strlen($new_password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
    }

    // If no errors, update the user information
    if (empty($errors)) {
        try {
            $pdo->beginTransaction();

            // Update basic info
            $stmt = $pdo->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
            $stmt->execute([$first_name, $last_name, $email, $user_id]);

            // Update password if requested
            if (!empty($new_password)) {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");
                $stmt->execute([$password_hash, $user_id]);
            }

            $pdo->commit();
            $message = "Profile updated successfully!";
            
            // Update session variables to reflect changes
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            
            // Refresh user data
            $stmt = $pdo->prepare("SELECT username, first_name, last_name, email FROM user WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>
    <div class="container">
        <h1>Edit Profile</h1>
        
        <?php if (!empty($message)): ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                <small>Username cannot be changed</small>
            </div>
            
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            
            <h2>Change Password (Optional)</h2>
            
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password">
            </div>
            
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password">
                <small>Leave blank to keep your current password</small>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="profile.php" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <?php include '../footer.php'; ?>
    </body>
</html>
