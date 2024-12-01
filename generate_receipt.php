<?php
header('Content-Type: application/json');



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
