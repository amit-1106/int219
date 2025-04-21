<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="market.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Sell Product</title>
    <style>
        .se{
            margin-top: 3rem;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="./images/—Pngtree—100 organic label_4130500.png" alt="Logo">
            </div>
            <ul class="nav-links">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="sell.php">Sell</a></li>
                <li><a href="contact1.php">Contact</a></li>
            </ul>
            <div class="auth-buttons">
                <button class="btn login">Login/SignUp</button>
            </div>
        </nav>
    </header>

    <?php 
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: marketlogin.php");
    exit();
}

if (!empty($_GET['error'])) {
    echo "<p style='color: red;'>❌ " . htmlspecialchars($_GET['error']) . "</p>";
}

if (isset($_GET['success']) && $_GET['success'] == "1") {
    echo "<p style='color: green;'>✅ Product listed successfully!</p>";
}
?>

<section class="sell-section se" id="sell">
    <div class="sell-container">
        <h3>Sell Your Products</h3>
        
        <?php if (isset($_GET['success']) && $_GET['success'] == "1"): ?>
            <p class="success-message">✅ Product listed successfully!</p>
        <?php endif; ?>
        
        <?php if (!empty($_GET['error'])): ?>
            <p class="error-message">❌ <?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form id="sellForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Product Name" required>
            <input type="number" name="price" placeholder="Price" required min="1" step="0.01">
            <input type="number" name="quantity" placeholder="Quantity" required min="1">
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="file" name="product_image" accept="image/*" required>
            <button type="submit" class="submit-btn">List Product</button>
        </form>
    </div>
</section>

<div class="cart">
    <div class="cart-header">
        <i class="fa-solid fa-cart-shopping"></i>
        <h3>Your Cart (<span id="cart-count">0</span>)</h3>
        <button class="close-cart">&times;</button>
    </div>
    <div class="cart-items"></div>
    <form class="cart-total"  method="POST"  action="checkout.php">
        <h4>Total: ₹<span id="cart-total">0</span></h4>
        <button class="checkout-btn">Proceed to Checkout</button>
            </form>
</div>

    <div class="cart-icon">
        <i style="color: purple" class="fa-solid fa-cart-shopping"></i><span class="cart-counter">0</span>
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-section about">
                <h4>About Us</h4>
                <p>Connecting farmers directly with consumers</p>
            </div>
            <div class="footer-section links">
                <h4>Quick Links</h4>
                <ul style="list-style-type: none; margin-left: 12px;">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#sell">Sell</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h4>Contact Us</h4>
                <p>Email: rajsudhanshu106@gamil.com</p>
                <p>Phone: +91 91550 33078</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script src="market.js"></script>
</body>

</html>
