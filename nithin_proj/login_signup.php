<?php
// database connection
$servername = "localhost";
$username = "root";  // your DB username
$password = "@nithin123";      // your DB password
$dbname = "yoyo_db";    // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle signup
if (isset($_POST['signup'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hashing the password
    $phone_number = $_POST['phone_number'];

    // Check if email already exists
    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email_sql);
    
    if ($result->num_rows > 0) {
        echo "<p>Email is already registered. Please use a different email address.</p>";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (first_name, last_name, email, password, phone_number) VALUES ('$first_name', '$last_name', '$email', '$password', '$phone_number')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect to index.php after successful signup
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Handle login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Redirect to index.php after successful login
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Invalid password</p>";
        }
    } else {
        echo "<p>No user found with that email address</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOYO - Login/Signup</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 10px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Signup Form -->
            <form method="POST" class="form" id="signup-form">
                <h2>Sign Up</h2>
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone_number" placeholder="Phone Number">
                <button type="submit" name="signup">Sign Up</button>
                <p>Already have an account? <a href="#" id="show-login-form">Login</a></p>
            </form>

            <!-- Login Form -->
            <form method="POST" class="form" id="login-form" style="display:none;">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#" id="show-signup-form">Sign Up</a></p>
            </form>
        </div>
    </div>

    <script>
        // Toggle between login and signup forms
        document.getElementById('show-login-form').addEventListener('click', function() {
            document.getElementById('signup-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        });

        document.getElementById('show-signup-form').addEventListener('click', function() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('signup-form').style.display = 'block';
        });
    </script>
</body>
</html>
