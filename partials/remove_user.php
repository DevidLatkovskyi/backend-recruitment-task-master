<?php
// Load JSON data from file
$jsonData = file_get_contents('../dataset/users.json');

// Decode JSON data
$users = json_decode($jsonData, true);

// Check if decoding was successful
if ($users !== null) {
    // Get the user ID to remove from the request payload
    $requestData = json_decode(file_get_contents('php://input'), true);
    $userIdToRemove = $requestData['userId'];

    // Find the user index based on the ID
    $userIndex = array_search($userIdToRemove, array_column($users, 'id'));

    // Remove the user from the array if found
    if ($userIndex !== false) {
        unset($users[$userIndex]);

        // Reindex the array to maintain sequential keys
        $users = array_values($users);

        // Save the updated JSON data back to the file
        file_put_contents('../dataset/users.json', json_encode($users));

        // Output a success message
        echo 'User successfully removed from JSON.';
    } else {
        // Output a message if the user with the specified ID is not found
        echo 'User with the specified ID not found.';
    }
} else {
    // Output an error message if JSON decoding fails
    echo 'Error: Unable to decode JSON data.';
}
?>
