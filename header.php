<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Update cart count
    function updateCartCount() {
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            cartCount.textContent = '<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>';
        }
    }
    
    // Call updateCartCount initially
    updateCartCount();
    
    // Update cart count when cart is modified
    window.addEventListener('storage', function(e) {
        if (e.key === 'cart') {
            updateCartCount();
        }
    });
});
</script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }
    
    body {
      overflow-x: hidden;
    }
    
    .announcement-bar {
      background-color: #1e3a1e;
      color: white;
      padding: 8px 0;
      text-align: center;
      overflow: hidden;
      white-space: nowrap;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .announcement-content {
      display: inline-flex;
      animation: scroll 25s linear infinite;
      padding: 0 10px;
    }
    
    .announcement-item {
      display: flex;
      align-items: center;
      padding: 0 20px;
    }
    
    .star-icon {
      font-size: 16px;
      margin: 0 10px;
    }
    
    .header-main {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      background-color: white;
      position: relative;
    }
    
    .logo {
      display: flex;
      align-items: center;
    }
    
    .logo-text {
      margin-left: 10px;
    }
    
    .logo-name {
      font-size: 24px;
      font-weight: bold;
      color: #42791d;
    }
    
    .logo-tagline {
      font-size: 28px;
      font-weight: 900;
      color: #333;
    }
    
    .search-bar {
  flex-grow: 1;
  max-width: 600px;
  margin: 0 30px;
  position: relative;
  transition: all 0.3s ease;
}

.search-input {
  width: 100%;
  padding: 14px 20px;
  border: 2px solid #e0e0e0;
  border-radius: 30px;
  font-size: 16px;
  font-family: 'Segoe UI', system-ui, sans-serif;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  background-color: #f8f8f8;
  color: #333;
  outline: none;
}

.search-input:focus {
  border-color: #67a728; /* Primary green color */
  box-shadow: 0 4px 12px rgba(103, 167, 40, 0.2); /* Green glow */
  background-color: #fff;
}

.search-input::placeholder {
  color: #999;
  font-weight: 300;
}

.search-button {
  position: absolute;
  right: 6px;
  top: 50%;
  transform: translateY(-50%);
  height: calc(100% - 12px);
  width: 50px;
  background: linear-gradient(135deg, #7bc242, #67a728); /* Green gradient */
  color: white;
  border: none;
  border-radius: 24px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  box-shadow: 0 2px 5px rgba(103, 167, 40, 0.3); /* Green shadow */
}

.search-button:hover {
  background: linear-gradient(135deg, #6bb132, #579718); /* Darker green gradient */
  transform: translateY(-50%) scale(1.02);
}

.search-button:active {
  transform: translateY(-50%) scale(0.98);
}

.search-button svg {
  width: 20px;
  height: 20px;
  fill: currentColor;
}

/* Micro-interaction for search bar focus */
.search-bar:focus-within {
  transform: translateY(-1px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .search-bar {
    margin: 0 15px;
    max-width: 100%;
  }
  
  .search-input {
    padding: 12px 16px;
  }
}
    
    .header-icons {
      display: flex;
      gap: 20px;
      position: relative;
    }
    
    .icon-button {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 5px;
    }
    
    .navigation {
      background-color: #67a728;
      display: flex;
      justify-content: space-between;
      padding: 0 50px;
      position: relative;
      z-index: 100;
    }
    
    .nav-menu {
      display: flex;
      list-style-type: none;
    }
    
    .nav-item {
      padding: 15px 25px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      position: relative;
      display: flex;
      align-items: center;
    }
    
    .nav-item:hover {
      background-color: #558821;
    }
    
    .dropdown-icon {
      margin-left: 8px;
      transition: transform 0.3s ease;
    }
    
    .nav-item:hover .dropdown-icon {
      transform: rotate(180deg);
    }
    
    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background-color: white;
      min-width: 200px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: all 0.3s ease;
      z-index: 10;
    }
    
    .nav-item:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .dropdown-item {
      display: block;
      padding: 12px 20px;
      color: #333;
      text-decoration: none;
      font-weight: normal;
      border-bottom: 1px solid #f1f1f1;
      transition: background-color 0.2s;
    }
    
    .dropdown-item:hover {
      background-color: #f8f8f8;
      color: #67a728;
    }
    
    .contact-info {
      display: flex;
      align-items: center;
      color: white;
      padding: 0 15px;
    }
    
    .phone-icon {
      background-color: #ffa600;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
    }
    
    .phone-number {
      font-weight: bold;
      font-size: 18px;
    }
    
    .call-text {
      font-size: 14px;
      margin-bottom: 5px;
    }
    
    /* Mega menu for categories */
    .mega-menu {
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background-color: white;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      display: flex;
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: all 0.3s ease;
      z-index: 10;
      padding: 20px;
    }
    
    .nav-item:hover .mega-menu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .mega-menu-column {
      flex: 1;
      padding: 0 15px;
    }
    
    .mega-menu-title {
      font-weight: bold;
      color: #67a728;
      margin-bottom: 15px;
      padding-bottom: 5px;
      border-bottom: 2px solid #67a728;
    }
    
    .mega-menu-item {
      display: block;
      padding: 8px 0;
      color: #333;
      text-decoration: none;
      transition: color 0.2s;
    }
    
    .mega-menu-item:hover {
      color: #67a728;
    }

    /* Profile Dropdown Styles */
    .profile-dropdown {
      display: none;
      position: absolute;
      right: 0;
      top: 100%;
      background-color: white;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      width: 300px;
      z-index: 1000;
      padding: 20px;
      margin-top: 10px;
      border-radius: 4px;
    }

    .profile-dropdown.show {
      display: block;
      animation: fadeIn 0.3s ease;
    }

    .welcome-section {
      text-align: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid #eee;
    }

    .welcome-section h3 {
      color: #333;
      margin-bottom: 5px;
      font-size: 18px;
    }

    .welcome-section p {
      color: #666;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .login-button {
      background-color: #67a728;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
      border-radius: 4px;
      font-weight: bold;
      transition: background-color 0.2s;
    }

    .login-button:hover {
      background-color: #558821;
    }

    .dropdown-menu-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .dropdown-menu-list li {
      padding: 8px 0;
      border-bottom: 1px solid #f1f1f1;
    }

    .dropdown-menu-list li:last-child {
      border-bottom: none;
    }

    .dropdown-menu-list li a {
      display: block;
      color: #333;
      text-decoration: none;
      transition: color 0.2s;
      font-size: 14px;
      padding: 5px 0;
    }

    .dropdown-menu-list li a:hover {
      color: #67a728;
    }

    .new-tag {
      background-color: #ff0000;
      color: white;
      padding: 2px 5px;
      font-size: 0.7em;
      border-radius: 3px;
      margin-left: 5px;
    }
    
    @keyframes scroll {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }










  /* Cart Popup Styles */
  .cart-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 998;
    display: none;
  }
  
  .cart-popup {
    position: fixed;
    top: 0;
    right: -400px;
    width: 380px;
    height: 100%;
    background-color: #ffffff;
    box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
    z-index: 999;
    transition: right 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  
  .cart-popup.active {
    right: 0;
  }
  
  .cart-header {
    padding: 20px;
    border-bottom: 1px solid #dad7cd;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .cart-header h3 {
    margin: 0;
    color: #3a5a40;
    font-size: 18px;
  }
  
  .close-cart {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 18px;
    cursor: pointer;
  }
  
  .cart-items {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
  }
  
  .cart-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f1f1f1;
    position: relative;
  }
  
  .cart-item-image {
    width: 70px;
    height: 70px;
    margin-right: 15px;
    border-radius: 4px;
    overflow: hidden;
  }
  
  .cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .cart-item-details {
    flex: 1;
  }
  
  .cart-item-details h4 {
    margin: 0 0 5px 0;
    font-size: 15px;
    color: #333;
  }
  
  .cart-item-price {
    color: #588157;
    font-weight: 600;
    margin-bottom: 8px;
  }
  
  .cart-item-quantity {
    display: flex;
    align-items: center;
  }
  
  .cart-item-quantity input {
    width: 40px;
    text-align: center;
    border: 1px solid #dad7cd;
    padding: 4px;
    margin: 0 5px;
  }
  
  .cart-qty-minus, .cart-qty-plus {
    width: 24px;
    height: 24px;
    border: 1px solid #dad7cd;
    background-color: #f8f9f3;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }
  
  .remove-item {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    padding: 5px;
  }
  
  .cart-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 50px 20px;
    text-align: center;
  }
  
  .empty-cart-icon {
    font-size: 60px;
    color: #dad7cd;
    margin-bottom: 20px;
  }
  
  .cart-empty p {
    color: #6c757d;
    margin-bottom: 20px;
  }
  
  .continue-shopping {
    color: #588157;
    text-decoration: none;
    font-weight: 600;
    padding: 8px 20px;
    border: 2px solid #588157;
    border-radius: 4px;
    transition: all 0.3s;
  }
  
  .continue-shopping:hover {
    background-color: #588157;
    color: #fff;
  }
  
  .cart-summary {
    background-color: #f8f9f3;
    padding: 20px;
  }
  
  .summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    color: #6c757d;
  }
  
  .summary-row.total {
    font-weight: 700;
    color: #3a5a40;
    font-size: 18px;
    border-top: 1px solid #dad7cd;
    padding-top: 10px;
    margin-top: 10px;
  }
  
  .cart-actions {
    padding: 20px;
    display: flex;
    gap: 10px;
  }
  
  .view-cart-btn, .checkout-btn {
    flex: 1;
    padding: 12px;
    text-align: center;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
  }
  
  .view-cart-btn {
    background-color: #ffffff;
    color: #588157;
    border: 2px solid #588157;
  }
  
  .view-cart-btn:hover {
    background-color: #f8f9f3;
  }
  
  .checkout-btn {
    background-color: #588157;
    color: #ffffff;
    border: 2px solid #588157;
  }
  
  .checkout-btn:hover {
    background-color: #3a5a40;
  }
  .cart-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: #ff6b6b;
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      font-size: 12px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
    }
  /* Responsive Styles */
  @media (max-width: 991px) {
    .search-bar {
      display: none;
    }
  }
  
  @media (max-width: 767px) {
    .main-nav {
      display: none;
    }
    
    .cart-popup {
      width: 100%;
      right: -100%;
    }
  }
  </style>
</head>
<body>
  <!-- Announcement Bar -->
  <!-- <div class="announcement-bar">
    <div class="announcement-content">
      <div class="announcement-item">Special Offer: Get 25% Discount Code 'FRESH25'</div>
      <span class="star-icon">★</span>
      <div class="announcement-item">Free Shipping on orders above ₹6000</div>
      <span class="star-icon">★</span>
      <div class="announcement-item">Local Delivery Within 24 Hours</div>
      <span class="star-icon">★</span>
      <div class="announcement-item">Special Offer: Get 25% Discount Code 'FRESH25'</div>
    </div>
  </div> -->
  <header>
  <!-- Main Header -->
  <div class="header-main">
    <!-- Logo -->
    <div class="logo">
      <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
        <path d="M20 5C15 5 10 10 10 15C10 20 15 25 20 25C25 25 30 20 30 15C30 10 25 5 20 5Z" fill="#67a728"/>
        <path d="M20 25V35M10 15L5 10M30 15L35 10" stroke="#67a728" stroke-width="2"/>
      </svg>
      <div class="logo-text">
        <div class="logo-name">FarmCart</div>
        <div class="logo-tagline">FRESH STORE</div>
      </div>
    </div>
    
    <!-- Search Bar -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Search a product ...">
      <button class="search-button">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
          <path d="M19 19L13.5 13.5M15.5 8.25C15.5 12.2541 12.2541 15.5 8.25 15.5C4.24594 15.5 1 12.2541 1 8.25C1 4.24594 4.24594 1 8.25 1C12.2541 1 15.5 4.24594 15.5 8.25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
    
    <!-- Header Icons -->
    <div class="header-icons">
      <button class="icon-button" id="profileButton">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#333" stroke-width="1.5"/>
          <path d="M20 22C20 17.5817 16.4183 14 12 14C7.58172 14 4 17.5817 4 22" stroke="#333" stroke-width="1.5"/>
        </svg>
      </button>
      <div class="profile-dropdown" id="profileDropdown">
        <div class="welcome-section">
          <?php
          if(isset($_SESSION['user_id'])){
            $user = htmlspecialchars($_SESSION["first_name"]);
              echo "<h3>Welcome, $user</h3>
              <p>To access account and manage orders</p>
              <button class='login-button' onclick=\"location.href='../marketplace/logout.php'\">LOGOUT</button>";
            }else{
            echo "<h3>Welcome, Guest</h3>
            <p>To access account and manage orders</p>
            <button class='login-button' onclick=\"location.href='../marketplace/marketlogin.php'\">LOGIN/SIGNUP</button>";
          }
          ?>
           
        </div>
        <ul class="dropdown-menu-list">
          <li><a href="orders.php">Orders</a></li>
          <li><a href="../marketplace/edit_profile.php">Edit Profile</a></li>

          <li><a href="#">Saved Addresses</a></li>
          <li><a href="#">Saved Addresses</a></li>
        </ul>
      </div>
      <button class="icon-button" id="cartButton" style="position: relative;">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
      <path d="M4 4H5.5L6 7M6 7L8 15H18L20 7H6Z" stroke="#333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      <circle cx="9" cy="19" r="1.5" stroke="#333"/>
      <circle cx="17" cy="19" r="1.5" stroke="#333"/>
    </svg>
    <span class="cart-count" id="cartCount"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
  </button>
    </div>
  </div>
  
  <!-- Navigation -->
  <div class="navigation">
    <ul class="nav-menu">
      <!-- Categories with mega menu -->
      <li class="nav-item">
        CATEGORIES 
        <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2 4L6 8L10 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <!-- <div class="mega-menu"> -->
          <div class="dropdown-menu">
            <a href="../marketplace/products.php" class="dropdown-item">All</a>
            <a href="../marketplace/products.php?category=Tractor" class="dropdown-item">Tractors</a>
            <a href="../marketplace/products.php?category=Seeds" class="dropdown-item">Seeds</a>
            <a href="../marketplace/products.php?category=Fertilizers" class="dropdown-item">Fertilizers</a>
            <a href="../marketplace/products.php?category=Tools" class="dropdown-item">Tools</a>
          </div>
        <!-- </div> -->
      </li>
      
      <!-- Home dropdown menu -->
      <li class="nav-item">
        Home
        <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2 4L6 8L10 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="dropdown-menu">
          <a href="../marketplace/products.php" class="dropdown-item">Home</a>
          <a href="#" class="dropdown-item">About Us</a>
          <a href="#" class="dropdown-item">Our Farmers</a>
        </div>
      </li>
      
      <li class="nav-item">
        <a href="../marketplace/products.php" style="text-decoration: none; color: white;">Shop</a>
      </li>
      
      <!-- Seasonal dropdown menu -->
      <li class="nav-item">
        Seasonal
        <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2 4L6 8L10 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="dropdown-menu">
          <a href="#" class="dropdown-item">Current Season Products</a>
          <a href="#" class="dropdown-item">Crop Calendars</a>
          <a href="#" class="dropdown-item">Seasonal Offers</a>
          <a href="#" class="dropdown-item">Seasonal Categories</a>
          <a href="#" class="dropdown-item">Seasonal Tools </a>
        </div>
      </li>
      
      <!-- More dropdown menu -->
      <li class="nav-item">
        More
        <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2 4L6 8L10 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="dropdown-menu">
        <a href="#" class="dropdown-item">FAQ</a>
          <a href="#" class="dropdown-item">Services</a>
          <a href="#" class="dropdown-item">Support</a>
          <a href="#" class="dropdown-item">Community</a>
          <a href="#" class="dropdown-item">Business Solutions</a>
          <a href="#" class="dropdown-item">Company Information</a>
        </div>
      </li>
      
      <li class="nav-item">Blog</li>
      <li class="nav-item">
        <a href="contact1.php" style="text-decoration: none; color: white;">Contact</a>
      </li>


    </ul>
    
    <div class="contact-info">
      <div class="phone-icon">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M14.6667 11.28V13.28C14.6667 13.4657 14.6267 13.6479 14.5495 13.8128C14.4723 13.9778 14.3594 14.1216 14.2196 14.2346C14.0798 14.3476 13.9168 14.4272 13.7424 14.4677C13.568 14.5082 13.3866 14.5086 13.212 14.4687C11.0847 13.9881 9.0891 13.0465 7.4 11.7133C5.82968 10.4786 4.54734 8.91556 3.66667 7.13332C3 5.33999 2.16666 3.38665 1.73333 1.39999C1.69689 1.2285 1.69753 1.05149 1.73518 0.880427C1.77284 0.709368 1.84675 0.55013 1.95252 0.413585C2.0583 0.27704 2.19348 0.167344 2.34912 0.0922029C2.50476 0.0170625 2.67651 -0.0130816 2.84667 0.00665653H4.93333C5.2216 0.00351219 5.50042 0.101436 5.7187 0.283706C5.93697 0.465977 6.0788 0.720437 6.12 0.999989C6.2 1.59999 6.33333 2.18665 6.52 2.75332C6.60808 2.98419 6.62602 3.23543 6.57168 3.47619C6.51735 3.71695 6.39334 3.93459 6.21333 4.09999L5.4 4.87999C6.22737 6.37332 7.36667 7.67999 8.8 8.73332L9.61333 7.95999C9.78669 7.78608 10.0078 7.66603 10.2536 7.61332C10.4994 7.56062 10.756 7.57747 10.9933 7.66665C11.58 7.84665 12.1867 7.97999 12.8067 8.05999C13.0952 8.10099 13.3576 8.24737 13.5435 8.47276C13.7294 8.69815 13.8267 8.98552 13.8207 9.27999L14.6667 11.28Z" fill="white"/>
        </svg>
      </div>
      <div>
        <div class="call-text">Order by phone</div>
        <div class="phone-number">+9155033078</div>
      </div>
    </div>
  </div>
</header>

<!-- Cart Popup -->
<div class="cart-popup" id="cart-popup">
  <div class="cart-header">
    <h3>Your Cart</h3>
    <button class="close-cart" id="close-cart"><i class="fas fa-times"></i></button>
  </div>
  
  <div class="cart-items" id="cart-items">
    <!-- Cart items will be dynamically added here -->
    <!-- Example item structure: -->
    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
      <?php else: ?>
        <div class="cart-empty" id="cart-empty" style="display: block;">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-basket"></i>
            </div>
            <p>Your cart is empty</p>
            <a href="../marketplace/products.php" class="continue-shopping">Continue Shopping</a>
        </div>
    <?php endif; ?>
    <div class="cart-item">
      <div class="cart-item-image">
        <img src="images/products/tomatoes.jpg" alt="Organic Tomatoes">
      </div>
      <div class="cart-item-details">
        <h4>Organic Tomatoes</h4>
        <div class="cart-item-price">₹120.00</div>
        <div class="cart-item-quantity">
          <button class="qty-btn cart-qty-minus">-</button>
          <input type="number" value="2" min="1" readonly>
          <button class="qty-btn cart-qty-plus">+</button>
        </div>
      </div>
      <button class="remove-item"><i class="fas fa-trash-alt"></i></button>
    </div>
    
    <div class="cart-item">
      <div class="cart-item-image">
        <img src="images/products/carrots.jpg" alt="Fresh Carrots">
      </div>
      <div class="cart-item-details">
        <h4>Fresh Carrots</h4>
        <div class="cart-item-price">₹80.00</div>
        <div class="cart-item-quantity ">
          <button class="qty-btn cart-qty-minus appearance-none cursor-pointer ease">-</button>
          <input type="number" value="1" min="1" readonly>
          <button class="qty-btn cart-qty-plus appearance-none cursor-pointer ease">+</button>
        </div>
      </div>
      <button class="remove-item"><i class="fas fa-trash-alt"></i></button>
    </div>
  </div>
  
  <div class="cart-empty" id="cart-empty" style="display: none;">
    <div class="empty-cart-icon">
      <i class="fas fa-shopping-basket"></i>
    </div>
    <p>Your cart is empty</p>
    <a href="../marketplace/products.php" class="continue-shopping">Continue Shopping</a>
  </div>
  
  <div class="cart-summary">
    <div class="summary-row">
      <span>Subtotal:</span>
      <span class="subtotal">₹320.00</span>
    </div>
    <div class="summary-row">
      <span>Shipping:</span>
      <span class="shipping">₹50.00</span>
    </div>
    <div class="summary-row total">
      <span>Total:</span>
      <span class="total-amount">₹370.00</span>
    </div>
  </div>
  
  <div class="cart-actions">
    <button id="checkout-btn" class="checkout-btn">Checkout</button>
  </div>
</div>

<!-- Cart Overlay -->
<div class="cart-overlay" id="cart-overlay"></div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
      const profileButton = document.getElementById('profileButton');
      const profileDropdown = document.getElementById('profileDropdown');
      
      // Toggle profile dropdown
      profileButton.addEventListener('click', function(event) {
        event.stopPropagation();
        profileDropdown.classList.toggle('show');
      });
      
      // Close dropdown when clicking outside
      document.addEventListener('click', function(event) {
        if (!event.target.closest('.header-icons')) {
          profileDropdown.classList.remove('show');
        }
      });
      
      // Close dropdown when pressing Escape key
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          profileDropdown.classList.remove('show');
        }
      });
      
      // Prevent dropdown from closing when clicking inside it
      profileDropdown.addEventListener('click', function(event) {
        event.stopPropagation();
      });
    });



    document.addEventListener('DOMContentLoaded', function() {
      // Get DOM elements
      const cartIcon = document.getElementById('cartButton');
      const cartPopup = document.getElementById('cart-popup');
      const closeCart = document.getElementById('close-cart');
      const cartOverlay = document.getElementById('cart-overlay');
      const cartItems = document.getElementById('cart-items');
      const cartEmpty = document.getElementById('cart-empty');
      const cartCount = document.getElementById('cartCount');
      
      // Toggle cart popup
      cartIcon.addEventListener('click', function() {
          cartPopup.classList.add('active');
          cartOverlay.style.display = 'block';
          document.body.style.overflow = 'hidden'; // Prevent scrolling when cart is open
      });
      
      // Close cart popup
      function closeCartPopup() {
          cartPopup.classList.remove('active');
          cartOverlay.style.display = 'none';
          document.body.style.overflow = ''; // Re-enable scrolling
      }
      
      closeCart.addEventListener('click', closeCartPopup);
      cartOverlay.addEventListener('click', closeCartPopup);
      
      // Initialize cart
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      updateCartDisplay();
      
      // Add to cart function
      window.addToCart = function(productId, productName, price, image, quantity = 1) {
          quantity = parseInt(quantity) || 1; // Ensure quantity is a number
          
          // Check if product is already in cart
          const existingItemIndex = cart.findIndex(item => item.id === productId);
          
          if (existingItemIndex > -1) {
              // Update quantity if product exists
              cart[existingItemIndex].quantity += quantity;
          } else {
              // Add new item to cart
              cart.push({
                  id: productId,
                  name: productName,
                  price: price,
                  image: image,
                  quantity: quantity
              });
          }
          
          // Save cart to localStorage
          localStorage.setItem('cart', JSON.stringify(cart));
          
          // Update cart display
          updateCartDisplay();
          
          // Show cart popup
          cartPopup.classList.add('active');
          cartOverlay.style.display = 'block';
          document.body.style.overflow = 'hidden';
      };
      
      // Update cart display
      function updateCartDisplay() {
          // Update cart count
          const totalItems = cart.reduce((total, item) => total + parseInt(item.quantity), 0);
          cartCount.textContent = totalItems;
          
          // Check if cart is empty
          if (cart.length === 0) {
              cartItems.style.display = 'none';
              cartEmpty.style.display = 'flex';
              document.querySelector('.cart-summary').style.display = 'none';
              return;
          }
          
          // Show cart items and summary
          cartItems.style.display = 'block';
          cartEmpty.style.display = 'none';
          document.querySelector('.cart-summary').style.display = 'block';
          
          // Clear current cart items
          cartItems.innerHTML = '';
          
          // Add each item to cart
          let subtotal = 0;
          
          cart.forEach((item, index) => {
              const itemTotal = item.price * item.quantity;
              subtotal += itemTotal;
              
              const cartItemElement = document.createElement('div');
              cartItemElement.className = 'cart-item';
              cartItemElement.innerHTML = `
                  <div class="cart-item-image">
                      <img src="${item.image}" alt="${item.name}">
                  </div>
                  <div class="cart-item-details">
                      <h4>${item.name}</h4>
                      <div class="cart-item-price">₹${parseFloat(item.price).toFixed(2)}</div>
                      <div class="cart-item-quantity">
                          <button class="qty-btn cart-qty-minus" data-index="${index}">-</button>
                          <input type="number" value="${item.quantity}" min="1" readonly>
                          <button class="qty-btn cart-qty-plus" data-index="${index}">+</button>
                      </div>
                  </div>
                  <button class="remove-item" data-index="${index}">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                          <path d="M2 4H14" stroke="#DC3545" stroke-width="1.5" stroke-linecap="round"/>
                          <path d="M12.6667 4V13.3333C12.6667 13.687 12.5262 14.0261 12.2762 14.2761C12.0261 14.5262 11.687 14.6667 11.3333 14.6667H4.66667C4.31304 14.6667 3.97391 14.5262 3.72386 14.2761C3.47381 14.0261 3.33333 13.687 3.33333 13.3333V4" stroke="#DC3545" stroke-width="1.5" stroke-linecap="round"/>
                          <path d="M5.33334 4.00008V2.66675C5.33334 2.31312 5.47381 1.97399 5.72386 1.72394C5.97391 1.4739 6.31305 1.33342 6.66667 1.33342H9.33334C9.68696 1.33342 10.0261 1.4739 10.2761 1.72394C10.5262 1.97399 10.6667 2.31312 10.6667 2.66675V4.00008" stroke="#DC3545" stroke-width="1.5" stroke-linecap="round"/>
                          <path d="M6.66667 7.33325V11.3333" stroke="#DC3545" stroke-width="1.5" stroke-linecap="round"/>
                          <path d="M9.33333 7.33325V11.3333" stroke="#DC3545" stroke-width="1.5" stroke-linecap="round"/>
                      </svg>
                  </button>
              `;
              

              cartItems.appendChild(cartItemElement);
          });
          
          // Update subtotal, shipping, and total
          const shipping = subtotal > 0 ? 50 : 0;
          const total = subtotal + shipping;
          
          document.querySelector('.subtotal').textContent = `₹${subtotal.toFixed(2)}`;
          document.querySelector('.shipping').textContent = `₹${shipping.toFixed(2)}`;
          document.querySelector('.total-amount').textContent = `₹${total.toFixed(2)}`;
          
          // Add event listeners for quantity buttons and remove buttons
          const minusButtons = document.querySelectorAll('.cart-qty-minus');
          const plusButtons = document.querySelectorAll('.cart-qty-plus');
          const removeButtons = document.querySelectorAll('.remove-item');
          
          minusButtons.forEach(button => {
              button.addEventListener('click', function(e) {
                  e.stopPropagation();
                  const index = this.getAttribute('data-index');
                  if (cart[index].quantity > 1) {
                      cart[index].quantity--;
                      localStorage.setItem('cart', JSON.stringify(cart));
                      updateCartDisplay();
                  }
              });
          });
          
          plusButtons.forEach(button => {
              button.addEventListener('click', function(e) {
                  e.stopPropagation();
                  const index = this.getAttribute('data-index');
                  cart[index].quantity++;
                  localStorage.setItem('cart', JSON.stringify(cart));
                  updateCartDisplay();
              });
          });
          
          removeButtons.forEach(button => {
              button.addEventListener('click', function(e) {
                  e.stopPropagation();
                  const index = this.getAttribute('data-index');
                  cart.splice(index, 1);
                  localStorage.setItem('cart', JSON.stringify(cart));
                  updateCartDisplay();
              });
          });

// Add event listener for checkout button
document.addEventListener('click', function(e) {
  if (e.target && e.target.id === 'checkout-btn') {
    // Save cart data for PHP to access
    sessionStorage.setItem('checkoutCart', JSON.stringify(cart));
    
    // Create a hidden form to POST the cart data
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'checkout.php';
    form.style.display = 'none';
    
    // Add cart data as a hidden input
    const cartInput = document.createElement('input');
    cartInput.type = 'hidden';
    cartInput.name = 'cart_data';
    cartInput.value = JSON.stringify(cart);
    form.appendChild(cartInput);
    
    // Submit the form
    document.body.appendChild(form);
    form.submit();
  }
});

          
      }
    });
  </script>
</body>
</html>