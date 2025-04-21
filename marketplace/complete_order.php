<?php
session_start();
require_once '../config/database.php';
$_SESSION['cart'] = array();
session_write_close();
session_start();
// Check if order ID is provided
if (!isset($_GET['order_id'])) {
    header('Location: checkout.php?error=invalid_order');
    exit();
}

$order_id = $_GET['order_id'];

try {
    // Get order details
    $stmt = $conn->prepare("
        SELECT o.*, o.total AS total_amount, u.username, u.email, p.provider AS payment_method
        FROM order_details o
        JOIN `user` u ON o.user_id = u.id
        LEFT JOIN payment p ON o.payment_id = p.id
        WHERE o.id = ? AND o.user_id = ?
    ");
    $stmt->execute([$order_id, $_SESSION['user_id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        header('Location: checkout.php?error=order_not_found');
        exit();
    }

    // Get order items
    $stmt = $conn->prepare("
        SELECT oi.*, p.name, p.image_url, p.selling_price AS price
        FROM order_items oi
        JOIN product p ON oi.product_id = p.id
        WHERE oi.order_id = ?
    ");
    $stmt->execute([$order_id]);
    $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error in complete_order.php: " . $e->getMessage());
    header('Location: checkout.php?error=system_error');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .order-confirmation {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .order-details {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1.5rem 0;
        }
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
<script>
    // Update cart count to 0
    document.addEventListener('DOMContentLoaded', function() {
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            cartCount.textContent = '0';
        }
    });
</script>
</head>
<body class="bg-light">

    <div class="container">
        <div class="order-confirmation">
            <div class="text-center">
                <i class="bi bi-check-circle-fill success-icon"></i>
                <h1 class="mb-4">Order Confirmed!</h1>
                <p class="lead">Thank you for your purchase. Your order has been successfully placed.</p>
            </div>

            <div class="order-details">
                <h3>Order Details</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Order Number:</strong> #<?php echo $order_id; ?></p>
                        <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> <span class="badge bg-success">Processing</span></p>
                        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                         class="product-image me-3">
                                    <div>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>₹<?php echo number_format($item['price'], 2); ?></td>
                            <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                            <td>₹<?php echo number_format($order['total_amount'], 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Tax:</strong></td>
                            <td>₹<?php echo number_format($order['total_amount'] * 0.1, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>₹<?php echo number_format($order['total_amount'] * 1.1, 2); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="products.php" class="btn btn-primary">Continue Shopping</a>
                <a href="orders.php" class="btn btn-outline-primary ms-2">View All Orders</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>