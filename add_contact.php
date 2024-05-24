<?php
  // query to DB 
  //1. connect db
  $host = "localhost";
  $user = "root";
  $pass = "root";
  $db = "my_contact_app";

// Create connection
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
  die("Connect database failed");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $conn->query("INSERT INTO PhoneBookContacts (Name, PhoneNumber) VALUES ('$name', '$phoneNumber')") or die($conn->error);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Add New Contact</h1>
    <form method="post" action="add_contact.php">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="phoneNumber" class="form-control" pattern="[0-9]{10,15}" title="Phone number must be numeric and between 10 to 15 digits" required>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
        <a href="index.php" class="btn btn-secondary">Back to Phone Book</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
