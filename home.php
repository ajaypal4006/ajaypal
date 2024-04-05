<?php
// Database details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "week5";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete customer record if delete button is clicked
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM customers WHERE id = $delete_id";
    $conn->query($delete_sql);
}

// Fetch data from the customers table
$sql = "SELECT id, cus_name, cus_email, cus_message, cus_image FROM customers";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ecf0f3;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #3498db;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 8px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 6px;
            display: block;
            margin: 0 auto;
        }

        button {
            display: block;
            margin: 10px auto;
            padding: 10px;
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        button:hover {
            background-color: #219c52;
        }
    </style>
</head>
<body>

    <h2>Customer Data</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Image</th>
                <th>Action</th> <!-- New column for delete button -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Display data in the table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['cus_name']}</td>";
                    echo "<td>{$row['cus_email']}</td>";
                    echo "<td>{$row['cus_message']}</td>";
                    echo "<td><img src='{$row['cus_image']}' alt='Customer Image'></td>";
                    echo "<td><form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>";
                    echo "<input type='hidden' name='delete_id' value='{$row['id']}'>";
                    echo "<button type='submit'>Delete</button>";
                    echo "</form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="form.html"><button type="button">Go to Form</button></a>

</body>
</html>
