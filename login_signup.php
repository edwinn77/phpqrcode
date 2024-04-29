<?php
session_start();

// Enable error reporting and display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$successMessage = ""; // Initialize the success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform basic validation (you should add more robust validation)
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        $password = hashPassword($password);
        // Perform database connection
        $conn = mysqli_connect("localhost", "root", "", "fyp");

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        // Prepare and bind parameters to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO login(username, password) VALUES (?,?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            // Set success message
            $successMessage = "Login successful!";
            // Redirect to homepage after 2 seconds
            header("refresh:2; url=tickets.php");
        } else {
            echo "Error inserting data into database: " . mysqli_error($conn);
        }

        // Close statement and connection
        $stmt->close();
        mysqli_close($conn);
    }
}

// Add this function to hash the password
function hashPassword($password) {
    // Replace this with the actual password hashing function you are using
    return password_hash($password, PASSWORD_DEFAULT);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        
        :root {
            --primary-color: #c6c3c3;
            --second-color: #ffffff;
            --black-color: #000000;
        }
        
        body {
            background-image: url(bacground.png);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
        a {
            text-decoration: none;
            color: var(--second-color);
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.2);
        }
        
        .login_box {
            position: relative;
            width: 450px;
            backdrop-filter: blur(25px);
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 7.5em 2.5em 4em 2.5em;
            color: var(--second-color);
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.2);
        }
        
        .login-header {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            width: 140px;
            height: 70px;
            border-radius: 0 0 20px 20px;
        }
        
        .login-header span {
            font-size: 30px;
            color: var(--black-color);
        }
        
        .login-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: -30px;
            width: 30px;
            height: 30px;
            border-top-right-radius: 50%;
            background: transparent;
            box-shadow: 15px 0 0 0 var(--primary-color);
        }
        
        .login-header::after {
            content: "";
            position: absolute;
            top: 0;
            right: -30px;
            width: 30px;
            height: 30px;
            border-top-left-radius: 50%;
            background: transparent;
            box-shadow: -15px 0 0 0 var(--primary-color);
        }
        
        .input_box {
            position: relative;
            display: flex;
            flex-direction: column;
            margin: 20px 0 10px 0; /* Adjust margin-bottom here */
        }
        
        .input-field {
            width: 100%;
            height: 55px;
            font-size: 16px;
            background: transparent;
            color: var(--second-color);
            padding-inline: 20px 50px;
            border: 2px solid var(--primary-color);
            border-radius: 30px;
            outline: none;
        }
        
        #user {
            margin-bottom: 10px;
        }
        
        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            transition: 0.2s;
        }

        .input-submit {
            width: 100%;
            height: 55px;
            font-size: 16px;
            background-color: var(--primary-color);
            color: var(--black-color);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px; /* Adjust space above the button */
        }
        
        .input-field:focus ~ .label,
        .input-field:valid .label {
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 14px;
            background-color: var(--primary-color);
            border-radius: 30px;
            color: var(--black-color);
            padding: 0 10px;
        }
        
        .icon {
            position: absolute;
            top: 18px;
            right: 25px;
            font-size: 20px;
        }
        
        .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 15px;
        margin-top: 20px; /* Adjust margin top as needed */
        margin-bottom: 10px; /* Add bottom margin to move it down */
        }

        
        .forgot a {
            color: var(--second-color);
        }

        .register {
            text-align: center;
            margin-top: 20px; /* Added margin */
        }

        .register a {
            font-weight: 500;
            color: var(--second-color);
            display: inline-block;
            padding: 20px 40px;
            border-radius: 15px;
            background-color: #c7ad7d;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .register a:hover {
            background-color: #b29667;
        }

        .button {
            font-weight: 500;
            color: var(--second-color);
            display: inline-block;
            padding: 20px 20px;
            border-radius: 20px;
            background-color: #c7ad7d;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 10px; /* Add margin */
            width: 100%; /* Ensure same width for all buttons */
            box-sizing: border-box; /* Include padding in the width calculation */
            
        }

        .button:hover {
            background-color: #b29667;
        }

        .guest {
            display: flex;
            justify-content: center;
            align-items: center; /* Center vertically */
            margin-top: 15px; /* Adjust margin as needed */
            text-align: center; /* Center text */
        }
        
        @media only screen and (max-width: 564px) {
            .wrapper {
                padding: 20px;
            }
            
            .login_box {
                padding: 7.5em 1.5em 4em 1.5em;
            }
            
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Login</span>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input_box">
                    <input type="text" name="username" id="user" class="input-field" required>
                    <label for="user" class="label">Username</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" name="password" id="pass" class="input-field" required>
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="submit" class="input-submit button" value="Login">
                </div>
            </form>
            <div class="register">
                <a href="sign_up.php" class="button">Don't have an account? Sign Up</a>
            </div>
            <div class="guest">
                <a href="tickets.php" class="button">Buy as Guest</a>
            </div>

            <?php if ($successMessage): ?>
                <div class="success-message">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>