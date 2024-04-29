<?php
session_start();
require_once 'database.php'; // Your database connection file

// SQL to join ticket_purchase with qrcode
$query = "SELECT tp.*, q.time_in, q.time_out
          FROM ticket_purchase tp
          LEFT JOIN qrcode q ON tp.qrcode_id = q.id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Admin Interface - Ticket Purchases</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Adult Quantity</th>
                <th>Children Quantity</th>
                <th>Senior Quantity</th>
                <th>Disabled Quantity</th>
                <th>Foreigner Quantity</th>
                <th>Total Price</th>
                <th>Purchase Date</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['adult_quantity']}</td>
                            <td>{$row['children_quantity']}</td>
                            <td>{$row['senior_quantity']}</td>
                            <td>{$row['disabled_quantity']}</td>
                            <td>{$row['foreigner_quantity']}</td>
                            <td>{$row['total_price']}</td>
                            <td>{$row['purchase_date']}</td>
                            <td>{$row['time_in']}</td>
                            <td>{$row['time_out']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
