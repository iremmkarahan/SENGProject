<?php
include 'partials/header.php';
?>

<style>
    .about__section {
        margin-top: 8rem;
        padding: 3rem 0;
        background: var(--color-bg);
    }

        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .about__content,
    .about__team {
        flex: 1;
        background: var(--color-gray-900);
        padding: 2.5rem;
        border-radius: var(--card-border-radius-3);
        box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.1);
    }

    .about__content h1,
    .about__team h2 {
        color: var(--color-text-main);
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }

    .about__content p {
        color: var(--color-text-main);
        margin-bottom: 1.5rem;
        line-height: 1.7;
    }

    .about__content strong {
        color: var(--color-primary);
    }

    .about__team {
        text-align: center;
    }

    .team__member {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #DFF5F0; /* Soft seafoam green background */
    border-radius: var(--card-border-radius-2);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

.team__member h3 {
    color: #264653; /* Muted dark blue for strong contrast */
    margin: 1rem 0;
}

.team__member p {
    color: #5B7065; /* Soft gray-green for description text */
    margin-bottom: 1rem;
}

.team__member .socials a {
    color: #264653; /* Calm blue */
    font-size: 1.5rem;
    transition: color 300ms ease;
}

.team__member .socials a:hover {
    color: #457B9D; /* Brighter ocean blue on hover */
}

    @media (max-width: 768px) {
        .about__container {
            flex-direction: column;
            gap: 2rem;
        }

        .about__content,
        .about__team {
            padding: 2rem;
        }
    }
</style>

<section class="about__section">
    <div class="container about__container">
        <!-- About Content Section -->
        <div class="about__content">
            <h1>About VOYAGO</h1>
            <p>
                Welcome to VOYAGO! This web application was designed and developed by two passionate Software Engineering students from TED University as part of our academic journey.
            </p>
            <p>
                Our goal was to create a modern, user-friendly platform that allows users to seamlessly search, book, and manage hotel reservations. We've combined our skills in PHP, MySQL, JavaScript, and responsive web design to build a system that simulates a real-world booking platform.
            </p>
            <p>
                Through this project, we've implemented essential features such as user registration and login, room listings, booking management, and admin panel controls — all secured and connected to a MySQL database.
            </p>
            <p>
                Thank you for visiting our website. We hope you enjoy the experience!
            </p>
        </div>

        <!-- Team Section -->
        <div class="about__team">
            <h2>Our Team</h2>
            <div class="team__member">
                <p>Gökçe Tiryaki Software Engineering Student</p>
                <p>TED University</p>
                <div class="socials">
                    <a href="#" target="_blank"><i class="uil uil-github"></i></a>
                    <a href="#" target="_blank"><i class="uil uil-linkedin"></i></a>
                </div>
            </div>
            <div class="team__member">
                <p>İrem Karahan Software Engineering Student</p>
                <p>TED University</p>
                <div class="socials">
                    <a href="#" target="_blank"><i class="uil uil-github"></i></a>
                    <a href="#" target="_blank"><i class="uil uil-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'partials/footer.php';
?>
