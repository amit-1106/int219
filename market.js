document.addEventListener('DOMContentLoaded', function() {
    // Form submission
    const sellForm = document.getElementById('sellForm');
    if(sellForm) {
        sellForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add form handling logic here
            alert('Product listed successfully!');
            this.reset();
        });
    }

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Product search functionality
    const searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-card');
            
            products.forEach(product => {
                const productName = product.querySelector('h4').textContent.toLowerCase();
                product.style.display = productName.includes(searchTerm) ? 'block' : 'none';
            });
        });
    }
});

// Add to script.js
// Product click handler
document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', function() {
        const productName = this.querySelector('h4').textContent;
        const price = this.querySelector('.price').textContent;
        // Add your product detail handling logic here
        alert(`Selected: ${productName}\nPrice: ${price}`);
    });
});

// Add to cart functionality
document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent triggering card click
        const product = this.closest('.product-card');
        const productName = product.querySelector('h4').textContent;
        const price = product.querySelector('.price').textContent;
        
        // Add to cart logic
        console.log(`Added to cart: ${productName} - ${price}`);
        alert(`Added to cart: ${productName}`);
    });
});
// Add to script.js
document.addEventListener('DOMContentLoaded', function() {
            let cart = [];

            // Cart functionality
            const cartIcon = document.querySelector('.cart-icon');
            const cartOverlay = document.querySelector('.cart-overlay');
            const cartContainer = document.querySelector('.cart');
            const closeCart = document.querySelector('.close-cart');

            // Toggle cart
            cartIcon.addEventListener('click', () => {
                cartContainer.classList.add('active');
                cartOverlay.classList.add('active');
            });

            closeCart.addEventListener('click', () => {
                cartContainer.classList.remove('active');
                cartOverlay.classList.remove('active');
            });

            cartOverlay.addEventListener('click', () => {
                cartContainer.classList.remove('active');
                cartOverlay.classList.remove('active');
            });

            // Add to cart function
            function addToCart(product) {
                const existingItem = cart.find(item => item.name === product.name);

                if (existingItem) {
                    existingItem.quantity += product.quantity;
                } else {
                    cart.push({ ...product });
                }

                updateCart();
                showPopup();
            }

            // Show popup notification
            function showPopup() {
                const popup = document.querySelector('.add-to-cart-popup');
                popup.classList.add('active');
                setTimeout(() => popup.classList.remove('active'), 2000);
            }

            // Update cart display
            function updateCart() {
                const cartItems = document.querySelector('.cart-items');
                const cartTotal = document.querySelector('#cart-total');
                const cartCount = document.querySelector('.cart-counter');

                cartItems.innerHTML = '';
                let total = 0;

                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    const cartItem = document.createElement('div');
                    cartItem.className = 'cart-item';
                    cartItem.innerHTML = `
                        <div>
                            <h4>${item.name}</h4>
                            <p>₹${item.price} x ${item.quantity}</p>
                        </div>
                        <div>
                            <p>₹${itemTotal}</p>
                            <button class="remove-item" data-index="${index}">&times;</button>
                        </div>
                    `;
                    cartItems.appendChild(cartItem);
                });

                cartTotal.textContent = total.toFixed(2);
                cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
            }

            // Remove item from cart
            document.querySelector('.cart-items').addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-item')) {
                    const index = e.target.dataset.index;
                    cart.splice(index, 1);
                    updateCart();
                }
            });

            // Update buy buttons
            document.querySelectorAll('.buy-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const productCard = this.closest('.product-card');
                    const product = {
                        name: productCard.querySelector('h4').textContent,
                        price: parseFloat(productCard.querySelector('.current-price').textContent.replace(/[^0-9.]/g, '')),
                        quantity: parseInt(productCard.querySelector('.quantity input').value)
                    };
                    addToCart(product);
                });
            });

            // Form submission
            const sellForm = document.getElementById('sellForm');
            if (sellForm) {
                sellForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Product listed successfully!');
                    this.reset();
                });
            }

            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Product search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const products = document.querySelectorAll('.product-card');

                    products.forEach(product => {
                        const productName = product.querySelector('h4').textContent.toLowerCase();
                        product.style.display = productName.includes(searchTerm) ? 'block' : 'none';
                    });
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Quantity decrement
            document.querySelectorAll('.qty-btn.minus').forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.closest('.quantity').querySelector('.qty-input');
                    let value = parseInt(input.value);
                    if (value > 1) {
                        input.value = value - 1;
                    }
                });
            });
        
            // Quantity increment
            document.querySelectorAll('.qty-btn.plus').forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.closest('.quantity').querySelector('.qty-input');
                    let value = parseInt(input.value);
                    input.value = value + 1;
                });
            });
        
            // Input validation: Prevents entering values below 1 or non-numeric values
            document.querySelectorAll('.qty-input').forEach(input => {
                input.addEventListener('change', function () {
                    if (this.value < 1 || isNaN(this.value)) {
                        this.value = 1;
                    }
                });
            });
        
            // Add to Cart functionality
            document.querySelectorAll('.buy-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const productCard = this.closest('.product-card');
                    const productName = productCard.querySelector('h4').textContent;
                    const quantity = parseInt(productCard.querySelector('.qty-input').value);
                    const price = productCard.querySelector('.current-price').textContent;
                    
                    alert(`Added to cart: ${quantity} x ${productName}\nTotal: ₹${calculateTotal(price, quantity)}`);
                });
            });
        
            // Function to calculate total price
            function calculateTotal(priceStr, quantity) {
                // Convert price string to number (removes ₹ and commas)
                const numericPrice = parseFloat(priceStr.replace(/[^\d.]/g, ""));
                return (numericPrice * quantity).toLocaleString('en-IN');
            }
        });