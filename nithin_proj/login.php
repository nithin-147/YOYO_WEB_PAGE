
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
  <link rel="stylesheet" href="./style.css">
  <script>
    function validateForm(event) {
      event.preventDefault(); // Prevent form submission
      
      // Get input values
      var username = document.querySelector(".login__input[type='text']").value;
      var password = document.querySelector(".login__input[type='password']").value;

      // Basic validation
      if (username === "" || password === "") {
        alert("Please fill in both fields");
        return false;
      } else {
        // Submit form if validation passes
        document.querySelector(".login").submit();
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" method="POST" action="" onsubmit="validateForm(event)">
                <div class="login__field">
                    <i class="login__icon fas fa-admin"></i>
                    <input type="text" name="username" class="login__input" placeholder="User name / Email" required>
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" name="password" class="login__input" placeholder="Password" required>
                </div>
                
                <!-- Log In Button -->
                <button class="button login__submit" type="submit">
                    <span class="button__text">Log In Now</span>
                    <a href="index.php" ></a>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
                
                <!-- Sign Up Link -->
                <div style="margin-top: 15px; text-align: center;">
                    <a href="signup.php" class="signup-link">Don't have an account? Sign Up</a>
                </div>
            </form>
        </div>
        
        <!-- Social Login Section -->
        <div class="social-login">
          <h3>Log in via</h3>
          <div class="social-icons">
            <a href="#" class="social-login__icon fab fa-instagram"></a>
            <a href="#" class="social-login__icon fab fa-facebook"></a>
            <a href="#" class="social-login__icon fab fa-twitter"></a>
          </div>
        </div>
        
        <!-- Background Shapes -->
        <div class="screen__background">
          <span class="screen__background__shape screen__background__shape4"></span>
          <span class="screen__background__shape screen__background__shape3"></span>
          <span class="screen__background__shape screen__background__shape2"></span>
          <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
  </div>
</body>
</html>
