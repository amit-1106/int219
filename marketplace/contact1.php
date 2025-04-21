<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <link rel="stylesheet" href="../market.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .section-contact {
    background: url('https://www.transparenttextures.com/patterns/agriculture.png');
    padding: 4rem 0;
}

.container.grid-two--cols {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.contact-content {
    background: #ffffff;
    padding: 3rem;
    display: grid;
    place-items: center;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(82, 143, 90, 0.1);
    border: 2px solid #e1f5e3;
    
}
#name{
    margin-bottom: 17px;
}


.contact-content form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.contact-content label {
    color: #2c5f2d;
    font-weight: 600;
    display: block;
    margin-bottom: 0.5rem;
}

.contact-content input,
.contact-content textarea, #email {
    width: 100%;
    padding: 12px 20px;
    border: 2px solid #c8e6c9;
    border-radius: 8px;
    background: #f8fff9;
    transition: all 0.3s ease;
}
.emailsection {
    width: 100%;
    padding: 12px 20px;
    border: 2px solid #c8e6c9;
    border-radius: 8px;
    background: #f8fff9;
    transition: all 0.3s ease;
}

.contact-content input:focus,
.contact-content textarea:focus {
    border-color: #81c784;
    outline: none;
    box-shadow: 0 0 8px rgba(129, 199, 132, 0.3);
}

.btn-submit {
    background: #2c5f2d;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
}

.btn-submit:hover {
    background: #1e401f;
    transform: translateY(-2px);
}

.contact-map iframe{
    width: 100%;
    height: 500px;
    border-radius: 15px;
    object-fit: cover;
    border: 4px solid #01ff1a;
    box-shadow: 0 10px 30px rgba(82, 143, 90, 0.1);
}

/* Agriculture theme decorations */
.section-common-heading {
    color: #2c5f2d;
    font-size: 2.5rem;
    text-align: center;
    position: relative;
    margin-bottom: 1rem;
}

.section-common-heading::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: #81c784;
    border-radius: 2px;
}

.section-common-subheading {
    text-align: center;
    color: #666;
    max-width: 600px;
    margin: 0 auto 2rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .container.grid-two--cols {
        grid-template-columns: 1fr;
        padding: 1rem;
    }

    .contact-map img {
        height: 300px;
    }
}
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include '../header.php'; ?>

    <div class="section-contact">
        <div class="container">
            <h2 class="section-common-heading" data-lang="contactHeading">🌱 Contact us</h2>
            <p class="section-common-subheading" data-lang="contactSubheading">If you have any questions, feel free to reach out to us.</p>
        </div>
    </div>

    <div class="container grid-two--cols">
        <div class="contact-content">
            <form action="contact.php" method="post">
                <div class="grid grid-two--cols">
                    <div>
                        <label for="name" data-lang="fullName"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Full Name" autocomplete="off" required />
                    </div>
                    <div>
                        <label for="email" data-lang="email"><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" id="email" name="email" placeholder="rajsudhanshu106@gmail.com" autocomplete="off" required />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="subject" data-lang="subject"><i class="fas fa-tag"></i> Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter message topic" />
                </div>
                <div class="mb-3">
                    <label for="message" data-lang="message"><i class="fas fa-comment"></i> Message</label>
                    <textarea id="message" name="message" placeholder="Type your message here" cols="30" rows="6" required></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-submit" data-lang="sendMessage">
                        <i class="fas fa-seedling"></i> Send Message
                    </button>
                </div>
            </form>
        </div>
        <div class="contact-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6821.537659689631!2d75.69942934411215!3d31.254822197346293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5f5e9c489cf3%3A0x4049a5409d53c300!2sLovely%20Professional%20University!5e0!3m2!1sen!2sin!4v1740152462191!5m2!1sen!2sin" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <?php include '../footer.php'; ?>

    <!-- Scripts -->
    <script src="script.js"></script>
    <script src="market.js"></script>
  </body>
</html>
