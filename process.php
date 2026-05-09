<?php
header("Content-Type: text/plain");

$apiKey = "AIzaSyB-7pO3U3jAv-oDzJ_Du4tXvRQ18sjNs8c";

// 🔹 User message (from AJAX POST)
$userMessage = $_POST['message'] ?? '';

if (empty($userMessage)) {
  echo "Please type something!";
  exit;
}

// 🔹 Correct endpoint for Gemini 2.5 Flash
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=$apiKey";

// 🔹 Request body
$payload = [
  "contents" => [
    [
      "parts" => [
        ["text" => $userMessage]
      ]
    ]
  ]
];

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL            => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST           => true,
  CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
  CURLOPT_POSTFIELDS     => json_encode($payload),
  CURLOPT_TIMEOUT        => 30,   
  CURLOPT_CONNECTTIMEOUT => 10,   
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
  echo "cURL Error: " . curl_error($curl);
  curl_close($curl);
  exit;
}

curl_close($curl);

// 🔹 Parse API response
$data = json_decode($response, true);

if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
  $text = trim($data['candidates'][0]['content']['parts'][0]['text']);
  $text = preg_replace('/\*\*(.*?)\*\*/s', '$1', $text);    // **bold**
  $text = preg_replace('/\*(.*?)\*/s',     '$1', $text);    // *italic*
  $text = preg_replace('/`{1,3}[^`]*`{1,3}/s', '', $text); // `code`
  $text = preg_replace('/#{1,6}\s*/m',     '',   $text);    // ## headings
  $text = preg_replace('/^\s*[-*+]\s+/m',  '',   $text);    // - bullets
  $text = preg_replace('/\n{3,}/',        "\n\n", $text);   // excess blank lines

  echo trim($text);
} else {
  echo "No response from Gemini API." . $response;
}
?>