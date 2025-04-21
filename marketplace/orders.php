<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .order-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .order-header {
            background-color: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .order-body {
            padding: 15px;
        }
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        .empty-orders {
            text-align: center;
            padding: 50px 0;
        }
        .empty-orders i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <?php include '../header.php'; 
    
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: marketlogin.php?redirect=orders');
    exit();
}


// Get user ID from session
$user_id = $_SESSION['user_id'];

// Initialize variables
$orders = [];
$error_message = "";

// Connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "int219";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all orders for the user
$sql = "SELECT od.*, pd.provider, pd.status 
        FROM order_details od 
        LEFT JOIN payment_details pd ON od.payment_id = pd.id 
        WHERE od.user_id = ? 
        ORDER BY od.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get order items for each order
        $order_id = $row['id'];
        $items_sql = "SELECT oi.*, p.name, p.image_url, p.selling_price 
        FROM order_items oi 
        JOIN product p ON oi.product_id = p.id 
        WHERE oi.order_id = ?";
        
        $items_stmt = $conn->prepare($items_sql);
        $items_stmt->bind_param("i", $order_id);
        $items_stmt->execute();
        $items_result = $items_stmt->get_result();
        
        $order_items = [];
        while ($item = $items_result->fetch_assoc()) {
            $order_items[] = $item;
        }
        
        $row['items'] = $order_items;
        $orders[] = $row;
    }
} else {
    $error_message = "You haven't placed any orders yet.";
}

$stmt->close();
$conn->close();?>

    <div class="container py-5">
        <h1 class="mb-4">My Orders</h1>
        
        <?php if (!empty($error_message)): ?>
            <div class="empty-orders">
                <i class="bi bi-bag-x"></i>
                <h3>No Orders Found</h3>
                <p class="text-muted"><?php echo $error_message; ?></p>
                <a href="products.php" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="order-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Order #<?php echo $order['id']; ?></h5>
                            <small class="text-muted">Placed on <?php echo date('F j, Y', strtotime($order['created_at'])); ?></small>
                        </div>
                        <div>
                            <?php 
                            $status_class = '';
                            $status_text = '';
                            
                            if (isset($order['status'])) {
                                switch ($order['status']) {
                                    case 'pending':
                                        $status_class = 'status-pending';
                                        $status_text = 'Pending';
                                        break;
                                    case 'completed':
                                        $status_class = 'status-completed';
                                        $status_text = 'Completed';
                                        break;
                                    case 'cancelled':
                                        $status_class = 'status-cancelled';
                                        $status_text = 'Cancelled';
                                        break;
                                    default:
                                        $status_class = 'status-pending';
                                        $status_text = 'Processing';
                                }
                            } else {
                                $status_class = 'status-pending';
                                $status_text = 'Processing';
                            }
                            ?>
                            <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                        </div>
                    </div>
                    <div class="order-body">
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
                                    <?php foreach ($order['items'] as $item): ?>
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
                                            <td>₹<?php echo number_format($item['selling_price'] ?? 0, 2); ?></td>
                                            <td>₹<?php echo number_format(($item['selling_price'] ?? 0) * $item['quantity'], 2); ?></td>
                                            </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>₹<?php echo number_format(array_sum(array_map(function($item) { 
                                                        return $item['selling_price'] * $item['quantity']; 
                                                    }, $order['items'])), 2); ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <strong>Payment Method:</strong> 
                                <?php echo isset($order['provider']) ? htmlspecialchars($order['provider']) : 'Not specified'; ?>
                            </div>
                            <!-- <a href="complete_order.php?order_id=<?php echo $order['id']; ?>" class="btn btn-outline-primary btn-sm">View Details</a> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>