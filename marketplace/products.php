<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "int219";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all available categories for the filter
$categoriesQuery = "SELECT DISTINCT category FROM product WHERE deleted_at IS NULL ORDER BY category";
$categoriesResult = $conn->query($categoriesQuery);
$categories = [];
while ($row = $categoriesResult->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Check if a category filter is applied
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Prepare the SQL query based on filter
$sql = "SELECT id, name, COALESCE(image_url, 'https://example.com/default.jpg') AS image,
         category, `desc` AS description, cost_price AS original_price,
         selling_price AS current_price, created_at
        FROM product
        WHERE deleted_at IS NULL";

// Add category filter if selected
if (!empty($categoryFilter)) {
    $sql .= " AND category = '" . $conn->real_escape_string($categoryFilter) . "'";
}

// Execute the query
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
}

.products {
    padding: 5rem 5%;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.product-card {
    background: #fff;
    border: 1px solid rgb(44, 95, 45, 0.3);
    border-radius: 10px;
    overflow: hidden;
    /* padding: 1rem; */
    text-align: center;
}
.product-card:hover {
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border: 1px solid rgb(44, 95, 45, 0.8);
    transform: translateY(-5px);
    
}
.product-card img {
    width: 100%;
    height: 200px;
    object-fit: fit;

    border-radius: 5px;
    margin: 0px 0 10px 0;
}
.product-card h4 {
    font-size: 1.3em;
    font-weight: 600;
}
.product-card {
    transition: transform 0.3s ease;
    cursor: pointer;
}

.buy-btn {
    background-color: #67A628;
    color: white;
    border: none;
    padding: 10px 30px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 0.9em;
    font-weight: 500;
    width: 100%;
    text-align: center;
}

.buy-btn:hover {
    background-color: #FEA601;
}



.productH {
    text-align: center;
    margin-left: 580px;
    font-size: 2.5em;
    font-weight: 600;
    color: #2c5f2d;
    margin-bottom: 20px;
    position: relative; 
    display: inline-block;
    
}

.productH::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 300px;
    height: 4px;
    background: #81c784;
    border-radius: 4px;
}
.product-image {
    position: relative;
}

.discount {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #e74c3c;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 0.9em;
}
.description {
    color: #000;
    font-size: 0.9em;
    min-height: 40px;
    margin: 10px 0;
}

.price-container {
    margin: 10px 0;
}

.original-price {
    text-decoration: line-through;
    color: #95a5a6;
    margin-right: 10px;
    font-weight:200;
    font-size: 0.8em;
}

.current-price {
    color: #27ae60;
    font-weight: bold;
    font-size: 1.2em;
}

.category{
    color: #7f8c8d;
    font-size: 0.8em;
} 

        .category-buttons {
            margin: 30px 0;
            text-align: center;
        }
        .category-filter select {
            padding: 8px 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .category-filter button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .category-filter button:hover {
            background-color: #45a049;
        }
        .category-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .category-btn {
            padding: 8px 15px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .category-btn:hover, .category-btn.active {
            background-color: #4CAF50;
            color: white;
        }
        .all-products {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include '../header.php'; ?>

    <section class="products" id="products">
        <h3 class="productH">Featured Products</h3>
        
        <!-- Category Filter -->
        <div class="category-buttons">
            <a href="?category=" class="category-btn <?php echo empty($categoryFilter) ? 'active all-products' : ''; ?>">All Products</a>
            <?php foreach ($categories as $category): ?>
                <a href="?category=<?php echo urlencode($category); ?>" 
                   class="category-btn <?php echo ($categoryFilter === $category) ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($category); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="product-grid">
            <?php 
            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    // Calculate discount percentage
                    $original_price = floatval($product['original_price'] ?? 0);
                    $current_price = floatval($product['current_price'] ?? 0);
                    $discount_percentage = 0;
                    if ($original_price > 0 && $current_price < $original_price) {
                        $discount_percentage = round(100 - ($current_price / $original_price * 100));
                    }
            ?>
            <div class="product-card" onclick="window.location.href='single_product.php?id=<?php echo $product['id']; ?>';" style="cursor: pointer;">
                <div class="product-image">
                    <img src="<?php echo !empty($product['image']) ? htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') : 'images/default.jpg'; ?>"
                        class="card-img-top"
                        alt="<?php echo htmlspecialchars($product['name'] ?? 'Product Image', ENT_QUOTES, 'UTF-8'); ?>">
                    <?php if ($discount_percentage > 0): ?>
                        <span class="discount"><?php echo htmlspecialchars($discount_percentage); ?>% OFF</span>
                    <?php endif; ?>
                </div>
                <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                <div class="category">Category: <?php echo htmlspecialchars($product['category'] ?? 'Uncategorized'); ?></div>
                <p class="description"><?php echo htmlspecialchars($product['description'] ?? ''); ?></p>
                <div class="price-container">
                    <span class="original-price">₹<?php echo htmlspecialchars(number_format($original_price, 2)); ?></span>
                    <span class="current-price">₹<?php echo htmlspecialchars(number_format($current_price, 2)); ?></span>
                </div>
                <input type="hidden" id="quantity" value="1">
                <button class="buy-btn" onclick="event.stopPropagation(); addToCart(
                    <?php echo $product['id']; ?>,
                    '<?php echo htmlspecialchars(addslashes($product['name'])); ?>',
                    <?php echo $product['current_price']; ?>,
                    '<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>',
                    document.getElementById('quantity').value
                );">Add to Cart</button>
            </div>
            <?php 
                }
            } else {
                echo '<div class="no-products">No products found in this category.</div>';
            }
            ?>
        </div>
    </section>
    
    <?php include '../footer.php'; ?>
    <?php include '../chatbot.php'; ?>
</body>
</html>

<?php
// Close connection
$conn->close();
?>