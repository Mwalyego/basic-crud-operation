<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Update User</h2>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        Username: <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
