<?php
// Database Connection
ob_start();
// session_destroy();
$servername = "127.0.0.1";
$username = "root";
$password_db = "";  
$database = "int219";

$conn = new mysqli($servername, $username, $password_db, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize Variables
$email = $password = "";
$emailErr = $passwordErr = $generalErr = "";

// Process Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $isValid = true;

    // Email Validation
    if (empty($email)) {
        $emailErr = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $isValid = false;
    }

    // Password Validation
    if (empty($password)) {
        $passwordErr = "Password is required.";
        $isValid = false;
    }

    // If Valid, Check Credentials
    if ($isValid) {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // ✅ Set session variables
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['email'] = $row['email'];  // ✅ Required for login/logout button

                // setcookie("user_id", $row['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                // setcookie("first_name", $row['first_name'], time() + (86400 * 30), "/");
                // setcookie("login-status", "true", time() + (86400 * 30), "/"); // 86400 = 1 day

                header("Location: products.php"); // Redirect to marketplace
                exit();
            } else {
                $generalErr = "Invalid password!";
            }
        } else {
            $generalErr = "Email not registered!";
        }
        $stmt->close();
    }
}



$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Login/Signup - Agriculture Mode</title>
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/29282018/pexels-photo-29282018/free-photo-of-farmer-spraying-pesticide-in-indian-rice-field.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');
            height: 100vh;
            display: flex;
            background-repeat: no-repeat;
            background-size: cover;
            justify-content: center;
            align-items: center;
            color: #333; /* Dark text for contrast */
        }
        .login-container {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            width: 900px; /* Specific width */
            height: 550px; /* Specific height */
            background-color: rgba(255, 255, 255, 0.659); /* White background */
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
        }
        .link {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .link a {
            text-decoration: none;
            color: #777; /* Gray for inactive links */
            transition: .2s all ease;
        }
        .active {
            padding-left: 5px;
            padding-right: 5px;
            color: #4CAF50 !important; /* Green for active link */
            border-bottom: 2px solid #4CAF50;
        }
        .link a:hover {
            color: #4CAF50; /* Green on hover */
        }
        .left-area {
            padding: 40px 60px;
            height: -webkit-fill-available;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .right-area {
            position: relative;
            background-image: url('https://images.pexels.com/photos/30808038/pexels-photo-30808038/free-photo-of-farmer-sorting-rice-grains-in-eastern-sri-lanka.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');
            background-size: cover;
            background-position: center;
            height: -webkit-fill-available;
            width: 50%;
            padding: 40px 60px;
            border-radius: 0 30px 30px 0;
        }
        .welcome-text{
            height: 180px;
            width: 200px;
            background-color: #46c47d5f ;
            backdrop-filter: blur(5px);
            border-radius: 12px;
        }
        .input-area {
            position: relative;
        }
        .input-area span {
            font-size: .8rem;
            color: #777; /* Gray for placeholder text */
            position: absolute;
            top: 15px;
            left: 20px;
            transition: .2s all ease;
        }
        input {
            color: #333; /* Dark text for input */
            background-color: #f5f5f5; /* Light gray background for input */
            width: 80%;
            padding: 30px 20px 10px 20px;
            margin: 5px 0;
            border-radius: 3px;
            border: none;
            outline: none;
            transition: .1s all ease;
        }
        input:focus {
            border-left: 3px solid #4CAF50; /* Green border on focus */
        }
        .input-area input:focus ~ span {
            color: #4CAF50 !important; /* Green text on focus */
            left: 23px;
        }
        .form-top {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .form-top h1, .form-top p {
            margin: 0;
        }
        .form-top p {
            color: #777; /* Gray for description text */
            margin-bottom: 20px;
        }
        .form-bottom {
            width: 90%;
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .checkbox {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .checkbox-container input[type="checkbox"] {
            display: none;
        }
        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #4CAF50; /* Green border for checkbox */
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }
        .custom-checkbox:hover {
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.6); /* Green glow on hover */
        }
        .custom-checkbox::after {
            content: '';
            width: 12px;
            height: 12px;
            background-color: #4CAF50; /* Green fill for checked checkbox */
            display: none;
            border-radius: 2px;
        }
        .checkbox-container input[type="checkbox"]:checked + .custom-checkbox::after {
            display: block;
        }
        .forgot-password {
            text-decoration: none;
            margin: 0;
            color: #777; /* Gray for forgot password */
            transition: .2s all ease;
        }
        .forgot-password:hover {
            color: #4CAF50; /* Green on hover */
        }
        .login-btn {
            font-size: 1rem;
            font-weight: 500;
            width: 150px;
            padding: 10px;
            border-radius: 3px;
            border: none;
            outline: none;
            cursor: pointer;
            background-color: #4CAF50; /* Green button */
            color: white; /* White text */
            animation: glow 4s infinite;
        }
        @keyframes glow {
            0% { box-shadow: 0 0 5px #4CAF50; }
            50% { box-shadow: 0 0 10px #4CAF50, 0 0 20px #4CAF50; }
            100% { box-shadow: 0 0 5px #4CAF50; }
        }
        .social {
            color: #777; /* Gray for social text */
            display: flex;
            align-items: center;
            gap: 30px;
        }
        .social-media {
            display: flex;
            gap: 20px;
        }
        .social-media i {
            cursor: pointer;
            font-size: 1.5rem;
            transition: .2s all ease;
        }
        .social-media i:hover {
            color: #4CAF50; /* Green on hover */
        }
        .welcome {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            background-color: rgba(22, 22, 22, 0.3); /* Semi-transparent dark overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-radius: 0 30px 30px 0;
        }
        .welcome-text {
            text-align: center;
            width: 70%;
        }
        .welcome-text h2 {
            margin: 0;
            font-size: 3rem;
            color: white; /* White text for contrast */
        }
        .welcome-text p {
            color: #ddd; /* Light gray for description text */
        }
        @media screen and (max-width: 800px) {
            .login-container {
                flex-direction: column-reverse;
                width: 100%;
                height: 100%;
                border-radius: 20px;
            }
            .right-area {
                width: -webkit-fill-available;
                border-radius: 20px 20px 0 0;
            }
            .left-area {
                padding: 30px 40px;
                width: -webkit-fill-available;
            }
            .left-area h1 {
                padding-top: 20px;
            }
            .input-area input {
                width: -webkit-fill-available;
            }
            .form-bottom {
                width: -webkit-fill-available;
            }
        }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="left-area">
        <div class="link">
          <a href="marketlogin.php" class="active">Login</a>
          <a href="marketreg.php">Register</a>
        </div>
        <div class="form">
          <div class="form-top">
            <h1>Login Form</h1>
            <p>
                Log in to access your account, manage your settings, and explore personalized features tailored just for you.
            </p>
          </div>
          <form action="marketlogin.php" method="post">
            <div class="input-area">
              <input type="email" placeholder="ghfjW@example.com" name="email" />
              <span>Email</span>
            </div>
            <div class="input-area">
              <input type="password" placeholder="enter your password" name="password"/>
              <span>Password</span>
            </div>
            <div class="form-bottom">
              <div class="checkbox">
                <label class="checkbox-container">
                  <input type="checkbox" checked />
                  <div class="custom-checkbox"></div>
                  Remember me
                </label>
              </div>
              <a href="#" class="forgot-password">Forgot Password</a>
            </div>
            <button type="submit" class="login-btn" name="login">Login</button>
          </form>
        </div>
        <div class="social">
          <p>Login with</p>
          <div class="social-media">
            <div class="social-icon">
              <i class="fa-brands fa-square-facebook"></i>
            </div>
            <div class="social-icon">
              <i class="fa-brands fa-google"></i>
            </div>
            <div class="social-icon">
              <i class="fa-brands fa-x-twitter"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="right-area">
        <div class="welcome">
          <div class="welcome-text">
            <h2>Welcome Back</h2>
            <p>
                Please log in to your Farmer Shop account to access premium agricultural products, monitor your order history, and engage with our network of dedicated local farmers. Your personalized procurement experience is just a click away.
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>