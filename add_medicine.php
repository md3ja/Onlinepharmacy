<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharma_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = $_POST['medicine_name'];
    $company_name = $_POST['company_name'];
    $ndc = $_POST['ndc'];
    $expiry_date = $_POST['expiry_date'];
    $available_amount_left = $_POST['available_amount_left'];

    $sql = "INSERT INTO medicines (medicine_name, company_name, ndc, expiry_date, available_amount_left) 
            VALUES ('$medicine_name', '$company_name', '$ndc', '$expiry_date', '$available_amount_left')";

    if ($conn->query($sql) === TRUE) {
        echo "<div id='customAlert' style='
                position: fixed; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background-color: rgba(0, 0, 0, 0.5); 
                display: flex; 
                justify-content: center; 
                align-items: center;'>
                <div style='
                    background-color: white; 
                    padding: 20px; 
                    border-radius: 10px; 
                    text-align: center;'>
                    <p>Store says: New medicine added successfully!</p>
                    <button style='
                        background-color: #2c8f8d; 
                        color: white; 
                        padding: 10px 20px; 
                        border: none; 
                        border-radius: 5px; 
                        cursor: pointer;' 
                        onclick='window.location.href=\"add_medicine.html\"'>OK</button>
                </div>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Medicine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('wallpaper 2.webp'); /* Link to your wallpaper */
            background-size: cover;
            margin: 0;
            padding: 20px;
        }

        #customAlert p {
            color: #2c3e50; /* Dark gray text */
            font-size: 18px;
        }

        #customAlert button {
            background-color: #2c8f8d; /* Teal button color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #customAlert button:hover {
            background-color: #247d7b; /* Darker teal on hover */
        }
    </style>
</head>
<body>
</body>
</html>
