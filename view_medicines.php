<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharma_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM medicines";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Storge</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #fff; 
        }

        .Storge {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .medicine-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .medicine-card h2 {
            font-size: 18px;
            margin: 0 0 10px;
            color: #333;
        }

        .medicine-card p {
            margin: 5px 0;
            color: #555;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .button-group button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .edit-button {
            background-color: #4CAF50;
            color: white;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }

        .add-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
        }

        .add-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Medicine Storge</h1>

    <button class="add-button" onclick="window.location.href='add_medicine.html'">Add New Medicine</button>

    <div class="Storge">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($medicine = $result->fetch_assoc()) {
                echo "
                <div class='medicine-card'>
                    <h2>Medicine Name: {$medicine['medicine_name']}</h2>
                    <p>Company Name: {$medicine['company_name']}</p>
                    <p>NDC: {$medicine['ndc']}</p>
                    <p>Expiry Date: {$medicine['expiry_date']}</p>
                    <p>Available Amount Left: {$medicine['available_amount_left']}</p>
                    <div class='button-group'>
                        <button class='edit-button' onclick=\"window.location.href='edit_medicine.php?id={$medicine['id']}'\">Edit</button>
                        <button class='delete-button' onclick=\"window.location.href='delete_medicine.php?id={$medicine['id']}'\">Delete</button>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No medicines found in the Storge.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
