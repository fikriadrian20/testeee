require 'vendor/autoload.php';

use Goutte\Client;

if (!function_exists('curl_version')) {
    die('cURL is not installed or enabled on your server');
}

$client = new Client();

$email = readline("Enter email: ");
$password = readline("Enter password: ");
$proxy = readline("Enter proxy: ");

$client->setClient(new \GuzzleHttp\Client(['proxy' => $proxy]));

// Send a GET request to the login page
$crawler = $client->request('GET', 'https://www.netflix.com/login');

// Fill out the login form and submit it
$form = $crawler->selectButton('Sign In')->form();
$crawler = $client->submit($form, array('userLoginId' => $email, 'password' => $password));

// Check if the login was successful by looking for specific elements on the page
$is_logged_in = $crawler->filter('.appMount')->count() > 0;

if ($is_logged_in) {
    echo "Login Successful for user " . $email . " with proxy " . $proxy . "\n";
} else {
    echo "Invalid credentials for user " . $email . " with proxy " . $proxy . "\n";
}
