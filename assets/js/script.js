//REMOVE USER CODE

document.addEventListener('DOMContentLoaded', function() {
    // Get a reference to the table
    const table = document.getElementById('users-table');

    // Add event listener to the table
    table.addEventListener('click', (event) => {
        // Check if the "Remove" button was clicked
        if (event.target.classList.contains('remove-user-btn')) {
            // Get the user ID from the "data-user-id" attribute
            const userId = event.target.getAttribute('data-user-id');

            // Remove the user from the JSON file
            removeUserFromJSON(userId);
        }
    });

    // Function to remove a user from the JSON file
    function removeUserFromJSON(userId) {
        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../partials/remove_user.php', true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Reload the page after successful user removal
                location.reload();
            } else {
                // Output an error message
                console.error('Error: ' + xhr.status);
            }
        };
        xhr.send(JSON.stringify({ userId: userId }));
    }
});

//REMOVE USER CODE

//==========================

//ADD USER CODE

document.addEventListener('DOMContentLoaded', function() {
    // Get a reference to the add user form
    const addUserForm = document.getElementById('add-user-form');

    // Add event listener to the form
    addUserForm.addEventListener('submit', (event) => {
        event.preventDefault();

        // Get the values from the form fields
        const name = document.getElementById('name-input').value;
        const username = document.getElementById('username-input').value;
        const email = document.getElementById('email-input').value;
        const street = document.getElementById('street-input').value;
        const zipcode = document.getElementById('zipcode-input').value;
        const city = document.getElementById('city-input').value;
        const phone = document.getElementById('phone-input').value;
        const company = document.getElementById('company-input').value;

        // Create an object with the user data
        const newUser = {
            name: name,
            username: username,
            email: email,
            street: street,
            zipcode: zipcode,
            city: city,
            phone: phone,
            company: company
        };

        // Send an AJAX request to add the user
        addUserToJSON(newUser);
    });

    // Function to add a user to the JSON file
    function addUserToJSON(user) {
        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../partials/add_user.php', true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Reload the page after successful user addition
                location.reload();
            } else {
                // Output an error message
                console.error('Error: ' + xhr.status);
            }
        };
        xhr.send(JSON.stringify(user));
    }
});
