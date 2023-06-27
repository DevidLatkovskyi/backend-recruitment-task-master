<?php
// Load JSON data from file
$jsonData = file_get_contents('dataset/users.json');

// Decode JSON data
$users = json_decode($jsonData, true);

// Check if decoding was successful
if ($users !== null) {
    // Create the table header
    $table = '<table class="table" id="users-table">';
    $table .= '<tr>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Company</th>
        <th>Remove User</th>
    </tr>';
    // Iterate over each user and create table rows
    foreach ($users as $user) {
        $userId = $user['id'];
        $name = $user['name'];
        $username = $user['username'];
        $email = $user['email'];
        $address = $user['address']['street'] . ', ' . $user['address']['zipcode'] . ', ' . $user['address']['city'];
        $phone = $user['phone'];
        $company = $user['company']['name'];

        // Add a new row to the table
        $table .= '<tr>
    <td>' . $name . '</td>
    <td>' . $username . '</td>
    <td>' . $email . '</td>
    <td>' . $address . '</td>
    <td>' . $phone . '</td>
    <td>' . $company . '</td>
    <td><a class="remove-user-btn" data-user-id="' . $userId . '" href="#">Remove</a></td>
</tr>';

    }

    // Close the table
    $table .= '</table>';

    // Display the table
    echo $table;

    //create add user form
    echo '<br><br><form id="add-user-form">
    <input type="text" id="name-input" placeholder="Name" required>
    <input type="text" id="username-input" placeholder="Username" required>
    <input type="email" id="email-input" placeholder="Email" required>
    <input type="text" id="street-input" placeholder="Street" required>
    <input type="text" id="zipcode-input" placeholder="Zipcode" required>
    <input type="text" id="city-input" placeholder="City" required>
    <input type="text" id="phone-input" placeholder="Phone" required>
    <input type="text" id="company-input" placeholder="Company" required>
    <button type="submit">Add User</button>
</form>';
}

else {
    echo 'Error: Unable to decode JSON data.';
}


