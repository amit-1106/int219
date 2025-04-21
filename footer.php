<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body{
            margin:0;
            padding:0;
        }
        /* Footer Styles */
.footer {
  background-color: #f8f9f3;
  color: #3a5a40;
  padding: 60px 0 20px;
  font-family: 'Open Sans', sans-serif;
  border-top: 3px solid #588157;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Top Footer - Logo and Newsletter */
.footer-top {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 40px;
  padding-bottom: 40px;
  border-bottom: 1px solid #dad7cd;
}

.footer-logo {
  flex: 0 0 100%;
  max-width: 320px;
  margin-bottom: 30px;
}

.footer-logo img {
  max-width: 180px;
  margin-bottom: 15px;
}

.footer-logo p {
  font-size: 14px;
  line-height: 1.6;
  margin-bottom: 20px;
}

.social-icons {
  display: flex;
  gap: 15px;
}

.social-icons a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 38px;
  height: 38px;
  background-color: #588157;
  color: white;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.social-icons a:hover {
  background-color: #3a5a40;
  transform: translateY(-3px);
}

.footer-newsletter {
  flex: 0 0 100%;
  max-width: 400px;
}

.footer-newsletter h3 {
  font-size: 18px;
  margin-bottom: 15px;
  font-weight: 600;
  color: #3a5a40;
}

.footer-newsletter p {
  font-size: 14px;
  margin-bottom: 20px;
  line-height: 1.6;
}

.newsletter-form {
  display: flex;
  max-width: 100%;
}

.newsletter-form input {
  flex: 1;
  padding: 12px 15px;
  border: 1px solid #dad7cd;
  border-radius: 4px 0 0 4px;
  font-size: 14px;
  outline: none;
}

.newsletter-form button {
  padding: 0 20px;
  background-color: #588157;
  color: white;
  border: none;
  border-radius: 0 4px 4px 0;
  cursor: pointer;
  transition: background-color 0.3s;
  font-weight: 600;
}

.newsletter-form button:hover {
  background-color: #3a5a40;
}

/* Footer Links Section */
.footer-links {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 40px;
  padding-bottom: 40px;
  border-bottom: 1px solid #dad7cd;
}

.footer-column {
  flex: 1;
  min-width: 160px;
  margin-bottom: 30px;
  padding-right: 15px;
}

.footer-column h3 {
  font-size: 16px;
  margin-bottom: 20px;
  font-weight: 600;
  color: #3a5a40;
}

.footer-column ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-column ul li {
  margin-bottom: 10px;
}

.footer-column ul li a {
  color: #6c757d;
  text-decoration: none;
  font-size: 14px;
  transition: color 0.3s;
}

.footer-column ul li a:hover {
  color: #588157;
  padding-left: 5px;
}

/* Contact Information */
.contact-info li {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  font-size: 14px;
  color: #6c757d;
}

.contact-info li i {
  margin-right: 10px;
  color: #588157;
  width: 16px;
  text-align: center;
}

/* Payment Methods */
.payment-methods {
  text-align: center;
  margin-bottom: 30px;
}

.payment-methods h3 {
  font-size: 16px;
  margin-bottom: 15px;
  font-weight: 600;
  color: #3a5a40;
}

.payment-icons {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 15px;
}

.payment-icons img {
  height: 30px;
  opacity: 0.7;
  transition: opacity 0.3s;
}

.payment-icons img:hover {
  opacity: 1;
}

/* Bottom Footer */
.footer-bottom {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  padding-top: 20px;
}

.copyright {
  font-size: 13px;
  color: #6c757d;
  margin-bottom: 15px;
}

.footer-legal {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.footer-legal a {
  color: #6c757d;
  text-decoration: none;
  font-size: 13px;
  transition: color 0.3s;
}

.footer-legal a:hover {
  color: #588157;
}

/* Responsive Styles */
@media (max-width: 991px) {
  .footer-top, .footer-links {
    flex-direction: column;
  }
  
  .footer-logo, .footer-newsletter {
    max-width: 100%;
  }
  
  .footer-column {
    flex: 0 0 50%;
  }
}

@media (max-width: 767px) {
  .footer-column {
    flex: 0 0 100%;
  }
  
  .footer-bottom {
    flex-direction: column;
    text-align: center;
  }
  
  .footer-legal {
    justify-content: center;
  }
}
    </style>
</head>
<body>
    <!-- Footer Section -->
<footer class="footer">
  <div class="footer-container">
    <!-- Top Footer Section with Logo and Newsletter -->
    <div class="footer-top">
      <div class="footer-logo">
      <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
        <path d="M20 5C15 5 10 10 10 15C10 20 15 25 20 25C25 25 30 20 30 15C30 10 25 5 20 5Z" fill="#67a728"/>
        <path d="M20 25V35M10 15L5 10M30 15L35 10" stroke="#67a728" stroke-width="2"/>
        </svg>
        <p>Bringing farm-fresh produce directly to your doorstep. Supporting local farmers and sustainable agriculture since 2020.</p>
        <div class="social-icons">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
        </div>
      </div>
      
      <div class="footer-newsletter">
        <h3>Subscribe to Our Newsletter</h3>
        <p>Get updates on new products, seasonal harvests, and exclusive offers.</p>
        <form class="newsletter-form">
          <input type="email" placeholder="Your email address" required>
          <button type="submit">Subscribe</button>
        </form>
      </div>
    </div>
    
    <!-- Middle Footer with Quick Links -->
    <div class="footer-links">
      <div class="footer-column">
        <h3>Shop</h3>
        <ul>
          <li><a href="#">Vegetables</a></li>
          <li><a href="#">Fruits</a></li>
          <li><a href="#">Dairy Products</a></li>
          <li><a href="#">Farm Tools</a></li>
          <li><a href="#">Seasonal Specials</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h3>Customer Service</h3>
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Shipping Policy</a></li>
          <li><a href="#">Returns & Refunds</a></li>
          <li><a href="#">Track Order</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h3>About Us</h3>
        <ul>
          <li><a href="#">Our Story</a></li>
          <li><a href="#">Meet Our Farmers</a></li>
          <li><a href="#">Sustainability</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Careers</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h3>Contact</h3>
        <ul class="contact-info">
          <li><i class="fas fa-map-marker-alt"></i> 123 Farm Road, Green Valley</li>
          <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
          <li><i class="fas fa-envelope"></i> support@farmfresh.com</li>
          <li><i class="fas fa-clock"></i> Mon-Fri: 8am - 8pm</li>
        </ul>
      </div>
    </div>
    
    <!-- Payment Methods -->
    <div class="payment-methods">
      <h3>Secure Payment Options</h3>
      <div class="payment-icons">
        <i class="fa-brands fa-cc-visa"></i>
        <i class="fa-brands fa-cc-mastercard"></i>
        <i class="fa-brands fa-cc-paypal"></i>
        <i class="fa-brands fa-cc-apple-pay"></i>
        <i class="fa-brands fa-google-pay"></i>
      </div>
    </div>
    
    <!-- Bottom Footer with Copyright and Links -->
    <div class="footer-bottom">
      <div class="copyright">
        <p>&copy; 2025 FarmFresh. All rights reserved.</p>
      </div>
      <div class="footer-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Accessibility</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>
</body>
</html>