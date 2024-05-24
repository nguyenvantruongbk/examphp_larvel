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
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM PhoneBookContacts WHERE ID=$id") or die($conn->error);
$contact = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $conn->query("UPDATE PhoneBookContacts SET Name='$name', PhoneNumber='$phoneNumber' WHERE ID=$id") or die($conn->error);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Edit Contact</h1>
    <form method="post" action="edit_contact.php?id=<?php echo $id; ?>">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $contact['Name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="phoneNumber" class="form-control" value="<?php echo $contact['PhoneNumber']; ?>" pattern="[0-9]{10,15}" title="Phone number must be numeric and between 10 to 15 digits" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="index.php" class="btn btn-secondary">Back to Phone Book</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
