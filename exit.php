<?php
session_start();

require_once 'database.php'; // Ensure this file correctly initializes $conn

$qrimage = $_GET['qrimage'] ?? ''; // Get the QR image name from the URL
$path = 'images/';
$qrcodePath = $path . $qrimage; // Construct the full path to the QR code image

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exit QR Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(bacground.png);
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 150px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .qr-code {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
            margin-bottom: 20px; /* Increased margin between QR code and buttons */
        }
        .qr-code img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px; /* Increased margin below QR code */
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px; /* Increased margin above and below buttons */
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Exit QR Code</h2>
        <!-- Button to show the pop-up message -->
        <button id="showPopup">Show QR Code</button>
        <!-- Hidden div to display the QR code after the pop-up message -->
        <div id="qrcodeContainer" class="qr-code" style="display: none;">
            <!-- Display the QR code image -->
            <img src="<?php echo $qrcodePath; ?>" alt="Exit QR Code">
            <!-- Button to confirm exit QR code scanning -->
            <button onclick="terminateQR()">Scan Exit QR Code</button>
        </div>
    </div>

    <script>
        // Function to show the pop-up message and QR code
        document.getElementById('showPopup').addEventListener('click', function() {
            // Show pop-up message
            alert("This is the Exit QR Code.\nScan me to proceed.");
            // Show QR code container
            document.getElementById('qrcodeContainer').style.display = 'flex';
        });

        // Function to handle exit QR code scanning
        function terminateQR() {
            // Alert the user
            // alert("Exit QR code scanned. Terminating...");

            window.location.href = 'admin_interface.php';
        }

    </script>
</body>
</html>