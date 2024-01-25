<?php
// $args = http_build_query(array(
//     'token' => 'trans_token',
//     'amount'  => 1000
// ));

// $url = "https://khalti.com/api/v2/payment/verify/";

// # Make the call using API.
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $headers = ['Authorization: Key test_secret_key_abcf34a5e73f49ed8a198a559a8b5d1d'];
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// // Response
// $response = curl_exec($ch);
// $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);

// if ($response === false) {
//     echo 'Curl error: ' . curl_error($ch) . PHP_EOL;
// } else {
//     echo 'Response: ' . $response . PHP_EOL;
// }

// if ($status_code == 200) {
//     header('Content-Type: application/json');
//     echo json_encode(['success' => 1, 'redirectto' => 'khalti.php']);
// } else {
//     header('Content-Type: application/json');
//     echo json_encode(['error' => 1, 'message' => 'Payment Failed']);
// }

// Ensure that both 'amount' and 'trans_token' parameters are present in the GET request.
// if (isset($_GET['amount']) && isset($_GET['trans_token'])) {
//     $amount = $_GET['amount'];
//     $trans_token = $_GET['trans_token'];

//     // Replace 'test_secret_key_abcf34a5e73f49ed8a198a559a8b5d1d' with your actual secret key.
//     $secret_key = 'test_secret_key_abcf34a5e73f49ed8a198a559a8b5d1d';

//     $url = "https://khalti.com/api/v2/payment/verify/";

//     // Prepare data for the Khalti API request.
//     $args = [
//         'token' => $trans_token,
//         'amount' => 1000,
//     ];

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//     $headers = ['Authorization: Key ' . $secret_key];
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//     // Execute the Khalti API request.
//     $response = curl_exec($ch);
//     $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);
//     return $response;

//     if ($status_code == 200) {
//         header('Content-Type: application/json');
//         echo json_encode(['success' => 1, 'message' => 'Payment Verified']);
//     } else {
//         header('Content-Type: application/json');
//         echo json_encode(['error' => 1, 'message' => 'Payment Verification Failed']);
//     }
// } else {
//     header('Content-Type: application/json');
//     echo json_encode(['error' => 1, 'message' => 'Invalid Request']);
// }
// Ensure that both 'amount' and 'trans_token' parameters are present in the GET request.
if (isset($_GET['amount']) && isset($_GET['trans_token'])) {
    $amount = $_GET['amount'];
    $trans_token = $_GET['trans_token'];

    // Replace 'test_secret_key_abcf34a5e73f49ed8a198a559a8b5d1d' with your actual secret key.
    $secret_key = 'live_secret_key_0e92ce7ead1842ab895da4a8b847143d';

    $url = "https://khalti.com/api/v2/payment/verify/";

    // Prepare data for the Khalti API request.
    $args = [
        'token' => $trans_token,
        'amount' => $amount,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $headers = ['Authorization: Key ' . $secret_key];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the Khalti API request.
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status_code == 200) {
       
        $decodedResponse = json_decode($response, true);

       
        $decodedResponse['status'] = 'success';

        
        $jsonResponse = json_encode($decodedResponse);

        // Send the JSON response to the client
        header('Content-Type: application/json');
        echo $jsonResponse;
    } else {
        // Send an error JSON response to the client
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Payment Verification Failed']);
    }
} else {
    // Send an invalid request JSON response to the client
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}

