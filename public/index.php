<?php
header('Content-Type: application/json');
$numberFile = 'last_number.txt';

// Check if the file exists
if (!file_exists($numberFile)) {
    // If the file doesn't exist, create it with a starting value of 10000
    file_put_contents($numberFile, '10000');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Read the last number from the file
    $lastNumber = file_get_contents($numberFile);

    // Convert to integer and increment by 1
    $nextNumber = intval($lastNumber) + 1;

    // Ensure the number stays within 5 digits
    if ($nextNumber > 99999) {
        $nextNumber = 10000; // Reset to 10000 if it exceeds 99999
    }

    // Save the updated number to the file
    file_put_contents($numberFile, $nextNumber);

    // Return the incremented number in the response
  echo json_encode(array('nextNumber' => $nextNumber));
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Please use GET method to access this resource.'));
}
?>