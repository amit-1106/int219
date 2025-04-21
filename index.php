<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture & Rural Development</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .tech{
            margin-top: 5rem;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <img class="nav-image" src="./images/20250214_202659.png" alt="website logo">
        <ul>
            <li><a data-lang="home" href="index.php">Home</a></li>
            <li><a data-lang="about" href="about.html">About Us</a></li>
            <li><a data-lang="features" href="features.html">Features</a></li>
            <li><a data-lang="marketplace" href="marketplace/products.php" target="_blank">Marketplace</a></li>
            <li><a data-lang="weather" href="weather.html">Weather</a></li>
            <li><a data-lang="contacts" href="contact.html">Contacts</a></li>
        </ul>
        <div class="language">Language:
            <select id="languageSelect">
                <option value="en">English</option>
                <option value="hi">Hindi</option>
                <option value="pu">Punjabi</option>
            </select>
        </div>
        <!-- <div class="signup-btn">Sign Up</div> -->
    </div>
    <div class="hero-section">
        <div class="hero-text">
            <div class="text-section">
                <h2 data-lang="framer">Empowering Farmers, Growing Future🌾</h2>
                <p data-lang="description">Agriculture sustains life, empowers farmers, and fuels economies. Hardworking
                    farmers cultivate the land, ensuring food security and a greener future 🌾🚜
                </p>
                <hr>
            </div>
        </div>
        <div class="carousel">
            <img src="https://images.pexels.com/photos/24205317/pexels-photo-24205317/free-photo-of-man-plowing-field.jpeg?auto=compress&cs=tinysrgb&w=600"
                alt="Farmer in Field" class="active">
            <img src="https://images.pexels.com/photos/28894372/pexels-photo-28894372/free-photo-of-traditional-farming-in-rajshahi-bangladesh.jpeg?auto=compress&cs=tinysrgb&w=600"
                alt="Rural Farming">
            <img src="https://images.pexels.com/photos/2252618/pexels-photo-2252618.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="Crop Harvest">
            <img src="https://images.pexels.com/photos/18620460/pexels-photo-18620460/free-photo-of-a-farmer-in-a-rice-field-holding-a-bucket-of-water.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="Smart Farming">
            <img src="https://images.pexels.com/photos/20527519/pexels-photo-20527519/free-photo-of-farmers-in-india.jpeg?auto=compress&cs=tinysrgb&w=600"
                alt="Farmer Marketplace">
        </div>
    </div>
    <!--Start about section-->
    <section class="about-us">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title" data-lang="aboutTitle">Empowering Agriculture Through Technology 🌱</h2>
                <p class="section-description" data-lang="aboutDescription">
                    At <strong>AgriTech Solutions</strong>, we are dedicated to transforming the agricultural sector
                    through innovative digital platforms.
                    Our mission is to provide cutting-edge software solutions that enhance agricultural productivity and
                    promote rural development.
                    By leveraging advanced technology, data analytics, and AI-driven insights, we empower farmers,
                    agribusinesses, and rural communities to optimize their operations and increase sustainability.
                </p>

                <div class="features">
                    <div class="feature">
                        <img src="https://images.pexels.com/photos/3912518/pexels-photo-3912518.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="Smart Farming">
                        <h3 data-lang="aboutFirstH">Smart Farming</h3>
                        <p data-lang="aboutFirstP">IoT and AI-powered tools to improve farm efficiency.</p>
                    </div>
                    <div class="feature">
                        <img src="https://images.pexels.com/photos/6476475/pexels-photo-6476475.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="Market Linkage">
                        <h3 data-lang="aboutSecondH">Market Linkage</h3>
                        <p data-lang="aboutSecondP">Connecting farmers directly with buyers to ensure fair pricing.</p>
                    </div>
                    <div class="feature">
                        <img src="https://images.pexels.com/photos/20515624/pexels-photo-20515624/free-photo-of-farmers-in-india.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="Rural Development">
                        <h3 data-lang="aboutThirdH">Rural Development</h3>
                        <p data-lang="aboutThirdP">Empowering rural communities through digital financial inclusion.</p>
                    </div>
                </div>

                <a href="features.html" class="learn-more-btn" data-lang="aboutLearnMore">Learn More</a>
            </div>
        </div>
    </section>
    <!--End about section-->
    <!--Fetures section-->
    <section class="techniques-section tech">
        <div class="container">
            <h2 class="techniques1" data-lang="techniquesTitle">Advanced Agricultural Techniques  🌱</h2>
            <p class="desccription-tech" data-lang="techniquesDesc">Discover innovative techniques that enhance agricultural productivity and sustainability.</p>
            <div class="techniques">
                <div class="technique-card">
                    <img src="https://agfundernews.com/wp-content/uploads/2019/05/iStock-898449496-768x512.jpg" alt="Precision Farming">
                    <h3 data-lang="precisionTitle">Precision Farming</h3>
                    <p data-lang="precisionDesc">Utilizing GPS and IoT to optimize resource usage.</p>
                    <a href="https://youtu.be/7k8FGrn-ktM?si=B9TnSK4WNTXLIhFE" target="_blank" data-lang="aboutLearnMore">Learn More</a>
                </div>
                <div class="technique-card">
                    <img src="https://greenstories.co.in/wp-content/uploads/2023/07/organic-farming-benefits.jpg" alt="Organic Farming">
                    <h3 data-lang="organicTitle">Organic Farming</h3>
                    <p data-lang="organicDesc">Eco-friendly farming practices for healthier crops.</p>
                    <a href="https://youtu.be/r_CWfywjfZs?si=G1qF7OFwjQq9_UwB" target="_blank" data-lang="aboutLearnMore">Learn More</a>
                </div>
                <div class="technique-card">
                    <img src="https://media.istockphoto.com/id/626603008/photo/vegetables-hydroponics.jpg?s=612x612&w=0&k=20&c=Fok18xW9jO2GMNThQTf5opsYFiL7XdWMeTwmq_Bhfms=" alt="Hydroponics">
                    <h3 data-lang="hydroponicsTitle">Hydroponics</h3>
                    <p data-lang="hydroponicsDesc" >Growing plants without soil using nutrient-rich solutions.</p>
                    <a href="https://youtu.be/8fWSfEBGobI?si=OOQ1X48D7zzTuCMq" target="_blank" data-lang="aboutLearnMore">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    <!--End Fetures section-->

    <!--Contact section-->
    <div class="section-contact">
        <div class="container">
            <h2 class="section-common-heading " data-lang="contactHeading">🌱 Contact Farmers Hub</h2>
            <p class="section-common-subheading" data-lang="contactSubheading" >Connect with agricultural experts and get support for your farming
                needs</p>
        </div>
    </div>

    <div class="container grid-two--cols">
        <div class="contact-content">
            <form action="https://formspree.io/f/xovvrnaw" method="post">
                <div class="grid grid-two--cols">
                    <div>
                        <label for="name" data-lang="fullName"><i class="fas fa-user" ></i> Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Full Name" autocomplete="off"
                            required />
                    </div>
                    <div>
                        <label for="email" data-lang="email"><i class="fas fa-envelope" ></i> Email Address</label>
                        <input type="email" id="email" name="email" placeholder="rajsudhanshu106@gmail.com"
                            autocomplete="off" required />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="subject" data-lang="subject"><i class="fas fa-tag" ></i> Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter message topic" />
                </div>
                <div class="mb-3">
                    <label for="message" data-lang="message"><i class="fas fa-comment" ></i> Message</label>
                    <textarea id="message" name="message" placeholder="Type your message here" cols="30"
                        rows="6"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-sumbit" data-lang="sendMessage">
                        <i class="fas fa-seedling"></i> Send Message
                    </button>
                </div>
            </form>
        </div>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6821.537659689631!2d75.69942934411215!3d31.254822197346293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5f5e9c489cf3%3A0x4049a5409d53c300!2sLovely%20Professional%20University!5e0!3m2!1sen!2sin!4v1740152462191!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!--End Contact section-->

    <!--footer Start-->
    <footer class="footer">
        <div class="container">
            <div class="footer-row">
                <!-- About Section -->
                <div class="footer-column">
                    <h3 class="footer-title">About Us</h3>
                    <p>Empowering agriculture with innovative software solutions to enhance productivity and rural development.</p>
                </div>
    
                <!-- Quick Links -->
                <div class="footer-column">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a data-lang="home" href="index.html">Home</a></li>
                        <li><a data-lang="about" href="about.html">About Us</a></li>
                        <li><a data-lang="features" href="features.html">Features</a></li>
                        <li><a data-lang="marketplace" href="marketplace/products.php" target="_blank">Marketplace</a></li>
                        <li><a data-lang="weather" href="weather.html">Weather</a></li>
                        <li><a data-lang="contacts" href="contact.html">Contacts</a></li>
                    </ul>
                </div>
    
                <!-- Contact Info -->
                <div class="footer-column">
                    <h3 class="footer-title">Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Rural Tech Solutions, India</p>
                    <p><i class="fas fa-envelope"></i>rajsudhanshu106@gmail.com</p>
                    <p><i class="fas fa-phone"></i> +91 91550 33078</p>
                </div>
    
                <!-- Newsletter Subscription -->
                <div class="footer-column">
                    <h3 class="footer-title">Newsletter</h3>
                    <p>Stay updated with our latest agricultural innovations.</p>
                    <form id="subscribe-form">
                        <input type="email" id="email" placeholder="Enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                    <div id="subscription-message"></div>
                </div>
            </div>
    
            <!-- Social Media Links -->
            <div class="social-icons">
                <a href="https://github.com/yourusername" target="_blank"><i class="fa-brands fa-github"></i></a>
                <a href="https://www.linkedin.com/in/sudhanshu-kumar-521880297/" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://x.com/SudhanshuS12" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.facebook.com/sudhanshu.shrivastav.395?rdid=QwMOXQlYwykScPQx&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F157G1JUJwT%2F#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/skedit_01/?utm_source=ig_contact_invite#" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            
            <p class="footer-bottom">© 2025 Rural Tech Solutions. All Rights Reserved.</p>
        </div>
    </footer>
    
    <!--end footer-->
    

        
    <?php include 'chatbot.php'; ?>
    <script src="main.js "></script>
    <script src="script.js "></script>
</body>

</html>