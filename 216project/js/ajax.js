// AJAX utility functions
const ajax = {
    // GET request function using fetch
    get: function(url, callback) {
        fetch(url) // sends a GET request to the specified URL
            .then(response => response.json()) // parses the response as JSON
            .then(data => callback(data)) // passes the parsed data to the callback
            .catch(error => console.error('Error:', error)); // logs any error
    },

    // POST request function using fetch
    post: function(url, data, callback) {
        fetch(url, {
            method: 'POST', // sets method to POST
            headers: {
                'Content-Type': 'application/json', // tells server to expect JSON
            },
            body: JSON.stringify(data) // sends data as a JSON string
        })
        .then(response => response.json()) // parses the JSON response
        .then(data => callback(data)) // sends parsed data to callback
        .catch(error => console.error('Error:', error)); // handles errors
    }
};

// Waits for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('#contact-form'); // selects contact form

    if (contactForm) {
        // Event listener for form submission
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // prevents default form behavior (refresh)

            const formData = new FormData(this); // gathers form data
            const data = Object.fromEntries(formData.entries()); // converts to object

            // Sends form data to server using AJAX POST
            ajax.post('contact-ajax.php', data, function(response) {
                const messageDiv = document.querySelector('#message'); // selects message container

                if (messageDiv) {
                    messageDiv.innerHTML = response.message; // displays message from server
                    messageDiv.className = response.success ? 'alert__message success' : 'alert__message error'; // applies styling

                    if (response.success) {
                        contactForm.reset(); // clears form if successful
                    }
                }
            });
        });
    }
});
