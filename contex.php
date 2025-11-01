<?php
// API endpoint URL
$api_url = 'https://api.example.com/data'; // Replace with your actual API endpoint

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);       // API URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
curl_setopt($ch, CURLOPT_HEADER, false);       // Do not include the header in the output

// If the API requires headers like authentication, you can add them here
$headers = [
    'Authorization: Bearer YOUR_ACCESS_TOKEN',  // Replace with your actual token or key
    'Content-Type: application/json',           // Set the content type to JSON
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the cURL request and capture the response
$response = curl_exec($ch);

// Check if the request was successful
if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Successfully received a response, parse it
    $data = json_decode($response, true); // Decode the JSON response into a PHP array

    // You can now use the $data array
    echo '<pre>';
    print_r($data); // Print the response data
    echo '</pre>';
}

// Close cURL session
curl_close($ch);
?>
