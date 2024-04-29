<?php
session_start();

// Enable error reporting and display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$successMessage = ""; // Initialize the success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Perform basic validation (you should add more robust validation)
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all fields.";
    } else {
        // Validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email address.";
        } else {
            // Check if passwords match
            if ($password !== $confirm_password) {
                echo "Passwords do not match.";
            } else {
                $password = hashPassword($password);
                $hashed_confirm_password = hashPassword($confirm_password);

                // Perform database connection
                $con = mysqli_connect("localhost", "root", "", "fyp");

                // Check connection
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepare and bind parameters to prevent SQL injection
                $stmt = $con->prepare("INSERT INTO signup (fullname, email, password, confirm_password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $fullname, $email, $password, $hashed_confirm_password);

                if ($stmt->execute()) {
                    // Set success message
                    $successMessage = "Sign up successful!";
                    // Redirect to login page after 2 seconds
                    header("refresh:2; url=login_signup.php");
                } else {
                    echo "Error inserting data into database: " . mysqli_error($con);
                }

                // Close statement and connection
                $stmt->close();
                mysqli_close($con);
            }
        }
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
    <title>Sign Up</title>
    <style>
        /* Your CSS styles here */
        /* Insert your CSS styles here */
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
        
        .signup_box {
            position: relative;
            width: 450px;
            backdrop-filter: blur(25px);
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 7.5em 2.5em 4em 2.5em;
            color: var(--second-color);
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.2);
        }
        
        .signup-header {
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
        
        .signup-header span {
            font-size: 30px;
            color: var(--black-color);
        }
        
        .input_box {
            position: relative;
            display: flex;
            flex-direction: column;
            margin: 20px 0;
        }
        
        .input-field {
            width: 100%;
            height: 55px;
            font-size: 16px;
            background: transparent;
            color: var(--second-color);
            padding-inline: 20px 50px;
            border: 2px solid var(--primary-color);
            border-radius
            : 30px;
            outline: none;
        }
        
        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            transition: 0.2s;
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
        
        .input-submit {
            width: 100%;
            height: 55px;
            font-size: 16px;
            color: var(--second-color);
            background-color: var(--primary-color);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            outline: none;
        }
        
        .input-submit:hover {
            background-color: #b29667;
        }
        
        .login {
            text-align: center;
            margin-top: 20px;
        }
        
        .login a {
            font-weight: 500;
            color: var(--second-color);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .login a:hover {
            color: #b29667;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="signup_box">
            <div class="signup-header">
                <span>Sign Up</span>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input_box">
                    <input type="text" id="fullname" name="fullname" class="input-field" required>
                    <label for="fullname" class="label">Full Name</label>
                </div>
                <div class="input_box">
                    <input type="email" id="email" name="email" class="input-field" required>
                    <label for="email" class="label">Email</label>
                </div>
                <div class="input_box">
                    <input type="password" id="password" name="password" class="input-field" required>
                    <label for="password" class="label">Password</label>
                </div>
                <div class="input_box">
                    <input type="password" id="confirm_password" name="confirm_password" class="input-field" required>
                    <label for="confirm_password" class="label">Confirm Password</label>
                </div>
                <div class="input_box">
                    <input type="submit" class="input-submit" value="Sign Up">
                </div>
            </form>
            <div class="login">
                <a href="login_signup.php" class="button">Already have an account? Login</a>
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
