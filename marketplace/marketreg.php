<?php
// Database Connection
$servername = "127.0.0.1";
$username = "root";
$password_db = "";  
$database = "int219";

$conn = new mysqli($servername, $username, $password_db, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize Variables
$firstname = $lastname = $email = $password = $repassword = "";
$fullnameErr = $emailErr = $passwordErr = $repasswordErr = $generalErr = "";

// Process Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $repassword = trim($_POST["repassword"]);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $isValid = true;

    // Full Name Validation
    if (empty($firstname)) {
        $fullnameErr = "Full Name is required.";
        $isValid = false;
    }
    if (empty($lastname)) {
        $fullnameErr = "Full Name is required.";
        $isValid = false;
    }

    // Email Validation
    if (empty($email)) {
        $emailErr = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $isValid = false;
    } else {
        // Check if Email Exists
        $sql_check = "SELECT * FROM user WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            $emailErr = "Email already registered.";
            $isValid = false;
        }
        $stmt_check->close();
    }

    // Password Validation
    if (empty($password)) {
        $passwordErr = "Password is required.";
        $isValid = false;
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters long.";
        $isValid = false;
    }

    // Confirm Password Validation
    if (empty($repassword)) {
        $repasswordErr = "Confirm Password is required.";
        $isValid = false;
    } elseif ($password !== $repassword) {
        $repasswordErr = "Passwords do not match.";
        $isValid = false;
    }

    // If Valid, Insert Data
    if ($isValid) {
        $sql = "INSERT INTO user (username, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email, $firstname, $lastname, $email, $password_hash);

        if ($stmt->execute()) {
            header("refresh:0; url=marketlogin.php");
            exit();
        } else {
            $generalErr = "Something went wrong! Please try again.";
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
    <title>Register</title>
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/29282018/pexels-photo-29282018/free-photo-of-farmer-spraying-pesticide-in-indian-rice-field.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .login-container {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            width: 900px; /* Same as login page */
            height: 700px; /* Same as login page */
            background-color: rgba(255, 255, 255, 0.659); 
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            backdrop-filter: blur(10px);
        }
        .link {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 15px;
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
            padding: 40px 60px; /* Same as login page */
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .right-area {
            position: relative;
            background-image: url('https://images.pexels.com/photos/8540158/pexels-photo-8540158.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'); /* Right area image from your registration page */
            background-size: cover;
            background-position: center;
            height: -webkit-fill-available;
            width: 50%;
            padding: 40px 60px;
            border-radius: 0 30px 30px 0;
        }
        .welcome-text{
            height: 150px;
            background-color: #46c47d5f ;
            backdrop-filter: blur(5px);
            border-radius: 12px;
        }
        .input-area {
            position: relative;
            margin-bottom: 10px;
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
            width: 100%;
            padding: 30px 20px 10px 20px; /* Same as login page */
            margin: 0;
            border-radius: 3px;
            border: none;
            outline: none;
            box-sizing: border-box;
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
            margin-bottom: 20px;
        }
        .form-top h1, .form-top p {
            margin: 0;
        }
        .form-top h1 {
            font-size: 1.8rem; /* Same as login page */
        }
        .form-top p {
            color: #777; /* Gray for description text */
            font-size: 0.9rem; /* Same as login page */
        }
        .form-bottom {
            width: 100%;
            margin: 15px 0; /* Same as login page */
            display: flex;
            justify-content: flex-start;
        }
        .reg{
            color: #333;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Same as login page */
            cursor: pointer;
            font-size: 0.9rem; /* Same as login page */
        }
        .checkbox-container input[type="checkbox"] {
            display: none;
        }
        .custom-checkbox {
            width: 18px; /* Same as login page */
            height: 18px; /* Same as login page */
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
            width: 10px; /* Same as login page */
            height: 10px; /* Same as login page */
            background-color: #4CAF50; /* Green fill for checked checkbox */
            display: none;
            border-radius: 2px;
        }
        .checkbox-container input[type="checkbox"]:checked + .custom-checkbox::after {
            display: block;
        }
        .desc{
            color: #333;
        }
        .login-btn {
            font-size: 1rem; /* Same as login page */
            font-weight: 500;
            width: 140px; /* Same as login page */
            padding: 10px; /* Same as login page */
            border-radius: 3px;
            border: none;
            outline: none;
            cursor: pointer;
            background-color: #4CAF50; /* Green button */
            color: white; /* White text */
            animation: glow 4s infinite;
            margin-top: 2px; /* Same as login page */
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
            gap: 20px; /* Same as login page */
            margin-top: 5px; /* Same as login page */
            font-size: 0.9rem; /* Same as login page */
        }
        .social-media {
            display: flex;
            gap: 15px; /* Same as login page */
        }
        .social-media i {
            cursor: pointer;
            font-size: 1.3rem; /* Same as login page */
            transition: .2s all ease;
        }
        .social-media i:hover {
            color: #4CAF50; /* Green on hover */
        }
        .welcome {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(22, 22, 22, 0.3); /* Semi-transparent dark overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-radius: 0 30px 30px 0;
        }
        .welcome-text {
            text-align: center;
            width: 70%; /* Same as login page */
        }
        .welcome-text h2 {
            margin: 0;
            font-size: 2.5rem; /* Same as login page */
            color: white; /* White text for contrast */
        }
        .welcome-text p {
            font-size: 0.95rem; /* Same as login page */
            color: #ddd; /* Light gray for description text */
        }

        @media screen and (max-width: 800px) {
            .login-container {
                flex-direction: column-reverse;
                width: 100%;
                max-width: 400px;
                height: auto;
                border-radius: 20px;
                padding: 15px;
            }
            .right-area {
                width: 100%;
                border-radius: 20px 20px 0 0;
                min-height: 180px; /* Adjusted for smaller container */
            }
            .left-area {
                padding: 20px;
                width: 100%;
            }
            .form-top h1 {
                padding-top: 10px;
            }
            .input-area input {
                width: 100%;
            }
            .form-bottom {
                width: 100%;
            }
            .welcome-text h2 {
                font-size: 1.8rem; /* Adjusted for smaller screens */
            }
        }
        span{
            color: red;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
    </style>
  </head>
  <body>

    <div class="login-container">
      <div class="left-area">
        <div class="link">
          <a href="marketlogin.php">Login</a>
          <a href="marketreg.php" class="active">Register</a>
        </div>
        <div class="form">
          <div class="form-top">
            <h1 class="reg">Register Now</h1>
            <p>Create your account and join our community today.</p>
          </div>

          <form action="marketreg.php" method="post">
            <div class="input-area">
              <input type="text" placeholder="John" name="firstname" />
              <span>First Name</span>
            </div>
            <div class="input-area">
              <input type="text" placeholder="Doe" name="lastname" />
              <span>Last Name</span>
            </div>
            <span class="error"><?php echo $fullnameErr; ?></span>
            <div class="input-area">
              <input type="email" placeholder="example@domain.com" name="email" />
              <span>Email</span>
            </div>
            <span class="error"><?php echo $emailErr; ?></span>
            <div class="input-area">
              <input type="password" placeholder="enter your password" name="password" />
              <span>Password</span>
            </div>
            <span class="error"><?php echo $passwordErr; ?></span>
            <div class="input-area">
              <input type="password" placeholder="confirm your password"  name="repassword"/>
              <span>Confirm Password</span>
            </div>
            <span class="error"><?php echo $repasswordErr; ?></span>
            <div class="form-bottom">
              <label class="checkbox-container">
                <input type="checkbox" />
                <div class="custom-checkbox"></div>
                <p class="desc">I agree to the Terms & Conditions</p>
              </label>
            </div>

            <button type="submit" class="login-btn" name="submit">Register</button>
            <span class="error"><?php echo $generalErr; ?></span>
          </form>
        </div>
        <div class="social">
          <p>Register with</p>
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
            <h2>Join Us</h2>
            <p>
                Sign up today and join our farmer marketplace! Buy, sell, and thrive with the best deals in our growing community!
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>