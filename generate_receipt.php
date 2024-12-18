<?php
header('Content-Type: application/json');

// Allow only POST requests 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Only POST requests are allowed"]);
    exit;
}

// Get input from POST request
$inputData = json_decode(file_get_contents('php://input'), true);
// Validate inputs
if (!isset($inputData['cardNumber']) || !isset($inputData['plateNumber'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Missing required parameters: cardNumber and plateNumber"]);
    exit;
}

$cardNumber = $inputData['cardNumber'];
$plateNumber = $inputData['plateNumber'];

// length checker
function validateLength($input, $length) {
    return strlen($input) === $length;
}
//return if user send empty inputs
if (empty($cardNumber) || empty($plateNumber)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input values: cardNumber and plateNumber cannot be empty"]);
    exit;
}
// Verify length of inputs cardNumber must be 16 digits and  plateNumber 7 characters)
if (!validateLength($cardNumber, 16) || !validateLength($plateNumber, 7)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input length: cardNumber must be 16 digits and plateNumber must be 7 characters"]);
    exit;
}

// generating unique ID
$receiptCode = strtoupper(uniqid("REC"));

// Generate receipt
$receipt = [
    "receiptCode" => $receiptCode,
    "cardNumber" => $cardNumber,
    "plateNumber" => $plateNumber,
    "taxPaid" => "1000.00", // tax amount
    "totalWithTax" => "1100.00", // 
    "date" => date("Y-m-d H:i:s")
];

// Output the receipt as JSON
echo json_encode(["receipt" => $receipt], JSON_PRETTY_PRINT);
