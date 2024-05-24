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
//2. query SQL
// Delete contact
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM PhoneBookContacts WHERE ID=$id") or die($conn->error);
}

// Fetch contacts
$result = $conn->query("SELECT * FROM PhoneBookContacts") or die($conn->error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Phone Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Phone Book Contacts</h1>
    <a href="add_contact.php" class="btn btn-primary mb-3">Add New Contact</a>
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['PhoneNumber']; ?></td>
            <td>
                <a href="edit_contact.php?id=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="index.php?delete=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>