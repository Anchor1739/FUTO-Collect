# Receipt Generation API

This repository contains a simple PHP script that generates a receipt for a given `cardNumber` and `plateNumber`. The script is designed to handle HTTP POST requests, validate inputs, and return a receipt in JSON format.

## Features

- **Accepts POST Requests**: The API only accepts `POST` requests. Other request methods are rejected with a `405 Method Not Allowed` error.
- **Input Validation**:
  - `cardNumber`: Must be a 16-digit number.
  - `plateNumber`: Must be exactly 7 characters.
  - Neither `cardNumber` nor `plateNumber` can be empty.
- **Generates Unique Receipt Code**: A unique receipt code is created using PHP's `uniqid` function, prefixed with `REC`.
- **Outputs Receipt**:
  - Includes a unique code, inputs (`cardNumber`, `plateNumber`), tax amount, total cost, and a timestamp.
- **Returns JSON Response**: All responses, including errors, are returned in JSON format.

## Prerequisites

- PHP installed on your server or local environment.
- A tool to send POST requests (e.g., Postman, curl, or similar).

## How to Use

1. Place the script on your PHP server or hosting environment.
2. Send a POST request to the script with the following JSON payload:
    ```json
    {
        "cardNumber": "1234567812345678",
        "plateNumber": "ABC1234"
    }
    ```

3. Ensure the request headers include:
    ```
    Content-Type: application/json
    ```

4. If the inputs are valid, the API will return a receipt in the following format:
    ```json
    {
        "receipt": {
            "receiptCode": "RECXXXXXXXXXXXX",
            "cardNumber": "1234567812345678",
            "plateNumber": "ABC1234",
            "taxPaid": "1000.00",
            "totalWithTax": "1100.00",
            "date": "YYYY-MM-DD HH:MM:SS"
        }
    }
    ```

## Error Responses

The API validates inputs and returns appropriate error responses:

- **Invalid HTTP Method**:
    ```json
    {
        "error": "Only POST requests are allowed"
    }
    ```

- **Missing Parameters**:
    ```json
    {
        "error": "Missing required parameters: cardNumber and plateNumber"
    }
    ```

- **Empty Input**:
    ```json
    {
        "error": "Invalid input values: cardNumber and plateNumber cannot be empty"
    }
    ```

- **Invalid Input Length**:
    ```json
    {
        "error": "Invalid input length: cardNumber must be 16 digits and plateNumber must be 7 characters"
    }
    ```


---
