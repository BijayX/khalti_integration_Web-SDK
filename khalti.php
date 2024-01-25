<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khalti Payment</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
    
        button {
            padding: 30px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            
        }
    </style>
</head>
<body>
   
<button id="payment-button" >
    <img src="logo.png" alt="logo" width="86" height="54">
    <br>
   Pay Now
</button>

  
   <script>
       var config = {
         
           "publicKey": "live_public_key_2c55477f922e4f60aac6caba3df4addb",
           "productIdentity": "1234567890",
           "productName": "Dragon",
           "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
           "paymentPreference": [
               "KHALTI",
               "EBANKING",
               "MOBILE_BANKING",
               "CONNECT_IPS",
               "SCT",
               ],
           "eventHandler": {
               onSuccess (payload) {
                   console.log(payload);
                   $.ajax({
                       url: "verify.php",
                       type: 'GET',
                       data: {
                           amount: payload.amount,
                           trans_token: payload.token
                       },
                       success: function (res) {
                           console.log(res);
                           
                           if (res.status === 'success') {
                               console.log("Transaction successful");
                           } else {
                               console.log("Transaction failed");
                           }
                       },
                       error: function (error) {
                           console.log("AJAX error:", error);
                       }
                   });

                  Swal.fire({
                    title: "Payment Successful!",
                    text: "Thank you for your payment!",
                    icon: "success"
                    });
               },
               onError (error) {
                   console.log(error);
                
                Swal.fire({
                    title: "Payment Error!",
                    text: "There was an error processing your payment.",
                    icon: "error"
                    });
               },
           }
       };

       var checkout = new KhaltiCheckout(config);
       var btn = document.getElementById("payment-button");
       btn.onclick = function () {
           // minimum transaction amount must be 10, i.e 1000 in paisa.
           checkout.show({amount: 1000});
       }
    </script>
</body>
</html>