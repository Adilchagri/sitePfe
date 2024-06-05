<?php
// Get the user's IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Get the user's location using IP Geolocation API
$api_url = "https://ipgeolocation.io/api/json/{$ip}";
$response = json_decode(file_get_contents($api_url), true);

$city = $response['city'];
$country = $response['country_name'];

// Get the current time
$current_time = date("h:i A"); // 12-hour format with AM/PM

// Get the current weather using OpenWeatherMap API
$api_key = "AIzaSyDYAayBO83o_DDYJlWMvWunY8o-nJy5FTA"; // replace with your OpenWeatherMap API key
$api_url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}";
$response = json_decode(file_get_contents($api_url), true);

$temperature = $response['main']['temp']; // in Kelvin
$weather_icon = $response['weather'][0]['icon'];

// Output the data as JSON
echo json_encode(array(
    'city' => $city,
    'country' => $country,
    'currentTime' => $current_time,
    'temperature' => $temperature,
    'weatherIcon' => $weather_icon
));
?>