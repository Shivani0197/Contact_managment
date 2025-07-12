<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $check = $conn->query("SELECT * FROM contacts WHERE email='$email' OR phone='$phone'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Duplicate Email or Phone');</script>";
    } else {
        $sql = "INSERT INTO contacts (first_name, last_name, address, email, phone)
                VALUES ('$fname', '$lname', '$address', '$email', '$phone')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$result = $conn->query("SELECT * FROM contacts");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Contact Manager</h2>

<form method="POST">
    <input type="text" name="fname" placeholder="First Name" required>
    <input type="text" name="lname" placeholder="Last Name" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="email" name="email" placeholder="Email ID" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <button type="submit">Add Contact</button>
</form>

<table>
<tr>
    <th>First Name</th><th>Last Name</th><th>Address</th><th>Email</th><th>Phone</th><th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['first_name'] ?></td>
    <td><?= $row['last_name'] ?></td>
    <td><?= $row['address'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this contact?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
</body>
</html>