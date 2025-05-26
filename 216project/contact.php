<?php
include 'partials/header.php';

?>

<style>
    /* Basic Reset and Typography (inherits from style.css body) */
    .contact__section {
        margin-top: 8rem; /* Adjust as needed, similar to other sections */
        padding: 3rem 0;
        background: var(--color-bg); /* Use background color from style.css */
    }

    .contact__container {
        display: flex;
        gap: 3rem;
        /* Responsive adjustment */
        flex-wrap: wrap; /* Allow wrapping on smaller screens */
    }

    .contact__info,
    .contact__form-container {
        flex: 1;
        background: var(--color-gray-900); /* Use card background color */
        padding: 2.5rem;
        border-radius: var(--card-border-radius-3); /* Use border radius from style.css */
        box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .contact__info h5,
    .contact__form-container h5 {
        color: var(--color-text-main); /* Use main text color for headings */
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
    }

    .contact__info-item {
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start; /* Align icon and text to the top */
        color: var(--color-text-main); /* Use main text color */
    }

    .contact__info-item i {
        margin-right: 1rem;
        font-size: 1.5rem;
        color: var(--color-primary); /* Use primary color for icons */
        margin-top: 0.2rem; /* Adjust vertical alignment with text */
    }

    .contact__info-item a {
        color: var(--color-text-main); /* Link color same as text */
        text-decoration: none;
        transition: color 300ms ease;
    }
    
    .contact__info-item a:hover {
         color: var(--color-primary-variant); /* Darker shade on hover */
    }

    .contact__socials {
        margin-top: 2rem;
        display: flex;
        gap: 1.5rem; /* Spacing between social icons */
    }

    .contact__socials a {
        display: inline-block;
        font-size: 1.8rem;
        color: var(--color-text-main); /* Social icon color */
         transition: color 300ms ease;
    }
    
    .contact__socials a:hover {
        color: var(--color-primary);
    }

    .contact__form form {
        display: flex;
        flex-direction: column;
        gap: 1.2rem; /* Spacing between form controls */
    }

    .form__control label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500; /* Adjust font weight */
        color: var(--color-text-main); /* Label color */
    }

    .contact__form input[type="text"],
    .contact__form input[type="email"],
    .contact__form textarea {
        width: 100%;
        padding: 0.8rem 1rem !important; /* Adjust padding */
        border: 1px solid var(--color-bg); /* Use a color complementing the new background */
        border-radius: var(--card-border-radius-1) !important; /* Use smaller border radius */
        background: #DFF5F0 !important; /* Soft seafoam green from about page */
        color: var(--color-white) !important; /* Use color from style.css for better visibility */
        font-family: inherit;
        font-size: 0.9rem;
    }
    
    .contact__form input[type="text"]::placeholder,
    .contact__form input[type="email"]::placeholder,
    .contact__form textarea::placeholder {
        color: #5B7065 !important; /* Soft gray-green from about page for placeholders */
    }

    /* Ensure text color is visible */
    .contact__form input,
    .contact__form textarea {
        color: #000 !important;
    }

    .contact__form textarea {
        resize: vertical; /* Allow vertical resize */
        min-height: 150px; /* Minimum height for textarea */
    }

    .contact__form button {
        align-self: flex-start; /* Align button to the left */
        /* Button styles inherit from general .btn in style.css */
    }

    /* Responsive adjustments for two columns */
    @media (max-width: 768px) {
        .contact__container {
            flex-direction: column;
            gap: 2rem;
        }

        .contact__info,
        .contact__form-container {
            padding: 2rem;
        }
    }

</style>

<section class="contact__section">
    <div class="container contact__container">
        <!-- Contact Information Section -->
        <div class="contact__info">
            <h5>Get in Touch</h5>
            <div class="contact__info-item">
                <i class="uil uil-phone"></i>
                <div>
                    <h6>Phone</h6>
                    <p><a href="tel:+1234567890">+1234567890</a></p>
                    <p><a href="tel:+1234567891">+1234567891</a></p>
                </div>
            </div>
            <div class="contact__info-item">
                <i class="uil uil-envelope"></i>
                 <div>
                    <h6>Email</h6>
                    <p><a href="mailto:ask.voyago@gmail.com">ask.voyago@gmail.com</a></p>
                 </div>
            </div>
             <div class="contact__info-item">
                <i class="uil uil-location-point"></i>
                 <div>
                    <h6>Address</h6>
                    <p>Ankara,Turkey</p>
                 </div>
            </div>

            <div class="contact__socials">
                 <a href="#" target="_blank"><i class="uil uil-twitter"></i></a>
                 <a href="#" target="_blank"><i class="uil uil-facebook-f"></i></a>
                 <a href="#" target="_blank"><i class="uil uil-instagram-alt"></i></a>
                 <a href="#" target="_blank"><i class="uil uil-linkedin"></i></a>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="contact__form-container">
            <h5>Send us a Message</h5>
            <form action="#" method="POST"> <?php // Replace # with actual form processing script ?>
                <div class="form__control">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                 <div class="form__control">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
                 <div class="form__control">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject" required>
                </div>
                 <div class="form__control">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </div>
</section>

<?php
include 'partials/footer.php';
?>
