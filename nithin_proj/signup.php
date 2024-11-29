<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Ensure all required POST data is received
    $name = isset($_POST['NAME']) ? $_POST['NAME'] : '';
    $email = isset($_POST['EMAIL']) ? $_POST['EMAIL'] : '';

    // Check if name and email are provided
    if (empty($name) || empty($email)) {
        die("Error: Name and email are required fields.");
    }

    // Database connection
    $con = new mysqli("localhost", "root", "12345", "DB");  // Change "DB" to your actual database name

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Insert user data
    $sql = "INSERT INTO admin (NAME, EMAIL) VALUES ('$name', '$email')";

    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();  // Closing the database connection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - YOYO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #a39fcf, #d1cfe8);
            font-family: Arial, sans-serif;
        }
        .signup-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        .signup-container h2 {
            font-size: 24px;
            color: #4e4c72;
            margin-bottom: 20px;
        }
        .signup-container .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        .signup-container .input-group input {
            width: 100%;
            padding: 10px;
            padding-left: 40px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            color: #555;
        }
        .signup-container .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #a39fcf;
        }
        .signup-container .signup-btn {
            width: 100%;
            padding: 10px;
            background: #6b5b95;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .signup-container .signup-btn:hover {
            background: #4e4c72;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Create Your Account</h2>
    <form id="signupForm" action="" method="POST">
        <!-- Username -->
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <!-- Email -->
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <!-- Password -->
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <!-- Confirm Password -->
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
        </div>
        <div class="error" id="errorMessage"></div>
        <!-- Submit Button -->
        <a href="index.php">
    <button type="button" class="signup-btn">Sign Up Now</button>
</a>


    </form>
    <div class="social-container">
        <p>Or Sign Up with</p>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
</div>

<script>
    function validateForm() {
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const errorMessage = document.getElementById('errorMessage');

        errorMessage.textContent = '';
        
        if (username === '' || email === '' || password === '' || confirmPassword === '') {
            errorMessage.textContent = 'Please fill in all fields.';
            return;
        }
        if (password !== confirmPassword) {
            errorMessage.textContent = 'Passwords do not match.';
            return;
        }
        if (password.length < 6) {
            errorMessage.textContent = 'Password should be at least 6 characters long.';
            return;
        }
        
        // Submit the form if validation passes
        document.getElementById("signupForm").submit();
    }
</script>

</body>
</html>
