

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment and Entrance QR Code</title>
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
        <h2>Payment and Entrance QR Code</h2>
        <!-- Button to show the pop-up message -->
        <button id="showPopup">Show QR Code</button>
        <!-- Hidden div to display the QR code after the pop-up message -->
        <div id="qrcodeContainer" class="qr-code" style="display: none;">

            <?php
                session_start();

                require_once 'database.php'; // Ensure this file correctly initializes $conn
                require_once 'phpqrcode/qrlib.php';

                // Initialize variables with empty default values if not set
                $name = $_GET['name'] ?? '';
                $adult = $_GET['adult'] ?? 0;
                $children = $_GET['children'] ?? 0;
                $senior_citizen = $_GET['senior_citizen'] ?? 0;
                $disabled_individual = $_GET['disabled_individual'] ?? 0;
                $foreigner = $_GET['foreigner'] ?? 0;
                $total_price = $_GET['total_price'] ?? 0;

                $path = 'images/';
                $qrimage = "$name" . time() . '.png';
                // $qrimage = time() . ".png"; // Unique filename for the QR image
                $qrcode = $path . $qrimage; // Full path where the QR code image will be saved

                // Ensure the directory exists and is writable
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // $qrtext = "$name"; // Initialize the QR code text

                $qrtext = "Name is $name\nAdult Tickets are $adult\nChildren Tickets are $children\nSenior Citizen Tickets are $senior_citizen\nDisabled Individual Tickets are $disabled_individual\nForeigner Tickets are $foreigner\nTotal Price is $total_price";
                // $qrtext = "Name: $name, Adults: $adult, Children: $children, Seniors: $senior_citizen, Disabled: $disabled_individual, Foreigners: $foreigner, Total Price: $total_price";
                $time_in = date('Y-m-d H:i:s');

                // Insert into QR Code table
                $stmt = $conn->prepare("INSERT INTO qrcode (qrtext, qrimage, time_in) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $qrtext, $qrimage, $time_in);

                if ($stmt->execute()) {
                    $qrcode_id = $conn->insert_id;
                    // echo "<script>alert('QR Code saved successfully');</script>";

                    // Assuming you have the ticket purchase ID stored in session
                    $ticket_purchase_id = $_SESSION['ticket_purchase_id'] ?? null;

                    if ($ticket_purchase_id) {
                        // Update the ticket_purchase table with the qrcode_id
                        $updateStmt = $conn->prepare("UPDATE ticket_purchase SET qrcode_id = ? WHERE id = ?");
                        $updateStmt->bind_param("ii", $qrcode_id, $ticket_purchase_id);
                        $updateStmt->execute();
                        $updateStmt->close();
                    }
                } else {
                    echo "<script>alert('Error saving data: " . htmlspecialchars($conn->error) . "');</script>";
                }
                $stmt->close();
                $conn->close();

                // Generate the QR code
                if (!empty($qrtext)) {
                    QRcode::png($qrtext, $qrcode, 'H', 4, 4);
                    echo "<img src='" . htmlspecialchars($qrcode) . "' alt='QR Code'>";
                }
            ?>
            <!-- Display the QR code image -->
            <!-- Button to proceed to the next step -->
            <button id="nextBtn">Next</button>
        </div>
    </div>

    <script>
        // Function to show the pop-up message and QR code
        document.getElementById('showPopup').addEventListener('click', function() {
            // Show pop-up message
            alert("This is the Payment and Entrance QR Code.\nScan me to proceed.");
            // Show QR code container
            document.getElementById('qrcodeContainer').style.display = 'flex';


        });

        // Function to handle the next button click event
        document.getElementById('nextBtn').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_timeout.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Redirect to the page to scan the exit QR code
                    var qrImageName = "<?php echo $qrimage; ?>";
                    window.location.href = 'exit.php?qrimage=' + encodeURIComponent(qrImageName);
                } else {
                    alert('Error updating time out.');
                }
            };
            xhr.send("qrimage=" + encodeURIComponent('<?php echo $qrimage; ?>'));
        });

    </script>
</body>
</html>