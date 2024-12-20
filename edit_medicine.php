<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharma_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $medicine_name = $_POST['medicine_name'];
    $company_name = $_POST['company_name'];
    $ndc = $_POST['ndc'];
    $expiry_date = $_POST['expiry_date'];
    $available_amount_left = $_POST['available_amount_left'];

    $sql = "UPDATE medicines SET medicine_name='$medicine_name', company_name='$company_name', ndc='$ndc', expiry_date='$expiry_date', available_amount_left='$available_amount_left' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully'); window.location.href='view_medicines.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$row = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM medicines WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>No medicine found with ID " . $id . "</p>";
    }
} else {
    echo "<p>No ID parameter provided.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Edit Medicine</h2>

<?php if ($row): ?>
<form method="POST" action="edit_medicine.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="medicine_name">Medicine Name:</label>
    <input type="text" name="medicine_name" value="<?php echo $row['medicine_name']; ?>" required>

    <label for="company_name">Company Name:</label>
    <input type="text" name="company_name" value="<?php echo $row['company_name']; ?>" required>

    <label for="ndc">NDC:</label>
    <input type="text" name="ndc" value="<?php echo $row['ndc']; ?>" required>

    <label for="expiry_date">Expiry Date:</label>
    <input type="date" name="expiry_date" value="<?php echo $row['expiry_date']; ?>" required>

    <label for="available_amount_left">Available Amount Left:</label>
    <input type="number" name="available_amount_left" value="<?php echo $row['available_amount_left']; ?>" required>

    <input type="submit" name="update" value="Update">
</form>
<?php else: ?>
<p>No medicine selected or medicine not found.</p>
<?php endif; ?>

</body>
</html>
