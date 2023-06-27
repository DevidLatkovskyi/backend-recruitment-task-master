<?php
// Load JSON data from file
$jsonData = file_get_contents('../dataset/users.json');

// Decode JSON data
$users = json_decode($jsonData, true);

// Check if decoding was successful
if ($users !== null) {
    // Get the user data from the request payload
    $requestData = json_decode(file_get_contents('php://input'), true);

    // Generate a unique user ID
    $newUserId = generateUserId($users);

    // Create a new user object
    $newUser = array(
        'id' => $newUserId,
        'name' => $requestData['name'],
        'username' => $requestData['username'],
        'email' => $requestData['email'],
        'address' => array(
            'street' => $requestData['street'],
            'zipcode' => $requestData['zipcode'],
            'city' => $requestData['city']
        ),
        'phone' => $requestData['phone'],
        'company' => array(
            'name' => $requestData['company']
        )
    );

    // Add the new user to the array
    $users[] = $newUser;

    // Save the updated JSON data back to the file
    file_put_contents('../dataset/users.json', json_encode($users));

    // Output a success message
    echo 'User successfully added to JSON.';
} else {
    // Output an error message if JSON decoding fails
    echo 'Error: Unable to decode JSON data.';
}

function generateUserId($users)
{
    // Generate a unique user ID
    $maxUserId = 0;

    foreach ($users as $user) {
        if ($user['id'] > $maxUserId) {
            $maxUserId = $user['id'];
        }
    }

    return $maxUserId + 1;
}

