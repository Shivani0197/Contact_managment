<?php
include 'config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM contacts WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $conn->query("UPDATE contacts SET first_name='$fname', last_name='$lname', address='$address', email='$email', phone='$phone' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
</head>
<body>
<h2>Edit Contact</h2>
<form method="POST">
    <input type="text" name="fname" value="<?= $row['first_name'] ?>" required>
    <input type="text" name="lname" value="<?= $row['last_name'] ?>" required>
    <input type="text" name="address" value="<?= $row['address'] ?>" required>
    <input type="email" name="email" value="<?= $row['email'] ?>" required>
    <input type="text" name="phone" value="<?= $row['phone'] ?>" required>
    <button type="submit">Update</button>
</form>
</body>
</html>