<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "@nithin123";
$dbname = "yoyo_db";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($input_password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }
    $stmt->close();
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: admin_panel.php");
    exit;
}

// Handle hotel data update form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_hotel']) && isset($_SESSION['admin_logged_in'])) {
    $hotel_id = $_POST['hotel_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rooms_available = $_POST['rooms_available'];

    $update_sql = "UPDATE hotels SET name=?, description=?, price=?, rooms_available=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssdii", $name, $description, $price, $rooms_available, $hotel_id);
    if ($stmt->execute()) {
        $message = "Hotel details updated successfully.";
    } else {
        $message = "Error updating hotel: " . $conn->error;
    }
    $stmt->close();
}

// Fetch hotel data if admin is logged in
if (isset($_SESSION['admin_logged_in'])) {
    $hotel_sql = "SELECT * FROM hotels";
    $hotels = $conn->query($hotel_sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>

<?php if (!isset($_SESSION['admin_logged_in'])): ?>
    <!-- Login Form -->
    <h2>Admin Login</h2>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form action="admin_panel.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit" name="login">Login</button>
    </form>

<?php else: ?>
    <!-- Admin Dashboard -->
    <h2>Welcome to the Admin Dashboard</h2>
    <p><a href="admin_panel.php?action=logout">Logout</a></p>

    <h3>Manage Hotel Data</h3>
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    <form method="POST">
        <label for="hotel_id">Hotel ID:</label>
        <input type="number" name="hotel_id" required>
        <br><br>
        <label for="name">Hotel Name:</label>
        <input type="text" name="name" required>
        <br><br>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <br><br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>
        <br><br>
        <label for="rooms_available">Rooms Available:</label>
        <input type="number" name="rooms_available" required>
        <br><br>
        <button type="submit" name="update_hotel">Update Hotel</button>
    </form>

    <h3>Hotels List</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Rooms Available</th>
        </tr>
        <?php while ($hotel = $hotels->fetch_assoc()): ?>
            <tr>
                <td><?php echo $hotel['id']; ?></td>
                <td><?php echo $hotel['name']; ?></td>
                <td><?php echo $hotel['description']; ?></td>
                <td><?php echo $hotel['price']; ?></td>
                <td><?php echo $hotel['rooms_available']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php endif; ?>

</body>
</html>
