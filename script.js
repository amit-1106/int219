// footer
document.addEventListener("DOMContentLoaded", function () {
    // Newsletter Subscription Form
    document.getElementById("subscribe-form").addEventListener("submit", function (event) {
        event.preventDefault();
        const email = document.getElementById("email").value;
        const messageBox = document.getElementById("subscription-message");

        if (email) {
            messageBox.innerHTML = "<p style='color: #81c784;'>✅ Subscription successful!</p>";
            setTimeout(() => { messageBox.innerHTML = ""; }, 3000);
            document.getElementById("email").value = "";
        } else {
            messageBox.innerHTML = "<p style='color: red;'>❌ Please enter a valid email!</p>";
        }
    });

    // Smooth Scroll Effect
    document.querySelectorAll('.footer-links a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetSection = document.querySelector(this.getAttribute('href'));
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});

// End of footer
//start about section
        let index = 0;
        const images = document.querySelectorAll('.carousel img');

        function showNextImage() {
            images.forEach(img => img.style.display = 'none');
            index = (index + 1) % images.length;
            images[index].style.display = 'block';
        }

        setInterval(showNextImage, 4000);
        images[0].style.display = 'block';

        ///About section
        document.addEventListener("DOMContentLoaded", function () {
            const features = document.querySelectorAll(".feature");

            features.forEach(feature => {
                feature.addEventListener("mouseover", () => {
                    feature.style.background = "rgba(255, 255, 255, 0.3)";
                });

                feature.addEventListener("mouseleave", () => {
                    feature.style.background = "rgba(255, 255, 255, 0.1)";
                });
            });
        });

///End About section
///features section
document.addEventListener('DOMContentLoaded', function () {
    // Add intersection observer for animation
    const cards = document.querySelectorAll('.technique-card');

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeIn 0.6s ease forwards';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    cards.forEach(card => {
        observer.observe(card);
    });

    // Add hover effect
    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = 'translateY(0)';
        });
    });

    // Smooth scroll for all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
