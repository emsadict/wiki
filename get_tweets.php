<?php
function getWikimediaTweets($count = 3) {
    $bearer_token = 'AAAAAAAAAAAAAAAAAAAAADWxpAEAAAAA6dR1vosC6BUPhPGtv710tm%2F806k%3D3C7wP3pcbLEqCxTaAVc94xECbHXIWL16fPYZg0h6AUh0hrMIXt'; // Replace with your actual Bearer Token

    // Get user ID
    $username = 'WikimediaNG';
    $user_url = "https://api.twitter.com/2/users/by/username/$username";

    $headers = [
        "Authorization: Bearer $bearer_token",
        "User-Agent: TwitterAPIRequest"
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $user_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);
    $user_response = curl_exec($ch);
    $user_data = json_decode($user_response, true);

    if (!isset($user_data['data']['id'])) return [];

    $user_id = $user_data['data']['id'];

    // Get tweets
    $tweets_url = "https://api.twitter.com/2/users/$user_id/tweets?" . http_build_query([
        'max_results' => $count,
        'tweet.fields' => 'created_at,public_metrics',
    ]);
    curl_setopt($ch, CURLOPT_URL, $tweets_url);
    $tweets_response = curl_exec($ch);
    curl_close($ch);

    $tweets_data = json_decode($tweets_response, true);
    if (!isset($tweets_data['data'])) return [];

    return $tweets_data['data'];
}
?>
