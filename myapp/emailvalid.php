<?php

$email	= $_POST['email'];
$api_key='021587613dfc472a8b27f0688eb1860b';
// Initialize cURL.
$ch = curl_init();

// Set the URL that you want to GET by using the CURLOPT_URL option.
curl_setopt($ch, CURLOPT_URL, 'https://emailvalidation.abstractapi.com/v1/?api_key='.$api_key.'&email='.$email.'');

// Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Execute the request.
$data = curl_exec($ch);

// Close the cURL handle.
curl_close($ch);

// Print the data out onto the page.
echo $data;

//c2yEW$d@R!MFehe
?>